<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resident;

class ResidentController extends Controller
{
    public function index(Request $request)
    {
        $query = Resident::query();

        // Search by name or Resident ID
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('resident_id', 'LIKE', "%{$search}%")
                  ->orWhere('first_name', 'LIKE', "%{$search}%")
                  ->orWhere('last_name', 'LIKE', "%{$search}%")
                  ->orWhere('middle_name', 'LIKE', "%{$search}%");
            });
        }

        // Filter by Verification Status
        if ($request->filled('verification_status') && $request->verification_status !== 'All') {
            $query->where('verification_status', $request->verification_status);
        }

        // Filter by Purok
        if ($request->filled('purok') && $request->purok !== 'All') {
            $query->where('purok', $request->purok);
        }

        // Filter by Sector
        if ($request->filled('sector') && $request->sector !== 'All') {
            match($request->sector) {
                'Senior' => $query->where('is_senior', 1),
                'PWD' => $query->where('is_pwd', 1),
                '4Ps' => $query->where('is_4ps', 1),
                'Indigent' => $query->where('is_indigent', 1),
                'SoloParent' => $query->where('is_solo_parent', 1),
                'Voter' => $query->where('voter_status', 'Registered'),
                default => null
            };
        }

        $residents = $query->orderByRaw("FIELD(verification_status, 'Pending Verification', 'Rejected', 'Verified') ASC")
            ->orderBy('last_name')
            ->paginate(15)
            ->withQueryString();

        $totalCount = Resident::count();
        $pendingCount = Resident::where('verification_status', 'Pending Verification')->count();
        $pendingResidents = Resident::where('verification_status', 'Pending Verification')->latest()->take(10)->get();

        $puroks = [
            'Purok 1', 'Purok 2', 'Purok 3', 'Purok 4', 'Purok 5', 
            'Purok 6', 'Purok 7', 'Sitio Ilawod', 'Sitio Ilaya'
        ];

        return view('admin.residents.index', compact('residents', 'totalCount', 'pendingCount', 'pendingResidents', 'puroks'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:50',
            'middle_name' => 'nullable|string|max:50',
            'last_name' => 'required|string|max:50',
            'suffix' => 'nullable|string|max:10',
            'gender' => 'required|in:Male,Female,Other',
            'birth_date' => 'required|date',
            'civil_status' => 'required|in:Single,Married,Widowed,Separated',
            'purok' => 'required|string',
            'address' => 'required|string|max:255',
            'contact_no' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:100',
            'occupation' => 'nullable|string|max:100',
            'monthly_income' => 'nullable|numeric|min:0',
            'voter_status' => 'required|in:Registered,Not Registered',
            'voter_precinct' => 'nullable|string|max:20',
        ]);

        // Auto-generate unique DAC-YYYY-XXXX ID
        do {
            $randNum = mt_rand(1000, 9999);
            $residentId = 'DAC-' . date('Y') . '-' . $randNum;
        } while (Resident::where('resident_id', $residentId)->exists());

        // Derive Senior citizen flag if age >= 60
        $birthDate = new \DateTime($validated['birth_date']);
        $age = $birthDate->diff(new \DateTime())->y;
        $isSenior = $age >= 60 || $request->has('is_senior');

        $resident = Resident::create([
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
            'contact_no' => $validated['contact_no'] ?? null,
            'email' => $validated['email'] ?? null,
            'occupation' => $validated['occupation'] ?? 'None',
            'monthly_income' => $validated['monthly_income'] ?? 0.00,
            'voter_status' => $validated['voter_status'],
            'voter_precinct' => $validated['voter_precinct'] ?? null,
            'is_senior' => $isSenior,
            'is_pwd' => $request->has('is_pwd'),
            'is_indigent' => $request->has('is_indigent'),
            'is_4ps' => $request->has('is_4ps'),
            'is_solo_parent' => $request->has('is_solo_parent'),
            'photo' => 'https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?auto=format&fit=crop&w=200&q=80',
        ]);

        return redirect()->route('admin.residents.index')
            ->with('success', "Resident {$resident->full_name} ({$resident->resident_id}) registered successfully!");
    }

    public function show($id)
    {
        $resident = Resident::findOrFail($id);
        return response()->json($resident);
    }

    public function update(Request $request, $id)
    {
        $resident = Resident::findOrFail($id);

        $validated = $request->validate([
            'first_name' => 'required|string|max:50',
            'middle_name' => 'nullable|string|max:50',
            'last_name' => 'required|string|max:50',
            'suffix' => 'nullable|string|max:10',
            'gender' => 'required|in:Male,Female,Other',
            'birth_date' => 'required|date',
            'civil_status' => 'required|in:Single,Married,Widowed,Separated',
            'purok' => 'required|string',
            'address' => 'required|string|max:255',
            'contact_no' => 'nullable|string|max:20',
            'occupation' => 'nullable|string|max:100',
            'monthly_income' => 'nullable|numeric|min:0',
            'voter_status' => 'required|in:Registered,Not Registered',
        ]);

        $birthDate = new \DateTime($validated['birth_date']);
        $isSenior = $birthDate->diff(new \DateTime())->y >= 60 || $request->has('is_senior');

        $resident->update(array_merge($validated, [
            'is_senior' => $isSenior,
            'is_pwd' => $request->has('is_pwd'),
            'is_indigent' => $request->has('is_indigent'),
            'is_4ps' => $request->has('is_4ps'),
            'is_solo_parent' => $request->has('is_solo_parent'),
        ]));

        return redirect()->route('admin.residents.index')
            ->with('success', "Resident {$resident->full_name} updated successfully.");
    }

    public function destroy($id)
    {
        $resident = Resident::findOrFail($id);
        $name = $resident->full_name;
        $resident->delete();

        return redirect()->route('admin.residents.index')
            ->with('info', "Resident record for {$name} has been archived/deleted.");
    }

    /**
     * Approve resident identity verification based on submitted ID and selfie.
     */
    public function verifyIdentity($id)
    {
        $resident = Resident::findOrFail($id);
        $officerName = auth()->user()?->name ?? 'Barangay Secretary';
        $resident->verification_status = 'Verified';
        $resident->verification_remarks = "Identity approved by {$officerName} (Secretary/Clerk) on " . now()->format('M d, Y h:i A') . " based on inspection of attached {$resident->id_type} and resident selfie.";
        $resident->save();

        return back()->with('success', "Resident {$resident->full_name} ({$resident->resident_id}) has been officially VERIFIED. Resident Portal access is now active!");
    }

    /**
     * Reject resident identity verification with specific remarks/deficiencies.
     */
    public function rejectIdentity(Request $request, $id)
    {
        $request->validate([
            'remarks' => 'required|string|max:500',
        ]);

        $resident = Resident::findOrFail($id);
        $officerName = auth()->user()?->name ?? 'Barangay Secretary';
        $resident->verification_status = 'Rejected';
        $resident->verification_remarks = "Rejected by {$officerName}: " . $request->remarks;
        $resident->save();

        return back()->with('info', "Identity verification for {$resident->full_name} has been marked as Rejected. Remarks: {$request->remarks}");
    }
}
