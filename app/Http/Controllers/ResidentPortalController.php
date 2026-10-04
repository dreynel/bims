<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Certificate;
use App\Models\Resident;
use App\Models\AidDistribution;

class ResidentPortalController extends Controller
{
    /**
     * Helper to retrieve resident and user context with Barangay Secretary verification check.
     */
    private function getResidentContext()
    {
        $user = Auth::user();
        if (!$user) {
            return [null, null, redirect()->route('login')];
        }

        $resident = $user->resident ?? Resident::where('email', $user->email)->first();

        if ($user->isResident()) {
            if (!$resident || $resident->verification_status !== 'Verified') {
                return [null, null, redirect()->route('resident.pending')
                    ->with('info', 'Your resident account is awaiting identity verification by the Barangay Secretary.')];
            }
        }

        return [$user, $resident, null];
    }

    /**
     * Show pending approval screen for unverified applicants.
     */
    public function pendingApproval()
    {
        $user = Auth::user();
        $resident = $user ? (Resident::where('user_id', $user->id)->orWhere('email', $user->email)->first()) : null;

        if ($resident && $resident->verification_status === 'Verified') {
            return redirect()->route('resident.dashboard');
        }

        return view('resident.pending-approval', compact('user', 'resident'));
    }

    /**
     * AJAX endpoint to check live verification status after registration.
     */
    public function checkVerificationStatus()
    {
        $user = Auth::user();
        $resident = $user ? (Resident::where('user_id', $user->id)->orWhere('email', $user->email)->first()) : null;

        $status = $resident?->verification_status ?? 'Pending Verification';
        $remarks = $resident?->verification_remarks ?? '';
        $isVerified = ($status === 'Verified');
        $isRejected = ($status === 'Rejected');

        return response()->json([
            'success' => true,
            'status' => $status,
            'is_verified' => $isVerified,
            'is_rejected' => $isRejected,
            'remarks' => $remarks,
            'resident_id' => $resident?->resident_id,
            'full_name' => $resident?->full_name ?? $user?->name,
            'redirect' => $isVerified ? route('resident.dashboard') : null,
        ]);
    }

    /**
     * Query all certificate applications belonging to current resident.
     */
    private function getCertificatesQuery($user, $resident)
    {
        $query = Certificate::query();
        if ($resident) {
            $query->where(function ($q) use ($resident, $user) {
                $q->where('resident_id', $resident->id)
                  ->orWhere('email', $user->email)
                  ->orWhere('citizen_name', $resident->full_name);
            });
        } else {
            $query->where('email', $user->email);
        }
        return $query;
    }

    /**
     * Resident Dashboard Overview
     */
    public function dashboard()
    {
        [$user, $resident, $redirect] = $this->getResidentContext();
        if ($redirect) return $redirect;

        $query = $this->getCertificatesQuery($user, $resident);
        $myCertificates = $query->latest()->get();

        $stats = [
            'total' => $myCertificates->count(),
            'pending' => $myCertificates->whereIn('status', ['Pending', 'Evaluated'])->count(),
            'approved' => $myCertificates->whereIn('status', ['Approved', 'Ready for Release'])->count(),
            'claimed' => $myCertificates->where('status', 'Claimed')->count(),
        ];

        $recentCertificates = $myCertificates->take(5);

        $recentAid = $resident 
            ? AidDistribution::where('resident_id', $resident->id)->latest('distribution_date')->take(3)->get()
            : collect();

        return view('resident.dashboard', compact('user', 'resident', 'recentCertificates', 'stats', 'recentAid', 'myCertificates'));
    }

