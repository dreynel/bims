@extends('layouts.app')

@section('title', 'Clearance & Certificate Issuance • Barangay Dacutan BIMS')
@section('header_title', 'Clearances & Certifications Desk')
@section('header_subtitle', 'Document Processing, Official Receipts & A4 Printable Generation')

@section('content')
<div class="space-y-6">

  <!-- 1. TOP HEADER & METRICS -->
  <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white p-4 sm:p-5 rounded-2xl border border-slate-200/80 shadow-sm">
    <div>
      <h2 class="text-lg font-extrabold text-slate-900 flex items-center gap-2">
        <i class="fa-solid fa-file-signature text-blue-600"></i>
        <span>Official Certification Register</span>
      </h2>
      <p class="text-xs text-slate-500 mt-0.5">Manage and print Philippine Republic standard barangay clearances, indigency, and residency certificates.</p>
    </div>

    <button 
      type="button" 
      onclick="openIssueModal()" 
      class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-500 text-white font-bold text-xs shadow-md shadow-blue-950/20 transition-all hover:scale-[1.02]"
    >
      <i class="fa-solid fa-stamp text-sm"></i>
      <span>Issue Official Document</span>
    </button>
  </div>

  <!-- 2. SEARCH & FILTER BAR -->
  <div class="bg-white p-4 sm:p-5 rounded-2xl border border-slate-200/80 shadow-sm">
    <form method="GET" action="{{ route('admin.certificates.index') }}" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3">
      
      <!-- Keyword Search -->
      <div class="relative">
        <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
          <i class="fa-solid fa-magnifying-glass text-xs"></i>
        </span>
        <input 
          type="text" 
          name="search" 
          value="{{ request('search') }}" 
          placeholder="Search Control # or Citizen..." 
          class="w-full pl-9 pr-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500"
        >
      </div>

      <!-- Filter by Doc Type -->
      <div>
        <select 
          name="type" 
          onchange="this.form.submit()" 
          class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-800 font-medium focus:outline-none focus:ring-2 focus:ring-blue-500"
        >
          <option value="All">All Document Types (12 Offerings)</option>
          <optgroup label="── Personal Certificates & Clearances ──">
            <option value="Barangay Clearance" {{ request('type') == 'Barangay Clearance' ? 'selected' : '' }}>Barangay Clearance / Certificate</option>
            <option value="Certificate of Residency" {{ request('type') == 'Certificate of Residency' ? 'selected' : '' }}>Certificate of Residency</option>
            <option value="Certificate of Indigency" {{ request('type') == 'Certificate of Indigency' ? 'selected' : '' }}>Certificate of Indigency</option>
            <option value="Certificate of Good Moral Character" {{ request('type') == 'Certificate of Good Moral Character' ? 'selected' : '' }}>Certificate of Good Moral Character</option>
            <option value="First Time Job Seeker (RA 11261)" {{ request('type') == 'First Time Job Seeker (RA 11261)' || request('type') == 'First-Time Jobseeker Certification (RA 11261)' ? 'selected' : '' }}>First Time Job Seeker (RA 11261)</option>
            <option value="Barangay ID" {{ request('type') == 'Barangay ID' ? 'selected' : '' }}>Barangay ID</option>
            <option value="Solo Parent Barangay Certification" {{ request('type') == 'Solo Parent Barangay Certification' ? 'selected' : '' }}>Solo Parent Barangay Certification</option>
          </optgroup>
          <optgroup label="── Business & Property Clearances ──">
            <option value="Barangay Business Clearance" {{ request('type') == 'Barangay Business Clearance' || request('type') == 'Barangay Business Clearance / Permit' ? 'selected' : '' }}>Barangay Business Clearance / Permit</option>
            <option value="Barangay Building / Construction Clearance" {{ request('type') == 'Barangay Building / Construction Clearance' ? 'selected' : '' }}>Barangay Building / Construction Clearance</option>
            <option value="Certificate of No Objection (CNO)" {{ request('type') == 'Certificate of No Objection (CNO)' ? 'selected' : '' }}>Certificate of No Objection (CNO)</option>
          </optgroup>
          <optgroup label="── Legal & Dispute Records ──">
            <option value="Barangay Blotter Certification" {{ request('type') == 'Barangay Blotter Certification' ? 'selected' : '' }}>Barangay Blotter Certification</option>
            <option value="Certification to File Action" {{ request('type') == 'Certification to File Action' ? 'selected' : '' }}>Certification to File Action (CFA)</option>
          </optgroup>
        </select>
      </div>

      <!-- Filter by Status -->
      <div>
        <select 
          name="status" 
          onchange="this.form.submit()" 
          class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-800 font-medium focus:outline-none focus:ring-2 focus:ring-blue-500"
        >
          <option value="All">All Processing Statuses</option>
          <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>Pending Review</option>
          <option value="Evaluated" {{ request('status') == 'Evaluated' ? 'selected' : '' }}>Evaluated (Secretary Endorsement)</option>
          <option value="Approved" {{ request('status') == 'Approved' ? 'selected' : '' }}>Approved (Punong Brgy Approval)</option>
          <option value="Ready for Release" {{ request('status') == 'Ready for Release' ? 'selected' : '' }}>Ready for Release</option>
          <option value="Claimed" {{ request('status') == 'Claimed' ? 'selected' : '' }}>Claimed / Issued</option>
          <option value="Rejected" {{ request('status') == 'Rejected' ? 'selected' : '' }}>Rejected / Needs Verification</option>
        </select>
      </div>

      <!-- Filter Actions -->
      <div class="flex items-center gap-2">
        <button type="submit" class="flex-1 py-2 px-3 rounded-xl bg-slate-800 hover:bg-slate-700 text-white font-bold text-xs transition-colors">
          Filter Records
        </button>
        @if(request()->hasAny(['search', 'type', 'status']))
          <a href="{{ route('admin.certificates.index') }}" class="py-2 px-3 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-600 font-bold text-xs transition-colors" title="Clear Filters">
            Reset
          </a>
        @endif
      </div>

    </form>
  </div>

  <!-- 3. CERTIFICATES RECORDS TABLE -->
  <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
    @if($certificates->isEmpty())
      <div class="p-12 text-center text-slate-400 space-y-3">
        <i class="fa-regular fa-folder-open text-4xl text-slate-300"></i>
        <p class="text-sm font-bold text-slate-600">No clearance or certificate records found.</p>
        <p class="text-xs text-slate-400">Click "Issue Official Document" above to generate a new certificate.</p>
      </div>
    @else
      <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse text-xs">
          <thead>
            <tr class="bg-slate-50/75 border-b border-slate-200 text-[11px] font-bold text-slate-500 uppercase tracking-wider">
              <th class="py-3.5 px-4">Control / Tracking #</th>
              <th class="py-3.5 px-4">Applicant Citizen</th>
              <th class="py-3.5 px-4">Document Type</th>
              <th class="py-3.5 px-4">Purpose</th>
              <th class="py-3.5 px-4">Fee / OR #</th>
              <th class="py-3.5 px-4">Status</th>
              <th class="py-3.5 px-4">Date Issued</th>
              <th class="py-3.5 px-4 text-right">Actions</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-slate-100 font-normal text-slate-700">
            @foreach($certificates as $cert)
              <tr class="hover:bg-slate-50/80 transition-colors">
                
                <!-- Control No -->
                <td class="py-3.5 px-4">
                  <span class="font-mono font-bold text-slate-900 block">{{ $cert->control_no }}</span>
                  <span class="text-[10px] text-slate-400">Issuer: {{ $cert->issued_by }}</span>
                </td>

                <!-- Applicant -->
                <td class="py-3.5 px-4">
                  <p class="font-bold text-slate-900">{{ $cert->citizen_name }}</p>
                  <p class="text-[10px] text-slate-400">{{ $cert->purok }} • {{ $cert->contact_no }}</p>
                </td>

                <!-- Document Type -->
                <td class="py-3.5 px-4 font-semibold text-slate-800">
                  {{ $cert->doc_type }}
                </td>

                <!-- Purpose -->
                <td class="py-3.5 px-4 text-slate-600 max-w-xs truncate" title="{{ $cert->purpose }}">
                  {{ $cert->purpose }}
                </td>

                <!-- Fee / OR -->
                <td class="py-3.5 px-4">
                  <span class="font-bold text-slate-900">₱{{ number_format($cert->amount_paid, 2) }}</span>
                  <span class="text-[10px] text-slate-400 block">{{ $cert->or_no ?? 'No OR' }}</span>
                </td>

                <!-- Status Badge -->
                <td class="py-3.5 px-4">
                  @php
                    $badgeColors = [
                      'Pending' => 'bg-amber-100 text-amber-800 border-amber-300',
                      'Evaluated' => 'bg-blue-100 text-blue-800 border-blue-300',
                      'Approved' => 'bg-emerald-100 text-emerald-800 border-emerald-300',
                      'Ready for Release' => 'bg-purple-100 text-purple-800 border-purple-300',
                      'Claimed' => 'bg-slate-100 text-slate-700 border-slate-300',
                      'Rejected' => 'bg-rose-100 text-rose-800 border-rose-300',
                    ];
                    $badge = $badgeColors[$cert->status] ?? 'bg-slate-100 text-slate-700 border-slate-300';
                  @endphp
                  <span class="inline-block px-2.5 py-0.5 rounded-full text-[10px] font-bold border {{ $badge }}">
                    {{ $cert->status }}
                  </span>
                </td>

                <!-- Date -->
                <td class="py-3.5 px-4 text-slate-500 whitespace-nowrap">
                  {{ $cert->issue_date ? $cert->issue_date->format('M d, Y') : ($cert->created_at ? $cert->created_at->format('M d, Y') : 'Pending') }}
                </td>

                <!-- Actions -->
                <td class="py-3.5 px-4 text-right space-x-1 whitespace-nowrap">
                  <!-- Status Transition Dropdown / Quick Button -->
                  @if($cert->status !== 'Claimed')
                    <form action="{{ route('admin.certificates.status', $cert->id) }}" method="POST" class="inline">
                      @csrf
                      @if($cert->status === 'Pending')
                        <input type="hidden" name="status" value="Evaluated">
                        <button type="submit" class="px-2 py-1 rounded bg-blue-600 hover:bg-blue-500 text-white font-bold text-[10px] shadow-sm" title="Secretary: Review & Endorse Application">
                          Sec. Review
                        </button>
                      @elseif($cert->status === 'Evaluated')
                        <input type="hidden" name="status" value="Approved">
                        <button type="submit" class="px-2 py-1 rounded bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-[10px] shadow-sm" title="Punong Barangay: Final Executive Approval">
                          Capt. Approve
                        </button>
                      @elseif($cert->status === 'Approved')
                        <input type="hidden" name="status" value="Ready for Release">
                        <button type="submit" class="px-2 py-1 rounded bg-purple-600 hover:bg-purple-500 text-white font-bold text-[10px] shadow-sm" title="Mark as Ready for Release">
                          Mark Ready
                        </button>
                      @elseif($cert->status === 'Ready for Release')
                        <input type="hidden" name="status" value="Claimed">
                        <button type="submit" class="px-2 py-1 rounded bg-slate-800 hover:bg-slate-700 text-white font-bold text-[10px] shadow-sm" title="Mark Claimed by Citizen">
                          Claimed
                        </button>
                      @endif
                    </form>
                  @endif

                  <!-- Printable A4 View Button -->
                  <a 
                    href="{{ route('admin.certificates.print', $cert->id) }}" 
                    target="_blank" 
                    class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-blue-50 hover:bg-blue-100 text-blue-700 border border-blue-200 font-bold text-[10px] transition-colors shadow-sm"
                    title="Open Philippine Republic Printable A4 Layout"
                  >
                    <i class="fa-solid fa-print"></i>
                    <span>Print A4</span>
                  </a>
                </td>

              </tr>
            @endforeach
          </tbody>
        </table>
      </div>

      <!-- Pagination -->
      <div class="p-4 border-t border-slate-100 bg-slate-50/50 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-slate-500">
        <div>
          Showing <span class="font-bold text-slate-800">{{ $certificates->firstItem() }}</span> to <span class="font-bold text-slate-800">{{ $certificates->lastItem() }}</span> of <span class="font-bold text-slate-800">{{ $certificates->total() }}</span> records
        </div>
        <div>
          {{ $certificates->links() }}
        </div>
      </div>
    @endif
  </div>

