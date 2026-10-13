<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Certificate;
use App\Models\Resident;

class CertificateController extends Controller
{
    public function index(Request $request)
    {
        $query = Certificate::query();

        if ($request->filled('status') && $request->status !== 'All') {
            $query->where('status', $request->status);
        }

        if ($request->filled('type') && $request->type !== 'All') {
            $query->where('doc_type', $request->type);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('control_no', 'LIKE', "%{$search}%")
                  ->orWhere('citizen_name', 'LIKE', "%{$search}%")
                  ->orWhere('purpose', 'LIKE', "%{$search}%");
            });
        }

        $certificates = $query->latest()->paginate(15)->withQueryString();
        $residents = Resident::orderBy('last_name')->get();

        return view('admin.certificates.index', compact('certificates', 'residents'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'resident_id' => 'required|exists:residents,id',
            'doc_type' => 'required|string',
            'purpose' => 'required|string|max:255',
            'ctc_no' => 'nullable|string|max:50',
            'or_no' => 'nullable|string|max:50',
            'amount_paid' => 'nullable|numeric|min:0',
            'issue_date' => 'required|date',
        ]);

        $resident = Resident::findOrFail($validated['resident_id']);

        // Control No Prefix for all official Barangay Dacutan certifications & clearances
        $prefixMap = [
            'Barangay Clearance' => 'CLR',
            'Barangay Clearance / Certificate' => 'CLR',
            'Certificate of Residency' => 'RES',
            'Certificate of Indigency' => 'IND',
            'Certificate of Good Moral Character' => 'MOR',
            'Certification for Delayed Registration' => 'DLR',
            'Certification for PWD' => 'PWD',
            'Certification for Solo Parent' => 'SOLO',
            'Solo Parent Barangay Certification' => 'SOLO',
            'Certification for Loan' => 'LOAN',
            'Certification for ILECO (Electrification)' => 'ILEC',
            'Certification for Electrical Permit' => 'ELEC',
            'Certification for Live-In' => 'LVN',
            'Certification for Deceased / House' => 'DEC',
            'Certification for First Time Job Seeker' => 'JOB',
            'First Time Job Seeker (RA 11261)' => 'JOB',
            'First-Time Jobseeker Certification (RA 11261)' => 'JOB',
            'Certification for RSBSA Member' => 'RSB',
            'Certification for TIN ID' => 'TIN',
            'Barangay ID' => 'BID',
            'Certification for Building Permit' => 'BLD',
            'Barangay Building / Construction Clearance' => 'BLD',
            'Barangay Business Clearance' => 'BIZ',
            'Barangay Business Clearance / Permit' => 'BIZ',
            'Aquatic Resources / Fisherfolk Clearance' => 'AQUA',
            'Certificate of No Objection (CNO)' => 'CNO',
            'Barangay Blotter Certification' => 'BLT',
            'Certification to File Action' => 'CFA',
        ];
        $prefix = $prefixMap[$validated['doc_type']] ?? 'DOC';
        $randNum = mt_rand(1000, 9999);
        $controlNo = "{$prefix}-" . date('Y') . "-{$randNum}";

        // Official Barangay Dacutan Schedule of Fees (Barangay Ordinance No. 2020-01)
        $fees = [
            'Barangay Clearance' => 30.00,
            'Barangay Clearance / Certificate' => 30.00,
            'Certificate of Residency' => 30.00,
            'Certificate of Indigency' => 0.00,
            'Certificate of Good Moral Character' => 30.00,
            'Certification for Delayed Registration' => 30.00,
            'Certification for PWD' => 0.00,
            'Certification for Solo Parent' => 0.00,
            'Solo Parent Barangay Certification' => 0.00,
            'Certification for Loan' => 50.00,
            'Certification for ILECO (Electrification)' => 30.00,
            'Certification for Electrical Permit' => 30.00,
            'Certification for Live-In' => 30.00,
            'Certification for Deceased / House' => 30.00,
            'Certification for First Time Job Seeker' => 0.00,
            'First Time Job Seeker (RA 11261)' => 0.00,
            'First-Time Jobseeker Certification (RA 11261)' => 0.00,
            'Certification for RSBSA Member' => 30.00,
            'Certification for TIN ID' => 30.00,
            'Barangay ID' => 30.00,
            'Certification for Building Permit' => 200.00,
            'Barangay Building / Construction Clearance' => 200.00,
            'Barangay Business Clearance' => 100.00,
            'Barangay Business Clearance / Permit' => 100.00,
            'Aquatic Resources / Fisherfolk Clearance' => 100.00,
            'Certificate of No Objection (CNO)' => 100.00,
            'Barangay Blotter Certification' => 100.00,
            'Certification to File Action' => 300.00,
        ];
        $amountPaid = isset($validated['amount_paid']) ? (float)$validated['amount_paid'] : ($fees[$validated['doc_type']] ?? 30.00);

        $cert = Certificate::create([
            'control_no' => $controlNo,
            'resident_id' => $resident->id,
            'citizen_name' => $resident->full_name,
            'contact_no' => $resident->contact_no,
            'email' => $resident->email,
            'purok' => $resident->purok,
            'doc_type' => $validated['doc_type'],
            'purpose' => $validated['purpose'],
            'ctc_no' => $validated['ctc_no'] ?? 'CTC-' . date('Y') . '-' . mt_rand(10000, 99999),
            'or_no' => $validated['or_no'] ?? ($amountPaid > 0 ? 'OR-' . date('Y') . '-' . mt_rand(1000, 9999) : 'EXEMPT'),
            'amount_paid' => $amountPaid,
            'status' => 'Ready for Release',
            'issued_by' => Auth::user()->name ?? 'Mrs. Ma. Elena Balleza',
            'issue_date' => $validated['issue_date'],
            'expiry_date' => date('Y-m-d', strtotime('+6 months', strtotime($validated['issue_date']))),
        ]);

        return redirect()->route('admin.certificates.index')
            ->with('success', "{$validated['doc_type']} issued successfully with Control No. {$controlNo}!");
    }

    public function updateStatus(Request $request, $id)
    {
        $cert = Certificate::findOrFail($id);
        $status = $request->input('status', 'Evaluated');
        $remarks = $request->input('remarks');

        $issuerName = Auth::user()->name ?? 'Mrs. Ma. Elena Balleza';

        // 2-Tier Approval Hierarchy Logic:
        // Tier 1: Secretary reviews and evaluates request
        // Tier 2: Punong Barangay grants final executive approval
        if ($status === 'Evaluated') {
            $remarks = $remarks ?: "Reviewed and verified by Barangay Secretary {$issuerName}. Endorsed to Punong Barangay for final approval.";
        } elseif ($status === 'Approved') {
            $remarks = $remarks ?: "Final Executive Approval granted by Punong Barangay Hon. Roberto S. Alen.";
        } elseif ($status === 'Ready for Release') {
            $remarks = $remarks ?: "Document officially sealed and stamped. Ready for pickup at Barangay Hall Window 1.";
        } elseif ($status === 'Claimed') {
            $remarks = $remarks ?: "Document officially released and claimed by applicant.";
        } elseif ($status === 'Rejected') {
            $remarks = $remarks ?: "Application requires additional requirements or verification. Please contact the Barangay Secretary.";
        }

        $cert->update([
            'status' => $status,
            'issued_by' => $issuerName,
            'issue_date' => now()->toDateString(),
            'remarks' => $remarks,
            'or_no' => $request->filled('or_no') ? $request->or_no : $cert->or_no,
        ]);

        // Send Email Notification to resident
        $recipientEmail = $cert->email ?: ($cert->resident?->email ?: null);
        if ($recipientEmail) {
            try {
                \Illuminate\Support\Facades\Mail::to($recipientEmail)->send(new \App\Mail\CertificateStatusUpdated($cert));
            } catch (\Throwable $e) {
                \Illuminate\Support\Facades\Log::warning("Failed to dispatch status email to {$recipientEmail}: " . $e->getMessage());
            }
        }

        return back()->with('success', "Document #{$cert->control_no} updated to '{$status}'. Notification email processed.");
    }

    public function print($id)
    {
        $certificate = Certificate::with('resident')->findOrFail($id);
        return view('admin.certificates.print', compact('certificate'));
    }
}
