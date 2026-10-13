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
            [
                'name' => 'Hon. Reynaldo M. Dela Cruz',
                'initials' => 'RD',
                'gender' => 'M',
                'role' => 'Punong Barangay',
                'committee' => 'Overall Executive Governance & Peace and Order',
                'avatar' => asset('assets/images/logo.svg'),
            ],
            [
                'name' => 'Hon. Danilo R. Bautista',
                'initials' => 'DB',
                'gender' => 'M',
                'role' => 'Barangay Kagawad',
                'committee' => 'Committee on Peace & Order / Lupon',
                'avatar' => asset('assets/images/logo.svg'),
            ],
            [
                'name' => 'Hon. Marites S. Reyes',
                'initials' => 'MR',
                'gender' => 'F',
                'role' => 'Barangay Kagawad',
                'committee' => 'Committee on Health & Sanitation',
                'avatar' => asset('assets/images/logo.svg'),
            ],
            [
                'name' => 'Hon. Rodrigo G. Mendoza',
                'initials' => 'RM',
                'gender' => 'M',
                'role' => 'Barangay Kagawad',
                'committee' => 'Committee on Agriculture & Fisheries',
                'avatar' => asset('assets/images/logo.svg'),
            ],
            [
                'name' => 'Hon. Luzviminda P. Villanueva',
                'initials' => 'LV',
                'gender' => 'F',
                'role' => 'Barangay Kagawad',
                'committee' => 'Committee on Appropriations & Budget',
                'avatar' => asset('assets/images/logo.svg'),
            ],
            [
                'name' => 'Hon. Eduardo C. Ramos',
                'initials' => 'ER',
                'gender' => 'M',
                'role' => 'Barangay Kagawad',
                'committee' => 'Committee on Infrastructure & Roads',
                'avatar' => asset('assets/images/logo.svg'),
            ],
            [
                'name' => 'Hon. Lorna T. Aquino',
                'initials' => 'LA',
                'gender' => 'F',
                'role' => 'Barangay Kagawad',
                'committee' => 'Committee on Education, Women & Family',
                'avatar' => asset('assets/images/logo.svg'),
            ],
            [
                'name' => 'Hon. Ernesto V. Garcia',
                'initials' => 'EG',
                'gender' => 'M',
                'role' => 'Barangay Kagawad',
                'committee' => 'Committee on Environment & Disaster Preparedness',
                'avatar' => asset('assets/images/logo.svg'),
            ],
            [
                'name' => 'Hon. Christian Jay D. Tolentino',
                'initials' => 'CT',
                'gender' => 'M',
                'role' => 'SK Chairperson',
                'committee' => 'Committee on Youth & Sports Development',
                'avatar' => asset('assets/images/logo.svg'),
            ],
            [
                'name' => 'Mrs. Ma. Elena F. Balleza',
                'initials' => 'MB',
                'gender' => 'F',
                'role' => 'Barangay Secretary',
                'committee' => 'Administrative Records, Clearances & Archives',
                'avatar' => asset('assets/images/logo.svg'),
            ],
            [
                'name' => 'Mr. Fernando A. Castro',
                'initials' => 'FC',
                'gender' => 'M',
                'role' => 'Barangay Treasurer',
                'committee' => 'Barangay Revenues & Financial Management',
                'avatar' => asset('assets/images/logo.svg'),
            ],
        ];

        // Official Barangay Dacutan Profile as of 2025 Summary (from Documentation/brgy/bgy profile summary.jpg)
        $brgyProfile = [
            'land_area' => '230.7171 km.',
            'distance_poblacion' => '2.5 km.',
            'purok_count' => 7,
            'route_zarraga' => '27.5 kms',
            'route_coastal' => '22 kms',
            'characteristics' => [
                'Plain / Rice Land' => '50%',
                'Fishpond' => '30%',
                'Residential' => '15%',
                'Hilly / Mountainous' => '5%',
            ],
            'coastline' => '1.5 kms.',
            'national_roads' => '2.5 kms.',
            'barangay_roads' => '1.5 kms.',
            'boundaries' => [
                'North' => 'Sulangan / Binaobao',
                'South' => 'Coastal Area',
                'East' => 'Talusan / Sapao',
                'West' => 'Ermita',
            ],
            'population' => [
                'male' => 1142,
                'female' => 1195,
                'total' => 2337,
                'families' => 678,
                'households' => 562,
            ],
            'registered' => [
                'seniors' => 556,
                'pwd' => 69,
                'voters' => 1445,
                'four_ps' => 69,
                'ofw' => 75,
            ],
            'structures' => [
                'concrete' => 260,
                'light_materials' => 193,
                'semi_concrete' => 102,
            ],
            'economic' => [
                'employed' => 740,
                'unemployed' => 505,
                'farmers' => 52,
                'farmers_female' => 25,
                'farmers_male' => 27,
                'fisherfolks' => 146,
                'fisherfolks_female' => 67,
                'fisherfolks_male' => 79,
                'talabahan' => 54,
                'kasagan' => 26,
                'punot' => 22,
                'pahubas' => 7,
                'saluran' => 3,
            ],
        ];

        return view('public.home', compact('officials', 'brgyProfile'));
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

        // Fee Schedule per Barangay Ordinance No. 2020-01 & Official Barangay Dacutan Certifications
        $fees = [
            // Section 3.A: Barangay Clearances & Personal Certifications
            'Barangay Clearance' => 30.00,
            'Barangay Clearance / Certificate' => 30.00,
            'Certificate of Residency' => 30.00,
            'Certificate of Good Moral Character' => 30.00,
            'Barangay ID' => 30.00,
            'Certification for TIN ID' => 30.00,
            'Certification for Delayed Registration' => 30.00,
            'Certification for ILECO (Electrification)' => 30.00,
            'Certification for Electrical Permit' => 30.00,
            'Certification for Live-In' => 30.00,
            'Certification for Deceased / House' => 30.00,
            'Certification for RSBSA Member' => 30.00,
            'Certification for Loan' => 50.00,
            'Barangay Clearance (Postal ID / Loan)' => 50.00,

            // Section 5 & Statutory Exemptions (RA 11261 /PWD / Senior / Student / Indigent)
            'Certificate of Indigency' => 0.00,
            'First Time Job Seeker (RA 11261)' => 0.00,
            'First-Time Jobseeker Certification (RA 11261)' => 0.00,
            'Solo Parent Barangay Certification' => 0.00,
            'Certification for Solo Parent' => 0.00,
            'Certification for PWD' => 0.00,
            'Student / Senior Citizen Clearance (Sec. 5 Exemption)' => 0.00,

            // Section 3.B, 3.C & Section 4: Business, Aquatic Resources & Construction
            'Barangay Business Clearance' => 100.00,
            'Barangay Business Clearance / Permit' => 100.00,
            'Aquatic Resources / Fisherfolk Clearance' => 100.00,
            'Barangay Building / Construction Clearance' => 200.00,
            'Certification for Building Permit' => 200.00,
            'Certificate of No Objection (CNO)' => 100.00,

            // Section 3.A.7, Section 7 & Section 8: Legal / KP Records
            'Barangay Blotter Certification' => 100.00,
            'Certification to File Action' => 300.00,
            'Certified True Copy of Barangay Document' => 5.00,
        ];
        $amountPaid = $fees[$validated['doc_type']] ?? 30.00;

        // Generate unique appointment / tracking code DAC-YYYY-XXXX
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
                'message' => 'Appointment and document request submitted successfully to Barangay Dacutan.',
                'certificate' => $certificate
            ]);
        }

        return back()->with('success_ref', $controlNo)
                     ->with('success_doc', $validated['doc_type'])
                     ->with('success', "Document appointment scheduled! Your reference number for Barangay Hall pickup is {$controlNo}.");
    }

    public function trackDocument(Request $request)
    {
        $ref = trim($request->input('ref', ''));

        if (empty($ref)) {
            return response()->json([
                'found' => false,
                'message' => 'Please enter an Appointment / Application Reference Number.'
            ]);
        }

        $cert = Certificate::where('control_no', $ref)
            ->orWhere('control_no', strtoupper($ref))
            ->first();

        if (!$cert) {
            return response()->json([
                'found' => false,
                'message' => "No appointment or request record found for reference: {$ref}. Please check the number and try again."
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
                'Pending' => 'Appointment request received and queued for verification by the Barangay Secretary.',
                'Evaluated' => 'Records verified by the Secretary. Awaiting Punong Barangay physical signature.',
                'Approved' => 'Approved by the Punong Barangay. Being printed and dry-sealed for your walk-in claiming.',
                'Ready for Release' => 'Ready for Walk-In Claiming! Please proceed to Barangay Hall Window 1 with your Valid ID and Reference Number to claim your physically signed & dry-sealed document.',
                'Claimed' => 'Physical document has been officially released and claimed at the Barangay Hall.',
                'Rejected' => 'Request requires in-person verification. Please visit the Barangay Secretary at Window 1.',
                default => 'Processing appointment...'
            }
        ]);
    }
}