</div>

<!-- 4. MODAL: ISSUE NEW CLEARANCE -->
<div id="issueModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm hidden">
  <div class="bg-white rounded-2xl max-w-xl w-full max-h-[90vh] flex flex-col shadow-2xl border border-slate-200 overflow-hidden animate-fade-in">
    
    <div class="px-6 py-4 bg-slate-900 text-white flex items-center justify-between">
      <div class="flex items-center gap-2.5">
        <div class="w-8 h-8 rounded-lg bg-blue-500/20 text-blue-400 flex items-center justify-center font-bold">
          <i class="fa-solid fa-stamp"></i>
        </div>
        <div>
          <h3 class="text-sm font-extrabold">Issue Official Barangay Certificate</h3>
          <p class="text-[10px] text-slate-400">Office of the Punong Barangay • Dacutan, Dumangas</p>
        </div>
      </div>
      <button onclick="closeIssueModal()" class="text-slate-400 hover:text-white">
        <i class="fa-solid fa-xmark text-lg"></i>
      </button>
    </div>

    <form action="{{ route('admin.certificates.store') }}" method="POST" class="p-6 space-y-4 overflow-y-auto flex-1">
      @csrf

      <!-- Resident Select -->
      <div>
        <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1">Select Registered Resident *</label>
        <select name="resident_id" required class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-900 font-medium focus:ring-2 focus:ring-blue-500">
          <option value="">-- Choose Resident from Directory --</option>
          @foreach($residents as $res)
            <option value="{{ $res->id }}">
              {{ $res->last_name }}, {{ $res->first_name }} {{ $res->middle_name }} ({{ $res->resident_id }} - {{ $res->purok }})
            </option>
          @endforeach
        </select>
        <p class="text-[10px] text-slate-400 mt-1">Resident information (Address, Contact, Sector) will be automatically embedded.</p>
      </div>

      <!-- Document Type -->
      <div>
        <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1">Document Type *</label>
        <select name="doc_type" id="modal_doc_type" onchange="adjustFeeByDocType()" required class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-900 font-medium focus:ring-2 focus:ring-blue-500">
          <optgroup label="── Personal Certificates & Clearances ──">
            <option value="Barangay Clearance">Barangay Clearance / Certificate</option>
            <option value="Certificate of Residency">Certificate of Residency</option>
            <option value="Certificate of Indigency">Certificate of Indigency (Free / DSWD)</option>
            <option value="Certificate of Good Moral Character">Certificate of Good Moral Character</option>
            <option value="First Time Job Seeker (RA 11261)">First Time Job Seeker (Free under RA 11261)</option>
            <option value="Barangay ID">Barangay ID</option>
            <option value="Solo Parent Barangay Certification">Solo Parent Barangay Certification (Free)</option>
          </optgroup>
          <optgroup label="── Business & Property Clearances ──">
            <option value="Barangay Business Clearance">Barangay Business Clearance / Permit</option>
            <option value="Barangay Building / Construction Clearance">Barangay Building / Construction Clearance</option>
            <option value="Certificate of No Objection (CNO)">Certificate of No Objection (CNO)</option>
          </optgroup>
          <optgroup label="── Legal & Dispute Records ──">
            <option value="Barangay Blotter Certification">Barangay Blotter Certification</option>
            <option value="Certification to File Action">Certification to File Action (CFA)</option>
          </optgroup>
        </select>
      </div>

      <!-- Specific Purpose -->
      <div>
        <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1">Specific Purpose *</label>
        <input 
          type="text" 
          name="purpose" 
          required 
          placeholder="e.g. Local Employment / Police Clearance / Scholarship Application"
          class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-900 focus:ring-2 focus:ring-blue-500"
        >
      </div>

      <!-- Fee & Receipt Numbers -->
      <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
        <div>
          <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1">Fee Paid (₱) *</label>
          <input type="number" step="0.01" name="amount_paid" id="modal_fee" value="50.00" required class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-900 font-mono font-bold focus:ring-2 focus:ring-blue-500">
        </div>
        <div>
          <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1">Official Receipt (OR) #</label>
          <input type="text" name="or_no" value="OR-2026-{{ mt_rand(1000, 9999) }}" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-900 font-mono">
        </div>
        <div>
          <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1">CTC (Cedula) #</label>
          <input type="text" name="ctc_no" value="CTC-2026-{{ mt_rand(10000, 99999) }}" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-900 font-mono">
        </div>
      </div>

      <!-- Issue Date -->
      <div>
        <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1">Date of Issuance *</label>
        <input type="date" name="issue_date" value="{{ date('Y-m-d') }}" required class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-900 focus:ring-2 focus:ring-blue-500">
      </div>

      <div class="pt-4 border-t border-slate-200 flex items-center justify-end gap-3">
        <button type="button" onclick="closeIssueModal()" class="px-4 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold">
          Cancel
        </button>
        <button type="submit" class="px-5 py-2 rounded-xl bg-blue-600 hover:bg-blue-500 text-white text-xs font-bold shadow-md shadow-blue-950/20 transition-all">
          Generate & Prepare Clearance
        </button>
      </div>
    </form>

  </div>
</div>
@endsection

@section('scripts')
<script>
  function openIssueModal() {
    document.getElementById('issueModal').classList.remove('hidden');
  }
  function closeIssueModal() {
    document.getElementById('issueModal').classList.add('hidden');
  }

  function adjustFeeByDocType() {
    const docType = document.getElementById('modal_doc_type').value;
    const feeInput = document.getElementById('modal_fee');
    const freeTypes = [
      'Certificate of Indigency',
      'First Time Job Seeker (RA 11261)',
      'First-Time Jobseeker Certification (RA 11261)',
      'Solo Parent Barangay Certification'
    ];
    if (freeTypes.includes(docType)) {
      feeInput.value = '0.00';
    } else if (docType === 'Barangay Business Clearance' || docType.includes('Business')) {
      feeInput.value = '150.00';
    } else if (docType === 'Barangay Building / Construction Clearance') {
      feeInput.value = '200.00';
    } else if (docType === 'Certificate of No Objection (CNO)' || docType === 'Certification to File Action') {
      feeInput.value = '100.00';
    } else {
      feeInput.value = '50.00';
    }
  }
</script>
@endsection
