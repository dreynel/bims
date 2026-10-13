@extends('layouts.resident')

@section('title', 'My Requests & Review • Resident Portal • Barangay Dacutan')

@section('content')
<div class="space-y-6">

  <!-- PAGE HEADER & TITLE -->
  <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-white p-6 rounded-3xl border border-slate-200/80 shadow-sm">
    <div class="space-y-1">
      <div class="flex items-center gap-2">
        <span class="p-2 rounded-xl bg-blue-50 text-blue-700 text-lg">
          <i class="fa-solid fa-list-check"></i>
        </span>
        <h2 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight">
          My Requests & Clearance Review
        </h2>
      </div>
      <p class="text-xs text-slate-500 font-medium">
        Review application stages, track 2-tier approval workflow, and retrieve official clearances & claim slips.
      </p>
    </div>

    <div class="flex items-center gap-2.5">
      <button 
        type="button" 
        onclick="openResidentApplyModal()" 
        class="px-5 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs shadow-md shadow-emerald-950/20 transition-all flex items-center gap-2"
      >
        <i class="fa-solid fa-file-circle-plus"></i>
        <span>New Document Request</span>
      </button>
    </div>
  </div>

  <!-- STATUS FILTER TABS -->
  <div class="flex items-center gap-2 overflow-x-auto pb-1 no-scrollbar text-xs font-bold">
    <a 
      href="{{ route('resident.requests', ['status' => 'all', 'search' => $search]) }}" 
      class="px-4 py-2.5 rounded-2xl transition-all whitespace-nowrap flex items-center gap-2 border {{ $statusFilter === 'all' ? 'bg-slate-900 text-white border-slate-900 shadow-sm' : 'bg-white text-slate-600 hover:bg-slate-50 border-slate-200' }}"
    >
      <span>All Requests</span>
      <span class="px-2 py-0.5 rounded-full text-[10px] {{ $statusFilter === 'all' ? 'bg-slate-800 text-slate-200' : 'bg-slate-100 text-slate-600' }}">
        {{ $counts['all'] }}
      </span>
    </a>

    <a 
      href="{{ route('resident.requests', ['status' => 'review', 'search' => $search]) }}" 
      class="px-4 py-2.5 rounded-2xl transition-all whitespace-nowrap flex items-center gap-2 border {{ $statusFilter === 'review' ? 'bg-amber-600 text-white border-amber-600 shadow-sm' : 'bg-white text-slate-600 hover:bg-slate-50 border-slate-200' }}"
    >
      <i class="fa-solid fa-hourglass-half text-[11px]"></i>
      <span>Under Review</span>
      <span class="px-2 py-0.5 rounded-full text-[10px] {{ $statusFilter === 'review' ? 'bg-amber-700 text-white' : 'bg-amber-100 text-amber-800' }}">
        {{ $counts['review'] }}
      </span>
    </a>

    <a 
      href="{{ route('resident.requests', ['status' => 'ready', 'search' => $search]) }}" 
      class="px-4 py-2.5 rounded-2xl transition-all whitespace-nowrap flex items-center gap-2 border {{ $statusFilter === 'ready' ? 'bg-purple-600 text-white border-purple-600 shadow-sm' : 'bg-white text-slate-600 hover:bg-slate-50 border-slate-200' }}"
    >
      <i class="fa-solid fa-stamp text-[11px]"></i>
      <span>Ready for Pickup / Approved</span>
      <span class="px-2 py-0.5 rounded-full text-[10px] {{ $statusFilter === 'ready' ? 'bg-purple-700 text-white' : 'bg-purple-100 text-purple-800' }}">
        {{ $counts['ready'] }}
      </span>
    </a>

    <a 
      href="{{ route('resident.requests', ['status' => 'claimed', 'search' => $search]) }}" 
      class="px-4 py-2.5 rounded-2xl transition-all whitespace-nowrap flex items-center gap-2 border {{ $statusFilter === 'claimed' ? 'bg-emerald-600 text-white border-emerald-600 shadow-sm' : 'bg-white text-slate-600 hover:bg-slate-50 border-slate-200' }}"
    >
      <i class="fa-solid fa-circle-check text-[11px]"></i>
      <span>Claimed / Completed</span>
      <span class="px-2 py-0.5 rounded-full text-[10px] {{ $statusFilter === 'claimed' ? 'bg-emerald-700 text-white' : 'bg-emerald-100 text-emerald-800' }}">
        {{ $counts['claimed'] }}
      </span>
    </a>

    <a 
      href="{{ route('resident.requests', ['status' => 'cancelled', 'search' => $search]) }}" 
      class="px-4 py-2.5 rounded-2xl transition-all whitespace-nowrap flex items-center gap-2 border {{ $statusFilter === 'cancelled' ? 'bg-rose-600 text-white border-rose-600 shadow-sm' : 'bg-white text-slate-600 hover:bg-slate-50 border-slate-200' }}"
    >
      <span>Cancelled / Rejected</span>
      <span class="px-2 py-0.5 rounded-full text-[10px] {{ $statusFilter === 'cancelled' ? 'bg-rose-700 text-white' : 'bg-rose-100 text-rose-800' }}">
        {{ $counts['cancelled'] }}
      </span>
    </a>
  </div>

  <!-- SEARCH & FILTER TOOLBAR -->
  <div class="bg-white p-4 rounded-2xl border border-slate-200 shadow-sm flex flex-col sm:flex-row items-center justify-between gap-3">
    <form action="{{ route('resident.requests') }}" method="GET" class="w-full sm:max-w-md flex items-center gap-2">
      <input type="hidden" name="status" value="{{ $statusFilter }}">
      <div class="relative w-full">
        <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
        <input 
          type="text" 
          name="search" 
          value="{{ $search }}" 
          placeholder="Search by Reference No, Document type, or Purpose..." 
          class="w-full pl-9 pr-4 py-2 rounded-xl border border-slate-200 text-xs font-medium focus:outline-none focus:ring-2 focus:ring-emerald-500"
        >
      </div>
      <button type="submit" class="px-4 py-2 rounded-xl bg-slate-900 hover:bg-slate-800 text-white text-xs font-bold">
        Search
      </button>
      @if($search)
        <a href="{{ route('resident.requests', ['status' => $statusFilter]) }}" class="px-3 py-2 rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-100 text-xs font-bold">
          Clear
        </a>
      @endif
    </form>

    <div class="text-xs text-slate-500 self-end sm:self-center">
      Showing <strong class="text-slate-800">{{ $certificates->count() }}</strong> {{ Str::plural('record', $certificates->count()) }}
    </div>
  </div>

  <!-- REQUESTS LIST -->
  @if($certificates->isEmpty())
    <div class="p-12 text-center bg-white rounded-3xl border border-slate-200/80 shadow-sm space-y-4">
      <div class="w-16 h-16 rounded-2xl bg-slate-100 text-slate-400 flex items-center justify-center mx-auto text-3xl">
        <i class="fa-regular fa-folder-open"></i>
      </div>
      <div class="space-y-1">
        <h3 class="text-base font-extrabold text-slate-800">No requests found</h3>
        <p class="text-xs text-slate-500 max-w-md mx-auto">
          @if($search)
            No document requests matched your search query "<span class="font-bold text-slate-700">{{ $search }}</span>".
          @else
            You currently have no document requests under this filter category.
          @endif
        </p>
      </div>
      <div>
        <button 
          type="button" 
          onclick="openResidentApplyModal()" 
          class="px-5 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs shadow-md transition-all inline-flex items-center gap-2"
        >
          <i class="fa-solid fa-file-circle-plus"></i>
          <span>Apply for Document Now</span>
        </button>
      </div>
    </div>
  @else
    <div class="space-y-4">
      @foreach($certificates as $cert)
        @php
          $statusColors = [
            'Pending' => ['badge' => 'bg-amber-100 text-amber-800 border-amber-300', 'step' => 1, 'text' => 'Under Clerical Review'],
            'Evaluated' => ['badge' => 'bg-blue-100 text-blue-800 border-blue-300', 'step' => 2, 'text' => 'Clerical Endorsement to Punong Brgy'],
            'Approved' => ['badge' => 'bg-emerald-100 text-emerald-800 border-emerald-300', 'step' => 3, 'text' => 'Approved by Punong Barangay'],
            'Ready for Release' => ['badge' => 'bg-purple-100 text-purple-800 border-purple-300', 'step' => 4, 'text' => 'Ready for Pickup at Window 1'],
            'Claimed' => ['badge' => 'bg-slate-100 text-slate-800 border-slate-300', 'step' => 5, 'text' => 'Claimed / Completed'],
            'Cancelled' => ['badge' => 'bg-rose-100 text-rose-800 border-rose-300', 'step' => 0, 'text' => 'Cancelled by Applicant'],
            'Rejected' => ['badge' => 'bg-rose-100 text-rose-800 border-rose-300', 'step' => 0, 'text' => 'Application Rejected'],
          ];
          $st = $statusColors[$cert->status] ?? ['badge' => 'bg-slate-100', 'step' => 1, 'text' => $cert->status];
        @endphp

        <div class="bg-white rounded-3xl border border-slate-200/80 p-5 sm:p-6 shadow-sm hover:shadow-md transition-shadow space-y-4">
          
          <!-- Top Row: Reference, Doc Type, Status -->
          <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 border-b border-slate-100 pb-3">
            <div class="flex items-start sm:items-center gap-3">
              <div class="w-10 h-10 rounded-2xl bg-slate-100 text-slate-700 flex items-center justify-center font-bold text-base flex-shrink-0">
                <i class="fa-solid fa-file-contract text-emerald-600"></i>
              </div>
              <div>
                <div class="flex flex-wrap items-center gap-2">
                  <h3 class="font-extrabold text-base text-slate-900">{{ $cert->doc_type }}</h3>
                  <span class="inline-block px-2.5 py-0.5 rounded-full text-[10px] font-extrabold border {{ $st['badge'] }}">
                    {{ $cert->status }}
                  </span>
                </div>
                <p class="text-xs text-slate-500 font-medium">
                  Ref No: <span class="font-mono text-slate-900 font-bold">{{ $cert->control_no }}</span> • 
                  Submitted: <span class="text-slate-600">{{ $cert->created_at->format('M d, Y h:i A') }}</span>
                </p>
              </div>
            </div>

            <!-- Fee & Payment Info -->
            <div class="text-left sm:text-right">
              @if($cert->amount_paid == 0)
                <span class="inline-block px-2 py-0.5 rounded-lg bg-emerald-100 text-emerald-800 text-[10px] font-extrabold border border-emerald-300">
                  ₱0.00 Statutory Fee Waiver
                </span>
              @else
                <span class="text-xs font-black text-slate-900">₱{{ number_format($cert->amount_paid, 2) }}</span>
                <span class="text-[10px] text-slate-500 block">OR: {{ $cert->or_no ?? 'Pending Assessment' }}</span>
              @endif
            </div>
          </div>

          <!-- Middle Content: Purpose & Stepper Pipeline -->
          <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-xs">
            <div class="space-y-1">
              <span class="text-[10px] font-bold uppercase text-slate-400">Stated Purpose:</span>
              <p class="font-semibold text-slate-800">{{ $cert->purpose }}</p>
              @if($cert->ctc_no)
                <p class="text-[11px] text-slate-500">Cedula: <span class="font-mono">{{ $cert->ctc_no }}</span></p>
              @endif
            </div>

            <!-- Mini Visual Stepper (Steps 1 to 5) -->
            <div class="md:col-span-2 space-y-1.5">
              <span class="text-[10px] font-bold uppercase text-slate-400">Approval Workflow Progress:</span>
              <div class="flex items-center gap-1.5">
                <!-- Step 1 -->
                <div class="flex-1 text-center">
                  <div class="h-2 rounded-full bg-emerald-500"></div>
                  <span class="text-[9px] font-bold text-emerald-700 block mt-1">Submitted</span>
                </div>
                <!-- Step 2 -->
                <div class="flex-1 text-center">
                  <div class="h-2 rounded-full {{ $st['step'] >= 2 ? 'bg-emerald-500' : 'bg-slate-200' }}"></div>
                  <span class="text-[9px] font-bold {{ $st['step'] >= 2 ? 'text-emerald-700' : 'text-slate-400' }} block mt-1">Clerk</span>
                </div>
                <!-- Step 3 -->
                <div class="flex-1 text-center">
                  <div class="h-2 rounded-full {{ $st['step'] >= 3 ? 'bg-emerald-500' : 'bg-slate-200' }}"></div>
                  <span class="text-[9px] font-bold {{ $st['step'] >= 3 ? 'text-emerald-700' : 'text-slate-400' }} block mt-1">PB Sanction</span>
                </div>
                <!-- Step 4 -->
                <div class="flex-1 text-center">
                  <div class="h-2 rounded-full {{ $st['step'] >= 4 ? 'bg-emerald-500' : 'bg-slate-200' }}"></div>
                  <span class="text-[9px] font-bold {{ $st['step'] >= 4 ? 'text-emerald-700' : 'text-slate-400' }} block mt-1">Ready</span>
                </div>
                <!-- Step 5 -->
                <div class="flex-1 text-center">
                  <div class="h-2 rounded-full {{ $st['step'] >= 5 ? 'bg-emerald-500' : 'bg-slate-200' }}"></div>
                  <span class="text-[9px] font-bold {{ $st['step'] >= 5 ? 'text-emerald-700' : 'text-slate-400' }} block mt-1">Claimed</span>
                </div>
              </div>
            </div>
          </div>

          <!-- Bottom Remarks & Action Buttons -->
          <div class="pt-3 border-t border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-3 text-xs">
            <div class="text-[11px] text-slate-500">
              <strong class="text-slate-700">Remarks:</strong> 
              <span>{{ $cert->remarks ?? 'Application received. Pending clerical review by Barangay Secretary.' }}</span>
            </div>

            <!-- Action Toolbar for This Row -->
            <div class="flex items-center gap-2 self-end sm:self-auto flex-shrink-0">
              
              <!-- Review Request Details Button -->
              <button 
                type="button" 
                onclick="openReviewModal({{ $cert->id }})" 
                class="px-3.5 py-1.5 rounded-xl bg-blue-50 hover:bg-blue-100 text-blue-800 font-bold text-xs border border-blue-200 transition-all flex items-center gap-1.5"
              >
                <i class="fa-solid fa-magnifying-glass-chart"></i>
                <span>Review Details</span>
              </button>

              <!-- Print Appointment & Claim Stub -->
              <a 
                href="{{ route('resident.requests.claim-stub', $cert->id) }}" 
                target="_blank" 
                class="px-3.5 py-1.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs shadow-sm transition-all flex items-center gap-1.5"
                title="Print appointment & claim stub for walk-in pickup at Window 1"
              >
                <i class="fa-solid fa-ticket"></i>
                <span>Appointment Claim Stub</span>
              </a>

              <!-- Cancel Button (If Pending) -->
              @if($cert->status === 'Pending')
                <form id="cancel-form-{{ $cert->id }}" action="{{ route('resident.requests.cancel', $cert->id) }}" method="POST" class="inline">
                  @csrf
                  <button 
                    type="button" 
                    onclick="confirmCancelRequest({{ $cert->id }}, '{{ $cert->control_number }}')"
                    class="px-3 py-1.5 rounded-xl bg-rose-50 hover:bg-rose-100 text-rose-700 font-bold text-xs border border-rose-200 transition-all"
                    title="Cancel pending application"
                  >
                    <i class="fa-solid fa-trash-can"></i>
                    <span class="hidden md:inline">Cancel</span>
                  </button>
                </form>
              @endif

            </div>
          </div>

        </div>
      @endforeach
    </div>
  @endif

</div>
@endsection

