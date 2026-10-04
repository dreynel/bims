@extends('layouts.app')

@section('title', 'Resident Profiling Directory • Barangay Dacutan BIMS')
@section('header_title', 'Resident Records & Profiling')
@section('header_subtitle', 'Comprehensive Census, Purok Mapping & Special Sector Eligibility')

@section('content')
<div class="space-y-6">

  <!-- 1. ACTIONS & METRICS TOP BAR -->
  <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white p-4 sm:p-5 rounded-2xl border border-slate-200/80 shadow-sm">
    <div>
      <h2 class="text-lg font-extrabold text-slate-900 flex items-center gap-2">
        <i class="fa-solid fa-address-book text-emerald-600"></i>
        <span>Official Masterlist of Residents</span>
      </h2>
      <p class="text-xs text-slate-500 mt-0.5">Showing {{ $residents->total() }} recorded residents in Barangay Dacutan, Dumangas, Iloilo.</p>
    </div>

    <div class="flex items-center gap-2.5">
      @if($pendingCount > 0)
        <a 
          href="{{ route('admin.residents.index', ['verification_status' => 'Pending Verification']) }}" 
          class="inline-flex items-center gap-1.5 px-3 py-2 rounded-xl bg-amber-500/10 hover:bg-amber-500/20 text-amber-800 border border-amber-300 font-extrabold text-xs transition-all animate-pulse"
        >
          <i class="fa-solid fa-clock"></i>
          <span>{{ $pendingCount }} Pending Verification</span>
        </a>
      @endif

      <button 
        type="button" 
        onclick="openAddModal()" 
        class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs shadow-md shadow-emerald-950/20 transition-all hover:scale-[1.02]"
      >
        <i class="fa-solid fa-user-plus text-sm"></i>
        <span>Register New Resident</span>
      </button>
    </div>
  </div>

  @if($pendingCount > 0 && request('verification_status') !== 'Verified')
    <!-- 1.5 SECRETARY IDENTITY VERIFICATION REVIEW DESK -->
    <div class="bg-gradient-to-r from-amber-950 via-slate-900 to-amber-950 rounded-2xl p-5 border-2 border-amber-500/60 shadow-xl text-white space-y-4">
      <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 border-b border-amber-500/30 pb-3">
        <div class="flex items-center gap-3">
          <span class="w-10 h-10 rounded-xl bg-amber-500/20 text-amber-400 flex items-center justify-center font-bold text-lg animate-pulse">
            <i class="fa-solid fa-stamp"></i>
          </span>
          <div>
            <div class="flex items-center gap-2">
              <h3 class="font-extrabold text-sm text-white">Barangay Secretary Identity Verification Desk</h3>
              <span class="px-2 py-0.5 rounded-full text-[10px] font-black bg-amber-500 text-slate-950">
                {{ $pendingCount }} Awaiting Review
              </span>
            </div>
            <p class="text-[11px] text-slate-300">
              Basis: Clerical review and side-by-side inspection of uploaded Government ID and resident selfie holding ID.
            </p>
          </div>
        </div>
        <span class="text-[11px] text-amber-300 font-medium">Clerk: Mrs. Ma. Elena Balleza</span>
      </div>

      <!-- Quick Review Cards Grid -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3.5 pt-1">
        @foreach($pendingResidents as $pres)
          <div class="bg-slate-800/95 rounded-2xl p-4 border border-slate-700/80 shadow-lg space-y-3">
            <div class="flex items-center justify-between">
              <span class="font-mono text-[10px] font-bold text-amber-400 bg-amber-500/10 px-2 py-0.5 rounded border border-amber-500/20">
                {{ $pres->resident_id }}
              </span>
              <button type="button" onclick="viewResident({{ $pres->id }})" class="text-[10px] font-bold text-slate-300 hover:text-white transition-colors flex items-center gap-1 px-2 py-0.5 rounded-lg bg-slate-700/60 hover:bg-slate-700">
                <i class="fa-solid fa-eye text-emerald-400"></i>
                <span>Inspect Profile</span>
              </button>
            </div>

            <div>
              <h4 class="font-extrabold text-xs text-white">{{ $pres->full_name }}</h4>
              <p class="text-[10px] text-slate-400">{{ $pres->purok }} • {{ $pres->gender }} • {{ $pres->age }} yrs old</p>
              <p class="text-[10px] text-emerald-400 mt-0.5"><i class="fa-solid fa-id-card mr-1"></i>{{ $pres->id_type }}: <span class="font-mono text-white">{{ $pres->id_number }}</span></p>
            </div>

            <!-- Side-by-side ID and Selfie -->
            <div class="grid grid-cols-2 gap-2 text-[10px]">
              <div class="space-y-1">
                <span class="text-slate-400 text-[9px] uppercase font-bold block truncate">1. Gov't ID</span>
                <div class="h-20 rounded-xl bg-slate-950 border border-slate-700 overflow-hidden relative group">
                  <img src="{{ $pres->id_photo ?? $pres->photo }}" alt="ID" class="w-full h-full object-cover">
                  <a href="{{ $pres->id_photo ?? $pres->photo }}" target="_blank" class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 flex items-center justify-center text-white text-[10px] font-bold transition-opacity">
                    <i class="fa-solid fa-expand"></i>
                  </a>
                </div>
              </div>

              <div class="space-y-1">
                <span class="text-slate-400 text-[9px] uppercase font-bold block truncate">2. Selfie with ID</span>
                <div class="h-20 rounded-xl bg-slate-950 border border-slate-700 overflow-hidden relative group">
                  <img src="{{ $pres->proof_of_residency ?? $pres->photo }}" alt="Selfie" class="w-full h-full object-cover">
                  <a href="{{ $pres->proof_of_residency ?? $pres->photo }}" target="_blank" class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 flex items-center justify-center text-white text-[10px] font-bold transition-opacity">
                    <i class="fa-solid fa-expand"></i>
                  </a>
                </div>
              </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center gap-2 pt-2 border-t border-slate-700">
              <button 
                type="button" 
                onclick="confirmValidateResident({{ $pres->id }}, '{{ addslashes($pres->full_name) }}')"
                class="flex-1 py-1.5 px-2 rounded-xl bg-emerald-600 hover:bg-emerald-500 active:scale-95 text-white font-extrabold text-[11px] shadow transition-all flex items-center justify-center gap-1"
                title="Approve identity verification"
              >
                <i class="fa-solid fa-circle-check"></i>
                <span>Approve</span>
              </button>

              <button 
                type="button" 
                onclick="confirmRejectResident({{ $pres->id }}, '{{ addslashes($pres->full_name) }}')" 
                class="py-1.5 px-3 rounded-xl bg-rose-950 hover:bg-rose-900 border border-rose-800 text-rose-300 font-bold text-[11px] transition-all flex items-center justify-center gap-1"
                title="Reject with remarks"
              >
                <i class="fa-solid fa-circle-xmark"></i>
                <span>Reject</span>
              </button>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  @endif

  <!-- 2. SEARCH & FILTERING BAR -->
  <div class="bg-white p-4 sm:p-5 rounded-2xl border border-slate-200/80 shadow-sm">
    <form method="GET" action="{{ route('admin.residents.index') }}" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-3">
      
      <!-- Keyword Search -->
      <div class="relative">
        <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
          <i class="fa-solid fa-magnifying-glass text-xs"></i>
        </span>
        <input 
          type="text" 
          name="search" 
          value="{{ request('search') }}" 
          placeholder="Search name or DAC ID..." 
          class="w-full pl-9 pr-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-emerald-500"
        >
      </div>

      <!-- Filter by Verification Status -->
      <div>
        <select 
          name="verification_status" 
          onchange="this.form.submit()" 
          class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-800 font-medium focus:outline-none focus:ring-2 focus:ring-emerald-500"
        >
          <option value="All">All Verification Statuses</option>
          <option value="Pending Verification" {{ request('verification_status') == 'Pending Verification' ? 'selected' : '' }}>Pending Review ({{ $pendingCount }})</option>
          <option value="Verified" {{ request('verification_status') == 'Verified' ? 'selected' : '' }}>Verified Only</option>
          <option value="Rejected" {{ request('verification_status') == 'Rejected' ? 'selected' : '' }}>Rejected Only</option>
        </select>
      </div>

      <!-- Filter by Purok -->
      <div>
        <select 
          name="purok" 
          onchange="this.form.submit()" 
          class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-800 font-medium focus:outline-none focus:ring-2 focus:ring-emerald-500"
        >
          <option value="All">All Puroks & Sitios</option>
          @foreach($puroks as $p)
            <option value="{{ $p }}" {{ request('purok') == $p ? 'selected' : '' }}>{{ $p }}</option>
          @endforeach
        </select>
      </div>

      <!-- Filter by Sector -->
      <div>
        <select 
          name="sector" 
          onchange="this.form.submit()" 
          class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-800 font-medium focus:outline-none focus:ring-2 focus:ring-emerald-500"
        >
          <option value="All">All Sectors & Eligibility</option>
          <option value="Senior" {{ request('sector') == 'Senior' ? 'selected' : '' }}>Senior Citizens (OSCA)</option>
          <option value="PWD" {{ request('sector') == 'PWD' ? 'selected' : '' }}>Persons with Disability (PWD)</option>
          <option value="4Ps" {{ request('sector') == '4Ps' ? 'selected' : '' }}>4Ps Beneficiaries</option>
          <option value="Indigent" {{ request('sector') == 'Indigent' ? 'selected' : '' }}>Indigent Residents</option>
          <option value="SoloParent" {{ request('sector') == 'SoloParent' ? 'selected' : '' }}>Solo Parents</option>
          <option value="Voter" {{ request('sector') == 'Voter' ? 'selected' : '' }}>Registered Voters</option>
        </select>
      </div>

      <!-- Submit / Reset Buttons -->
      <div class="flex items-center gap-2">
        <button 
          type="submit" 
          class="flex-1 py-2 px-3 rounded-xl bg-slate-800 hover:bg-slate-700 text-white font-bold text-xs transition-colors"
        >
          Filter
        </button>
        @if(request()->hasAny(['search', 'verification_status', 'purok', 'sector']))
          <a 
            href="{{ route('admin.residents.index') }}" 
            class="py-2 px-3 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-600 font-bold text-xs transition-colors"
            title="Clear Filters"
          >
            Reset
          </a>
        @endif
      </div>

    </form>
  </div>

  <!-- 3. RESIDENTS MASTERLIST TABLE -->
  <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
    @if($residents->isEmpty())
      <div class="p-12 text-center text-slate-400 space-y-3">
        <i class="fa-solid fa-users-slash text-4xl text-slate-300"></i>
        <p class="text-sm font-bold text-slate-600">No resident records matched your query.</p>
        <p class="text-xs text-slate-400">Try adjusting your search criteria or register a new resident above.</p>
      </div>
    @else
      <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse text-xs">
          <thead>
            <tr class="bg-slate-50/75 border-b border-slate-200 text-[11px] font-bold text-slate-500 uppercase tracking-wider">
              <th class="py-3.5 px-4">Resident ID</th>
              <th class="py-3.5 px-4">Full Name & Details</th>
              <th class="py-3.5 px-4">Verification</th>
              <th class="py-3.5 px-4">Territory (Purok)</th>
              <th class="py-3.5 px-4">Civil Status</th>
              <th class="py-3.5 px-4">Sector Classifications</th>
              <th class="py-3.5 px-4">Voter Status</th>
              <th class="py-3.5 px-4 text-right">Actions</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-slate-100 font-normal text-slate-700">
            @foreach($residents as $res)
              <tr class="hover:bg-slate-50/80 transition-colors">
                <!-- Resident ID -->
                <td class="py-3.5 px-4 font-mono font-bold text-slate-900">
                  {{ $res->resident_id }}
                </td>

                <!-- Full Name & Details -->
                <td class="py-3.5 px-4">
                  <div class="flex items-center gap-3">
                    <img 
                      src="{{ $res->photo }}" 
                      alt="Avatar" 
                      class="w-9 h-9 rounded-full object-cover border border-slate-200 flex-shrink-0"
                    >
                    <div>
                      <p class="font-bold text-slate-900 text-xs hover:text-emerald-700 cursor-pointer" onclick="viewResident({{ $res->id }})">
                        {{ $res->full_name }}
                      </p>
                      <p class="text-[10px] text-slate-400">
                        {{ $res->gender }} • {{ $res->age }} yrs old • {{ $res->birth_date->format('M d, Y') }}
                      </p>
                    </div>
                  </div>
                </td>

                <!-- Identity Verification Status -->
                <td class="py-3.5 px-4 whitespace-nowrap">
                  @if($res->verification_status === 'Verified')
                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-emerald-50 text-emerald-800 border border-emerald-200 text-[10px] font-extrabold">
                      <i class="fa-solid fa-circle-check text-emerald-600"></i> Verified
                    </span>
                  @elseif($res->verification_status === 'Pending Verification')
                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-amber-50 text-amber-800 border border-amber-300 text-[10px] font-extrabold animate-pulse">
                      <i class="fa-solid fa-clock text-amber-600"></i> Pending Review
                    </span>
                  @elseif($res->verification_status === 'Rejected')
                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-rose-50 text-rose-800 border border-rose-200 text-[10px] font-extrabold">
                      <i class="fa-solid fa-circle-xmark text-rose-600"></i> Rejected
                    </span>
                  @else
                    <span class="text-slate-400 text-[10px]">{{ $res->verification_status }}</span>
                  @endif
                </td>

                <!-- Purok -->
                <td class="py-3.5 px-4 font-medium text-slate-800">
                  <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-slate-100 text-slate-700 text-[11px] font-semibold border border-slate-200">
                    <i class="fa-solid fa-location-dot text-amber-500 text-[10px]"></i>
                    {{ $res->purok }}
                  </span>
                  <p class="text-[10px] text-slate-400 mt-0.5 truncate max-w-xs">{{ $res->address }}</p>
                </td>

                <!-- Civil Status -->
                <td class="py-3.5 px-4 text-slate-600 font-medium">
                  {{ $res->civil_status }}
                </td>

                <!-- Sector Badges -->
                <td class="py-3.5 px-4">
                  <div class="flex flex-wrap gap-1">
                    @if($res->is_senior)
                      <span class="px-2 py-0.5 rounded bg-amber-50 text-amber-800 border border-amber-200 text-[10px] font-bold" title="Senior Citizen (OSCA)">Senior</span>
                    @endif
                    @if($res->is_pwd)
                      <span class="px-2 py-0.5 rounded bg-blue-50 text-blue-800 border border-blue-200 text-[10px] font-bold" title="Person with Disability">PWD</span>
                    @endif
                    @if($res->is_4ps)
                      <span class="px-2 py-0.5 rounded bg-emerald-50 text-emerald-800 border border-emerald-200 text-[10px] font-bold" title="4Ps DSWD Beneficiary">4Ps</span>
                    @endif
                    @if($res->is_indigent)
                      <span class="px-2 py-0.5 rounded bg-purple-50 text-purple-800 border border-purple-200 text-[10px] font-bold" title="Indigent Family">Indigent</span>
                    @endif
                    @if($res->is_solo_parent)
                      <span class="px-2 py-0.5 rounded bg-pink-50 text-pink-800 border border-pink-200 text-[10px] font-bold" title="Solo Parent">Solo Parent</span>
                    @endif
                    @if(!$res->is_senior && !$res->is_pwd && !$res->is_4ps && !$res->is_indigent && !$res->is_solo_parent)
                      <span class="text-slate-400 text-[10px] italic">General Resident</span>
                    @endif
                  </div>
                </td>

                <!-- Voter Status -->
                <td class="py-3.5 px-4">
                  @if($res->voter_status === 'Registered')
                    <span class="inline-flex items-center gap-1 text-[11px] font-bold text-emerald-700">
                      <i class="fa-solid fa-circle-check text-[10px]"></i>
                      Registered
                    </span>
                  @else
                    <span class="inline-flex items-center gap-1 text-[11px] font-medium text-slate-400">
                      <i class="fa-solid fa-circle-xmark text-[10px]"></i>
                      Not Registered
                    </span>
                  @endif
                </td>

                <!-- Actions -->
                <td class="py-3.5 px-4 text-right space-x-1 whitespace-nowrap">
                  @if($res->verification_status === 'Pending Verification' || $res->verification_status === 'Rejected')
                    <!-- Quick Approve Button -->
                    <button 
                      type="button" 
                      onclick="confirmValidateResident({{ $res->id }}, '{{ addslashes($res->full_name) }}')"
                      class="p-1.5 rounded-lg bg-emerald-100 hover:bg-emerald-200 text-emerald-800 transition-colors" 
                      title="Approve Identity Verification"
                    >
                      <i class="fa-solid fa-stamp text-xs"></i>
                    </button>

                    <!-- Quick Reject / Revoke Button -->
                    <button 
                      type="button" 
                      onclick="confirmRejectResident({{ $res->id }}, '{{ addslashes($res->full_name) }}')" 
                      class="p-1.5 rounded-lg bg-rose-50 hover:bg-rose-100 text-rose-700 transition-colors" 
                      title="{{ $res->verification_status === 'Rejected' ? 'Edit Rejection Remarks' : 'Reject Verification' }}"
                    >
                      <i class="fa-solid fa-user-xmark text-xs"></i>
                    </button>
                  @endif

                  <!-- View Profile Modal Button -->
                  <button 
                    type="button" 
                    onclick="viewResident({{ $res->id }})" 
                    class="p-1.5 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-700 transition-colors" 
                    title="View Profile Details"
                  >
                    <i class="fa-solid fa-eye text-xs"></i>
                  </button>

                  <!-- Edit Resident Button -->
                  <button 
                    type="button" 
                    onclick="editResident({{ $res->toJson() }})" 
                    class="p-1.5 rounded-lg bg-blue-50 hover:bg-blue-100 text-blue-700 transition-colors" 
                    title="Edit Record"
                  >
                    <i class="fa-solid fa-pen-to-square text-xs"></i>
                  </button>

                  <!-- Delete Resident Form -->
                  <form action="{{ route('admin.residents.destroy', $res->id) }}" method="POST" class="inline" onsubmit="confirmDeleteResident(event, this, '{{ addslashes($res->full_name) }}');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="p-1.5 rounded-lg bg-rose-50 hover:bg-rose-100 text-rose-600 transition-colors" title="Delete Resident">
                      <i class="fa-solid fa-trash-can text-xs"></i>
                    </button>
                  </form>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>

      <!-- Pagination Footer -->
      <div class="p-4 border-t border-slate-100 bg-slate-50/50 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-slate-500">
        <div>
          Showing <span class="font-bold text-slate-800">{{ $residents->firstItem() }}</span> to <span class="font-bold text-slate-800">{{ $residents->lastItem() }}</span> of <span class="font-bold text-slate-800">{{ $residents->total() }}</span> records
        </div>
        <div>
          {{ $residents->links() }}
        </div>
      </div>
    @endif
  </div>

