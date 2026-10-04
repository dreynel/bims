@extends('layouts.resident')

@section('title', 'Resident Portal Dashboard • Barangay Dacutan')

@section('content')
<div class="space-y-6">

  <!-- 1. WELCOME & VERIFIED IDENTITY HERO CARD -->
  <div class="rounded-3xl bg-gradient-to-r from-slate-900 via-emerald-950 to-slate-900 text-white p-6 sm:p-8 shadow-xl border border-slate-700 relative overflow-hidden">
    <div class="absolute -right-16 -top-16 w-64 h-64 bg-emerald-500/20 rounded-full blur-3xl pointer-events-none"></div>

    <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
      
      <div class="flex items-start sm:items-center gap-4">
        <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-2xl bg-white/10 border-2 border-emerald-400/50 flex items-center justify-center overflow-hidden flex-shrink-0 shadow-lg">
          @if($resident?->photo || $resident?->id_photo)
            <img src="{{ $resident->photo ?? $resident->id_photo }}" alt="ID Photo" class="w-full h-full object-cover">
          @else
            <i class="fa-solid fa-user-check text-3xl text-emerald-400"></i>
          @endif
        </div>

        <div class="space-y-1">
          <div class="flex flex-wrap items-center gap-2">
            <h2 class="text-xl sm:text-2xl font-black text-white">
              Mabuhay, {{ $user->name }}!
            </h2>
            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-emerald-500/20 text-emerald-300 text-[10px] font-extrabold border border-emerald-500/30">
              <i class="fa-solid fa-circle-check text-emerald-400"></i> Verified Resident
            </span>
            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-blue-500/20 text-blue-300 text-[10px] font-extrabold border border-blue-500/30">
              <i class="fa-solid fa-stamp text-blue-400"></i> Approved by Secretary
            </span>
          </div>

          <p class="text-xs text-slate-300 font-medium">
            Resident Control ID: <strong class="font-mono text-amber-400 font-bold">{{ $resident?->resident_id ?? 'DAC-2026-TEMP' }}</strong> • 
            <span>{{ $resident?->purok ?? 'Barangay Dacutan' }}</span>
          </p>

          <div class="flex flex-wrap items-center gap-x-4 gap-y-1 text-[11px] text-slate-400 pt-1">
            <span><i class="fa-solid fa-id-card text-emerald-400 mr-1"></i> {{ $resident?->id_type ?? 'Government ID' }}: <strong class="font-mono text-slate-200">{{ $resident?->id_number ?? 'Verified' }}</strong></span>
            <span><i class="fa-solid fa-phone text-emerald-400 mr-1"></i> {{ $resident?->contact_no ?? 'N/A' }}</span>
            <span><i class="fa-solid fa-envelope text-emerald-400 mr-1"></i> {{ $user->email }}</span>
          </div>
        </div>
      </div>

      <!-- Quick Action Buttons -->
      <div class="flex flex-wrap sm:flex-nowrap items-center gap-2.5 flex-shrink-0">
        <button 
          type="button" 
          onclick="openResidentApplyModal()" 
          class="w-full sm:w-auto px-5 py-3 rounded-2xl bg-emerald-500 hover:bg-emerald-400 text-slate-950 font-black text-xs sm:text-sm shadow-lg shadow-emerald-950/40 transition-all flex items-center justify-center gap-2"
        >
          <i class="fa-solid fa-file-circle-plus text-base"></i>
          <span>Request Document</span>
        </button>

        <a 
          href="{{ route('resident.requests') }}" 
          class="w-full sm:w-auto px-4 py-3 rounded-2xl bg-white/10 hover:bg-white/20 text-white font-bold text-xs sm:text-sm border border-white/20 transition-all flex items-center justify-center gap-2"
        >
          <i class="fa-solid fa-list-check"></i>
          <span>Review My Requests</span>
        </a>
      </div>

    </div>
  </div>

  <!-- 2. FOUR METRIC STAT CARDS -->
  <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
    <div class="p-5 rounded-3xl bg-white border border-slate-200/80 shadow-sm space-y-1">
      <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Total Applications</span>
      <div class="flex items-center justify-between">
        <span class="text-2xl font-black text-slate-900 font-mono">{{ $stats['total'] }}</span>
        <div class="w-9 h-9 rounded-2xl bg-blue-50 text-blue-700 flex items-center justify-center text-sm font-bold">
          <i class="fa-solid fa-folder-closed"></i>
        </div>
      </div>
    </div>

    <div class="p-5 rounded-3xl bg-white border border-slate-200/80 shadow-sm space-y-1">
      <span class="text-[10px] font-bold text-amber-700 uppercase tracking-wider block">Under Review</span>
      <div class="flex items-center justify-between">
        <span class="text-2xl font-black text-amber-800 font-mono">{{ $stats['pending'] }}</span>
        <div class="w-9 h-9 rounded-2xl bg-amber-50 text-amber-700 flex items-center justify-center text-sm font-bold">
          <i class="fa-solid fa-hourglass-half"></i>
        </div>
      </div>
    </div>

    <div class="p-5 rounded-3xl bg-white border border-slate-200/80 shadow-sm space-y-1">
      <span class="text-[10px] font-bold text-purple-700 uppercase tracking-wider block">Approved / Ready</span>
      <div class="flex items-center justify-between">
        <span class="text-2xl font-black text-purple-800 font-mono">{{ $stats['approved'] }}</span>
        <div class="w-9 h-9 rounded-2xl bg-purple-50 text-purple-700 flex items-center justify-center text-sm font-bold">
          <i class="fa-solid fa-stamp"></i>
        </div>
      </div>
    </div>

    <div class="p-5 rounded-3xl bg-white border border-slate-200/80 shadow-sm space-y-1">
      <span class="text-[10px] font-bold text-emerald-700 uppercase tracking-wider block">Claimed / Released</span>
      <div class="flex items-center justify-between">
        <span class="text-2xl font-black text-emerald-800 font-mono">{{ $stats['claimed'] }}</span>
        <div class="w-9 h-9 rounded-2xl bg-emerald-50 text-emerald-700 flex items-center justify-center text-sm font-bold">
          <i class="fa-solid fa-circle-check"></i>
        </div>
      </div>
    </div>
  </div>

  <!-- 3. RECENT REQUESTS & APPLICATION REVIEW PREVIEW -->
  <div class="bg-white rounded-3xl border border-slate-200/80 shadow-sm overflow-hidden">
    <div class="p-5 sm:p-6 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
      <div>
        <h3 class="text-base sm:text-lg font-extrabold text-slate-900 tracking-tight flex items-center gap-2">
          <i class="fa-solid fa-list-check text-emerald-600"></i>
          <span>Recent Document Requests & Status Review</span>
        </h3>
        <p class="text-xs text-slate-500 font-medium">Real-time tracking of approvals, remarks, and claim slips</p>
      </div>

      <div class="flex items-center gap-2">
        <a 
          href="{{ route('resident.requests') }}" 
          class="px-4 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-800 font-bold text-xs transition-all flex items-center gap-1.5"
        >
          <span>View All Requests & Review</span>
          <i class="fa-solid fa-arrow-right text-[10px]"></i>
        </a>
      </div>
    </div>

    @if($recentCertificates->isEmpty())
      <div class="p-12 text-center text-slate-400 space-y-3">
        <i class="fa-regular fa-folder-open text-4xl text-slate-300"></i>
        <p class="text-sm font-bold text-slate-700">No document requests submitted yet.</p>
        <p class="text-xs text-slate-400 max-w-sm mx-auto">
          Click "Request Document" to apply for a Barangay Clearance, Indigency, Residency, or Business Permit online.
        </p>
        <div>
          <button 
            type="button" 
            onclick="openResidentApplyModal()" 
            class="px-5 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs shadow-md transition-all inline-flex items-center gap-2"
          >
            <i class="fa-solid fa-file-circle-plus"></i>
            <span>Apply Now</span>
          </button>
        </div>
      </div>
    @else
      <div class="overflow-x-auto">
        <table class="w-full text-left text-xs">
          <thead class="bg-slate-50 border-b border-slate-200 text-[11px] font-bold text-slate-500 uppercase tracking-wider">
            <tr>
              <th class="py-3.5 px-4">Reference #</th>
              <th class="py-3.5 px-4">Document Type</th>
              <th class="py-3.5 px-4">Purpose</th>
              <th class="py-3.5 px-4">Fee / Waiver</th>
              <th class="py-3.5 px-4">Current Status</th>
              <th class="py-3.5 px-4 text-right">Actions</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-slate-100">
            @foreach($recentCertificates as $cert)
              @php
                $statusBadges = [
                  'Pending' => 'bg-amber-100 text-amber-800 border-amber-300',
                  'Evaluated' => 'bg-blue-100 text-blue-800 border-blue-300',
                  'Approved' => 'bg-emerald-100 text-emerald-800 border-emerald-300',
                  'Ready for Release' => 'bg-purple-100 text-purple-800 border-purple-300',
                  'Claimed' => 'bg-slate-100 text-slate-700 border-slate-300',
                  'Cancelled' => 'bg-rose-100 text-rose-800 border-rose-300',
                  'Rejected' => 'bg-rose-100 text-rose-800 border-rose-300',
                ];
                $badge = $statusBadges[$cert->status] ?? 'bg-slate-100 text-slate-700 border-slate-300';
              @endphp
              <tr class="hover:bg-slate-50/70 transition-colors">
                <td class="py-3.5 px-4 font-mono font-bold text-slate-900 whitespace-nowrap">
                  {{ $cert->control_no }}
                  <span class="block text-[10px] font-normal text-slate-400">{{ $cert->created_at->format('M d, Y h:i A') }}</span>
                </td>
                <td class="py-3.5 px-4 font-bold text-slate-800">
                  {{ $cert->doc_type }}
                </td>
                <td class="py-3.5 px-4 text-slate-600 max-w-xs truncate" title="{{ $cert->purpose }}">
                  {{ $cert->purpose }}
                </td>
                <td class="py-3.5 px-4 whitespace-nowrap">
                  @if($cert->amount_paid == 0)
                    <span class="font-extrabold text-emerald-700">₱0.00 Free</span>
                  @else
                    <span class="font-bold text-slate-900">₱{{ number_format($cert->amount_paid, 2) }}</span>
                  @endif
                </td>
                <td class="py-3.5 px-4 whitespace-nowrap">
                  <span class="inline-block px-2.5 py-0.5 rounded-full text-[10px] font-bold border {{ $badge }}">
                    {{ $cert->status }}
                  </span>
                </td>
                <td class="py-3.5 px-4 text-right whitespace-nowrap">
                  <div class="flex items-center justify-end gap-1.5">
                    <button 
                      type="button" 
                      onclick="openReviewModal({{ $cert->id }})" 
                      class="px-3 py-1 rounded-xl bg-blue-50 hover:bg-blue-100 text-blue-800 border border-blue-200 font-bold text-[11px] transition-all"
                      title="Review request details and progress"
                    >
                      <i class="fa-solid fa-magnifying-glass-chart"></i>
                      <span>Review</span>
                    </button>

                    @if(in_array($cert->status, ['Approved', 'Ready for Release', 'Claimed']))
                      <a 
                        href="{{ route('resident.certificates.print', $cert->id) }}" 
                        target="_blank" 
                        class="inline-flex items-center gap-1 px-3 py-1 rounded-xl bg-emerald-50 hover:bg-emerald-100 text-emerald-800 border border-emerald-200 font-bold text-[11px] transition-all"
                        title="View official document"
                      >
                        <i class="fa-solid fa-print"></i>
                        <span>Print</span>
                      </a>
                    @endif
                  </div>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    @endif
  </div>

  <!-- 4. BOTTOM 2 COLUMNS: AID RELIEF PREVIEW & BARANGAY SERVICES GUIDE -->
  <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    
    <!-- Aid & Relief Summary -->
    <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-sm space-y-4">
      <div class="flex items-center justify-between border-b border-slate-100 pb-3">
        <h4 class="font-extrabold text-sm text-slate-900 flex items-center gap-2">
          <i class="fa-solid fa-hand-holding-heart text-rose-600"></i>
          <span>My Calamity & Relief Distribution</span>
        </h4>
        <a href="{{ route('resident.aid.history') }}" class="text-xs font-bold text-emerald-700 hover:underline">
          View All History & Advisories &rarr;
        </a>
      </div>

      @if($recentAid->isEmpty())
        <div class="p-6 text-center text-slate-400 space-y-1 text-xs">
          <p class="font-bold text-slate-600">No emergency relief distributions logged for your household.</p>
          <p>Typhoon assistance and social amelioration distributions will appear here when issued.</p>
        </div>
      @else
        <div class="space-y-3">
          @foreach($recentAid as $aid)
            <div class="p-3.5 rounded-2xl bg-slate-50 border border-slate-200 flex items-center justify-between text-xs">
              <div class="space-y-0.5">
                <p class="font-bold text-slate-900">{{ $aid->program_name }}</p>
                <p class="text-[11px] text-slate-500">{{ $aid->assistance_type }} • {{ $aid->amount_or_quantity }}</p>
              </div>
              <span class="px-2.5 py-0.5 rounded-full text-[10px] font-extrabold bg-emerald-100 text-emerald-800 border border-emerald-200">
                {{ $aid->status }}
              </span>
            </div>
          @endforeach
        </div>
      @endif
    </div>

    <!-- Official Service Desk Quick Guide -->
    <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-sm space-y-4">
      <div class="flex items-center justify-between border-b border-slate-100 pb-3">
        <h4 class="font-extrabold text-sm text-slate-900 flex items-center gap-2">
          <i class="fa-solid fa-building-columns text-emerald-600"></i>
          <span>Barangay Dacutan Service Desks</span>
        </h4>
        <a href="{{ route('resident.help') }}" class="text-xs font-bold text-emerald-700 hover:underline">
          Full Directory & Charter &rarr;
        </a>
      </div>

      <div class="space-y-3 text-xs">
        <div class="flex items-start gap-3 p-3 rounded-2xl bg-slate-50 border border-slate-200">
          <span class="px-2 py-1 rounded-xl bg-blue-100 text-blue-800 font-extrabold text-[10px]">W-1</span>
          <div>
            <p class="font-bold text-slate-900">Window 1: Document Processing & Releasing</p>
            <p class="text-[11px] text-slate-500">Barangay Secretary desk • 15 to 30 mins turnaround</p>
          </div>
        </div>

        <div class="flex items-start gap-3 p-3 rounded-2xl bg-slate-50 border border-slate-200">
          <span class="px-2 py-1 rounded-xl bg-emerald-100 text-emerald-800 font-extrabold text-[10px]">W-2</span>
          <div>
            <p class="font-bold text-slate-900">Window 2: Treasury, Assessment & Cedula</p>
            <p class="text-[11px] text-slate-500">Official receipt & community tax certificate assessment</p>
          </div>
        </div>

        <div class="flex items-start gap-3 p-3 rounded-2xl bg-slate-50 border border-slate-200">
          <span class="px-2 py-1 rounded-xl bg-purple-100 text-purple-800 font-extrabold text-[10px]">W-3</span>
          <div>
            <p class="font-bold text-slate-900">Window 3: Lupong Tagapamayapa Mediation</p>
            <p class="text-[11px] text-slate-500">KP hearings, public complaints & dispute resolutions</p>
          </div>
        </div>
      </div>
    </div>

  </div>

</div>
@endsection