    /**
     * Review Requests & Applications
     */
    public function requests(Request $request)
    {
        [$user, $resident, $redirect] = $this->getResidentContext();
        if ($redirect) return $redirect;

        $statusFilter = $request->query('status', 'all');
        $search = $request->query('search');

        $baseQuery = $this->getCertificatesQuery($user, $resident);

        // Counts for tab badges
        $allCerts = (clone $baseQuery)->get();
        $counts = [
            'all' => $allCerts->count(),
            'review' => $allCerts->whereIn('status', ['Pending', 'Evaluated'])->count(),
            'ready' => $allCerts->whereIn('status', ['Approved', 'Ready for Release'])->count(),
            'claimed' => $allCerts->where('status', 'Claimed')->count(),
            'cancelled' => $allCerts->whereIn('status', ['Cancelled', 'Rejected'])->count(),
        ];

        $query = clone $baseQuery;

        if ($statusFilter === 'review') {
            $query->whereIn('status', ['Pending', 'Evaluated']);
        } elseif ($statusFilter === 'ready') {
            $query->whereIn('status', ['Approved', 'Ready for Release']);
        } elseif ($statusFilter === 'claimed') {
            $query->where('status', 'Claimed');
        } elseif ($statusFilter === 'cancelled') {
            $query->whereIn('status', ['Cancelled', 'Rejected']);
        }

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('control_no', 'like', "%{$search}%")
                  ->orWhere('doc_type', 'like', "%{$search}%")
                  ->orWhere('purpose', 'like', "%{$search}%")
                  ->orWhere('or_no', 'like', "%{$search}%");
            });
        }

        $certificates = $query->latest()->get();

        return view('resident.requests', compact('user', 'resident', 'certificates', 'statusFilter', 'search', 'counts'));
    }

    /**
     * Show single request details (JSON for Interactive Review Modal)
     */
    public function showRequest($id)
    {
        [$user, $resident, $redirect] = $this->getResidentContext();
        if ($redirect) return response()->json(['error' => 'Unverified'], 403);

        $cert = Certificate::findOrFail($id);

        $isOwner = ($cert->email === $user->email) ||
                   ($resident && $cert->resident_id === $resident->id) ||
                   (strcasecmp($cert->citizen_name, $user->name) === 0);

        if (!$isOwner && !$user->isOfficial()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        return response()->json([
            'success' => true,
            'certificate' => [
                'id' => $cert->id,
                'control_no' => $cert->control_no,
                'doc_type' => $cert->doc_type,
                'purpose' => $cert->purpose,
                'status' => $cert->status,
                'amount_paid' => number_format($cert->amount_paid, 2),
                'or_no' => $cert->or_no ?? 'Pending Issuance',
                'ctc_no' => $cert->ctc_no ?? 'Not Provided',
                'purok' => $cert->purok,
                'citizen_name' => $cert->citizen_name,
                'contact_no' => $cert->contact_no,
                'created_at' => $cert->created_at->format('M d, Y h:i A'),
                'issue_date' => $cert->issue_date ? $cert->issue_date->format('M d, Y') : null,
                'issued_by' => $cert->issued_by ?? 'Barangay Dacutan Administration',
                'remarks' => $cert->remarks ?? 'Awaiting clerical evaluation by Barangay Secretary.',
            ],
            'timeline' => [
                'submitted' => [
                    'label' => 'Application Filed',
                    'timestamp' => $cert->created_at->format('M d, Y h:i A'),
                    'completed' => true,
                    'actor' => 'Citizen Self-Service'
                ],
                'clerical' => [
                    'label' => 'Clerical Evaluation & Records Clearance',
                    'completed' => in_array($cert->status, ['Evaluated', 'Approved', 'Ready for Release', 'Claimed']),
                    'actor' => 'Mrs. Ma. Elena Balleza (Brgy Secretary & Clerk)'
                ],
                'executive' => [
                    'label' => 'Punong Barangay Administrative Sanction',
                    'completed' => in_array($cert->status, ['Approved', 'Ready for Release', 'Claimed']),
                    'actor' => 'Hon. Roberto D. Dacutan (Punong Barangay)'
                ],
                'releasing' => [
                    'label' => 'Document Printed, Stamped & Ready for Pickup',
                    'completed' => in_array($cert->status, ['Ready for Release', 'Claimed']),
                    'location' => 'Barangay Hall Window 1 (Document Releasing Desk)'
                ],
                'claimed' => [
                    'label' => 'Released to Resident / Completed',
                    'completed' => ($cert->status === 'Claimed'),
                ]
            ],
            'actions' => [
                'can_print' => in_array($cert->status, ['Approved', 'Ready for Release', 'Claimed']),
                'print_url' => route('resident.certificates.print', $cert->id),
                'claim_stub_url' => route('resident.requests.claim-stub', $cert->id),
                'can_cancel' => ($cert->status === 'Pending'),
                'cancel_url' => route('resident.requests.cancel', $cert->id),
            ]
        ]);
    }

    /**
     * Submit Document Application
     */
    public function submitApplication(Request $request)
    {
        $user = Auth::user();
        $resident = $user->resident ?? Resident::where('email', $user->email)->first();

        $validated = $request->validate([
            'doc_type' => 'required|string',
            'purpose' => 'required|string|max:255',
            'ctc_no' => 'nullable|string|max:50',
        ]);

        $fees = [
            'Barangay Clearance' => 50.00,
            'Barangay Clearance / Certificate' => 50.00,
            'Certificate of Residency' => 50.00,
            'Certificate of Indigency' => 0.00,
            'Certificate of Good Moral Character' => 50.00,
            'First Time Job Seeker (RA 11261)' => 0.00,
            'First-Time Jobseeker Certification (RA 11261)' => 0.00,
            'Barangay ID' => 50.00,
            'Solo Parent Barangay Certification' => 0.00,
            'Barangay Business Clearance' => 150.00,
            'Barangay Business Clearance / Permit' => 150.00,
            'Barangay Building / Construction Clearance' => 200.00,
            'Certificate of No Objection (CNO)' => 100.00,
            'Barangay Blotter Certification' => 50.00,
            'Certification to File Action' => 100.00,
        ];
        $amountPaid = $fees[$validated['doc_type']] ?? 50.00;

        $randNum = mt_rand(1000, 9999);
        $controlNo = 'DAC-' . date('Y') . '-' . $randNum;

        $citizenName = $resident ? $resident->full_name : $user->name;
        $contactNo = $resident?->contact_no ?? 'N/A';
        $purok = $resident?->purok ?? 'Purok 1';

        $certificate = Certificate::create([
            'control_no' => $controlNo,
            'resident_id' => $resident?->id,
            'citizen_name' => $citizenName,
            'contact_no' => $contactNo,
            'email' => $user->email,
            'purok' => $purok,
            'doc_type' => $validated['doc_type'],
            'purpose' => $validated['purpose'],
            'ctc_no' => $validated['ctc_no'] ?? null,
            'amount_paid' => $amountPaid,
            'status' => 'Pending',
        ]);

        // Send confirmation email
        if (!empty($user->email)) {
            try {
                \Illuminate\Support\Facades\Mail::to($user->email)->send(new \App\Mail\CertificateStatusUpdated($certificate));
            } catch (\Throwable $e) {
                \Illuminate\Support\Facades\Log::warning("Failed sending resident portal email: " . $e->getMessage());
            }
        }

        return redirect()->route('resident.dashboard')
            ->with('success', "Your application for {$validated['doc_type']} has been submitted with Reference No. {$controlNo}!");
    }

    /**
     * Cancel an application if still Pending
     */
    public function cancelApplication($id)
    {
        [$user, $resident, $redirect] = $this->getResidentContext();
        if ($redirect) return $redirect;

        $certificate = Certificate::findOrFail($id);

        $isOwner = ($certificate->email === $user->email) ||
                   ($resident && $certificate->resident_id === $resident->id) ||
                   (strcasecmp($certificate->citizen_name, $user->name) === 0);

        if (!$isOwner) {
            abort(403, 'Unauthorized action.');
        }

        if ($certificate->status !== 'Pending') {
            return back()->with('error', 'Only applications in "Pending" status can be cancelled. This request is already being processed.');
        }

        $certificate->status = 'Cancelled';
        $certificate->remarks = 'Application cancelled by applicant on ' . now()->format('M d, Y h:i A') . '.';
        $certificate->save();

        return back()->with('success', "Application {$certificate->control_no} has been cancelled successfully.");
    }

    /**
     * Print Official Claim Stub / Acknowledgment Slip
     */
    public function printClaimStub($id)
    {
        [$user, $resident, $redirect] = $this->getResidentContext();
        if ($redirect) return $redirect;

        $certificate = Certificate::with('resident')->findOrFail($id);

        $isOwner = ($certificate->email === $user->email) ||
                   ($resident && $certificate->resident_id === $resident->id) ||
                   (strcasecmp($certificate->citizen_name, $user->name) === 0);

        if (!$isOwner && !$user->isOfficial()) {
            abort(403, 'Unauthorized access to this document.');
        }

        return view('resident.claim-stub', compact('certificate', 'user', 'resident'));
    }

    /**
     * Resident Profile & Verified Identity Record
     */
    public function profile()
    {
        [$user, $resident, $redirect] = $this->getResidentContext();
        if ($redirect) return $redirect;

        return view('resident.profile', compact('user', 'resident'));
    }

    /**
     * Update Contact / Address / Password
     */
    public function updateProfile(Request $request)
    {
        [$user, $resident, $redirect] = $this->getResidentContext();
        if ($redirect) return $redirect;

        $request->validate([
            'contact_no' => 'required|string|max:30',
            'address' => 'required|string|max:255',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        if ($resident) {
            $resident->update([
                'contact_no' => $request->contact_no,
                'address' => $request->address,
            ]);
        }

        if ($request->filled('password')) {
            $user->update([
                'password' => Hash::make($request->password),
            ]);
        }

        return back()->with('success', 'Your resident profile information has been successfully updated.');
    }

    /**
     * Aid & Relief Distribution History
     */
    public function aidHistory()
    {
        [$user, $resident, $redirect] = $this->getResidentContext();
        if ($redirect) return $redirect;

        $aidDistributions = $resident 
            ? AidDistribution::where('resident_id', $resident->id)->latest('distribution_date')->get()
            : collect();

        // Community relief advisories
        $reliefPrograms = [
            [
                'title' => 'LGU Coastal Calamity & Typhoon Relief Buffer Stock',
                'schedule' => 'Immediate deployment during active PAGASA Storm Signals',
                'location' => 'Barangay Dacutan Covered Gym & Evacuation Center',
                'target' => 'Registered Purok 1 to Purok 7 coastal & low-lying households',
                'status' => 'Active Preparedness',
            ],
            [
                'title' => 'Quarterly Senior Citizen & PWD Medical Subsidy',
                'schedule' => 'First Friday of every quarter (8:00 AM - 3:00 PM)',
                'location' => 'Barangay Health Center',
                'target' => 'Verified Senior Citizens (60+) & PWD Identification card holders',
                'status' => 'Ongoing Enrollment',
            ],
            [
                'title' => 'DSWD Assistance to Individuals in Crisis Situations (AICS)',
                'schedule' => 'Endorsement scheduling through Barangay Secretary Window 1',
                'location' => 'Dumangas Municipal Social Welfare & Development Office (MSWDO)',
                'target' => 'Bona fide indigent families with medical or burial emergencies',
                'status' => 'Open Referral',
            ],
        ];

        return view('resident.aid-history', compact('user', 'resident', 'aidDistributions', 'reliefPrograms'));
    }

    /**
     * Barangay Services & Help Desk
     */
    public function helpDesk()
    {
        [$user, $resident, $redirect] = $this->getResidentContext();
        if ($redirect) return $redirect;

        return view('resident.help', compact('user', 'resident'));
    }

    /**
     * Print Approved Clearance in A4 layout
     */
    public function printCertificate($id)
    {
        $user = Auth::user();
        $certificate = Certificate::with('resident')->findOrFail($id);

        $resident = $user->resident;
        $isOwner = ($certificate->email === $user->email) ||
                   ($resident && $certificate->resident_id === $resident->id) ||
                   (strcasecmp($certificate->citizen_name, $user->name) === 0);

        if (!$isOwner && !$user->isOfficial()) {
            abort(403, 'Unauthorized access to this official document.');
        }

        return view('admin.certificates.print', compact('certificate'));
    }
}
