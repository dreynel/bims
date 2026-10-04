<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Resident;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            return Auth::user()->isResident()
                ? redirect()->route('resident.dashboard')
                : redirect()->route('admin.dashboard');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ]);

        // Support login by email OR username
        $loginType = filter_var($credentials['login'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $authAttempt = Auth::attempt([
            $loginType => $credentials['login'],
            'password' => $credentials['password']
        ], $request->has('remember'));

        if ($authAttempt) {
            $request->session()->regenerate();
            $user = Auth::user();

            if ($user->isResident()) {
                $resident = $user->resident ?? Resident::where('email', $user->email)->first();
                if (!$resident || $resident->verification_status !== 'Verified') {
                    return redirect()->route('resident.pending')
                        ->with('info', "Your resident account is awaiting identity verification by the Barangay Secretary.");
                }

                $intended = session()->get('url.intended');
                if ($intended && str_contains($intended, '/admin')) {
                    session()->forget('url.intended');
                }
                return redirect()->intended(route('resident.dashboard'))
                    ->with('success', "Mabuhay, {$user->name}! Welcome to your Barangay Dacutan Resident Portal.");
            }

            $intended = session()->get('url.intended');
            if ($intended && str_contains($intended, '/resident')) {
                session()->forget('url.intended');
            }
            return redirect()->intended(route('admin.dashboard'))
                ->with('success', "Welcome back, {$user->name} (" . ($user->role === 'captain' ? 'Punong Barangay' : 'Barangay Secretary & Clerk') . ")!");
        }

        return back()->withErrors([
            'login' => 'The provided credentials do not match our official records.',
        ])->onlyInput('login');
    }

    public function showRegister()
    {
        if (Auth::check()) {
            return Auth::user()->isResident()
                ? redirect()->route('resident.dashboard')
                : redirect()->route('admin.dashboard');
        }
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:100',
            'middle_name' => 'nullable|string|max:100',
            'last_name' => 'required|string|max:100',
            'suffix' => 'nullable|string|max:20',
            'gender' => 'required|in:Male,Female',
            'birth_date' => 'required|date|before:today',
            'civil_status' => 'required|in:Single,Married,Widowed,Separated',
            'purok' => 'required|string',
            'address' => 'required|string|max:255',
            'contact_no' => 'required|string|max:30',
            'email' => 'required|email|max:150|unique:users,email',
            'username' => 'required|string|max:50|alpha_dash|unique:users,username',
            'password' => 'required|string|min:6|confirmed',
            'id_type' => 'required|string|max:100',
            'id_number' => 'required|string|max:100',
            'id_photo' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:5120',
            'proof_of_residency' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:5120',
            'sworn_statement' => 'required|accepted',
        ]);

        // Upload verification identity files (or use sample demo asset if omitted during testing)
        $idPhotoPath = $request->hasFile('id_photo')
            ? asset('storage/' . $request->file('id_photo')->store('identities', 'public'))
            : asset('assets/images/logo.svg');

        $proofPath = $request->hasFile('proof_of_residency')
            ? asset('storage/' . $request->file('proof_of_residency')->store('identities', 'public'))
            : asset('assets/images/logo.svg');

        $fullName = trim("{$validated['first_name']} " . ($validated['middle_name'] ? "{$validated['middle_name']} " : "") . "{$validated['last_name']}" . ($validated['suffix'] ? " {$validated['suffix']}" : ""));

        // 1. Create User account with role 'resident' (no email OTP needed; Secretary verifies identity)
        $user = User::create([
            'name' => $fullName,
            'email' => $validated['email'],
            'username' => $validated['username'],
            'role' => 'resident',
            'password' => Hash::make($validated['password']),
            'avatar' => $idPhotoPath,
            'email_verified_at' => now(),
        ]);

        // 2. Create Resident Census & Identity Record with 'Pending Verification'
        $residentId = 'DAC-' . date('Y') . '-' . str_pad(mt_rand(1, 9999), 4, '0', STR_PAD_LEFT);
        $resident = Resident::create([
            'user_id' => $user->id,
            'resident_id' => $residentId,
            'first_name' => $validated['first_name'],
            'middle_name' => $validated['middle_name'] ?? null,
            'last_name' => $validated['last_name'],
            'suffix' => $validated['suffix'] ?? null,
            'gender' => $validated['gender'],
            'birth_date' => $validated['birth_date'],
            'civil_status' => $validated['civil_status'],
            'purok' => $validated['purok'],
            'address' => $validated['address'],
            'contact_no' => $validated['contact_no'],
            'email' => $validated['email'],
            'id_type' => $validated['id_type'],
            'id_number' => $validated['id_number'],
            'id_photo' => $idPhotoPath,
            'proof_of_residency' => $proofPath,
            'verification_status' => 'Pending Verification',
            'verification_remarks' => 'Online self-registration submitted. Awaiting clerical review of attached ID and selfie by Barangay Secretary.',
            'photo' => $idPhotoPath,
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        // Redirect directly to Pending Verification screen
        return redirect()->route('resident.pending')
            ->with('info', "Registration submitted successfully! Your account is currently pending clerical verification by the Barangay Secretary based on your attached ID and selfie.");
    }

    public function quickLogin($role)
    {
        // STRICTLY 3 ROLES ONLY:
        // 1. captain (Punong Barangay)
        // 2. secretary (Barangay Secretary & Clerk)
        // 3. resident (Barangay Resident)
        $roleMap = [
            'captain' => 'captain.dacutan@dumangas.gov.ph',
            'secretary' => 'sec.fernandez@dumangas.gov.ph',
            'resident' => 'juan.dacutan@gmail.com',
        ];

        $email = $roleMap[$role] ?? 'captain.dacutan@dumangas.gov.ph';
        $user = User::where('email', $email)->first();

        if ($user) {
            Auth::login($user);
            request()->session()->regenerate();

            if ($user->isResident()) {
                return redirect()->route('resident.dashboard')
                    ->with('success', "Quick Demo Login: Authenticated as Verified Resident {$user->name}");
            }

            return redirect()->route('admin.dashboard')
                ->with('success', "Quick Demo Login: Authenticated as {$user->name} (" . ($user->role === 'captain' ? 'Punong Barangay' : 'Barangay Secretary & Clerk') . ")");
        }

        return redirect()->route('login')->with('error', 'Demo user not found.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('info', 'You have been successfully signed out of the system.');
    }
}
