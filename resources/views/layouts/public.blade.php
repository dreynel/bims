<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', 'Barangay Dacutan Public Citizen Portal - Dumangas, Iloilo')</title>
  
  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
  
  <!-- FontAwesome 6 Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  
  <!-- Custom GovPH Stylesheet -->
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-slate-100 text-slate-800 min-h-screen flex flex-col antialiased is-public-mode selection:bg-emerald-500 selection:text-white">

  <!-- 1. GOVPH OFFICIAL TOP MASTHEAD -->
  <div class="govph-masthead py-1.5 px-4 lg:px-8 flex items-center justify-between no-print z-50 relative">
    <div class="flex items-center gap-2.5">
      <span class="font-extrabold tracking-wider text-[11px] text-amber-400">GOVPH</span>
      <span class="text-slate-400 text-xs">|</span>
      <span class="text-[11px] text-slate-300 font-medium">Republic of the Philippines</span>
      <span class="hidden sm:inline text-slate-400 text-xs">•</span>
      <span class="hidden sm:inline text-[11px] text-slate-300">Region VI (Western Visayas) • Province of Iloilo</span>
    </div>
    <div class="flex items-center gap-3 text-[11px] text-slate-300">
      <div class="flex items-center gap-1.5">
        <i class="fa-regular fa-clock text-amber-400"></i>
        <span class="hidden sm:inline">Philippine Standard Time (PST):</span>
        <span id="pstClock" class="font-mono font-bold text-white">Loading PST...</span>
      </div>
    </div>
  </div>

  <!-- 2. TOP CITIZEN NAVIGATION BAR -->
  <header class="sticky top-0 z-40 gov-nav px-4 lg:px-8 py-3 flex items-center justify-between no-print">
    <div class="flex items-center gap-3.5">
      <a href="{{ route('public.home') }}" class="flex items-center gap-3 group">
        <img src="{{ asset('assets/images/logo.svg') }}" alt="Barangay Dacutan Seal" class="w-10 h-10 drop-shadow group-hover:scale-105 transition-transform">
        <div>
          <div class="flex items-center gap-2">
            <h1 class="text-base sm:text-lg font-extrabold tracking-tight text-slate-900">
              BARANGAY DACUTAN
            </h1>
            <span class="text-[10px] sm:text-xs px-2.5 py-0.5 rounded-full bg-emerald-100 text-emerald-800 border border-emerald-300 font-bold">
              Citizen Portal
            </span>
          </div>
          <p class="text-[10px] sm:text-xs text-slate-500 font-medium">Municipality of Dumangas, Province of Iloilo • Region VI</p>
        </div>
      </a>
    </div>

    <!-- Navigation Controls -->
    <div class="flex items-center gap-2 sm:gap-3">
      <nav class="hidden lg:flex items-center gap-4 text-xs font-bold text-slate-600 mr-2">
        <a href="#services-section" class="hover:text-emerald-700 transition-colors">E-Services</a>
        <a href="#tracker-section" class="hover:text-emerald-700 transition-colors">Track Document</a>
        <a href="#advisories-section" class="hover:text-emerald-700 transition-colors">Advisories</a>
        <a href="#officials-section" class="hover:text-emerald-700 transition-colors">Officials</a>
        <a href="#hotlines-section" class="hover:text-emerald-700 transition-colors">Hotlines</a>
      </nav>

      <a href="#request-section" class="hidden sm:flex items-center gap-1.5 px-3.5 py-1.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-800 border border-slate-200 text-xs font-bold transition-all">
        <i class="fa-solid fa-file-arrow-up text-emerald-700"></i>
        <span>Express Request</span>
      </a>

      @auth
        @if(Auth::user()->isResident())
          <a href="{{ route('resident.dashboard') }}" class="px-3.5 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs sm:text-sm shadow-md flex items-center gap-2 transition-all">
            <i class="fa-solid fa-user-circle text-white"></i>
            <span>Resident Portal</span>
          </a>
        @else
          <a href="{{ route('admin.dashboard') }}" class="px-3.5 py-2 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-xs sm:text-sm shadow-md flex items-center gap-2 transition-all">
            <i class="fa-solid fa-gauge text-white"></i>
            <span>Official Terminal</span>
          </a>
        @endif
        <form action="{{ route('logout') }}" method="POST" class="inline">
          @csrf
          <button type="submit" title="Sign Out of Portal" class="p-2 rounded-xl bg-slate-100 hover:bg-rose-50 text-slate-500 hover:text-rose-600 border border-slate-200 text-xs font-bold transition-all">
            <i class="fa-solid fa-arrow-right-from-bracket"></i>
          </button>
        </form>
      @else
        <!-- SINGLE SIGN-IN BUTTON (Auto-detects role upon login) -->
        <a href="{{ route('login') }}" class="px-4 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs sm:text-sm shadow-md shadow-emerald-900/20 flex items-center gap-2 transition-all">
          <i class="fa-solid fa-right-to-bracket text-emerald-100"></i>
          <span>Sign In</span>
        </a>
      @endauth
    </div>
  </header>

  <!-- FLASH MESSAGES -->
  @if(session('success'))
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4 w-full">
      <div class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-bold flex items-center justify-between shadow-sm">
        <div class="flex items-center gap-2">
          <i class="fa-solid fa-circle-check text-emerald-600 text-base"></i>
          <span>{{ session('success') }}</span>
        </div>
        <button onclick="this.parentElement.remove()" class="text-emerald-600 hover:text-emerald-900"><i class="fa-solid fa-xmark"></i></button>
      </div>
    </div>
  @endif

  <!-- MAIN BODY CONTENT -->
  <main class="flex-1 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 w-full space-y-8">
    @yield('content')
  </main>

  <!-- FOOTER -->
  <footer class="bg-slate-900 text-white mt-12 border-t-2 border-amber-500 py-8 px-4 sm:px-8 text-xs font-medium">
    <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-6">
      <div class="space-y-2">
        <div class="flex items-center gap-2">
          <img src="{{ asset('assets/images/logo.svg') }}" alt="Seal" class="w-8 h-8">
          <span class="font-extrabold text-sm text-white">BARANGAY DACUTAN</span>
        </div>
        <p class="text-slate-400 leading-relaxed">
          Official Local Government Unit Portal • Municipality of Dumangas, Province of Iloilo. Dedicated to transparent, accountable, and technology-driven public service.
        </p>
      </div>

      <div class="space-y-1">
        <p class="font-bold text-slate-200 uppercase tracking-wider text-[11px] mb-2">Government Links</p>
        <p><a href="https://www.gov.ph" target="_blank" class="text-slate-400 hover:text-white transition-colors">GOV.PH National Portal</a></p>
        <p><a href="https://dilg.gov.ph" target="_blank" class="text-slate-400 hover:text-white transition-colors">Department of the Interior and Local Government (DILG)</a></p>
        <p><a href="https://privacy.gov.ph" target="_blank" class="text-slate-400 hover:text-white transition-colors">National Privacy Commission (RA 10173)</a></p>
      </div>

      <div class="space-y-1">
        <p class="font-bold text-slate-200 uppercase tracking-wider text-[11px] mb-2">Barangay Hall Desk</p>
        <p class="text-slate-400"><i class="fa-solid fa-location-dot text-emerald-400 mr-1.5"></i> Main Road, Barangay Dacutan, Dumangas, Iloilo 5006</p>
        <p class="text-slate-400"><i class="fa-solid fa-phone text-emerald-400 mr-1.5"></i> (033) 396-1024 / 0917-889-9123</p>
        <p class="text-slate-400"><i class="fa-regular fa-clock text-emerald-400 mr-1.5"></i> Monday - Friday: 8:00 AM - 5:00 PM</p>
      </div>
    </div>
    <div class="max-w-7xl mx-auto pt-6 mt-6 border-t border-slate-800 text-center text-slate-500 text-[11px]">
      All content is in the public domain unless otherwise stated. Capstone Undergraduate Project • BIMS v2.4 (PHP Laravel & MySQL 8.0)
    </div>
  </footer>

  <!-- PST Live Clock & SweetAlert Notifications -->
  <script>
    const GovSwal = Swal.mixin({
      customClass: {
        popup: 'rounded-3xl shadow-2xl font-sans border border-slate-200',
        confirmButton: 'px-5 py-2.5 rounded-xl font-extrabold text-xs shadow-md transition-all',
        cancelButton: 'px-4 py-2.5 rounded-xl font-bold text-xs transition-all',
      },
      buttonsStyling: true,
    });

    @if(session('success'))
      GovSwal.fire({
        icon: 'success',
        title: 'Success!',
        text: {!! json_encode(session('success')) !!},
        confirmButtonColor: '#059669',
      });
    @endif

    @if(session('info'))
      GovSwal.fire({
        icon: 'info',
        title: 'Notice',
        text: {!! json_encode(session('info')) !!},
        confirmButtonColor: '#2563eb',
      });
    @endif

    @if(session('error'))
      GovSwal.fire({
        icon: 'error',
        title: 'Notice',
        text: {!! json_encode(session('error')) !!},
        confirmButtonColor: '#e11d48',
      });
    @endif

    @if($errors->any())
      GovSwal.fire({
        icon: 'warning',
        title: 'Validation Notice',
        html: '<div class="text-left text-xs space-y-1 text-slate-700"><ul class="list-disc pl-5">@foreach($errors->all() as $err)<li>{{ addslashes($err) }}</li>@endforeach</ul></div>',
        confirmButtonColor: '#d97706',
      });
    @endif

    function updatePstClock() {
      const clockEl = document.getElementById('pstClock');
      if (!clockEl) return;
      const now = new Date();
      const options = {
        timeZone: 'Asia/Manila',
        hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: true,
        day: 'numeric', month: 'short', year: 'numeric'
      };
      try {
        clockEl.textContent = `${new Intl.DateTimeFormat('en-PH', options).format(now)} PST`;
      } catch (e) {
        clockEl.textContent = now.toLocaleTimeString() + ' PST';
      }
    }
    updatePstClock();
    setInterval(updatePstClock, 1000);
  </script>

  @yield('scripts')
</body>
</html>