</div>

<!-- 4. MODAL: REGISTER NEW RESIDENT -->
<div id="addResidentModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm hidden">
  <div class="bg-white rounded-2xl max-w-2xl w-full max-h-[90vh] flex flex-col shadow-2xl border border-slate-200 overflow-hidden animate-fade-in">
    
    <!-- Modal Header -->
    <div class="px-6 py-4 bg-slate-900 text-white flex items-center justify-between">
      <div class="flex items-center gap-2.5">
        <div class="w-8 h-8 rounded-lg bg-emerald-500/20 text-emerald-400 flex items-center justify-center font-bold">
          <i class="fa-solid fa-user-plus"></i>
        </div>
        <div>
          <h3 class="text-sm font-extrabold">Barangay Resident Registration</h3>
          <p class="text-[10px] text-slate-400">Official Census Profiling • Dumangas, Iloilo</p>
        </div>
      </div>
      <button onclick="closeAddModal()" class="text-slate-400 hover:text-white transition-colors">
        <i class="fa-solid fa-xmark text-lg"></i>
      </button>
    </div>

    <!-- Modal Form Body -->
    <form action="{{ route('admin.residents.store') }}" method="POST" class="p-6 space-y-4 overflow-y-auto flex-1">
      @csrf

      <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
        <div>
          <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1">First Name *</label>
          <input type="text" name="first_name" required placeholder="Juan" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-900 focus:ring-2 focus:ring-emerald-500">
        </div>
        <div>
          <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1">Middle Name</label>
          <input type="text" name="middle_name" placeholder="Santos" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-900 focus:ring-2 focus:ring-emerald-500">
        </div>
        <div>
          <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1">Last Name *</label>
          <input type="text" name="last_name" required placeholder="Dela Cruz" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-900 focus:ring-2 focus:ring-emerald-500">
        </div>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-4 gap-3">
        <div>
          <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1">Suffix</label>
          <input type="text" name="suffix" placeholder="Jr., III" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-900 focus:ring-2 focus:ring-emerald-500">
        </div>
        <div>
          <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1">Gender *</label>
          <select name="gender" required class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-900 focus:ring-2 focus:ring-emerald-500">
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Other">Other</option>
          </select>
        </div>
        <div>
          <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1">Birth Date *</label>
          <input type="date" name="birth_date" required class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-900 focus:ring-2 focus:ring-emerald-500">
        </div>
        <div>
          <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1">Civil Status *</label>
          <select name="civil_status" required class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-900 focus:ring-2 focus:ring-emerald-500">
            <option value="Single">Single</option>
            <option value="Married">Married</option>
            <option value="Widowed">Widowed</option>
            <option value="Separated">Separated</option>
          </select>
        </div>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
        <div>
          <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1">Purok / Sitio *</label>
          <select name="purok" required class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-900 focus:ring-2 focus:ring-emerald-500">
            @foreach($puroks as $p)
              <option value="{{ $p }}">{{ $p }}</option>
            @endforeach
          </select>
        </div>
        <div class="sm:col-span-2">
          <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1">Complete Street Address *</label>
          <input type="text" name="address" required placeholder="House #, Street, Purok" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-900 focus:ring-2 focus:ring-emerald-500">
        </div>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
        <div>
          <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1">Contact Mobile</label>
          <input type="text" name="contact_no" placeholder="0917-123-4567" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-900 focus:ring-2 focus:ring-emerald-500">
        </div>
        <div>
          <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1">Occupation</label>
          <input type="text" name="occupation" placeholder="Farmer, Teacher, etc." class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-900 focus:ring-2 focus:ring-emerald-500">
        </div>
        <div>
          <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1">Monthly Income (₱)</label>
          <input type="number" step="0.01" name="monthly_income" placeholder="10000.00" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-900 focus:ring-2 focus:ring-emerald-500">
        </div>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
        <div>
          <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1">COMELEC Voter Status *</label>
          <select name="voter_status" required class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-900 focus:ring-2 focus:ring-emerald-500">
            <option value="Registered">Registered Voter</option>
            <option value="Not Registered">Not Registered</option>
          </select>
        </div>
        <div>
          <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1">Voter Precinct No.</label>
          <input type="text" name="voter_precinct" placeholder="PRECINCT-0042A" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-900 focus:ring-2 focus:ring-emerald-500">
        </div>
      </div>

      <!-- Sector Checkboxes -->
      <div class="p-3.5 bg-slate-50 rounded-xl border border-slate-200 space-y-2">
        <label class="block text-[11px] font-bold text-slate-700 uppercase">Sector Affiliations & Vulnerability Indicators</label>
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-2 pt-1 text-xs">
          <label class="flex items-center gap-2 cursor-pointer">
            <input type="checkbox" name="is_senior" value="1" class="rounded text-emerald-600 focus:ring-emerald-500">
            <span>Senior Citizen</span>
          </label>
          <label class="flex items-center gap-2 cursor-pointer">
            <input type="checkbox" name="is_pwd" value="1" class="rounded text-blue-600 focus:ring-blue-500">
            <span>PWD</span>
          </label>
          <label class="flex items-center gap-2 cursor-pointer">
            <input type="checkbox" name="is_4ps" value="1" class="rounded text-emerald-600 focus:ring-emerald-500">
            <span>4Ps Beneficiary</span>
          </label>
          <label class="flex items-center gap-2 cursor-pointer">
            <input type="checkbox" name="is_indigent" value="1" class="rounded text-purple-600 focus:ring-purple-500">
            <span>Indigent</span>
          </label>
          <label class="flex items-center gap-2 cursor-pointer col-span-2">
            <input type="checkbox" name="is_solo_parent" value="1" class="rounded text-pink-600 focus:ring-pink-500">
            <span>Solo Parent (RA 8972)</span>
          </label>
        </div>
      </div>

      <!-- Modal Footer -->
      <div class="pt-4 border-t border-slate-200 flex items-center justify-end gap-3">
        <button type="button" onclick="closeAddModal()" class="px-4 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold transition-colors">
          Cancel
        </button>
        <button type="submit" class="px-5 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-bold shadow-md shadow-emerald-950/20 transition-all">
          Save Resident Record
        </button>
      </div>
    </form>

  </div>
