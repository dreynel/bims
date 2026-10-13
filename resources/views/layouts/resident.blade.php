<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', 'Resident Portal • Barangay Dacutan BIMS')</title>
  
  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
  
  <!-- FontAwesome 6 -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  
  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  
  <!-- Custom GovPH Stylesheet -->
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

  <style>
    @media print {
      .no-print { display: none !important; }
      body { background: white !important; color: black !important; }
    }
  </style>
  @yield('styles')
</head>
<body class="bg-slate-100 text-slate-800 min-h-screen flex flex-col antialiased selection:bg-emerald-500 selection:text-white">

  <!-- 1. GOVPH OFFICIAL TOP MASTHEAD -->
  <div class="govph-masthead py-1.5 px-4 lg:px-8 flex items-center justify-between no-print z-50 relative">
    <div class="flex items-center gap-2.5">
      <span class="font-extrabold tracking-wider text-[11px] text-amber-400">GOVPH</span>
      <span class="text-slate-400 text-xs">|</span>
      <span class="text-[11px] text-slate-300 font-medium">Republic of the Philippines</span>
      <span class="hidden sm:inline text-slate-400 text-xs">•</span>
      <span class="hidden sm:inline text-[11px] text-slate-300">Barangay Dacutan, Dumangas, Iloilo</span>
    </div>
    <div class="flex items-center gap-3 text-[11px] text-slate-300">
      <i class="fa-regular fa-clock text-amber-400"></i>
      <span class="hidden sm:inline">Philippine Standard Time (PST):</span>
      <span id="pstClock" class="font-mono font-bold text-white">Loading PST...</span>
    </div>
  </div>

  <div class="flex-1 flex min-h-0">
    <!-- 2. RESIDENT SIDEBAR NAVIGATION -->
    <div id="sidebarBackdrop" onclick="toggleResidentSidebar()" class="fixed inset-0 bg-slate-900/60 z-40 backdrop-blur-xs md:hidden hidden"></div>

    <aside id="residentSidebar" class="w-64 bg-slate-900 text-slate-300 flex-shrink-0 flex flex-col justify-between border-r border-slate-800 transition-all duration-300 z-50 no-print hidden md:flex md:static fixed inset-y-0 left-0 shadow-2xl md:shadow-none">
      
      <!-- Top Branding in Sidebar -->
      <div class="p-4 border-b border-slate-800">
        <a href="{{ route('resident.dashboard') }}" class="flex items-center gap-3 group">
          <img src="{{ asset('assets/images/logo.svg') }}" alt="Seal" class="w-10 h-10 rounded-full bg-slate-800 p-1 group-hover:scale-105 transition-transform">
          <div>
            <h2 class="text-sm font-extrabold text-white tracking-wide leading-tight">BARANGAY DACUTAN</h2>
            <span class="text-[10px] uppercase font-bold tracking-wider text-emerald-400 flex items-center gap-1 mt-0.5">
              <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
              <span>Resident Portal</span>
            </span>
          </div>
        </a>
      </div>

      <!-- Verified Resident Card / Badge in Sidebar -->
      @if(Auth::check())
        @php
          $residentUser = Auth::user();
          $residentModel = $residentUser->resident;
          $purokName = $residentModel?->purok ?? 'Brgy. Dacutan';
          $dacId = $residentModel?->resident_id ?? 'DAC-CITIZEN';
        @endphp
        <div class="mx-3 mt-3 p-3 rounded-2xl bg-slate-800/80 border border-slate-700/60 space-y-1.5">
          <div class="flex items-center justify-between">
            <span class="text-[10px] uppercase font-bold text-slate-400">Citizen Dossier</span>
            <span class="px-2 py-0.5 rounded-full bg-emerald-500/20 text-emerald-400 text-[10px] font-extrabold flex items-center gap-1 border border-emerald-500/30">
              <i class="fa-solid fa-circle-check text-[9px]"></i>
              <span>Verified</span>
            </span>
          </div>
          <p class="text-xs font-bold text-white truncate">{{ $residentUser->name }}</p>
          <div class="flex items-center justify-between text-[10px] text-slate-400 font-mono">
            <span>{{ $purokName }}</span>
            <span class="text-emerald-400 font-bold">{{ $dacId }}</span>
          </div>
        </div>
      @endif

      <!-- Navigation Links -->
      <nav class="flex-1 p-3 space-y-1.5 overflow-y-auto">
        <div class="px-3 pt-2 pb-1 text-[10px] font-extrabold tracking-wider uppercase text-slate-500">Citizen Services</div>
        
        <!-- 1. Dashboard Overview -->
        <a 
          href="{{ route('resident.dashboard') }}" 
          class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-bold transition-all {{ request()->routeIs('resident.dashboard') ? 'bg-emerald-600 text-white shadow-lg shadow-emerald-950/40' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}"
        >
          <i class="fa-solid fa-chart-pie w-4 text-center {{ request()->routeIs('resident.dashboard') ? 'text-white' : 'text-emerald-400' }}"></i>
          <span>Dashboard Overview</span>
        </a>

        <!-- 2. My Requests & Clearance Review -->
        @php
          $activeRequestsCount = Auth::check() 
            ? \App\Models\Certificate::where('email', Auth::user()->email)->whereIn('status', ['Pending', 'Evaluated', 'Ready for Release'])->count()
            : 0;
        @endphp
        <a 
          href="{{ route('resident.requests') }}" 
          class="flex items-center justify-between px-3.5 py-2.5 rounded-xl text-xs font-bold transition-all {{ request()->routeIs('resident.requests*') ? 'bg-emerald-600 text-white shadow-lg shadow-emerald-950/40' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}"
        >
          <div class="flex items-center gap-3">
            <i class="fa-solid fa-list-check w-4 text-center {{ request()->routeIs('resident.requests*') ? 'text-white' : 'text-blue-400' }}"></i>
            <span>My Requests</span>
          </div>
          @if($activeRequestsCount > 0)
            <span class="px-2 py-0.5 text-[10px] font-black rounded-full {{ request()->routeIs('resident.requests*') ? 'bg-white text-emerald-800' : 'bg-amber-500 text-white shadow-sm' }}">
              {{ $activeRequestsCount }}
            </span>
          @endif
        </a>

        <!-- 3. Request Document (Trigger Modal Action) -->
        <button 
          type="button" 
          onclick="openResidentApplyModal()" 
          class="w-full text-left flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-bold text-emerald-400 hover:bg-emerald-600/15 hover:text-emerald-300 border border-emerald-500/20 transition-all cursor-pointer"
        >
          <i class="fa-solid fa-file-circle-plus w-4 text-center text-emerald-400"></i>
          <span>Request Clearance / ID</span>
        </button>

        <!-- 4. My Profile & Digital ID -->
        <a 
          href="{{ route('resident.profile') }}" 
          class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-bold transition-all {{ request()->routeIs('resident.profile*') ? 'bg-emerald-600 text-white shadow-lg shadow-emerald-950/40' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}"
        >
          <i class="fa-solid fa-id-card w-4 text-center {{ request()->routeIs('resident.profile*') ? 'text-white' : 'text-purple-400' }}"></i>
          <span>My Profile & ID</span>
        </a>

        <!-- 5. Aid & Relief History -->
        <a 
          href="{{ route('resident.aid.history') }}" 
          class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-bold transition-all {{ request()->routeIs('resident.aid.history*') ? 'bg-emerald-600 text-white shadow-lg shadow-emerald-950/40' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}"
        >
          <i class="fa-solid fa-hand-holding-heart w-4 text-center {{ request()->routeIs('resident.aid.history*') ? 'text-white' : 'text-rose-400' }}"></i>
          <span>Ayuda & Relief History</span>
        </a>

        <div class="px-3 pt-4 pb-1 text-[10px] font-extrabold tracking-wider uppercase text-slate-500">Citizen Support</div>

        <!-- 6. Barangay Directory & Services Guide -->
        <a 
          href="{{ route('resident.help') }}" 
          class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-bold transition-all {{ request()->routeIs('resident.help*') ? 'bg-emerald-600 text-white shadow-lg shadow-emerald-950/40' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}"
        >
          <i class="fa-solid fa-circle-question w-4 text-center {{ request()->routeIs('resident.help*') ? 'text-white' : 'text-amber-400' }}"></i>
          <span>Barangay Directory</span>
        </a>

        <!-- 7. Public Portal View Link -->
        <a 
          href="{{ route('public.home') }}" 
          target="_blank" 
          class="flex items-center justify-between px-3.5 py-2.5 rounded-xl text-xs font-bold text-slate-300 hover:bg-slate-800 hover:text-emerald-400 transition-all"
        >
          <div class="flex items-center gap-3">
            <i class="fa-solid fa-globe w-4 text-center text-slate-400"></i>
            <span>Public Web Portal</span>
          </div>
          <i class="fa-solid fa-arrow-up-right-from-square text-[10px] text-slate-500"></i>
        </a>
      </nav>

      <!-- Sidebar User Profile & Prominent Sign Out Button -->
      <div class="p-3 border-t border-slate-800 bg-slate-950/60 space-y-3">
        @auth
          <div class="flex items-center gap-3 px-2 py-1">
            <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-emerald-600 to-teal-500 text-white font-bold flex items-center justify-center text-sm shadow">
              {{ substr(Auth::user()->name, 0, 1) }}
            </div>
            <div class="flex-1 min-w-0">
              <p class="text-xs font-bold text-white truncate">{{ Auth::user()->name }}</p>
              <p class="text-[10px] text-emerald-400 uppercase tracking-wider font-semibold truncate">{{ Auth::user()->resident?->purok ?? 'Barangay Resident' }}</p>
            </div>
          </div>

          <form id="logoutForm" action="{{ route('logout') }}" method="POST" class="w-full">
            @csrf
            <button 
              type="button" 
              onclick="confirmLogout()" 
              class="w-full py-2 px-3 rounded-xl bg-rose-500/10 hover:bg-rose-600 text-rose-300 hover:text-white border border-rose-500/30 text-xs font-bold flex items-center justify-center gap-2 transition-all shadow-sm cursor-pointer"
            >
              <i class="fa-solid fa-power-off"></i>
              <span>Sign Out</span>
            </button>
          </form>
        @endauth
      </div>
    </aside>

    <!-- 3. MAIN CONTENT WRAPPER -->
    <div class="flex-1 flex flex-col min-w-0 overflow-y-auto">
      
      <!-- Top Action Bar for Resident Portal -->
      <header class="bg-white border-b border-slate-200 py-3 px-4 sm:px-6 lg:px-8 flex items-center justify-between no-print sticky top-0 z-30 shadow-sm">
        <div class="flex items-center gap-3">
          <!-- Hamburger for Mobile -->
          <button 
            type="button" 
            onclick="toggleResidentSidebar()" 
            class="md:hidden p-2 rounded-xl text-slate-500 hover:text-slate-800 hover:bg-slate-100 cursor-pointer"
            aria-label="Toggle navigation"
          >
            <i class="fa-solid fa-bars text-lg"></i>
          </button>

          <div>
            <h1 class="text-base sm:text-lg font-black text-slate-900 leading-tight flex items-center gap-2">
              @if(request()->routeIs('resident.dashboard'))
                <i class="fa-solid fa-chart-pie text-emerald-600 text-base"></i>
                <span>Resident Dashboard</span>
              @elseif(request()->routeIs('resident.requests*'))
                <i class="fa-solid fa-list-check text-blue-600 text-base"></i>
                <span>My Requests & Review</span>
              @elseif(request()->routeIs('resident.profile*'))
                <i class="fa-solid fa-id-card text-purple-600 text-base"></i>
                <span>My Profile & Citizen ID</span>
              @elseif(request()->routeIs('resident.aid.history*'))
                <i class="fa-solid fa-hand-holding-heart text-rose-600 text-base"></i>
                <span>Ayuda & Calamity Relief</span>
              @elseif(request()->routeIs('resident.help*'))
                <i class="fa-solid fa-circle-question text-amber-600 text-base"></i>
                <span>Barangay Directory & Guide</span>
              @else
                <span>@yield('header_title', 'Citizen Resident Portal')</span>
              @endif
            </h1>
            <p class="text-xs text-slate-500 font-medium hidden sm:block">
              Barangay Dacutan, Dumangas, Iloilo • Citizen Self-Service Terminal
            </p>
          </div>
        </div>

        <div class="flex items-center gap-3">
          <!-- Request Document Primary CTA Button in Top Bar -->
          <button 
            type="button" 
            onclick="openResidentApplyModal()" 
            class="hidden sm:inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-extrabold text-xs shadow-md shadow-emerald-950/20 active:scale-95 transition-all cursor-pointer"
          >
            <i class="fa-solid fa-file-circle-plus"></i>
            <span>Request Document</span>
          </button>

          <!-- Citizen ID Pill -->
          @if(Auth::check())
            <div class="flex items-center gap-2 px-2.5 py-1 bg-slate-50 border border-slate-200 rounded-xl">
              <div class="w-7 h-7 rounded-full bg-emerald-600 text-white font-bold text-xs flex items-center justify-center flex-shrink-0 shadow-sm">
                {{ substr(Auth::user()->name, 0, 1) }}
              </div>
              <div class="text-left hidden lg:block">
                <p class="text-xs font-bold text-slate-900 leading-tight truncate max-w-[120px]">{{ Auth::user()->name }}</p>
                <p class="text-[10px] text-emerald-600 font-semibold truncate">{{ Auth::user()->resident?->purok ?? 'Resident' }}</p>
              </div>
            </div>
          @endif
        </div>
      </header>

      <!-- 3. FLASH NOTIFICATION MESSAGES -->
      <div class="p-4 sm:p-6 lg:p-8 pb-0 max-w-7xl w-full mx-auto no-print">
        @if(session('success'))
          <div class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-bold flex items-center justify-between shadow-sm mb-3">
            <div class="flex items-center gap-2.5">
              <i class="fa-solid fa-circle-check text-emerald-600 text-base flex-shrink-0"></i>
              <span>{{ session('success') }}</span>
            </div>
            <button onclick="this.parentElement.remove()" class="text-emerald-600 hover:text-emerald-900 ml-2"><i class="fa-solid fa-xmark"></i></button>
          </div>
        @endif

        @if(session('error'))
          <div class="p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-800 text-xs font-bold flex items-center justify-between shadow-sm mb-3">
            <div class="flex items-center gap-2.5">
              <i class="fa-solid fa-triangle-exclamation text-rose-600 text-base flex-shrink-0"></i>
              <span>{{ session('error') }}</span>
            </div>
            <button onclick="this.parentElement.remove()" class="text-rose-600 hover:text-rose-900 ml-2"><i class="fa-solid fa-xmark"></i></button>
          </div>
        @endif

        @if(session('info'))
          <div class="p-4 rounded-2xl bg-blue-50 border border-blue-200 text-blue-800 text-xs font-bold flex items-center justify-between shadow-sm mb-3">
            <div class="flex items-center gap-2.5">
              <i class="fa-solid fa-circle-info text-blue-600 text-base flex-shrink-0"></i>
              <span>{{ session('info') }}</span>
            </div>
            <button onclick="this.parentElement.remove()" class="text-blue-600 hover:text-blue-900 ml-2"><i class="fa-solid fa-xmark"></i></button>
          </div>
        @endif
      </div>

      <!-- 4. MAIN PAGE CONTENT -->
      <main class="flex-1 p-4 sm:p-6 lg:p-8 space-y-6 max-w-7xl w-full mx-auto">
        @yield('content')
      </main>

      <!-- 7. FOOTER -->
      <footer class="py-4 px-4 sm:px-6 lg:px-8 text-center sm:text-left flex flex-col sm:flex-row items-center justify-between text-xs text-slate-500 border-t border-slate-200 no-print mt-auto bg-white/70 gap-2">
        <p>Republic of the Philippines • Municipality of Dumangas, Province of Iloilo • Barangay Dacutan BIMS v2.0</p>
        <p class="text-[11px] text-slate-400 font-medium">Citizen Self-Service Portal • Secured Role: Bona Fide Resident</p>
      </footer>
    </div>
  </div>

  <!-- 5. GLOBAL MODAL: BOOK OFFICIAL DOCUMENT PICKUP APPOINTMENT -->
  <div id="residentApplyModal" class="fixed inset-0 z-50 bg-slate-900/60 backdrop-blur-sm hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl max-w-lg w-full p-6 sm:p-8 shadow-2xl border border-slate-200 space-y-5 animate-in fade-in zoom-in-95 duration-200">
      
      <div class="flex items-center justify-between border-b border-slate-200 pb-3">
        <div class="flex items-center gap-3">
          <div class="w-10 h-10 rounded-2xl bg-emerald-100 text-emerald-700 flex items-center justify-center font-bold text-lg">
            <i class="fa-solid fa-calendar-check"></i>
          </div>
          <div>
            <h3 class="font-extrabold text-base sm:text-lg text-slate-900">Book Document Pickup Appointment</h3>
            <p class="text-xs text-slate-500">Applicant: <strong class="text-slate-800">{{ Auth::user()?->name ?? 'Resident' }}</strong> ({{ Auth::user()?->resident?->purok ?? 'Dacutan' }})</p>
          </div>
        </div>
        <button type="button" onclick="closeResidentApplyModal()" class="w-8 h-8 rounded-full bg-slate-100 text-slate-500 hover:bg-slate-200 flex items-center justify-center">
          <i class="fa-solid fa-xmark"></i>
        </button>
      </div>

      <form action="{{ route('resident.apply') }}" method="POST" class="space-y-4">
        @csrf

        <!-- Document Type (Official Barangay Dacutan Certifications & Ordinance No. 2020-01) -->
        <div>
          <label class="block text-xs font-bold text-slate-700 uppercase mb-1.5">Document Type Requested *</label>
          <select 
            name="doc_type" 
            id="resModalDocType" 
            required 
            onchange="updateResModalFee()" 
            class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 bg-slate-50 text-slate-900 text-xs font-bold focus:bg-white focus:ring-2 focus:ring-emerald-500"
          >
            <optgroup label="── Sec. 3.A Barangay Clearances (Ordinance No. 2020-01) ──">
              <option value="Barangay Clearance">Barangay Clearance (Employment / General) - ₱30.00</option>
              <option value="Certificate of Residency">Certificate of Residency - ₱30.00</option>
              <option value="Certificate of Good Moral Character">Certificate of Good Moral Character - ₱30.00</option>
              <option value="Certificate of Indigency">Certificate of Indigency (Sec. 5 Free Waiver) - ₱0.00</option>
            </optgroup>
            <optgroup label="── Official Barangay Dacutan Certifications ──">
              <option value="Certification for Delayed Registration">1. Certification for Delayed Registration - ₱30.00</option>
              <option value="Certification for PWD">2. Certification for PWD (Sec. 5 Free Waiver) - ₱0.00</option>
              <option value="Certification for Solo Parent">3. Certification for Solo Parent - ₱0.00</option>
              <option value="Certification for Loan">4. Certification for Loan (Sec. 3.A.5) - ₱50.00</option>
              <option value="Certification for ILECO (Electrification)">5. Certification for ILECO (Electrification) - ₱30.00</option>
              <option value="Certification for Live-In">6. Certification for Live-In - ₱30.00</option>
              <option value="Certification for Deceased / House">7. Certification for Deceased / House - ₱30.00</option>
              <option value="Certification for First Time Job Seeker">8. Certification for First Time Job Seeker (RA 11261) - ₱0.00</option>
              <option value="Certification for RSBSA Member">9. Certification for RSBSA Member (Farmers/Fisherfolks) - ₱30.00</option>
              <option value="Certification for TIN ID">10. Certification for TIN ID / Proper ID - ₱30.00</option>
              <option value="Certification for Building Permit">11. Certification for Building Permit (Sec. 4) - ₱200.00</option>
              <option value="Certification for Electrical Permit">12. Certification for Electrical Permit (Sec. 3.A.6) - ₱30.00</option>
            </optgroup>
            <optgroup label="── Sec. 3.B Business, Sec. 3.C Aquatic & Sec. 8 Legal ──">
              <option value="Barangay Business Clearance / Permit">Barangay Business Clearance / Permit (Sec. 3.B) - ₱100.00</option>
              <option value="Aquatic Resources / Fisherfolk Clearance">Aquatic Resources Clearance (Talaba/Kasagan/Punot/Fishpond) - ₱100.00</option>
              <option value="Barangay Blotter Certification">Barangay Case / Blotter Filing (Sec. 3.A.7) - ₱100.00</option>
              <option value="Certification to File Action">Certification to File Action / CFA (Sec. 8) - ₱300.00</option>
            </optgroup>
          </select>
        </div>

        <!-- Purpose of Request -->
        <div>
          <label class="block text-xs font-bold text-slate-700 uppercase mb-1.5">Specific Purpose of Application *</label>
          <input 
            type="text" 
            name="purpose" 
            required 
            placeholder="e.g. Local Employment, ILECO Connection, Loan, RSBSA Registry" 
            class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 bg-slate-50 text-slate-900 text-xs font-medium focus:bg-white focus:ring-2 focus:ring-emerald-500"
          >
        </div>

        <!-- Community Tax Certificate (CTC / Cedula) Optional -->
        <div>
          <div class="flex items-center justify-between mb-1.5">
            <label class="text-xs font-bold text-slate-700 uppercase">Community Tax Cert. (Cedula) #</label>
            <span class="text-[10px] text-slate-400 font-normal">Optional (Payable at Window 2)</span>
          </div>
          <input 
            type="text" 
            name="ctc_no" 
            placeholder="e.g. CTC-2026-00123" 
            class="w-full px-3.5 py-2 rounded-xl border border-slate-300 bg-slate-50 text-slate-900 text-xs font-medium focus:bg-white focus:ring-2 focus:ring-emerald-500"
          >
        </div>

        <!-- Fee Preview Card -->
        <div class="p-3.5 rounded-2xl bg-slate-50 border border-slate-200 flex items-center justify-between text-xs">
          <div>
            <span class="text-slate-500 block text-[11px]">Ordinance No. 2020-01 Regulatory Fee:</span>
            <span class="font-bold text-slate-900 text-sm" id="resModalFeeText">₱30.00</span>
          </div>
          <span class="text-[10px] text-emerald-800 bg-emerald-100 font-extrabold px-2.5 py-1 rounded-full" id="resModalFeeBadge">
            Payable at Window 1 upon pickup
          </span>
        </div>

        <!-- Guidelines note -->
        <p class="text-[11px] text-slate-600 bg-amber-50/80 p-3 rounded-xl border border-amber-200 leading-relaxed">
          <i class="fa-solid fa-calendar-check text-amber-600 mr-1"></i>
          <strong>Appointment Policy:</strong> Portal requests schedule your document for preparation. Official certificates are <strong>not issued digitally</strong> and must be claimed in person at <strong>Window 1</strong> with your Claim Stub &amp; Valid ID for official wet signature and dry seal.
        </p>

        <!-- Submit Button -->
        <div class="pt-3 border-t border-slate-200 flex items-center justify-end gap-3">
          <button type="button" onclick="closeResidentApplyModal()" class="px-4 py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold">
            Cancel
          </button>
          <button type="submit" class="px-5 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-bold shadow-md shadow-emerald-950/20 transition-all">
            Book Pickup Appointment
          </button>
        </div>

      </form>
    </div>
  </div>

  <!-- 6. GLOBAL INTERACTIVE MODAL: REVIEW REQUEST DETAILS & TIMELINE -->
  <div id="reviewRequestModal" class="fixed inset-0 z-50 bg-slate-900/60 backdrop-blur-sm hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl max-w-2xl w-full p-6 sm:p-8 shadow-2xl border border-slate-200 space-y-6 max-h-[90vh] overflow-y-auto animate-in fade-in zoom-in-95 duration-200">
      
      <!-- Modal Header -->
      <div class="flex items-center justify-between border-b border-slate-200 pb-4">
        <div class="flex items-center gap-3">
          <div class="w-10 h-10 rounded-2xl bg-blue-100 text-blue-700 flex items-center justify-center font-bold text-lg">
            <i class="fa-solid fa-magnifying-glass-chart"></i>
          </div>
          <div>
            <h3 class="font-extrabold text-base sm:text-lg text-slate-900" id="revModalDocType">Review Request Details</h3>
            <p class="text-xs text-slate-500">
              Appointment Control #: <strong class="font-mono text-emerald-700 font-bold" id="revModalControlNo">DAC-2026-XXXX</strong>
            </p>
          </div>
        </div>
        <button type="button" onclick="closeReviewModal()" class="w-8 h-8 rounded-full bg-slate-100 text-slate-500 hover:bg-slate-200 flex items-center justify-center">
          <i class="fa-solid fa-xmark"></i>
        </button>
      </div>

      <!-- Current Status Banner -->
      <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200 flex flex-col sm:flex-row sm:items-center justify-between gap-3" id="revStatusBanner">
        <div>
          <span class="text-[10px] uppercase font-bold text-slate-500 tracking-wider block">Appointment &amp; Processing Status</span>
          <span class="text-sm font-extrabold text-slate-900" id="revStatusText">Under Clerical Evaluation</span>
        </div>
        <div class="flex items-center gap-2" id="revQuickBadges">
          <span class="px-3 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-800 border border-amber-300" id="revBadge">
            Pending
          </span>
        </div>
      </div>

      <!-- 5-STEP VISUAL PROGRESS STEPPER -->
      <div class="space-y-3">
        <h4 class="text-xs font-bold uppercase tracking-wider text-slate-500 flex items-center gap-1.5">
          <i class="fa-solid fa-timeline text-emerald-600"></i>
          <span>Official 2-Tier Walk-In Pickup Workflow</span>
        </h4>

        <div class="grid grid-cols-1 sm:grid-cols-5 gap-2" id="stepperContainer">
          <!-- Step 1 -->
          <div class="p-3 rounded-xl border text-center space-y-1 bg-emerald-50 border-emerald-300 text-emerald-900" id="step1">
            <div class="w-6 h-6 rounded-full bg-emerald-600 text-white font-bold text-xs flex items-center justify-center mx-auto">1</div>
            <p class="text-[11px] font-bold leading-tight">Booked</p>
            <span class="text-[9px] text-slate-500 block" id="step1Time">--</span>
          </div>

          <!-- Step 2 -->
          <div class="p-3 rounded-xl border text-center space-y-1 bg-slate-50 border-slate-200 text-slate-600" id="step2">
            <div class="w-6 h-6 rounded-full bg-slate-200 text-slate-700 font-bold text-xs flex items-center justify-center mx-auto">2</div>
            <p class="text-[11px] font-bold leading-tight">Clerical Review</p>
            <span class="text-[9px] text-slate-400 block">Secretary / Clerk</span>
          </div>

          <!-- Step 3 -->
          <div class="p-3 rounded-xl border text-center space-y-1 bg-slate-50 border-slate-200 text-slate-600" id="step3">
            <div class="w-6 h-6 rounded-full bg-slate-200 text-slate-700 font-bold text-xs flex items-center justify-center mx-auto">3</div>
            <p class="text-[11px] font-bold leading-tight">PB Clearance</p>
            <span class="text-[9px] text-slate-400 block">Punong Barangay</span>
          </div>

          <!-- Step 4 -->
          <div class="p-3 rounded-xl border text-center space-y-1 bg-slate-50 border-slate-200 text-slate-600" id="step4">
            <div class="w-6 h-6 rounded-full bg-slate-200 text-slate-700 font-bold text-xs flex items-center justify-center mx-auto">4</div>
            <p class="text-[11px] font-bold leading-tight">Ready for Pickup</p>
            <span class="text-[9px] text-slate-400 block">Window 1</span>
          </div>

          <!-- Step 5 -->
          <div class="p-3 rounded-xl border text-center space-y-1 bg-slate-50 border-slate-200 text-slate-600" id="step5">
            <div class="w-6 h-6 rounded-full bg-slate-200 text-slate-700 font-bold text-xs flex items-center justify-center mx-auto">5</div>
            <p class="text-[11px] font-bold leading-tight">Claimed</p>
            <span class="text-[9px] text-slate-400 block">In Person</span>
          </div>
        </div>
      </div>

      <!-- Application Details Table -->
      <div class="border border-slate-200 rounded-2xl overflow-hidden text-xs">
        <div class="bg-slate-50 px-4 py-2.5 font-bold text-slate-700 border-b border-slate-200">
          Appointment Information &amp; Ordinance No. 2020-01 Fee Breakdown
        </div>
        <div class="p-4 grid grid-cols-1 sm:grid-cols-2 gap-3 divide-y sm:divide-y-0 sm:divide-x divide-slate-100">
          <div class="space-y-2">
            <div>
              <span class="text-slate-400 block text-[10px] uppercase font-bold">Purpose of Request:</span>
              <p class="font-medium text-slate-800" id="revModalPurpose">--</p>
            </div>
            <div>
              <span class="text-slate-400 block text-[10px] uppercase font-bold">Community Tax Cert (CTC):</span>
              <p class="font-medium text-slate-800" id="revModalCtc">--</p>
            </div>
            <div>
              <span class="text-slate-400 block text-[10px] uppercase font-bold">Applicant / Purok:</span>
              <p class="font-medium text-slate-800" id="revModalApplicant">--</p>
            </div>
          </div>
          <div class="space-y-2 sm:pl-3 pt-2 sm:pt-0">
            <div>
              <span class="text-slate-400 block text-[10px] uppercase font-bold">Regulatory Fee (Payable at Hall):</span>
              <p class="font-bold text-slate-900" id="revModalFee">--</p>
            </div>
            <div>
              <span class="text-slate-400 block text-[10px] uppercase font-bold">Official Receipt (OR) #:</span>
              <p class="font-medium text-slate-800" id="revModalOr">--</p>
            </div>
            <div>
              <span class="text-slate-400 block text-[10px] uppercase font-bold">Barangay Admin Remarks:</span>
              <p class="font-semibold text-emerald-800 bg-emerald-50/70 p-2 rounded-xl border border-emerald-200 text-[11px]" id="revModalRemarks">--</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Action Toolbar -->
      <div class="pt-3 border-t border-slate-200 flex flex-wrap items-center justify-between gap-3">
        <div>
          <!-- Cancel Button (Only if Pending) -->
          <form id="revCancelForm" action="" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to cancel this pending appointment?');">
            @csrf
            <button 
              type="submit" 
              id="revBtnCancel" 
              class="hidden px-4 py-2 rounded-xl bg-rose-50 hover:bg-rose-100 text-rose-700 border border-rose-200 font-bold text-xs transition-all"
            >
              <i class="fa-solid fa-trash-can mr-1"></i> Cancel Appointment
            </button>
          </form>
        </div>

        <div class="flex items-center gap-2">
          <!-- Print Appointment Claim Stub Button -->
          <a 
            id="revBtnClaimStub" 
            href="#" 
            target="_blank" 
            class="px-5 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs shadow-md transition-all flex items-center gap-1.5"
          >
            <i class="fa-solid fa-ticket"></i>
            <span>Print Appointment &amp; Claim Stub</span>
          </a>

          <!-- Hidden legacy element kept for DOM compatibility -->
          <a id="revBtnPrintCert" href="#" class="hidden"></a>

          <button type="button" onclick="closeReviewModal()" class="px-4 py-2 rounded-xl bg-slate-900 hover:bg-slate-800 text-white text-xs font-bold">
            Close
          </button>
        </div>
      </div>

    </div>
  </div>

  <!-- JAVASCRIPT LOGIC -->
  <script>
    // Live Philippine Standard Time (PST) Clock
    function updatePST() {
      const clockElement = document.getElementById('pstClock');
      if (!clockElement) return;
      const now = new Date();
      const options = {
        timeZone: 'Asia/Manila',
        weekday: 'short',
        month: 'short',
        day: 'numeric',
        year: 'numeric',
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit',
        hour12: true
      };
      clockElement.textContent = new Intl.DateTimeFormat('en-US', options).format(now) + ' PST';
    }
    updatePST();
    setInterval(updatePST, 1000);

    // Mobile Sidebar Drawer Toggle
    function toggleResidentSidebar() {
      const sidebar = document.getElementById('residentSidebar');
      const backdrop = document.getElementById('sidebarBackdrop');
      if (sidebar) sidebar.classList.toggle('hidden');
      if (backdrop) backdrop.classList.toggle('hidden');
    }

    // SweetAlert2 Sign Out Confirmation
    function confirmLogout() {
      const swal = window.GovSwal || (typeof Swal !== 'undefined' ? Swal : null);
      if (!swal) {
        if (confirm('Are you sure you want to sign out of the Resident Portal?')) {
          document.getElementById('logoutForm').submit();
        }
        return;
      }
      swal.fire({
        title: 'Sign Out?',
        text: 'Are you sure you want to exit your resident portal session?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#e11d48',
        cancelButtonColor: '#64748b',
        confirmButtonText: '<i class="fa-solid fa-power-off mr-1"></i> Yes, Sign Out',
        cancelButtonText: 'Cancel'
      }).then((result) => {
        if (result.isConfirmed) {
          document.getElementById('logoutForm').submit();
        }
      });
    }

    // Modal: Request Official Document
    function openResidentApplyModal() {
      const modal = document.getElementById('residentApplyModal');
      if (modal) modal.classList.remove('hidden');
    }
    function closeResidentApplyModal() {
      const modal = document.getElementById('residentApplyModal');
      if (modal) modal.classList.add('hidden');
    }

    // Fee preview calculator in apply modal (Barangay Ordinance No. 2020-01)
    function updateResModalFee() {
      const select = document.getElementById('resModalDocType');
      if (!select) return;
      const docType = select.value;
      const feeText = document.getElementById('resModalFeeText');
      const feeBadge = document.getElementById('resModalFeeBadge');

      const freeDocs = [
        'Certificate of Indigency',
        'Certification for PWD',
        'Certification for Solo Parent',
        'Solo Parent Barangay Certification',
        'Certification for First Time Job Seeker',
        'First-Time Jobseeker Certification (RA 11261)'
      ];
      if (freeDocs.includes(docType)) {
        feeText.textContent = '₱0.00 (FREE WAIVER)';
        feeBadge.textContent = 'Ordinance Sec. 5 / RA 11261 Waiver';
        feeBadge.className = 'text-[10px] text-emerald-800 bg-emerald-100 font-extrabold px-2.5 py-1 rounded-full';
      } else if (docType === 'Certification to File Action') {
        feeText.textContent = '₱300.00';
        feeBadge.textContent = 'Ordinance Sec. 8 CFA Fee';
        feeBadge.className = 'text-[10px] text-rose-800 bg-rose-100 font-bold px-2.5 py-1 rounded-full';
      } else if (docType.includes('Building')) {
        feeText.textContent = '₱200.00';
        feeBadge.textContent = 'Ordinance Sec. 4 Construction';
        feeBadge.className = 'text-[10px] text-purple-800 bg-purple-100 font-bold px-2.5 py-1 rounded-full';
      } else if (docType.includes('Business') || docType.includes('Aquatic') || docType.includes('Blotter')) {
        feeText.textContent = '₱100.00';
        feeBadge.textContent = 'Ordinance Sec. 3.B / 3.C / 3.A.7';
        feeBadge.className = 'text-[10px] text-blue-800 bg-blue-100 font-bold px-2.5 py-1 rounded-full';
      } else if (docType.includes('Loan')) {
        feeText.textContent = '₱50.00';
        feeBadge.textContent = 'Ordinance Sec. 3.A.5 Loan Fee';
        feeBadge.className = 'text-[10px] text-amber-800 bg-amber-100 font-bold px-2.5 py-1 rounded-full';
      } else {
        feeText.textContent = '₱30.00';
        feeBadge.textContent = 'Payable at Window 1 upon pickup';
        feeBadge.className = 'text-[10px] text-slate-800 bg-slate-100 font-bold px-2.5 py-1 rounded-full';
      }
    }

    // Modal: Review Request Details & Timeline
    async function openReviewModal(certId) {
      const modal = document.getElementById('reviewRequestModal');
      if (!modal) return;
      modal.classList.remove('hidden');

      try {
        const res = await fetch(`/resident/requests/${certId}/details`, {
          headers: { 'Accept': 'application/json' }
        });
        const data = await res.json();
        if (!data.success) throw new Error('Failed loading details');

        const cert = data.certificate;
        const timeline = data.timeline;
        const actions = data.actions;

        // Populate fields
        document.getElementById('revModalDocType').textContent = cert.doc_type;
        document.getElementById('revModalControlNo').textContent = cert.control_no;
        document.getElementById('revModalPurpose').textContent = cert.purpose;
        document.getElementById('revModalCtc').textContent = cert.ctc_no;
        document.getElementById('revModalApplicant').textContent = `${cert.citizen_name} (${cert.purok})`;
        document.getElementById('revModalFee').textContent = `₱${cert.amount_paid}`;
        document.getElementById('revModalOr').textContent = cert.or_no;
        document.getElementById('revModalRemarks').textContent = cert.remarks;

        // Status badge
        const badge = document.getElementById('revBadge');
        badge.textContent = cert.status;
        const statusColors = {
          'Pending': 'bg-amber-100 text-amber-800 border-amber-300',
          'Evaluated': 'bg-blue-100 text-blue-800 border-blue-300',
          'Approved': 'bg-emerald-100 text-emerald-800 border-emerald-300',
          'Ready for Release': 'bg-purple-100 text-purple-800 border-purple-300',
          'Claimed': 'bg-slate-100 text-slate-800 border-slate-300',
          'Cancelled': 'bg-rose-100 text-rose-800 border-rose-300',
          'Rejected': 'bg-rose-100 text-rose-800 border-rose-300'
        };
        badge.className = `px-3 py-1 rounded-full text-xs font-bold border ${statusColors[cert.status] || 'bg-slate-100'}`;

        // Status narrative text
        const statusNarratives = {
          'Pending': 'Pickup appointment booked. Pending clerical review by Barangay Secretary.',
          'Evaluated': 'Clerical review passed. Endorsed to Punong Barangay for executive signature.',
          'Approved': 'Approved by Punong Barangay. Being printed and stamped with dry seal at Window 1.',
          'Ready for Release': 'Hardcopy printed, wet-signed & dry-sealed! Proceed to Window 1 with your Claim Stub & Valid ID.',
          'Claimed': 'Official hardcopy document has been claimed in person at Barangay Hall.',
          'Cancelled': 'Appointment request was cancelled.',
          'Rejected': 'Application was not approved. Check remarks for details.'
        };
        document.getElementById('revStatusText').textContent = statusNarratives[cert.status] || cert.status;

        // Stepper Highlights
        const setStepActive = (stepEl, isActive, isDone) => {
          if (!stepEl) return;
          if (isDone) {
            stepEl.className = 'p-3 rounded-xl border text-center space-y-1 bg-emerald-50 border-emerald-300 text-emerald-900';
            stepEl.querySelector('div').className = 'w-6 h-6 rounded-full bg-emerald-600 text-white font-bold text-xs flex items-center justify-center mx-auto';
          } else if (isActive) {
            stepEl.className = 'p-3 rounded-xl border text-center space-y-1 bg-blue-50 border-blue-400 text-blue-900 animate-pulse';
            stepEl.querySelector('div').className = 'w-6 h-6 rounded-full bg-blue-600 text-white font-bold text-xs flex items-center justify-center mx-auto';
          } else {
            stepEl.className = 'p-3 rounded-xl border text-center space-y-1 bg-slate-50 border-slate-200 text-slate-500';
            stepEl.querySelector('div').className = 'w-6 h-6 rounded-full bg-slate-200 text-slate-700 font-bold text-xs flex items-center justify-center mx-auto';
          }
        };

        const s1 = document.getElementById('step1');
        const s2 = document.getElementById('step2');
        const s3 = document.getElementById('step3');
        const s4 = document.getElementById('step4');
        const s5 = document.getElementById('step5');

        document.getElementById('step1Time').textContent = cert.created_at;

        setStepActive(s1, false, true);
        setStepActive(s2, cert.status === 'Pending', timeline.clerical.completed);
        setStepActive(s3, cert.status === 'Evaluated', timeline.executive.completed);
        setStepActive(s4, cert.status === 'Approved', timeline.releasing.completed);
        setStepActive(s5, cert.status === 'Ready for Release', timeline.claimed.completed);

        // Action Buttons (Residents print Appointment & Claim Stub, not digitalized certificates)
        const btnClaimStub = document.getElementById('revBtnClaimStub');
        btnClaimStub.href = actions.claim_stub_url;

        const btnCancel = document.getElementById('revBtnCancel');
        const cancelForm = document.getElementById('revCancelForm');
        if (actions.can_cancel) {
          cancelForm.action = actions.cancel_url;
          btnCancel.classList.remove('hidden');
        } else {
          btnCancel.classList.add('hidden');
        }

      } catch (err) {
        console.error(err);
        alert('Could not load request details. Please try again.');
        closeReviewModal();
      }
    }

    function closeReviewModal() {
      const modal = document.getElementById('reviewRequestModal');
      if (modal) modal.classList.add('hidden');
    }
  </script>

  <!-- SweetAlert2 GovPH Configuration & Notifications -->
  <script>
    const GovSwal = Swal.mixin({
      customClass: {
        popup: 'rounded-3xl shadow-2xl font-sans border border-slate-200',
        confirmButton: 'px-5 py-2.5 rounded-xl font-extrabold text-xs shadow-md transition-all active:scale-95',
        cancelButton: 'px-4 py-2.5 rounded-xl font-bold text-xs bg-slate-100 hover:bg-slate-200 text-slate-700 transition-all mr-2',
      },
      buttonsStyling: true,
    });
    window.GovSwal = GovSwal;

    @if(session('success'))
      GovSwal.fire({
        icon: 'success',
        title: 'Operation Successful',
        text: {!! json_encode(session('success')) !!},
        confirmButtonColor: '#059669',
        confirmButtonText: 'Understood',
      });
    @endif

    @if(session('info'))
      GovSwal.fire({
        icon: 'info',
        title: 'Notice',
        text: {!! json_encode(session('info')) !!},
        confirmButtonColor: '#0284c7',
        confirmButtonText: 'Understood',
      });
    @endif

    @if(session('error'))
      GovSwal.fire({
        icon: 'error',
        title: 'Notice',
        text: {!! json_encode(session('error')) !!},
        confirmButtonColor: '#e11d48',
        confirmButtonText: 'Close',
      });
    @endif

    @if($errors->any())
      GovSwal.fire({
        icon: 'warning',
        title: 'Validation Notice',
        html: '<div class="text-left text-xs space-y-1 text-slate-700"><ul class="list-disc pl-5">@foreach($errors->all() as $err)<li>{{ addslashes($err) }}</li>@endforeach</ul></div>',
        confirmButtonColor: '#d97706',
        confirmButtonText: 'Review Form',
      });
    @endif
  </script>

  @yield('scripts')
</body>
</html>
