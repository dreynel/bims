<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', 'Admin Command Terminal • Barangay Dacutan BIMS')</title>
  
  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
  
  <!-- FontAwesome 6 Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  
  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  
  <!-- Custom GovPH Stylesheet -->
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

  <style>
    /* Print overrides */
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
      <div class="flex items-center gap-1.5">
        <i class="fa-regular fa-clock text-amber-400"></i>
        <span class="hidden sm:inline">Philippine Standard Time (PST):</span>
        <span id="pstClock" class="font-mono font-bold text-white">Loading PST...</span>
      </div>
    </div>
  </div>

  <div class="flex-1 flex min-h-0">
    <!-- 2. ADMIN SIDEBAR NAVIGATION -->
    <aside id="sidebar" class="w-64 bg-slate-900 text-slate-300 flex-shrink-0 flex flex-col justify-between border-r border-slate-800 transition-all duration-300 z-50 no-print hidden md:flex md:static fixed inset-y-0 left-0 shadow-2xl md:shadow-none">
      
      <!-- Top Branding in Sidebar -->
      <div class="p-4 border-b border-slate-800">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 group">
          <img src="{{ asset('assets/images/logo.svg') }}" alt="Seal" class="w-10 h-10 rounded-full bg-slate-800 p-1 group-hover:scale-105 transition-transform">
          <div>
            <h2 class="text-sm font-extrabold text-white tracking-wide leading-tight">BARANGAY DACUTAN</h2>
            <span class="text-[10px] uppercase font-bold tracking-wider text-emerald-400">Executive BIMS</span>
          </div>
        </a>
      </div>

      <!-- Navigation Links -->
      <nav class="flex-1 p-3 space-y-1.5 overflow-y-auto">
        <div class="px-3 pt-2 pb-1 text-[10px] font-extrabold tracking-wider uppercase text-slate-500">Core Modules</div>
        
        <!-- Dashboard -->
        <a 
          href="{{ route('admin.dashboard') }}" 
          class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-bold transition-all {{ request()->routeIs('admin.dashboard') ? 'bg-emerald-600 text-white shadow-lg shadow-emerald-950/40' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}"
        >
          <i class="fa-solid fa-chart-pie w-4 text-center {{ request()->routeIs('admin.dashboard') ? 'text-white' : 'text-emerald-400' }}"></i>
          <span>Dashboard</span>
        </a>

        <!-- Resident Directory -->
        <a 
          href="{{ route('admin.residents.index') }}" 
          class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-bold transition-all {{ request()->routeIs('admin.residents.*') ? 'bg-emerald-600 text-white shadow-lg shadow-emerald-950/40' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}"
        >
          <i class="fa-solid fa-users-gear w-4 text-center {{ request()->routeIs('admin.residents.*') ? 'text-white' : 'text-amber-400' }}"></i>
          <span>Resident Profiling</span>
        </a>

        <!-- Certificates & Clearances -->
        <a 
          href="{{ route('admin.certificates.index') }}" 
          class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-bold transition-all {{ request()->routeIs('admin.certificates.*') ? 'bg-emerald-600 text-white shadow-lg shadow-emerald-950/40' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}"
        >
          <i class="fa-solid fa-file-shield w-4 text-center {{ request()->routeIs('admin.certificates.*') ? 'text-white' : 'text-blue-400' }}"></i>
          <span>Clearances & Issuance</span>
        </a>

        <!-- Blotter Records -->
        <a 
          href="{{ route('admin.blotter.index') }}" 
          class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-bold transition-all {{ request()->routeIs('admin.blotter.*') ? 'bg-emerald-600 text-white shadow-lg shadow-emerald-950/40' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}"
        >
          <i class="fa-solid fa-scale-balanced w-4 text-center {{ request()->routeIs('admin.blotter.*') ? 'text-white' : 'text-rose-400' }}"></i>
          <span>KP Blotter Cases</span>
        </a>

        <!-- Calamity / Ayuda Aid Distribution -->
        <a 
          href="{{ route('admin.aid.index') }}" 
          class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-bold transition-all {{ request()->routeIs('admin.aid.*') ? 'bg-emerald-600 text-white shadow-lg shadow-emerald-950/40' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}"
        >
          <i class="fa-solid fa-hand-holding-heart w-4 text-center {{ request()->routeIs('admin.aid.*') ? 'text-white' : 'text-teal-400' }}"></i>
          <span>Ayuda / Aid Registry</span>
        </a>

        <div class="px-3 pt-4 pb-1 text-[10px] font-extrabold tracking-wider uppercase text-slate-500">Citizen Services</div>

        <!-- Public Portal View Link -->
        <a 
          href="{{ route('public.home') }}" 
          target="_blank" 
          class="flex items-center justify-between px-3.5 py-2.5 rounded-xl text-xs font-bold text-slate-300 hover:bg-slate-800 hover:text-emerald-400 transition-all"
        >
          <div class="flex items-center gap-3">
            <i class="fa-solid fa-globe w-4 text-center text-slate-400"></i>
            <span>Citizen Public Portal</span>
          </div>
          <i class="fa-solid fa-arrow-up-right-from-square text-[10px] text-slate-500"></i>
        </a>
      </nav>

      <!-- Sidebar User Profile & Prominent Sign Out Button -->
      <div class="p-3 border-t border-slate-800 bg-slate-950/60 space-y-3">
        @auth
          <div class="flex items-center gap-3 px-2 py-1">
            <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-amber-500 to-emerald-600 text-white font-bold flex items-center justify-center text-sm shadow">
              {{ substr(Auth::user()->name, 0, 1) }}
            </div>
            <div class="flex-1 min-w-0">
              <p class="text-xs font-bold text-white truncate">{{ Auth::user()->name }}</p>
              <p class="text-[10px] text-emerald-400 uppercase tracking-wider font-semibold truncate">{{ Auth::user()->role === 'captain' ? 'Punong Barangay' : (Auth::user()->role === 'secretary' ? 'Brgy Secretary & Clerk' : Auth::user()->role) }}</p>
            </div>
          </div>

          <!-- SIGN OUT BUTTON (PROMINENT & CLEAR) -->
          <form action="{{ route('logout') }}" method="POST" class="w-full">
            @csrf
            <button 
              type="submit" 
              class="w-full flex items-center justify-center gap-2 px-3 py-2 rounded-xl bg-rose-600/20 hover:bg-rose-600 text-rose-300 hover:text-white border border-rose-500/30 text-xs font-bold transition-all shadow-sm group"
              title="Click to end administrative session and sign out"
            >
              <i class="fa-solid fa-arrow-right-from-bracket group-hover:translate-x-0.5 transition-transform"></i>
              <span>Sign Out</span>
            </button>
          </form>
        @endauth
      </div>
    </aside>

    <!-- 3. MAIN ADMINISTRATIVE CONTENT AREA -->
    <div class="flex-1 flex flex-col min-w-0 overflow-y-auto">
      
      <!-- Top Administrative Header -->
      <header class="bg-white border-b border-slate-200 px-4 sm:px-6 lg:px-8 py-3.5 flex items-center justify-between no-print sticky top-0 z-20 shadow-sm">
        
        <!-- Left: Mobile Menu Toggle & Title -->
        <div class="flex items-center gap-3">
          <button 
            type="button" 
            onclick="toggleMobileSidebar()" 
            class="md:hidden p-2 rounded-lg text-slate-600 hover:bg-slate-100 focus:outline-none"
            title="Toggle Menu"
          >
            <i class="fa-solid fa-bars text-lg"></i>
          </button>
          <div>
            <h1 class="text-base sm:text-lg font-extrabold text-slate-900 tracking-tight flex items-center gap-2">
              @yield('header_title', 'Barangay Dacutan Administration')
            </h1>
            <p class="text-xs text-slate-500 hidden sm:block">
              @yield('header_subtitle', 'Dumangas, Iloilo • Integrated Management Dashboard')
            </p>
          </div>
        </div>

        <!-- Right: Official User Info & Prominent Top Sign Out Button -->
        <div class="flex items-center gap-3 sm:gap-4">
          
          <a href="{{ route('public.home') }}" target="_blank" class="hidden sm:inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg border border-slate-200 text-slate-600 hover:text-emerald-700 hover:border-emerald-300 text-xs font-bold transition-colors">
            <i class="fa-solid fa-eye text-emerald-600"></i>
            <span>Public View</span>
          </a>

          @auth
            <!-- Official Account Tag -->
            <div class="hidden sm:flex items-center gap-2.5 px-3 py-1.5 bg-slate-50 border border-slate-200 rounded-xl">
              <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
              <div class="text-left">
                <span class="text-xs font-bold text-slate-800 block leading-tight">{{ Auth::user()->name }}</span>
                <span class="text-[10px] text-slate-500 uppercase tracking-wider font-semibold">{{ Auth::user()->role === 'captain' ? 'Punong Barangay' : (Auth::user()->role === 'secretary' ? 'Brgy Secretary & Clerk' : Auth::user()->role) }}</span>
              </div>
            </div>

            <!-- Prominent Top Header Sign Out Button -->
            <form action="{{ route('logout') }}" method="POST" class="inline">
              @csrf
              <button 
                type="submit" 
                class="flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-rose-50 hover:bg-rose-600 text-rose-700 hover:text-white border border-rose-200 hover:border-rose-600 text-xs font-bold transition-all shadow-sm"
                title="Click to sign out immediately"
              >
                <i class="fa-solid fa-power-off text-sm"></i>
                <span class="hidden sm:inline">Sign Out</span>
              </button>
            </form>
          @endauth
        </div>
      </header>

      <!-- FLASH NOTIFICATIONS -->
      <div class="px-4 sm:px-6 lg:px-8 pt-4">
        @if(session('success'))
          <div class="p-3.5 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-bold flex items-center justify-between shadow-sm">
            <div class="flex items-center gap-2.5">
              <i class="fa-solid fa-circle-check text-emerald-600 text-base"></i>
              <span>{{ session('success') }}</span>
            </div>
            <button onclick="this.parentElement.remove()" class="text-emerald-600 hover:text-emerald-900"><i class="fa-solid fa-xmark"></i></button>
          </div>
        @endif

        @if(session('info'))
          <div class="p-3.5 rounded-2xl bg-blue-50 border border-blue-200 text-blue-800 text-xs font-bold flex items-center justify-between shadow-sm">
            <div class="flex items-center gap-2.5">
              <i class="fa-solid fa-circle-info text-blue-600 text-base"></i>
              <span>{{ session('info') }}</span>
            </div>
            <button onclick="this.parentElement.remove()" class="text-blue-600 hover:text-blue-900"><i class="fa-solid fa-xmark"></i></button>
          </div>
        @endif

        @if(session('error'))
          <div class="p-3.5 rounded-2xl bg-rose-50 border border-rose-200 text-rose-800 text-xs font-bold flex items-center justify-between shadow-sm">
            <div class="flex items-center gap-2.5">
              <i class="fa-solid fa-triangle-exclamation text-rose-600 text-base"></i>
              <span>{{ session('error') }}</span>
            </div>
            <button onclick="this.parentElement.remove()" class="text-rose-600 hover:text-rose-900"><i class="fa-solid fa-xmark"></i></button>
          </div>
        @endif

        @if($errors->any())
          <div class="p-3.5 rounded-2xl bg-rose-50 border border-rose-200 text-rose-800 text-xs font-medium space-y-1 shadow-sm">
            <div class="flex items-center gap-2 font-bold text-rose-900">
              <i class="fa-solid fa-circle-exclamation text-base"></i>
              <span>Please resolve the following submission errors:</span>
            </div>
            <ul class="list-disc list-inside pl-2 text-rose-700">
              @foreach($errors->all() as $err)
                <li>{{ $err }}</li>
              @endforeach
            </ul>
          </div>
        @endif
      </div>

      <!-- MAIN BODY CONTAINER -->
      <main class="flex-1 p-4 sm:p-6 lg:p-8 space-y-6">
        @yield('content')
      </main>

      <!-- FOOTER -->
      <footer class="bg-white border-t border-slate-200 py-3 px-4 sm:px-6 lg:px-8 text-center sm:text-left flex flex-col sm:flex-row items-center justify-between text-xs text-slate-500 no-print gap-2">
        <p>Republic of the Philippines • Barangay Dacutan BIMS Capstone Project</p>
        <p class="font-medium text-[11px] text-slate-400">Powered by PHP Laravel & MySQL 8.0</p>
      </footer>

    </div>
  </div>

  <!-- SCRIPT HELPERS -->
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
      clockElement.textContent = new Intl.DateTimeFormat('en-PH', options).format(now);
    }
    setInterval(updatePST, 1000);
    updatePST();

    function toggleMobileSidebar() {
      const sidebar = document.getElementById('sidebar');
      sidebar.classList.toggle('hidden');
    }
  </script>

  <!-- SweetAlert2 GovPH Configuration & Notifications -->
  <script>
    const GovSwal = (typeof Swal !== 'undefined') ? Swal.mixin({
      customClass: {
        popup: 'rounded-3xl shadow-2xl font-sans border border-slate-200',
        confirmButton: 'px-5 py-2.5 rounded-xl font-extrabold text-xs shadow-md transition-all active:scale-95',
        cancelButton: 'px-4 py-2.5 rounded-xl font-bold text-xs bg-slate-100 hover:bg-slate-200 text-slate-700 transition-all mr-2',
      },
      buttonsStyling: true,
    }) : null;
    window.GovSwal = GovSwal;

    @if(session('success'))
      if (GovSwal) {
        GovSwal.fire({
          icon: 'success',
          title: 'Operation Successful',
          text: {!! json_encode(session('success')) !!},
          confirmButtonColor: '#059669',
          confirmButtonText: 'Understood',
        });
      }
    @endif

    @if(session('info'))
      if (GovSwal) {
        GovSwal.fire({
          icon: 'info',
          title: 'System Notice',
          text: {!! json_encode(session('info')) !!},
          confirmButtonColor: '#0284c7',
          confirmButtonText: 'Understood',
        });
      }
    @endif

    @if(session('error'))
      if (GovSwal) {
        GovSwal.fire({
          icon: 'error',
          title: 'Action Failed',
          text: {!! json_encode(session('error')) !!},
          confirmButtonColor: '#e11d48',
          confirmButtonText: 'Close',
        });
      }
    @endif

    @if($errors->any())
      if (GovSwal) {
        GovSwal.fire({
          icon: 'warning',
          title: 'Validation Notice',
          html: '<div class="text-left text-xs space-y-1 text-slate-700"><ul class="list-disc pl-5">@foreach($errors->all() as $err)<li>{{ addslashes($err) }}</li>@endforeach</ul></div>',
          confirmButtonColor: '#d97706',
          confirmButtonText: 'Review Form',
        });
      }
    @endif
  </script>
  @yield('scripts')
</body>
</html>