</div>

<!-- 5. MODAL: VIEW RESIDENT PROFILE & IDENTITY DOCUMENTS -->
<div id="viewResidentModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm hidden">
  <div class="bg-white rounded-3xl max-w-xl w-full max-h-[92vh] flex flex-col shadow-2xl border border-slate-200 overflow-hidden animate-fade-in">
    <div class="px-6 py-4 bg-slate-900 text-white flex items-center justify-between">
      <h3 class="text-sm font-extrabold flex items-center gap-2">
        <i class="fa-solid fa-id-card text-emerald-400"></i>
        <span>Official Citizen Profile & Verification Desk</span>
      </h3>
      <button onclick="closeViewModal()" class="text-slate-400 hover:text-white">
        <i class="fa-solid fa-xmark text-lg"></i>
      </button>
    </div>
    <div id="viewModalContent" class="p-6 space-y-4 text-xs overflow-y-auto flex-1">
      <!-- Injected via JavaScript -->
      <div class="text-center py-8 text-slate-400">Loading resident details...</div>
    </div>
    <div id="viewModalFooter" class="px-6 py-3 bg-slate-50 border-t border-slate-200 flex items-center justify-between">
      <span class="text-[11px] text-slate-400">Barangay Dacutan Census Records</span>
      <button onclick="closeViewModal()" class="px-4 py-1.5 rounded-xl bg-slate-800 text-white text-xs font-bold">
        Close
      </button>
    </div>
  </div>
