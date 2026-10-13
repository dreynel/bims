@extends('layouts.app')

@section('title', 'Executive Dashboard • Barangay Dacutan BIMS')
@section('header_title', 'Barangay Executive Dashboard')
@section('header_subtitle', 'Live Barangay Demographics, Revenue Collections & Citizen Requests')

@section('content')
<div class="space-y-6">

  <!-- 1. EXECUTIVE WELCOME BANNER -->
  <div class="relative overflow-hidden rounded-2xl bg-gradient-to-r from-slate-900 via-slate-800 to-emerald-950 p-6 sm:p-8 text-white shadow-xl border border-slate-800">
    <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
      <div class="space-y-2">
        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-500/20 text-emerald-300 border border-emerald-500/30 text-xs font-bold uppercase tracking-wider">
          <span class="w-2 h-2 rounded-full bg-emerald-400 animate-ping"></span>
          <span>Barangay Dacutan Live Terminal</span>
        </div>
        <h2 class="text-2xl sm:text-3xl font-extrabold tracking-tight">
          Mabuhay, {{ Auth::user()->name }}!
        </h2>
        <p class="text-xs sm:text-sm text-slate-300 max-w-2xl leading-relaxed">
          Welcome to the official Barangay Information Management System. You are authenticated with <span class="font-bold text-amber-300 uppercase">{{ Auth::user()->role === 'captain' ? 'Punong Barangay' : (Auth::user()->role === 'secretary' ? 'Barangay Secretary & Clerk' : Auth::user()->role) }}</span> credentials. All records are synchronized in real-time with MySQL 8.0.
        </p>
      </div>

      <!-- Quick Action Buttons -->
      <div class="flex flex-wrap gap-2.5 sm:self-center">
        <a href="{{ route('admin.residents.index') }}?action=add" class="px-3.5 py-2.5 rounded-xl bg-amber-500 hover:bg-amber-400 text-slate-900 font-extrabold text-xs flex items-center gap-2 shadow-lg transition-transform hover:-translate-y-0.5">
          <i class="fa-solid fa-user-plus"></i>
          <span>Add Resident</span>
        </a>
        <a href="{{ route('admin.certificates.index') }}?action=issue" class="px-3.5 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-extrabold text-xs flex items-center gap-2 shadow-lg transition-transform hover:-translate-y-0.5">
          <i class="fa-solid fa-file-circle-plus"></i>
          <span>Issue Clearance</span>
        </a>
        <a href="{{ route('admin.blotter.index') }}?action=file" class="px-3.5 py-2.5 rounded-xl bg-rose-600 hover:bg-rose-500 text-white font-extrabold text-xs flex items-center gap-2 shadow-lg transition-transform hover:-translate-y-0.5">
          <i class="fa-solid fa-scale-balanced"></i>
          <span>File Blotter</span>
        </a>
        <a href="{{ route('admin.aid.index') }}?action=log" class="px-3.5 py-2.5 rounded-xl bg-teal-600 hover:bg-teal-500 text-white font-extrabold text-xs flex items-center gap-2 shadow-lg transition-transform hover:-translate-y-0.5">
          <i class="fa-solid fa-hand-holding-heart"></i>
          <span>Log Ayuda Aid</span>
        </a>
      </div>
    </div>
  </div>

  <!-- 2. PRIMARY METRICS KPI CARDS -->
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
    
    <!-- Total Population -->
    <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-sm hover:shadow-md transition-shadow">
      <div class="flex items-center justify-between">
        <div>
          <p class="text-[11px] font-extrabold uppercase tracking-wider text-slate-400">Total Population</p>
          <h3 class="text-2xl sm:text-3xl font-extrabold text-slate-900 mt-1">{{ number_format($totalResidents) }}</h3>
        </div>
        <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-xl">
          <i class="fa-solid fa-users"></i>
        </div>
      </div>
      <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
        <span class="flex items-center gap-1.5 font-medium">
          <i class="fa-solid fa-check-to-slot text-emerald-600"></i>
          Registered Voters
        </span>
        <span class="font-bold text-slate-800">{{ $registeredVoters }}</span>
      </div>
    </div>

    <!-- Special Sectors Breakdown -->
    <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-sm hover:shadow-md transition-shadow">
      <div class="flex items-center justify-between">
        <div>
          <p class="text-[11px] font-extrabold uppercase tracking-wider text-slate-400">Special Sectors</p>
          <h3 class="text-2xl sm:text-3xl font-extrabold text-slate-900 mt-1">{{ $seniorCitizens + $pwdCount + $fourPsCount }}</h3>
        </div>
        <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-xl">
          <i class="fa-solid fa-id-badge"></i>
        </div>
      </div>
      <div class="mt-4 pt-3 border-t border-slate-100 grid grid-cols-3 gap-1 text-[11px] text-center">
        <div class="bg-slate-50 rounded-lg p-1">
          <span class="block text-slate-400 font-bold">OSCA</span>
          <span class="font-extrabold text-slate-800">{{ $seniorCitizens }}</span>
        </div>
        <div class="bg-slate-50 rounded-lg p-1">
          <span class="block text-slate-400 font-bold">PWD</span>
          <span class="font-extrabold text-slate-800">{{ $pwdCount }}</span>
        </div>
        <div class="bg-slate-50 rounded-lg p-1">
          <span class="block text-slate-400 font-bold">4Ps</span>
          <span class="font-extrabold text-slate-800">{{ $fourPsCount }}</span>
        </div>
      </div>
    </div>

    <!-- Revenue Collections -->
    <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-sm hover:shadow-md transition-shadow">
      <div class="flex items-center justify-between">
        <div>
          <p class="text-[11px] font-extrabold uppercase tracking-wider text-slate-400">Collections ({{ now()->format('M Y') }})</p>
          <h3 class="text-2xl sm:text-3xl font-extrabold text-emerald-600 mt-1">₱{{ number_format($collectionsThisMonth, 2) }}</h3>
        </div>
        <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-xl">
          <i class="fa-solid fa-peso-sign"></i>
        </div>
      </div>
      <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
        <span class="flex items-center gap-1.5 font-medium">
          <i class="fa-solid fa-file-invoice text-emerald-600"></i>
          Certificates Issued
        </span>
        <span class="font-bold text-slate-800">{{ $clearanceCount }} docs</span>
      </div>
    </div>

    <!-- KP Dispute Mediation -->
    <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-sm hover:shadow-md transition-shadow">
      <div class="flex items-center justify-between">
        <div>
          <p class="text-[11px] font-extrabold uppercase tracking-wider text-slate-400">KP Resolution Rate</p>
          <h3 class="text-2xl sm:text-3xl font-extrabold text-slate-900 mt-1">{{ $resolutionRate }}%</h3>
        </div>
        <div class="w-12 h-12 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center text-xl">
          <i class="fa-solid fa-scale-unbalanced-flip"></i>
        </div>
      </div>
      <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
        <span class="flex items-center gap-1.5 font-medium">
          <i class="fa-solid fa-clock-rotate-left text-amber-500"></i>
          In Mediation
        </span>
        <span class="font-bold text-amber-600">{{ $activeBlotters }} active cases</span>
      </div>
    </div>

  </div>

  <!-- 3. LIVE CITIZEN REQUEST QUEUE (SUBMITTED FROM PUBLIC PORTAL) -->
  <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
    <div class="p-5 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
      <div>
        <h3 class="text-base font-extrabold text-slate-900 flex items-center gap-2">
          <i class="fa-solid fa-inbox text-emerald-600"></i>
          <span>Incoming Citizen Online Clearance Queue</span>
        </h3>
        <p class="text-xs text-slate-500 mt-0.5">Online applications submitted through the public citizen landing portal requiring review.</p>
      </div>
      <a href="{{ route('admin.certificates.index') }}" class="inline-flex items-center gap-1 text-xs font-bold text-emerald-700 hover:text-emerald-800">
        <span>View All Certificates</span>
        <i class="fa-solid fa-arrow-right text-[10px]"></i>
      </a>
    </div>

    @if($pendingRequests->isEmpty())
      <div class="p-8 text-center text-slate-400 text-xs font-medium">
        <i class="fa-regular fa-folder-open text-3xl mb-2 text-slate-300"></i>
        <p>No pending online requests currently. New citizen applications will populate here automatically.</p>
      </div>
    @else
      <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse text-xs">
          <thead>
            <tr class="bg-slate-50/75 border-b border-slate-100 text-[11px] font-bold text-slate-500 uppercase tracking-wider">
              <th class="py-3 px-4">Tracking / Control #</th>
              <th class="py-3 px-4">Applicant Citizen</th>
              <th class="py-3 px-4">Document Type</th>
              <th class="py-3 px-4">Purpose</th>
              <th class="py-3 px-4">Date Filed</th>
              <th class="py-3 px-4">Current Status</th>
              <th class="py-3 px-4 text-right">Quick Action</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-slate-100">
            @foreach($pendingRequests as $req)
              <tr class="hover:bg-slate-50/60 transition-colors">
                <td class="py-3 px-4 font-mono font-bold text-slate-900">
                  {{ $req->control_no }}
                </td>
                <td class="py-3 px-4">
                  <p class="font-bold text-slate-800">{{ $req->citizen_name }}</p>
                  <p class="text-[10px] text-slate-400">{{ $req->purok }} • {{ $req->contact_no }}</p>
                </td>
                <td class="py-3 px-4 font-medium text-slate-700">
                  {{ $req->doc_type }}
                </td>
                <td class="py-3 px-4 text-slate-600 max-w-xs truncate" title="{{ $req->purpose }}">
                  {{ $req->purpose }}
                </td>
                <td class="py-3 px-4 text-slate-500">
                  {{ $req->created_at->format('M d, Y') }}
                </td>
                <td class="py-3 px-4">
                  @php
                    $badgeColors = [
                      'Pending' => 'bg-amber-100 text-amber-800 border-amber-300',
                      'Evaluated' => 'bg-blue-100 text-blue-800 border-blue-300',
                      'Approved' => 'bg-emerald-100 text-emerald-800 border-emerald-300',
                      'Ready for Release' => 'bg-purple-100 text-purple-800 border-purple-300',
                      'Claimed' => 'bg-slate-100 text-slate-700 border-slate-300',
                    ];
                    $color = $badgeColors[$req->status] ?? 'bg-slate-100 text-slate-700 border-slate-300';
                  @endphp
                  <span class="inline-block px-2.5 py-1 rounded-full text-[10px] font-bold border {{ $color }}">
                    {{ $req->status }}
                  </span>
                </td>
                <td class="py-3 px-4 text-right space-x-1">
                  <!-- Status Transition Form -->
                  @if($req->status === 'Pending')
                    <form action="{{ route('admin.certificates.status', $req->id) }}" method="POST" class="inline">
                      @csrf
                      <input type="hidden" name="status" value="Evaluated">
                      <button type="submit" class="px-2.5 py-1 rounded-lg bg-blue-600 hover:bg-blue-500 text-white font-bold text-[10px] shadow-sm transition-colors" title="Secretary: Review & Endorse Application">
                        <i class="fa-solid fa-clipboard-check"></i> Sec. Review
                      </button>
                    </form>
                  @elseif($req->status === 'Evaluated')
                    <form action="{{ route('admin.certificates.status', $req->id) }}" method="POST" class="inline">
                      @csrf
                      <input type="hidden" name="status" value="Approved">
                      <button type="submit" class="px-2.5 py-1 rounded-lg bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-[10px] shadow-sm transition-colors" title="Punong Barangay: Final Executive Approval">
                        <i class="fa-solid fa-stamp"></i> Capt. Approve
                      </button>
                    </form>
                  @elseif($req->status === 'Approved')
                    <form action="{{ route('admin.certificates.status', $req->id) }}" method="POST" class="inline">
                      @csrf
                      <input type="hidden" name="status" value="Ready for Release">
                      <button type="submit" class="px-2.5 py-1 rounded-lg bg-purple-600 hover:bg-purple-500 text-white font-bold text-[10px] shadow-sm transition-colors" title="Mark Ready for Release">
                        <i class="fa-solid fa-box-archive"></i> Mark Ready
                      </button>
                    </form>
                  @elseif($req->status === 'Ready for Release')
                    <a href="{{ route('admin.certificates.print', $req->id) }}" target="_blank" class="px-2.5 py-1 rounded-lg bg-blue-600 hover:bg-blue-500 text-white font-bold text-[10px] shadow-sm transition-colors inline-flex items-center gap-1">
                      <i class="fa-solid fa-print"></i> Print A4
                    </a>
                  @else
                    <a href="{{ route('admin.certificates.print', $req->id) }}" target="_blank" class="px-2 py-1 rounded text-slate-600 hover:text-slate-900 text-[11px] font-bold">
                      <i class="fa-solid fa-eye"></i> View
                    </a>
                  @endif
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    @endif
  </div>

  <!-- 4. BOTTOM TWO-COLUMN SECTION: PUROK BREAKDOWN & KP ACTIVE CASE -->
  <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    
    <!-- Purok Distribution Column -->
    <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-200/80 p-5 shadow-sm space-y-4">
      <div class="flex items-center justify-between border-b border-slate-100 pb-3">
        <div>
          <h3 class="text-sm font-extrabold text-slate-900 flex items-center gap-2">
            <i class="fa-solid fa-map-location-dot text-amber-500"></i>
            <span>Barangay Dacutan Purok & Sitio Distribution</span>
          </h3>
          <p class="text-xs text-slate-500 mt-0.5">Demographic density across territorial subdivisions.</p>
        </div>
        <span class="text-xs font-bold text-slate-400">Total: {{ $totalResidents }} residents</span>
      </div>

      <!-- Purok Progress Bars -->
      <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-2">
        @forelse($purokData as $purokName => $count)
          @php
            $percentage = $totalResidents > 0 ? round(($count / $totalResidents) * 100, 1) : 0;
          @endphp
          <div class="p-3 rounded-xl bg-slate-50 border border-slate-100 space-y-1.5">
            <div class="flex items-center justify-between text-xs">
              <span class="font-bold text-slate-800">{{ $purokName }}</span>
              <span class="font-extrabold text-emerald-700">{{ $count }} ({{ $percentage }}%)</span>
            </div>
            <div class="w-full bg-slate-200 rounded-full h-2 overflow-hidden">
              <div class="bg-emerald-600 h-2 rounded-full" style="width: {{ $percentage }}%"></div>
            </div>
          </div>
        @empty
          <p class="text-xs text-slate-400 col-span-2 py-4 text-center">No residents registered yet.</p>
        @endforelse
      </div>
    </div>

    <!-- KP Incident Highlight Card -->
    <div class="bg-white rounded-2xl border border-slate-200/80 p-5 shadow-sm space-y-4 flex flex-col justify-between">
      <div>
        <div class="flex items-center justify-between border-b border-slate-100 pb-3">
          <h3 class="text-sm font-extrabold text-slate-900 flex items-center gap-2">
            <i class="fa-solid fa-scale-balanced text-rose-500"></i>
            <span>KP Blotter Focus</span>
          </h3>
          <span class="px-2 py-0.5 rounded-full bg-rose-100 text-rose-800 text-[10px] font-bold">
            Lupon Tagapamayapa
          </span>
        </div>

        @if($activeBlotterItem)
          <div class="mt-4 p-4 rounded-xl bg-slate-50 border border-slate-200/60 space-y-2">
            <div class="flex items-center justify-between">
              <span class="font-mono text-[11px] font-extrabold text-slate-800">{{ $activeBlotterItem->case_no }}</span>
              <span class="text-[10px] font-bold px-2 py-0.5 rounded-full {{ $activeBlotterItem->status === 'In Mediation' ? 'bg-amber-100 text-amber-800' : 'bg-emerald-100 text-emerald-800' }}">
                {{ $activeBlotterItem->status }}
              </span>
            </div>
            <p class="text-xs font-bold text-slate-800">{{ $activeBlotterItem->incident_type }}</p>
            <p class="text-[11px] text-slate-600 line-clamp-3 italic">"{{ $activeBlotterItem->narrative }}"</p>
            <div class="pt-2 text-[10px] text-slate-500 border-t border-slate-200 flex justify-between">
              <span><strong>Complainant:</strong> {{ $activeBlotterItem->complainant_name }}</span>
              <span><strong>Respondent:</strong> {{ $activeBlotterItem->respondent_name }}</span>
            </div>
          </div>
        @else
          <p class="text-xs text-slate-400 py-6 text-center">No active blotter cases on record.</p>
        @endif
      </div>

      <div class="pt-3">
        <a href="{{ route('admin.blotter.index') }}" class="w-full py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-800 text-xs font-bold text-center block transition-colors">
          Manage Katarungang Pambarangay Blotter
        </a>
      </div>
    </div>

  </div>

  <!-- 5. OFFICIAL BARANGAY DACUTAN PROFILE AS OF 2025 SUMMARY -->
  <div class="bg-white rounded-2xl border border-slate-200/80 p-5 sm:p-6 shadow-sm space-y-5">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 border-b border-slate-100 pb-3">
      <div>
        <h3 class="text-sm font-extrabold text-slate-900 flex items-center gap-2">
          <i class="fa-solid fa-chart-pie text-emerald-600"></i>
          <span>Barangay Dacutan Official Profile Summary (As of 2025)</span>
        </h3>
        <p class="text-xs text-slate-500 mt-0.5">Official Barangay Census, Land Use, Boundaries, Housing Structure &amp; Livelihood Reference</p>
      </div>
      <span class="px-3 py-1 rounded-full bg-emerald-100 text-emerald-800 text-[10px] font-extrabold uppercase tracking-wider self-start sm:self-auto">
        230.7171 km. • 7 Puroks • 2,337 Pop.
      </span>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 text-xs">
      <!-- Geography & Boundaries -->
      <div class="p-4 rounded-xl bg-slate-50 border border-slate-100 space-y-2">
        <h4 class="font-extrabold text-slate-800 uppercase text-[10px] tracking-wider text-emerald-700">Geography &amp; Boundaries</h4>
        <div class="space-y-1 text-[11px] text-slate-600">
          <div class="flex justify-between"><span>Land Area:</span><strong class="text-slate-900">230.7171 km.</strong></div>
          <div class="flex justify-between"><span>Dist. from Poblacion:</span><strong class="text-slate-900">2.5 km.</strong></div>
          <div class="flex justify-between"><span>To Iloilo (Zarraga / Coastal):</span><strong class="text-slate-900">27.5 km / 22 km</strong></div>
          <div class="flex justify-between"><span>North / South:</span><strong class="text-slate-900">Sulangan-Binaobao / Coastal</strong></div>
          <div class="flex justify-between"><span>East / West:</span><strong class="text-slate-900">Talusan-Sapao / Ermita</strong></div>
        </div>
      </div>

      <!-- Land Use & Roads -->
      <div class="p-4 rounded-xl bg-slate-50 border border-slate-100 space-y-2">
        <h4 class="font-extrabold text-slate-800 uppercase text-[10px] tracking-wider text-blue-700">Land Characteristics</h4>
        <div class="space-y-1 text-[11px] text-slate-600">
          <div class="flex justify-between"><span>Plain / Rice Land:</span><strong class="text-slate-900">50%</strong></div>
          <div class="flex justify-between"><span>Fishpond (Fish Fund):</span><strong class="text-slate-900">30%</strong></div>
          <div class="flex justify-between"><span>Residential / Hilly:</span><strong class="text-slate-900">15% / 5%</strong></div>
          <div class="flex justify-between"><span>Coastline Length:</span><strong class="text-slate-900">1.5 kms.</strong></div>
          <div class="flex justify-between"><span>National / Brgy Roads:</span><strong class="text-slate-900">2.5 km / 1.5 km</strong></div>
        </div>
      </div>

      <!-- Demographics & Housing -->
      <div class="p-4 rounded-xl bg-slate-50 border border-slate-100 space-y-2">
        <h4 class="font-extrabold text-slate-800 uppercase text-[10px] tracking-wider text-purple-700">2025 Census &amp; Housing</h4>
        <div class="space-y-1 text-[11px] text-slate-600">
          <div class="flex justify-between"><span>Total Pop (M / F):</span><strong class="text-slate-900">2,337 (1,142 / 1,195)</strong></div>
          <div class="flex justify-between"><span>Families / Households:</span><strong class="text-slate-900">678 / 562</strong></div>
          <div class="flex justify-between"><span>Voters / Seniors:</span><strong class="text-slate-900">1,445 / 556</strong></div>
          <div class="flex justify-between"><span>PWD / 4Ps / OFW:</span><strong class="text-slate-900">69 / 69 / 75</strong></div>
          <div class="flex justify-between"><span>Concrete / Light / Semi:</span><strong class="text-slate-900">260 / 193 / 102</strong></div>
        </div>
      </div>

      <!-- Economic & Coastal Livelihood -->
      <div class="p-4 rounded-xl bg-slate-50 border border-slate-100 space-y-2">
        <h4 class="font-extrabold text-slate-800 uppercase text-[10px] tracking-wider text-amber-700">Economic &amp; Fisherfolks</h4>
        <div class="space-y-1 text-[11px] text-slate-600">
          <div class="flex justify-between"><span>Employed / Unemployed:</span><strong class="text-slate-900">740 / 505</strong></div>
          <div class="flex justify-between"><span>Farmers (F: 25, M: 27):</span><strong class="text-slate-900">52</strong></div>
          <div class="flex justify-between"><span>Fisherfolks (F: 67, M: 79):</span><strong class="text-slate-900">146</strong></div>
          <div class="flex justify-between"><span>Talabahan / Kasagan:</span><strong class="text-slate-900">54 / 26</strong></div>
          <div class="flex justify-between"><span>Punot / Pahubas / Saluran:</span><strong class="text-slate-900">22 / 7 / 3</strong></div>
        </div>
      </div>
    </div>
  </div>

</div>
@endsection
