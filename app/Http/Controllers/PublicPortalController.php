<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Certificate;
use App\Models\Resident;

class PublicPortalController extends Controller
{
    public function index()
    {
        $officials = [
            ['name' => 'Hon. Roberto D. Dacutan', 'role' => 'Punong Barangay', 'committee' => 'Overall Executive Governance & Peace and Order', 'avatar' => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?auto=format&fit=crop&w=150&q=80'],
            ['name' => 'Hon. Arnel B. Defensor', 'role' => 'Barangay Kagawad', 'committee' => 'Committee on Peace & Order / Lupon', 'avatar' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=150&q=80'],
            ['name' => 'Hon. Maria Teresa S. Balleza', 'role' => 'Barangay Kagawad', 'committee' => 'Committee on Health & Sanitation', 'avatar' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=150&q=80'],
            ['name' => 'Hon. Rommel J. Demaisip', 'role' => 'Barangay Kagawad', 'committee' => 'Committee on Agriculture & Fisheries', 'avatar' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=150&q=80'],
            ['name' => 'Hon. Carmen L. Villanueva', 'role' => 'Barangay Kagawad', 'committee' => 'Committee on Appropriations & Budget', 'avatar' => 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?auto=format&fit=crop&w=150&q=80'],
            ['name' => 'Hon. Jose Marie G. Tupas', 'role' => 'Barangay Kagawad', 'committee' => 'Committee on Infrastructure & Roads', 'avatar' => 'https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?auto=format&fit=crop&w=150&q=80'],
            ['name' => 'Hon. Antonio P. Alcantara', 'role' => 'Barangay Kagawad', 'committee' => 'Committee on Education & Culture', 'avatar' => 'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?auto=format&fit=crop&w=150&q=80'],
            ['name' => 'Hon. Nelson V. Solis', 'role' => 'Barangay Kagawad', 'committee' => 'Committee on Environment & Disaster Preparedness', 'avatar' => 'https://images.unsplash.com/photo-1522075469751-3a6694fb2f61?auto=format&fit=crop&w=150&q=80'],
            ['name' => 'Hon. Bea Andrea Divinagracia', 'role' => 'SK Chairperson', 'committee' => 'Committee on Youth & Sports Development', 'avatar' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=150&q=80'],
            ['name' => 'Mrs. Ma. Elena Balleza', 'role' => 'Barangay Secretary', 'committee' => 'Administrative Records, Clearances & Archives', 'avatar' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&w=150&q=80'],
            ['name' => 'Mr. Jose Mari Demaisip', 'role' => 'Barangay Treasurer', 'committee' => 'Barangay Revenues & Financial Management', 'avatar' => 'https://images.unsplash.com/photo-1463453091185-61582044d556?auto=format&fit=crop&w=150&q=80'],
        ];

        return view('public.home', compact('officials'));
    }

    public function submitRequest(Request $request)
    {
        if (!$request->filled('citizen_name') && $request->filled('first_name')) {
            $request->merge([
                'citizen_name' => trim($request->input('first_name') . ' ' . $request->input('last_name'))
            ]);
        }

        $validated = $request->validate([
            'citizen_name' => 'required|string|max:150',
            'contact_no' => 'required|string|max:30',
            'email' => 'nullable|email|max:150',
            'purok' => 'required|string',
            'doc_type' => 'required|string',
            'purpose' => 'required|string|max:255',
            'ctc_no' => 'nullable|string|max:50',
        ]);

        // Fee logic for all 12 document offerings
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

        // Generate unique tracking code DAC-YYYY-XXXX
        $randNum = mt_rand(1000, 9999);
        $controlNo = 'DAC-' . date('Y') . '-' . $randNum;

        // Link with resident if exists
        $resident = Resident::whereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ["%{$validated['citizen_name']}%"])->first();
        $citizenEmail = $validated['email'] ?? $resident?->email;

        $certificate = Certificate::create([
            'control_no' => $controlNo,
            'resident_id' => $resident?->id,
            'citizen_name' => $validated['citizen_name'],
            'contact_no' => $validated['contact_no'],
            'email' => $citizenEmail,
            'purok' => $validated['purok'],
            'doc_type' => $validated['doc_type'],
            'purpose' => $validated['purpose'],
            'ctc_no' => $validated['ctc_no'] ?? null,
            'amount_paid' => $amountPaid,
            'status' => 'Pending',
        ]);

        // Send initial email acknowledgment if email is provided
        if (!empty($citizenEmail)) {
            try {
                \Illuminate\Support\Facades\Mail::to($citizenEmail)->send(new \App\Mail\CertificateStatusUpdated($certificate));
            } catch (\Throwable $e) {
                \Illuminate\Support\Facades\Log::warning("Failed sending submission email to {$citizenEmail}: " . $e->getMessage());
            }
        }

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'control_no' => $controlNo,
                'message' => 'Application submitted successfully to Barangay Dacutan database.',
                'certificate' => $certificate
            ]);
        }

        return back()->with('success_ref', $controlNo)
                     ->with('success_doc', $validated['doc_type'])
                     ->with('success', "Application submitted! Your tracking reference is {$controlNo}.");
    }

    public function trackDocument(Request $request)
    {
        $ref = trim($request->input('ref', ''));

        if (empty($ref)) {
            return response()->json([
                'found' => false,
                'message' => 'Please enter an Application Reference Number.'
            ]);
        }

        $cert = Certificate::where('control_no', $ref)
            ->orWhere('control_no', strtoupper($ref))
            ->first();

        if (!$cert) {
            return response()->json([
                'found' => false,
                'message' => "No application record found for reference: {$ref}. Please check the number and try again."
            ]);
        }

        // Map status to progress step (1 to 4)
        $stepMap = [
            'Pending' => 1,
            'Evaluated' => 2,
            'Approved' => 3,
            'Ready for Release' => 4,
            'Claimed' => 4,
            'Rejected' => 1,
        ];
        $step = $stepMap[$cert->status] ?? 1;

        return response()->json([
            'found' => true,
            'control_no' => $cert->control_no,
            'citizen_name' => $cert->citizen_name,
            'doc_type' => $cert->doc_type,
            'purok' => $cert->purok,
            'status' => $cert->status,
            'step' => $step,
            'amount_paid' => number_format($cert->amount_paid, 2),
            'date_submitted' => $cert->created_at->format('M d, Y h:i A'),
            'status_message' => match($cert->status) {
                'Pending' => 'Application received and queued for evaluation by the Barangay Secretary.',
                'Evaluated' => 'Records and clearances verified. Awaiting Punong Barangay signature.',
                'Approved' => 'Document approved and officially signed by the Punong Barangay.',
                'Ready for Release' => 'Document signed and ready for pick-up at Barangay Hall Window 1.',
                'Claimed' => 'Document has been officially released and claimed by resident.',
                'Rejected' => 'Application requires attention. Please contact the Barangay Secretary.',
                default => 'Processing...'
            }
        ]);
    }
}