</div>

<!-- 5.5 MODAL: REJECT IDENTITY VERIFICATION -->
<div id="rejectModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm hidden">
  <div class="bg-white rounded-3xl max-w-md w-full p-6 shadow-2xl border border-slate-200 space-y-4 animate-fade-in">
    <div class="flex items-center justify-between border-b border-slate-100 pb-3">
      <div class="flex items-center gap-2">
        <div class="w-8 h-8 rounded-xl bg-rose-100 text-rose-600 flex items-center justify-center text-sm font-bold">
          <i class="fa-solid fa-user-xmark"></i>
        </div>
        <h4 class="font-extrabold text-sm text-slate-900">Reject Identity Verification</h4>
      </div>
      <button onclick="closeRejectModal()" class="text-slate-400 hover:text-slate-600">
        <i class="fa-solid fa-xmark text-lg"></i>
      </button>
    </div>

    <p class="text-xs text-slate-600 leading-relaxed">
      Provide evaluation remarks explaining why the identity documents for <strong id="rejectResidentName" class="text-slate-900"></strong> are being rejected (e.g. blurry ID photo, invalid document, or unverified address):
    </p>

    <form id="rejectForm" method="POST" class="space-y-4">
      @csrf
      <div>
        <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1">Clerical Remarks *</label>
        <textarea 
          name="remarks" 
          id="reject_remarks" 
          required 
          rows="3" 
          placeholder="e.g. Attached ID photo is blurry and illegible. Please visit Window 1 or re-upload a clear copy of your PhilSys ID."
          class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-900 focus:ring-2 focus:ring-rose-500 focus:outline-none"
        ></textarea>
      </div>

      <div class="flex items-center justify-end gap-2 pt-2 border-t border-slate-100">
        <button type="button" onclick="closeRejectModal()" class="px-4 py-2 rounded-xl bg-slate-100 text-slate-700 font-bold text-xs">
          Cancel
        </button>
        <button type="submit" class="px-5 py-2 rounded-xl bg-rose-600 hover:bg-rose-500 text-white font-bold text-xs shadow-md shadow-rose-950/20 transition-all">
          Confirm Rejection
        </button>
      </div>
    </form>
  </div>
