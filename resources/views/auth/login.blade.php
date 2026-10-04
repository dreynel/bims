<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Single Sign-In Portal • Barangay Dacutan BIMS</title>
  
  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
  
  <!-- FontAwesome 6 Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  
  <!-- Custom GovPH Stylesheet -->
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>
<body class="bg-slate-900 text-slate-100 min-h-screen flex flex-col justify-between antialiased selection:bg-emerald-500 selection:text-white relative overflow-x-hidden">

  <!-- Background Texture / Ambient Glow -->
  <div class="fixed inset-0 pointer-events-none z-0">
    <div class="absolute top-0 left-1/4 w-[600px] h-[600px] bg-emerald-600/10 rounded-full blur-[140px]"></div>
    <div class="absolute bottom-0 right-1/4 w-[600px] h-[600px] bg-blue-600/10 rounded-full blur-[140px]"></div>
    <div class="absolute inset-0 bg-[radial-gradient(#1e293b_1px,transparent_1px)] [background-size:24px_24px] opacity-25"></div>
  </div>

  <!-- 1. GOVPH OFFICIAL TOP MASTHEAD -->
  <div class="govph-masthead py-1.5 px-4 lg:px-8 flex items-center justify-between z-10 relative">
    <div class="flex items-center gap-2.5">
      <span class="font-extrabold tracking-wider text-[11px] text-amber-400">GOVPH</span>
      <span class="text-slate-400 text-xs">|</span>
      <span class="text-[11px] text-slate-300 font-medium">Republic of the Philippines</span>
      <span class="hidden sm:inline text-slate-400 text-xs">•</span>
      <span class="hidden sm:inline text-[11px] text-slate-300">Region VI • Municipality of Dumangas</span>
    </div>
    <div class="flex items-center gap-3 text-[11px] text-slate-300">
      <div class="flex items-center gap-1.5">
        <i class="fa-regular fa-clock text-amber-400"></i>
        <span class="hidden sm:inline">PST:</span>
        <span id="pstClock" class="font-mono font-bold text-white">Loading PST...</span>
      </div>
    </div>
  </div>

  <!-- 2. LOGIN CONTAINER -->
  <main class="flex-1 flex items-center justify-center p-4 sm:p-6 lg:p-8 z-10 relative">
    <div class="w-full max-w-md space-y-6">

      <!-- Official Header Card -->
      <div class="text-center space-y-3">
        <a href="{{ route('public.home') }}" class="inline-flex flex-col items-center group">
          <div class="relative p-1 rounded-full bg-gradient-to-tr from-amber-500 to-emerald-500 group-hover:scale-105 transition-transform shadow-lg shadow-emerald-950/50">
            <img src="{{ asset('assets/images/logo.svg') }}" alt="Barangay Dacutan Seal" class="w-20 h-20 bg-slate-900 rounded-full p-2">
          </div>
          <span class="mt-3 text-xs font-bold text-emerald-400 uppercase tracking-widest flex items-center gap-1.5">
            <i class="fa-solid fa-building-columns"></i>
            Barangay Dacutan BIMS
          </span>
        </a>
        <div>
          <h1 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight">Single Sign-In Portal</h1>
          <p class="text-xs text-slate-400 mt-1">Automatic Role Detection • Punong Barangay, Secretary & Residents</p>
        </div>
      </div>

      <!-- Flash & Error Messages -->
      @if(session('info'))
        <div class="p-3.5 rounded-xl bg-blue-950/70 border border-blue-800 text-blue-300 text-xs font-medium flex items-center gap-2.5">
          <i class="fa-solid fa-circle-info text-blue-400 text-base"></i>
          <span>{{ session('info') }}</span>
        </div>
      @endif

      @if(session('error'))
        <div class="p-3.5 rounded-xl bg-red-950/70 border border-red-800 text-red-300 text-xs font-medium flex items-center gap-2.5">
          <i class="fa-solid fa-circle-exclamation text-red-400 text-base"></i>
          <span>{{ session('error') }}</span>
        </div>
      @endif

      @if($errors->any())
        <div class="p-3.5 rounded-xl bg-red-950/70 border border-red-800 text-red-300 text-xs font-medium flex items-center gap-2.5">
          <i class="fa-solid fa-triangle-exclamation text-red-400 text-base"></i>
          <span>{{ $errors->first() }}</span>
        </div>
      @endif

      <!-- Authentication Form Card -->
      <div class="bg-slate-800/90 backdrop-blur-xl border border-slate-700/80 rounded-2xl p-6 sm:p-8 shadow-2xl shadow-black/50">
        <form action="{{ route('login.submit') }}" method="POST" class="space-y-4">
          @csrf

          <!-- Role Routing Notice -->
          <div class="p-3 rounded-xl bg-slate-900/70 border border-slate-700 text-[11px] text-slate-300 flex items-start gap-2.5">
            <i class="fa-solid fa-shield-halved text-emerald-400 text-sm mt-0.5"></i>
            <div>
              <span class="font-bold text-slate-200">Role-Aware Single Sign-In:</span>
              <p class="text-slate-400 mt-0.5 leading-relaxed">Enter your credentials. The system automatically identifies your role and routes you to your portal (<span class="text-amber-300 font-semibold">Punong Barangay</span>, <span class="text-emerald-300 font-semibold">Secretary</span>, or <span class="text-blue-300 font-semibold">Resident Portal</span>).</p>
            </div>
          </div>

          <!-- Username / Email Field -->
          <div>
            <label for="login" class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">
              Email Address or Username
            </label>
            <div class="relative">
              <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                <i class="fa-regular fa-user"></i>
              </span>
              <input 
                type="text" 
                name="login" 
                id="login" 
                value="{{ old('login') }}" 
                required 
                autofocus
                placeholder="Enter email or username (Resident or Official)"
                class="w-full pl-10 pr-4 py-2.5 bg-slate-900/90 border border-slate-700 rounded-xl text-white placeholder-slate-500 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all font-medium"
              >
            </div>
          </div>

          <!-- Password Field -->
          <div>
            <div class="flex items-center justify-between mb-2">
              <label for="password" class="block text-xs font-bold text-slate-300 uppercase tracking-wider">
                Password
              </label>
              <button type="button" onclick="togglePasswordVisibility()" class="text-[11px] text-slate-400 hover:text-emerald-400 font-medium transition-colors">
                <i class="fa-regular fa-eye" id="toggleIcon"></i> Show
              </button>
            </div>
            <div class="relative">
              <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                <i class="fa-solid fa-lock"></i>
              </span>
              <input 
                type="password" 
                name="password" 
                id="password" 
                required 
                placeholder="••••••••••••"
                class="w-full pl-10 pr-4 py-2.5 bg-slate-900/90 border border-slate-700 rounded-xl text-white placeholder-slate-500 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all font-medium font-mono"
              >
            </div>
          </div>

          <!-- Remember Session -->
          <div class="flex items-center justify-between pt-1">
            <label class="flex items-center gap-2 cursor-pointer text-xs text-slate-400 hover:text-slate-300">
              <input type="checkbox" name="remember" class="w-4 h-4 rounded bg-slate-900 border-slate-700 text-emerald-600 focus:ring-emerald-500">
              <span>Keep session authenticated</span>
            </label>
            <span class="text-[11px] text-slate-500">256-bit Secure</span>
          </div>

          <!-- Submit Button -->
          <button 
            type="submit" 
            class="w-full py-3 px-4 rounded-xl bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-500 hover:to-teal-500 text-white font-bold text-sm shadow-lg shadow-emerald-950/60 focus:outline-none focus:ring-2 focus:ring-emerald-400 transition-all flex items-center justify-center gap-2 group mt-2"
          >
            <i class="fa-solid fa-right-to-bracket text-base group-hover:translate-x-0.5 transition-transform"></i>
            <span>Sign In to Portal</span>
          </button>
        </form>

        <!-- Divider -->
        <div class="relative my-6 text-center">
          <div class="absolute inset-0 flex items-center"><div class="w-full border-t border-slate-700"></div></div>
          <span class="relative bg-slate-800 px-3 text-[11px] font-bold uppercase tracking-wider text-slate-400">
            Capstone Demo 1-Click Role Access
          </span>
        </div>

        <!-- Quick Demo Role Logins -->
        <div class="space-y-2">
          <a 
            href="{{ route('quick.login', 'captain') }}" 
            class="w-full flex items-center justify-between p-2.5 rounded-xl bg-slate-900/70 hover:bg-slate-700/80 border border-slate-700/60 text-xs transition-all group"
          >
            <div class="flex items-center gap-2.5">
              <div class="w-7 h-7 rounded-lg bg-amber-500/20 text-amber-400 flex items-center justify-center font-bold">
                <i class="fa-solid fa-user-tie"></i>
              </div>
              <div class="text-left">
                <p class="font-bold text-slate-200">Hon. Roberto S. Alen</p>
                <p class="text-[10px] text-slate-400">Punong Barangay (Captain)</p>
              </div>
            </div>
            <span class="text-[10px] font-bold text-amber-400 group-hover:translate-x-1 transition-transform flex items-center gap-1">
              Login <i class="fa-solid fa-arrow-right"></i>
            </span>
          </a>

          <a 
            href="{{ route('quick.login', 'secretary') }}" 
            class="w-full flex items-center justify-between p-2.5 rounded-xl bg-slate-900/70 hover:bg-slate-700/80 border border-slate-700/60 text-xs transition-all group"
          >
            <div class="flex items-center gap-2.5">
              <div class="w-7 h-7 rounded-lg bg-emerald-500/20 text-emerald-400 flex items-center justify-center font-bold">
                <i class="fa-solid fa-file-signature"></i>
              </div>
              <div class="text-left">
                <p class="font-bold text-slate-200">Mrs. Ma. Elena Balleza</p>
                <p class="text-[10px] text-slate-400">Barangay Secretary & Clerk</p>
              </div>
            </div>
            <span class="text-[10px] font-bold text-emerald-400 group-hover:translate-x-1 transition-transform flex items-center gap-1">
              Login <i class="fa-solid fa-arrow-right"></i>
            </span>
          </a>

          @if(\App\Models\User::where('role', 'resident')->exists())
            <a 
              href="{{ route('quick.login', 'resident') }}" 
              class="w-full flex items-center justify-between p-2.5 rounded-xl bg-slate-900/70 hover:bg-slate-700/80 border border-slate-700/60 text-xs transition-all group"
            >
              <div class="flex items-center gap-2.5">
                <div class="w-7 h-7 rounded-lg bg-blue-500/20 text-blue-400 flex items-center justify-center font-bold">
                  <i class="fa-solid fa-user-check"></i>
                </div>
                <div class="text-left">
                  <p class="font-bold text-slate-200">Juan Dela Cruz Dacutan</p>
                  <p class="text-[10px] text-slate-400">Verified Barangay Resident</p>
                </div>
              </div>
              <span class="text-[10px] font-bold text-blue-400 group-hover:translate-x-1 transition-transform flex items-center gap-1">
                Login <i class="fa-solid fa-arrow-right"></i>
              </span>
            </a>
          @endif
        </div>

        <!-- Resident Registration Link -->
        <div class="mt-6 pt-4 border-t border-slate-700/80 text-center text-xs text-slate-400">
          <span>Are you a resident of Barangay Dacutan?</span>
          <a href="{{ route('register') }}" class="font-bold text-emerald-400 hover:text-emerald-300 ml-1 transition-colors">
            Sign Up & Verify Identity <i class="fa-solid fa-arrow-right text-[10px]"></i>
          </a>
        </div>

      </div>

      <!-- Back to Public Citizen Portal -->
      <div class="text-center">
        <a href="{{ route('public.home') }}" class="inline-flex items-center gap-2 text-xs font-bold text-slate-400 hover:text-emerald-400 transition-colors">
          <i class="fa-solid fa-arrow-left"></i>
          <span>Return to Public Citizen Landing Portal</span>
        </a>
      </div>

    </div>
  </main>

  <!-- 3. FOOTER -->
  <footer class="py-3 px-4 text-center text-xs text-slate-500 border-t border-slate-800 z-10 relative">
    <p>Republic of the Philippines • Municipality of Dumangas, Province of Iloilo • Barangay Dacutan BIMS v2.0</p>
  </footer>

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

    function togglePasswordVisibility() {
      const pwd = document.getElementById('password');
      const icon = document.getElementById('toggleIcon');
      if (pwd.type === 'password') {
        pwd.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
      } else {
        pwd.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
      }
    }
  </script>
</body>
</html>
