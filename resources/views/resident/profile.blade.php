@extends('layouts.resident')

@section('title', 'My Resident Profile & Identity Records • Barangay Dacutan')

@section('content')
<div class="space-y-6">

  <!-- PAGE HEADER -->
  <div class="bg-white p-6 rounded-3xl border border-slate-200/80 shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-4">
    <div class="flex items-center gap-3.5">
      <div class="w-14 h-14 rounded-2xl bg-purple-100 text-purple-700 flex items-center justify-center font-bold text-2xl flex-shrink-0">
        <i class="fa-solid fa-id-card-clip"></i>
      </div>
      <div>
        <div class="flex items-center gap-2">
          <h2 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight">
            My Resident Profile & Identity Records
          </h2>
          <span class="px-2.5 py-0.5 rounded-full bg-emerald-100 text-emerald-800 text-[10px] font-extrabold border border-emerald-300">
            Verified Resident
          </span>
        </div>
        <p class="text-xs text-slate-500 font-medium">
          Official Barangay Demographic Census records & authenticated PhilSys / Gov't verification documents.
        </p>
      </div>
    </div>

    <div>
      <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-slate-100 text-slate-700 text-xs font-mono font-bold border border-slate-200">
        <i class="fa-solid fa-fingerprint text-emerald-600"></i>
        <span>Control ID: {{ $resident?->resident_id ?? 'DAC-2026-TEMP' }}</span>
      </span>
    </div>
  </div>

  <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    <!-- LEFT COLUMN: IDENTIFICATION CARD & VERIFICATION BADGES -->
    <div class="space-y-6">
      
      <!-- Virtual Digital Barangay Citizen Card -->
      <div class="rounded-3xl bg-gradient-to-br from-slate-900 via-emerald-950 to-slate-900 text-white p-6 shadow-xl border border-slate-700 relative overflow-hidden space-y-4">
        <div class="absolute -right-12 -top-12 w-48 h-48 bg-emerald-500/20 rounded-full blur-2xl pointer-events-none"></div>

        <div class="flex items-center justify-between border-b border-white/10 pb-3 relative z-10">
          <div class="flex items-center gap-2">
            <img src="{{ asset('assets/images/logo.svg') }}" alt="Seal" class="w-8 h-8 drop-shadow">
            <div>
              <p class="text-[10px] uppercase tracking-wider text-amber-400 font-bold leading-tight">Republic of the Philippines</p>
              <p class="text-xs font-extrabold text-white">Barangay Dacutan, Dumangas</p>
            </div>
          </div>
          <span class="text-[9px] bg-emerald-500/20 text-emerald-300 font-extrabold px-2 py-0.5 rounded-full border border-emerald-400/30">
            DIGITAL ID
          </span>
        </div>

        <div class="flex items-center gap-4 relative z-10">
          <div class="w-16 h-16 rounded-2xl bg-white/10 border-2 border-emerald-400/50 overflow-hidden flex items-center justify-center flex-shrink-0 shadow-lg">
            @if($resident?->photo || $resident?->id_photo)
              <img src="{{ $resident->photo ?? $resident->id_photo }}" alt="ID Photo" class="w-full h-full object-cover">
            @else
              <i class="fa-solid fa-user text-2xl text-emerald-300"></i>
            @endif
          </div>
          <div class="space-y-0.5 min-w-0">
            <h3 class="text-sm font-black text-white truncate">{{ $user->name }}</h3>
            <p class="text-[11px] text-emerald-400 font-bold">{{ $resident?->purok ?? 'Purok 1' }}</p>
            <p class="text-[10px] text-slate-300 font-mono">ID: {{ $resident?->resident_id ?? 'DAC-2026-TEMP' }}</p>
          </div>
        </div>

        <div class="grid grid-cols-2 gap-2 pt-2 border-t border-white/10 text-[10px] relative z-10 text-slate-300">
          <div>
            <span class="text-slate-400 block text-[9px] uppercase font-bold">Birth Date:</span>
            <span class="font-bold text-white">{{ $resident?->birth_date ? $resident->birth_date->format('M d, Y') : 'N/A' }}</span>
          </div>
          <div>
            <span class="text-slate-400 block text-[9px] uppercase font-bold">Civil Status:</span>
            <span class="font-bold text-white">{{ $resident?->civil_status ?? 'Single' }}</span>
          </div>
          <div>
            <span class="text-slate-400 block text-[9px] uppercase font-bold">Gender:</span>
            <span class="font-bold text-white">{{ $resident?->gender ?? 'N/A' }}</span>
          </div>
          <div>
            <span class="text-slate-400 block text-[9px] uppercase font-bold">Voter Status:</span>
            <span class="font-bold text-emerald-400">{{ $resident?->voter_status ?? 'Registered' }}</span>
          </div>
        </div>
      </div>

      <!-- Identity Verification Requirement Files -->
      <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-sm space-y-4">
        <h3 class="text-xs font-extrabold uppercase tracking-wider text-slate-500 flex items-center gap-1.5">
          <i class="fa-solid fa-file-shield text-emerald-600"></i>
          <span>Uploaded Verification Documents</span>
        </h3>

        <div class="space-y-3 text-xs">
          <!-- Gov't ID Details -->
          <div class="p-3.5 rounded-2xl bg-slate-50 border border-slate-200 space-y-1">
            <span class="text-[10px] font-bold uppercase text-slate-400">Authenticated ID Type:</span>
            <p class="font-bold text-slate-900">{{ $resident?->id_type ?? 'PhilSys National ID' }}</p>
            <p class="text-[11px] font-mono text-slate-600">Number: <strong>{{ $resident?->id_number ?? 'Verified' }}</strong></p>
          </div>

          <!-- Document Thumbnails -->
          <div class="grid grid-cols-2 gap-3">
            <div class="p-3 rounded-2xl border border-slate-200 text-center space-y-2">
              <span class="text-[10px] font-bold text-slate-500 block">Valid Gov't ID</span>
              <div class="h-24 bg-slate-100 rounded-xl overflow-hidden flex items-center justify-center border">
                @if($resident?->id_photo)
                  <img src="{{ $resident->id_photo }}" alt="Valid ID" class="w-full h-full object-cover">
                @else
                  <i class="fa-solid fa-id-card text-2xl text-slate-400"></i>
                @endif
              </div>
              <span class="text-[9px] font-bold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-full inline-block">Archived</span>
            </div>

            <div class="p-3 rounded-2xl border border-slate-200 text-center space-y-2">
              <span class="text-[10px] font-bold text-slate-500 block">Proof of Residency</span>
              <div class="h-24 bg-slate-100 rounded-xl overflow-hidden flex items-center justify-center border">
                @if($resident?->proof_of_residency)
                  <img src="{{ $resident->proof_of_residency }}" alt="Proof of Residency" class="w-full h-full object-cover">
                @else
                  <i class="fa-solid fa-image text-2xl text-slate-400"></i>
                @endif
              </div>
              <span class="text-[9px] font-bold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-full inline-block">Archived</span>
            </div>
          </div>
        </div>
      </div>

    </div>

    <!-- RIGHT 2 COLUMNS: FULL DEMOGRAPHIC DETAILS & EDIT PROFILE -->
    <div class="lg:col-span-2 space-y-6">
      
      <!-- Full Demographic Census Information -->
      <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-sm space-y-6">
        <div class="flex items-center justify-between border-b border-slate-100 pb-4">
          <h3 class="text-base font-extrabold text-slate-900 flex items-center gap-2">
            <i class="fa-solid fa-user-check text-emerald-600"></i>
            <span>Barangay Census Masterlist Record</span>
          </h3>
          <span class="text-xs text-slate-400">Official Municipal Record</span>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 text-xs">
          <div class="p-3.5 rounded-2xl bg-slate-50/70 border border-slate-200/60">
            <span class="text-slate-400 block text-[10px] uppercase font-bold">Full Legal Name:</span>
            <span class="font-extrabold text-slate-900 text-sm">{{ $resident?->full_name ?? $user->name }}</span>
          </div>

          <div class="p-3.5 rounded-2xl bg-slate-50/70 border border-slate-200/60">
            <span class="text-slate-400 block text-[10px] uppercase font-bold">Purok / Zone:</span>
            <span class="font-extrabold text-emerald-800 text-sm">{{ $resident?->purok ?? 'Purok 1' }}</span>
          </div>

          <div class="p-3.5 rounded-2xl bg-slate-50/70 border border-slate-200/60">
            <span class="text-slate-400 block text-[10px] uppercase font-bold">Street Address:</span>
            <span class="font-bold text-slate-800">{{ $resident?->address ?? 'Barangay Dacutan' }}</span>
          </div>

          <div class="p-3.5 rounded-2xl bg-slate-50/70 border border-slate-200/60">
            <span class="text-slate-400 block text-[10px] uppercase font-bold">Birth Date / Age:</span>
            <span class="font-bold text-slate-800">
              {{ $resident?->birth_date ? $resident->birth_date->format('M d, Y') : 'N/A' }} 
              ({{ $resident?->age ?? 'N/A' }} yrs old)
            </span>
          </div>

          <div class="p-3.5 rounded-2xl bg-slate-50/70 border border-slate-200/60">
            <span class="text-slate-400 block text-[10px] uppercase font-bold">Gender & Civil Status:</span>
            <span class="font-bold text-slate-800">{{ $resident?->gender ?? 'Male' }} • {{ $resident?->civil_status ?? 'Single' }}</span>
          </div>

          <div class="p-3.5 rounded-2xl bg-slate-50/70 border border-slate-200/60">
            <span class="text-slate-400 block text-[10px] uppercase font-bold">Occupation:</span>
            <span class="font-bold text-slate-800">{{ $resident?->occupation ?? 'Employed / Resident' }}</span>
          </div>

          <div class="p-3.5 rounded-2xl bg-slate-50/70 border border-slate-200/60">
            <span class="text-slate-400 block text-[10px] uppercase font-bold">Contact Number:</span>
            <span class="font-bold text-slate-800">{{ $resident?->contact_no ?? 'N/A' }}</span>
          </div>

          <div class="p-3.5 rounded-2xl bg-slate-50/70 border border-slate-200/60">
            <span class="text-slate-400 block text-[10px] uppercase font-bold">Verified Email:</span>
            <span class="font-bold text-slate-800">{{ $user->email }}</span>
          </div>

          <div class="p-3.5 rounded-2xl bg-slate-50/70 border border-slate-200/60">
            <span class="text-slate-400 block text-[10px] uppercase font-bold">Portal Username:</span>
            <span class="font-mono font-bold text-slate-800">{{ $user->username }}</span>
          </div>
        </div>

        <!-- Welfare & Beneficiary Badges -->
        <div class="pt-4 border-t border-slate-100 space-y-2">
          <span class="text-[10px] uppercase font-bold text-slate-400 block">Special Sector & Social Classification:</span>
          <div class="flex flex-wrap gap-2 text-xs">
            @if($resident?->is_senior)
              <span class="px-3 py-1 rounded-xl bg-amber-100 text-amber-800 font-extrabold border border-amber-300">
                <i class="fa-solid fa-person-walking-with-cane mr-1"></i> Senior Citizen
              </span>
            @endif
            @if($resident?->is_pwd)
              <span class="px-3 py-1 rounded-xl bg-blue-100 text-blue-800 font-extrabold border border-blue-300">
                <i class="fa-solid fa-wheelchair mr-1"></i> Person with Disability (PWD)
              </span>
            @endif
            @if($resident?->is_indigent)
              <span class="px-3 py-1 rounded-xl bg-emerald-100 text-emerald-800 font-extrabold border border-emerald-300">
                <i class="fa-solid fa-hand-holding-dollar mr-1"></i> Indigent Classification (Fee Exempt)
              </span>
            @endif
            @if($resident?->is_solo_parent)
              <span class="px-3 py-1 rounded-xl bg-purple-100 text-purple-800 font-extrabold border border-purple-300">
                <i class="fa-solid fa-children mr-1"></i> Solo Parent (Fee Exempt)
              </span>
            @endif
            @if($resident?->is_4ps)
              <span class="px-3 py-1 rounded-xl bg-rose-100 text-rose-800 font-extrabold border border-rose-300">
                <i class="fa-solid fa-award mr-1"></i> 4Ps Beneficiary
              </span>
            @endif
            @if(!$resident?->is_senior && !$resident?->is_pwd && !$resident?->is_indigent && !$resident?->is_solo_parent && !$resident?->is_4ps)
              <span class="px-3 py-1 rounded-xl bg-slate-100 text-slate-700 font-bold border border-slate-200">
                Standard Resident Demographic
              </span>
            @endif
          </div>
        </div>

      </div>

      <!-- EDIT CONTACT DETAILS & PASSWORD FORM -->
      <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-sm space-y-6">
        <div class="border-b border-slate-100 pb-3">
          <h3 class="text-base font-extrabold text-slate-900 flex items-center gap-2">
            <i class="fa-solid fa-sliders text-emerald-600"></i>
            <span>Update Contact Details & Password</span>
          </h3>
          <p class="text-xs text-slate-500">Keep your contact number and home address up-to-date for clearance and aid delivery notifications.</p>
        </div>

        <form action="{{ route('resident.profile.update') }}" method="POST" class="space-y-4 text-xs">
          @csrf

          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
              <label class="block font-bold text-slate-700 uppercase mb-1">Mobile / Contact Number *</label>
              <input 
                type="text" 
                name="contact_no" 
                value="{{ old('contact_no', $resident?->contact_no) }}" 
                required 
                class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 bg-slate-50 text-slate-900 font-bold focus:bg-white focus:ring-2 focus:ring-emerald-500"
              >
            </div>

            <div>
              <label class="block font-bold text-slate-700 uppercase mb-1">Residential Address *</label>
              <input 
                type="text" 
                name="address" 
                value="{{ old('address', $resident?->address) }}" 
                required 
                class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 bg-slate-50 text-slate-900 font-bold focus:bg-white focus:ring-2 focus:ring-emerald-500"
              >
            </div>
          </div>

          <div class="pt-3 border-t border-slate-100">
            <h4 class="font-bold text-slate-800 mb-2">Change Password (Leave blank to keep current)</h4>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
              <div>
                <label class="block text-slate-500 uppercase mb-1 text-[10px] font-bold">New Password</label>
                <input 
                  type="password" 
                  name="password" 
                  placeholder="Min. 6 characters" 
                  class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 bg-slate-50 text-slate-900 font-medium focus:bg-white focus:ring-2 focus:ring-emerald-500"
                >
              </div>

              <div>
                <label class="block text-slate-500 uppercase mb-1 text-[10px] font-bold">Confirm New Password</label>
                <input 
                  type="password" 
                  name="password_confirmation" 
                  placeholder="Repeat new password" 
                  class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 bg-slate-50 text-slate-900 font-medium focus:bg-white focus:ring-2 focus:ring-emerald-500"
                >
              </div>
            </div>
          </div>

          <div class="pt-3 flex justify-end">
            <button 
              type="submit" 
              class="px-5 py-2.5 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs shadow-md transition-all flex items-center gap-2"
            >
              <i class="fa-solid fa-floppy-disk"></i>
              <span>Save Profile Updates</span>
            </button>
          </div>
        </form>
      </div>

    </div>

  </div>

</div>
@endsection