</div>

<!-- 6. MODAL: EDIT RESIDENT -->
<div id="editResidentModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm hidden">
  <div class="bg-white rounded-2xl max-w-2xl w-full max-h-[90vh] flex flex-col shadow-2xl border border-slate-200 overflow-hidden animate-fade-in">
    
    <div class="px-6 py-4 bg-slate-900 text-white flex items-center justify-between">
      <h3 class="text-sm font-extrabold flex items-center gap-2">
        <i class="fa-solid fa-user-pen text-blue-400"></i>
        <span>Edit Resident Record</span>
      </h3>
      <button onclick="closeEditModal()" class="text-slate-400 hover:text-white">
        <i class="fa-solid fa-xmark text-lg"></i>
      </button>
    </div>

    <form id="editResidentForm" method="POST" class="p-6 space-y-4 overflow-y-auto flex-1">
      @csrf
      @method('PUT')

      <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
        <div>
          <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1">First Name *</label>
          <input type="text" id="edit_first_name" name="first_name" required class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-900 focus:ring-2 focus:ring-blue-500">
        </div>
        <div>
          <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1">Middle Name</label>
          <input type="text" id="edit_middle_name" name="middle_name" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-900">
        </div>
        <div>
          <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1">Last Name *</label>
          <input type="text" id="edit_last_name" name="last_name" required class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-900">
        </div>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-4 gap-3">
        <div>
          <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1">Suffix</label>
          <input type="text" id="edit_suffix" name="suffix" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-900">
        </div>
        <div>
          <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1">Gender *</label>
          <select id="edit_gender" name="gender" required class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-900">
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Other">Other</option>
          </select>
        </div>
        <div>
          <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1">Birth Date *</label>
          <input type="date" id="edit_birth_date" name="birth_date" required class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-900">
        </div>
        <div>
          <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1">Civil Status *</label>
          <select id="edit_civil_status" name="civil_status" required class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-900">
            <option value="Single">Single</option>
            <option value="Married">Married</option>
            <option value="Widowed">Widowed</option>
            <option value="Separated">Separated</option>
          </select>
        </div>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
        <div>
          <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1">Purok *</label>
          <select id="edit_purok" name="purok" required class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-900">
            @foreach($puroks as $p)
              <option value="{{ $p }}">{{ $p }}</option>
            @endforeach
          </select>
        </div>
        <div class="sm:col-span-2">
          <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1">Address *</label>
          <input type="text" id="edit_address" name="address" required class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-900">
        </div>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
        <div>
          <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1">Contact No</label>
          <input type="text" id="edit_contact_no" name="contact_no" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-900">
        </div>
        <div>
          <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1">Occupation</label>
          <input type="text" id="edit_occupation" name="occupation" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-900">
        </div>
        <div>
          <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1">Monthly Income (₱)</label>
          <input type="number" step="0.01" id="edit_monthly_income" name="monthly_income" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-900">
        </div>
      </div>

      <div>
        <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1">Voter Status *</label>
        <select id="edit_voter_status" name="voter_status" required class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-900">
          <option value="Registered">Registered</option>
          <option value="Not Registered">Not Registered</option>
        </select>
      </div>

      <!-- Sector Affiliations -->
      <div class="p-3.5 bg-slate-50 rounded-xl border border-slate-200 space-y-2">
        <label class="block text-[11px] font-bold text-slate-700 uppercase">Sector Affiliations</label>
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-2 pt-1 text-xs">
          <label class="flex items-center gap-2 cursor-pointer">
            <input type="checkbox" id="edit_is_senior" name="is_senior" value="1" class="rounded text-emerald-600">
            <span>Senior Citizen</span>
          </label>
          <label class="flex items-center gap-2 cursor-pointer">
            <input type="checkbox" id="edit_is_pwd" name="is_pwd" value="1" class="rounded text-blue-600">
            <span>PWD</span>
          </label>
          <label class="flex items-center gap-2 cursor-pointer">
            <input type="checkbox" id="edit_is_4ps" name="is_4ps" value="1" class="rounded text-emerald-600">
            <span>4Ps Beneficiary</span>
          </label>
          <label class="flex items-center gap-2 cursor-pointer">
            <input type="checkbox" id="edit_is_indigent" name="is_indigent" value="1" class="rounded text-purple-600">
            <span>Indigent</span>
          </label>
          <label class="flex items-center gap-2 cursor-pointer col-span-2">
            <input type="checkbox" id="edit_is_solo_parent" name="is_solo_parent" value="1" class="rounded text-pink-600">
            <span>Solo Parent</span>
          </label>
        </div>
      </div>

      <div class="pt-4 border-t border-slate-200 flex items-center justify-end gap-3">
        <button type="button" onclick="closeEditModal()" class="px-4 py-2 rounded-xl bg-slate-100 text-slate-700 text-xs font-bold">
          Cancel
        </button>
        <button type="submit" class="px-5 py-2 rounded-xl bg-blue-600 hover:bg-blue-500 text-white text-xs font-bold">
          Update Resident
        </button>
      </div>
    </form>
  </div>
</div>
@endsection

@section('scripts')
<!-- SweetAlert2 (Loaded locally to guarantee availability in Resident Directory) -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  window.GovSwal = (typeof Swal !== 'undefined') ? Swal.mixin({
    customClass: {
      popup: 'rounded-3xl shadow-2xl font-sans border border-slate-200',
      confirmButton: 'px-5 py-2.5 rounded-xl font-extrabold text-xs shadow-md transition-all active:scale-95',
      cancelButton: 'px-4 py-2.5 rounded-xl font-bold text-xs bg-slate-100 hover:bg-slate-200 text-slate-700 transition-all mr-2',
    },
    buttonsStyling: true,
  }) : null;

  function openAddModal() {
    document.getElementById('addResidentModal').classList.remove('hidden');
  }
  function closeAddModal() {
    document.getElementById('addResidentModal').classList.add('hidden');
  }

  function viewResident(id) {
    const modal = document.getElementById('viewResidentModal');
    const content = document.getElementById('viewModalContent');
    const footer = document.getElementById('viewModalFooter');
    modal.classList.remove('hidden');
    content.innerHTML = '<div class="text-center py-8 text-slate-400"><i class="fa-solid fa-spinner fa-spin text-2xl mb-2 text-emerald-600"></i><p>Loading resident profile & identity records...</p></div>';

    fetch(`{{ url('admin/residents') }}/${id}`)
      .then(res => res.json())
      .then(data => {
        const birthDate = data.birth_date ? new Date(data.birth_date).toLocaleDateString('en-US', { year: 'numeric', month: 'short', day: 'numeric' }) : 'N/A';
        
        let statusBadge = '<span class="px-2.5 py-0.5 rounded-full bg-emerald-100 text-emerald-800 font-extrabold text-[10px] border border-emerald-200"><i class="fa-solid fa-circle-check mr-1"></i>Verified Resident</span>';
        if (data.verification_status === 'Pending Verification') {
          statusBadge = '<span class="px-2.5 py-0.5 rounded-full bg-amber-100 text-amber-800 font-extrabold text-[10px] border border-amber-300 animate-pulse"><i class="fa-solid fa-clock mr-1"></i>Pending Secretary Review</span>';
        } else if (data.verification_status === 'Rejected') {
          statusBadge = '<span class="px-2.5 py-0.5 rounded-full bg-rose-100 text-rose-800 font-extrabold text-[10px] border border-rose-200"><i class="fa-solid fa-circle-xmark mr-1"></i>Rejected</span>';
        }

        content.innerHTML = `
          <div class="flex items-center justify-between border-b border-slate-100 pb-3">
            <div class="flex items-center gap-3">
              <img src="${data.photo || 'https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?auto=format&fit=crop&w=200&q=80'}" class="w-14 h-14 rounded-2xl object-cover border border-slate-200 shadow-sm">
              <div>
                <span class="font-mono text-[10px] font-bold text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded border border-emerald-200">${data.resident_id}</span>
                <h4 class="text-sm font-extrabold text-slate-900 mt-0.5">${data.first_name} ${data.middle_name || ''} ${data.last_name} ${data.suffix || ''}</h4>
                <p class="text-slate-500 text-[11px]">${data.gender} • ${data.civil_status}</p>
              </div>
            </div>
            <div>
              ${statusBadge}
            </div>
          </div>

          <!-- Submitted Verification Documents (The Basis for Verification) -->
          <div class="space-y-2 pt-1">
            <div class="flex items-center justify-between">
              <span class="text-[11px] font-bold uppercase text-slate-700 tracking-wider flex items-center gap-1.5">
                <i class="fa-solid fa-id-card-clip text-emerald-600"></i>
                <span>Basis for Verification: Attached Documents</span>
              </span>
              <span class="text-[10px] text-slate-400 font-mono">${data.id_type || 'Government ID'}</span>
            </div>

            <div class="grid grid-cols-2 gap-2 text-[10px]">
              <div class="p-2.5 rounded-xl bg-slate-50 border border-slate-200 space-y-1.5">
                <span class="font-bold text-slate-700 block truncate">1. Front of Valid ID</span>
                <div class="h-28 rounded-lg bg-slate-900 border border-slate-300 overflow-hidden relative group">
                  <img src="${data.id_photo || data.photo || '{{ asset('assets/images/logo.svg') }}'}" alt="Govt ID" class="w-full h-full object-contain p-1">
                  <a href="${data.id_photo || data.photo || '{{ asset('assets/images/logo.svg') }}'}" target="_blank" class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 flex items-center justify-center text-white font-bold transition-opacity">
                    <i class="fa-solid fa-expand mr-1"></i> View Full
                  </a>
                </div>
                <p class="text-slate-500 truncate">ID No: <span class="font-mono font-bold text-slate-800">${data.id_number || 'N/A'}</span></p>
              </div>

              <div class="p-2.5 rounded-xl bg-slate-50 border border-slate-200 space-y-1.5">
                <span class="font-bold text-slate-700 block truncate">2. Selfie Holding ID</span>
                <div class="h-28 rounded-lg bg-slate-900 border border-slate-300 overflow-hidden relative group">
                  <img src="${data.proof_of_residency || data.photo || '{{ asset('assets/images/logo.svg') }}'}" alt="Proof" class="w-full h-full object-contain p-1">
                  <a href="${data.proof_of_residency || data.photo || '{{ asset('assets/images/logo.svg') }}'}" target="_blank" class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 flex items-center justify-center text-white font-bold transition-opacity">
                    <i class="fa-solid fa-expand mr-1"></i> View Full
                  </a>
                </div>
                <p class="text-emerald-700 font-semibold truncate"><i class="fa-solid fa-shield-check mr-1"></i>Residency Proof</p>
              </div>
            </div>
          </div>

          ${data.verification_remarks ? `
            <div class="p-3 rounded-xl bg-amber-50 border border-amber-200 text-xs text-amber-900 space-y-0.5">
              <strong class="font-bold block text-[11px] text-amber-950 uppercase">Verification Remarks:</strong>
              <p>${data.verification_remarks}</p>
            </div>
          ` : ''}

          <div class="grid grid-cols-2 gap-3 py-2 border-t border-slate-100">
            <div><span class="text-slate-400 block text-[10px] uppercase font-bold">Birth Date</span><span class="font-semibold text-slate-800">${birthDate}</span></div>
            <div><span class="text-slate-400 block text-[10px] uppercase font-bold">Purok / Sitio</span><span class="font-semibold text-slate-800">${data.purok}</span></div>
            <div class="col-span-2"><span class="text-slate-400 block text-[10px] uppercase font-bold">Address</span><span class="font-semibold text-slate-800">${data.address}</span></div>
            <div><span class="text-slate-400 block text-[10px] uppercase font-bold">Contact</span><span class="font-semibold text-slate-800">${data.contact_no || 'None'}</span></div>
            <div><span class="text-slate-400 block text-[10px] uppercase font-bold">Voter Status</span><span class="font-semibold text-slate-800">${data.voter_status}</span></div>
          </div>
        `;

        if (footer) {
          const safeFullName = ((data.first_name || '') + ' ' + (data.last_name || '')).trim() || 'this resident';
          window.currentInspectedResident = {
            id: data.id,
            name: safeFullName
          };

          if (data.verification_status === 'Pending Verification' || data.verification_status === 'Rejected') {
            footer.innerHTML = `
              <div class="flex items-center gap-2">
                <button type="button" onclick="approveInspectedResident();" class="px-4 py-1.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 active:scale-95 text-white text-xs font-bold shadow transition-all flex items-center gap-1.5 cursor-pointer">
                  <i class="fa-solid fa-stamp"></i>
                  <span>Approve Verification</span>
                </button>
                <button type="button" onclick="rejectInspectedResident();" class="px-3.5 py-1.5 rounded-xl bg-rose-50 hover:bg-rose-100 border border-rose-200 text-rose-700 text-xs font-bold transition-all flex items-center gap-1.5 cursor-pointer">
                  <i class="fa-solid fa-user-xmark"></i>
                  <span>${data.verification_status === 'Rejected' ? 'Update Rejection Remarks' : 'Reject'}</span>
                </button>
              </div>
              <button type="button" onclick="closeViewModal();" class="px-4 py-1.5 rounded-xl bg-slate-800 hover:bg-slate-700 text-white text-xs font-bold transition-colors cursor-pointer">
                Close
              </button>
            `;
          } else {
            footer.innerHTML = `
              <div class="flex items-center gap-2">
                <span class="text-[11px] text-emerald-700 font-extrabold flex items-center gap-1">
                  <i class="fa-solid fa-circle-check"></i>
                  <span>Verified Dacutan Citizen</span>
                </span>
                <button type="button" onclick="rejectInspectedResident();" class="px-2.5 py-1 rounded-lg bg-rose-50 hover:bg-rose-100 border border-rose-200 text-rose-700 text-[10px] font-bold transition-all cursor-pointer" title="Flag or revoke verification">
                  Flag / Revoke
                </button>
              </div>
              <button type="button" onclick="closeViewModal();" class="px-4 py-1.5 rounded-xl bg-slate-800 hover:bg-slate-700 text-white text-xs font-bold transition-colors cursor-pointer">
                Close
              </button>
            `;
          }
        }
      })
      .catch(err => {
        content.innerHTML = '<p class="text-rose-600 text-center py-4">Failed to load resident profile.</p>';
      });
  }

  function approveInspectedResident() {
    if (!window.currentInspectedResident) return;
    const { id, name } = window.currentInspectedResident;
    closeViewModal();
    confirmValidateResident(id, name);
  }

  function rejectInspectedResident() {
    if (!window.currentInspectedResident) return;
    const { id, name } = window.currentInspectedResident;
    closeViewModal();
    confirmRejectResident(id, name);
  }

  function closeViewModal() {
    document.getElementById('viewResidentModal').classList.add('hidden');
  }

  function openRejectModal(id, name) {
    confirmRejectResident(id, name);
  }

  function closeRejectModal() {
    const modal = document.getElementById('rejectModal');
    if (modal) modal.classList.add('hidden');
  }

  function editResident(res) {
    const modal = document.getElementById('editResidentModal');
    const form = document.getElementById('editResidentForm');
    form.action = `{{ url('admin/residents') }}/${res.id}`;

    document.getElementById('edit_first_name').value = res.first_name || '';
    document.getElementById('edit_middle_name').value = res.middle_name || '';
    document.getElementById('edit_last_name').value = res.last_name || '';
    document.getElementById('edit_suffix').value = res.suffix || '';
    document.getElementById('edit_gender').value = res.gender || 'Male';
    document.getElementById('edit_birth_date').value = res.birth_date ? res.birth_date.split('T')[0] : '';
    document.getElementById('edit_civil_status').value = res.civil_status || 'Single';
    document.getElementById('edit_purok').value = res.purok || '';
    document.getElementById('edit_address').value = res.address || '';
    document.getElementById('edit_contact_no').value = res.contact_no || '';
    document.getElementById('edit_occupation').value = res.occupation || '';
    document.getElementById('edit_monthly_income').value = res.monthly_income || 0;
    document.getElementById('edit_voter_status').value = res.voter_status || 'Registered';

    document.getElementById('edit_is_senior').checked = Boolean(res.is_senior);
    document.getElementById('edit_is_pwd').checked = Boolean(res.is_pwd);
    document.getElementById('edit_is_4ps').checked = Boolean(res.is_4ps);
    document.getElementById('edit_is_indigent').checked = Boolean(res.is_indigent);
    document.getElementById('edit_is_solo_parent').checked = Boolean(res.is_solo_parent);

    modal.classList.remove('hidden');
  }

  function closeEditModal() {
    document.getElementById('editResidentModal').classList.add('hidden');
  }

  // SweetAlert2 Confirmation & Rejection Handlers
  function confirmValidateResident(arg1, arg2, arg3) {
    let residentId = null;
    let residentName = 'this resident';
    let submitAction = null;

    if (arg1 && typeof arg1 === 'object' && arg1.preventDefault) {
      // Form submission: onsubmit="confirmValidateResident(event, this, 'Name')"
      arg1.preventDefault();
      const form = arg2;
      residentName = arg3 || 'this resident';
      submitAction = () => form.submit();
    } else {
      // Direct call: onclick="confirmValidateResident(id, 'Name')"
      residentId = arg1;
      residentName = arg2 || 'this resident';
      submitAction = () => {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `{{ url('admin/residents') }}/${residentId}/verify`;

        const csrf = document.createElement('input');
        csrf.type = 'hidden';
        csrf.name = '_token';
        csrf.value = '{{ csrf_token() }}';
        form.appendChild(csrf);

        document.body.appendChild(form);
        form.submit();
      };
    }

    const swal = window.GovSwal || (typeof Swal !== 'undefined' ? Swal : null);
    if (!swal) {
      if (confirm(`Approve and validate identity for ${residentName}?\n\nThis officially verifies the resident and activates their Resident Portal.`)) {
        submitAction();
      }
      return;
    }

    swal.fire({
      title: 'Approve Verification?',
      html: `Are you sure you want to officially approve and validate the identity of <strong>${residentName}</strong>?<br><span class="text-xs text-slate-500 mt-2 block">This activates their citizen portal and enables online certificate requests.</span>`,
      icon: 'question',
      showCancelButton: true,
      confirmButtonColor: '#059669',
      cancelButtonColor: '#64748b',
      confirmButtonText: '<i class="fa-solid fa-stamp mr-1.5"></i> Yes, Approve Identity',
      cancelButtonText: 'Cancel'
    }).then((result) => {
      if (result.isConfirmed) {
        if (swal.showLoading) {
          swal.fire({
            title: 'Processing Approval...',
            text: 'Updating verification registry and activating portal access.',
            allowOutsideClick: false,
            didOpen: () => {
              swal.showLoading();
            }
          });
        }
        submitAction();
      }
    });
  }

  function confirmRejectResident(residentId, residentName) {
    const swal = window.GovSwal || (typeof Swal !== 'undefined' ? Swal : null);
    if (!swal) {
      const reason = prompt(`Provide evaluation remarks for ${residentName} explaining what deficiencies were identified:`);
      if (reason && reason.trim()) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `{{ url('admin/residents') }}/${residentId}/reject-verification`;

        const csrf = document.createElement('input');
        csrf.type = 'hidden';
        csrf.name = '_token';
        csrf.value = '{{ csrf_token() }}';
        form.appendChild(csrf);

        const remarksInput = document.createElement('input');
        remarksInput.type = 'hidden';
        remarksInput.name = 'remarks';
        remarksInput.value = reason.trim();
        form.appendChild(remarksInput);

        document.body.appendChild(form);
        form.submit();
      }
      return;
    }

    swal.fire({
      title: 'Reject Identity Verification',
      html: `Provide evaluation remarks for <strong>${residentName}</strong> explaining what deficiencies were identified:`,
      input: 'textarea',
      inputPlaceholder: 'e.g. Attached ID photo is blurry and illegible. Please re-upload a clear copy or visit Window 1.',
      inputAttributes: {
        'aria-label': 'Evaluation remarks',
        'rows': 3,
        'class': 'w-full p-3 text-xs border border-slate-300 rounded-xl focus:ring-2 focus:ring-rose-500'
      },
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#e11d48',
      cancelButtonColor: '#64748b',
      confirmButtonText: '<i class="fa-solid fa-ban mr-1.5"></i> Confirm Rejection',
      cancelButtonText: 'Cancel',
      inputValidator: (value) => {
        if (!value || !value.trim()) {
          return 'Clerical remarks are required so the citizen understands the deficiency.';
        }
      }
    }).then((result) => {
      if (result.isConfirmed) {
        if (swal.showLoading) {
          swal.fire({
            title: 'Submitting Rejection...',
            text: 'Recording remarks and updating verification status.',
            allowOutsideClick: false,
            didOpen: () => {
              swal.showLoading();
            }
          });
        }

        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `{{ url('admin/residents') }}/${residentId}/reject-verification`;

        const csrf = document.createElement('input');
        csrf.type = 'hidden';
        csrf.name = '_token';
        csrf.value = '{{ csrf_token() }}';
        form.appendChild(csrf);

        const remarksInput = document.createElement('input');
        remarksInput.type = 'hidden';
        remarksInput.name = 'remarks';
        remarksInput.value = result.value.trim();
        form.appendChild(remarksInput);

        document.body.appendChild(form);
        form.submit();
      }
    });
  }

  function confirmDeleteResident(arg1, arg2, arg3) {
    let residentName = 'this resident';
    let submitAction = null;

    if (arg1 && typeof arg1 === 'object' && arg1.preventDefault) {
      arg1.preventDefault();
      const form = arg2;
      residentName = arg3 || 'this resident';
      submitAction = () => form.submit();
    } else {
      const residentId = arg1;
      residentName = arg2 || 'this resident';
      submitAction = () => {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `{{ url('admin/residents') }}/${residentId}`;

        const csrf = document.createElement('input');
        csrf.type = 'hidden';
        csrf.name = '_token';
        csrf.value = '{{ csrf_token() }}';
        form.appendChild(csrf);

        const method = document.createElement('input');
        method.type = 'hidden';
        method.name = '_method';
        method.value = 'DELETE';
        form.appendChild(method);

        document.body.appendChild(form);
        form.submit();
      };
    }

    const swal = window.GovSwal || (typeof Swal !== 'undefined' ? Swal : null);
    if (!swal) {
      if (confirm(`Are you sure you want to remove ${residentName} from active census registry?`)) {
        submitAction();
      }
      return;
    }

    swal.fire({
      title: 'Archive / Delete Resident?',
      html: `Are you sure you want to remove <strong>${residentName}</strong> from active census registry?`,
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#e11d48',
      cancelButtonColor: '#64748b',
      confirmButtonText: '<i class="fa-solid fa-trash-can mr-1.5"></i> Yes, Delete Record',
      cancelButtonText: 'Cancel'
    }).then((result) => {
      if (result.isConfirmed) {
        if (swal.showLoading) {
          swal.fire({
            title: 'Deleting Record...',
            text: 'Updating active census registry.',
            allowOutsideClick: false,
            didOpen: () => {
              swal.showLoading();
            }
          });
        }
        submitAction();
      }
    });
  }
</script>
@endsection
