<!DOCTYPE html>
<html lang="en" class="h-full bg-slate-100">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Account Verification Pending | Barangay Dacutan Resident Portal</title>
  
  <link rel="icon" type="image/svg+xml" href="{{ asset('assets/images/logo.svg') }}">
  <!-- Tailwind CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- FontAwesome 6 -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <!-- Inter Font -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <style>
    body { font-family: 'Plus Jakarta Sans', sans-serif; }
    @keyframes pulseSlow {
      0%, 100% { opacity: 1; transform: scale(1); }
      50% { opacity: 0.85; transform: scale(1.03); }
    }
    .animate-pulse-slow {
      animation: pulseSlow 3s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }
  </style>
</head>
<body class="h-full flex flex-col justify-between text-slate-800 antialiased selection:bg-emerald-500 selection:text-white">

  <!-- Top Citizen Header Bar -->
  <header class="bg-slate-900 border-b border-slate-800 text-white sticky top-0 z-40 shadow-md">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
      <div class="flex items-center gap-3">
        <img src="{{ asset('assets/images/logo.svg') }}" alt="Seal" class="w-9 h-9 object-contain drop-shadow">
        <div>
          <span class="text-xs font-black uppercase tracking-wider text-emerald-400 block leading-none">Barangay Dacutan</span>
          <span class="text-[11px] text-slate-400 font-medium">Citizen Self-Service Portal</span>
        </div>
      </div>

      <div class="flex items-center gap-3">
        <div class="hidden sm:flex items-center gap-2 px-3 py-1 bg-slate-800/80 rounded-xl border border-slate-700 text-xs">
          <i class="fa-solid fa-clock text-emerald-400 text-[10px]"></i>
          <span id="pstClock" class="font-mono text-slate-300">PST</span>
        </div>

        <form action="{{ route('logout') }}" method="POST" id="logoutForm" class="inline">
          @csrf
          <button 
            type="button" 
            onclick="confirmLogout()"
            class="px-3.5 py-1.5 rounded-xl bg-slate-800 hover:bg-rose-950 text-slate-300 hover:text-rose-300 border border-slate-700 hover:border-rose-800 text-xs font-bold transition-all flex items-center gap-1.5 shadow-sm"
          >
            <i class="fa-solid fa-arrow-right-from-bracket text-xs"></i>
            <span>Sign Out</span>
          </button>
        </form>
      </div>
    </div>
  </header>

  <!-- Main Content Area -->
  <main class="flex-1 max-w-4xl w-full mx-auto px-4 sm:px-6 py-8 sm:py-12 flex flex-col justify-center">
    
    <div class="bg-white rounded-3xl border border-slate-200 shadow-xl overflow-hidden">
      
      <!-- Banner Header -->
      <div class="bg-gradient-to-r from-slate-900 via-slate-800 to-emerald-950 p-6 sm:p-8 text-white relative">
        <div class="flex flex-col sm:flex-row items-center gap-5 sm:gap-6 text-center sm:text-left relative z-10">
          <div class="w-20 h-20 rounded-2xl {{ ($resident?->verification_status ?? '') === 'Rejected' ? 'bg-rose-500/10 border-2 border-rose-400/40 text-rose-400' : 'bg-amber-500/10 border-2 border-amber-400/40 text-amber-400' }} flex items-center justify-center text-3xl shadow-inner shrink-0 {{ ($resident?->verification_status ?? '') === 'Rejected' ? '' : 'animate-pulse-slow' }}">
            <i class="fa-solid {{ ($resident?->verification_status ?? '') === 'Rejected' ? 'fa-triangle-exclamation' : 'fa-user-clock' }}"></i>
          </div>
          <div>
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full {{ ($resident?->verification_status ?? '') === 'Rejected' ? 'bg-rose-400/15 border border-rose-400/30 text-rose-300' : 'bg-amber-400/10 border border-amber-400/30 text-amber-300' }} text-[11px] font-bold uppercase tracking-wider mb-2">
              <span class="w-2 h-2 rounded-full {{ ($resident?->verification_status ?? '') === 'Rejected' ? 'bg-rose-400' : 'bg-amber-400 animate-ping' }}"></span>
              <span>{{ ($resident?->verification_status ?? '') === 'Rejected' ? 'Application Flagged / Action Required' : 'Clerical Review in Progress' }}</span>
            </div>
            <h1 class="text-xl sm:text-2xl font-black text-white tracking-tight">
              {{ ($resident?->verification_status ?? '') === 'Rejected' ? 'Identity Verification Requires Attention' : 'Awaiting Approval by Barangay Secretary' }}
            </h1>
            <p class="text-slate-300 text-xs sm:text-sm mt-1 max-w-2xl leading-relaxed">
              @if(($resident?->verification_status ?? '') === 'Rejected')
                Mabuhay, <strong class="text-white">{{ $user->name ?? $resident?->full_name }}</strong>. The Barangay Secretary has reviewed your application and noted deficiencies. Please review the remarks below or visit Barangay Hall Window 1.
              @else
                Mabuhay, <strong class="text-white">{{ $user->name ?? $resident?->full_name }}</strong>! Your resident portal account has been submitted and is currently queued for official identity validation by the Barangay Secretary.
              @endif
            </p>
          </div>
        </div>
      </div>

      <!-- Content Body -->
      <div class="p-6 sm:p-8 space-y-6">
        
        <!-- Explanation Note -->
        <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200 text-xs text-slate-700 flex items-start gap-3.5">
          <div class="w-8 h-8 rounded-xl bg-emerald-100 text-emerald-800 flex items-center justify-center shrink-0 mt-0.5">
            <i class="fa-solid fa-shield-halved text-sm"></i>
          </div>
          <div class="space-y-1">
            <h4 class="font-extrabold text-slate-900">Why is identity verification required?</h4>
            <p class="text-slate-600 leading-relaxed">
              Under Barangay Dacutan governance and Philippine Data Privacy standards, official certificates (Barangay Clearance, Certificate of Residency, Indigency, First Time Jobseeker) carry official legal standing. The Barangay Secretary examines your submitted Government ID and holding selfie to prevent impersonation and guarantee records authenticity.
            </p>
          </div>
        </div>

        <!-- Submitted Identity Dossier Review -->
        <div class="border border-slate-200 rounded-2xl p-5 space-y-4 bg-white">
          <div class="flex items-center justify-between border-b border-slate-100 pb-3">
            <div class="flex items-center gap-2">
              <i class="fa-solid fa-id-card text-emerald-600 text-sm"></i>
              <h3 class="text-xs font-black uppercase tracking-wider text-slate-800">Your Submitted Credentials</h3>
            </div>
            <span class="px-2.5 py-1 rounded-lg {{ ($resident?->verification_status ?? '') === 'Rejected' ? 'bg-rose-50 text-rose-800 border border-rose-200' : 'bg-amber-50 text-amber-800 border border-amber-200' }} text-[10px] font-extrabold uppercase">
              {{ $resident?->verification_status ?? 'Pending Verification' }}
            </span>
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-xs">
            <div>
              <span class="text-slate-400 block text-[10px] uppercase font-bold">Assigned DAC ID</span>
              <span class="font-mono font-bold text-slate-900">{{ $resident?->resident_id ?? 'DAC-PENDING' }}</span>
            </div>
            <div>
              <span class="text-slate-400 block text-[10px] uppercase font-bold">ID Type & Number</span>
              <span class="font-bold text-slate-800">{{ $resident?->id_type ?? 'Government ID' }} • <span class="font-mono text-slate-600">{{ $resident?->id_number ?? 'N/A' }}</span></span>
            </div>
            <div>
              <span class="text-slate-400 block text-[10px] uppercase font-bold">Purok & Address</span>
              <span class="font-medium text-slate-800">{{ $resident?->purok ?? 'Dacutan' }}, Dumangas</span>
            </div>
          </div>

          <!-- Document Inspection Previews -->
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
            <!-- ID Photo -->
            <div class="border border-slate-200 rounded-xl p-3 bg-slate-50 space-y-2">
              <span class="text-[10px] font-extrabold text-slate-500 uppercase flex items-center justify-between">
                <span>1. Government ID Upload</span>
                <i class="fa-solid fa-id-badge text-slate-400"></i>
              </span>
              <div class="h-36 rounded-lg bg-slate-900 border border-slate-300 overflow-hidden relative group">
                <img src="{{ $resident?->id_photo ?? asset('assets/images/logo.svg') }}" alt="Government ID" class="w-full h-full object-contain p-1">
                <a href="{{ $resident?->id_photo ?? asset('assets/images/logo.svg') }}" target="_blank" class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 flex items-center justify-center text-white text-xs font-bold transition-opacity gap-1.5">
                  <i class="fa-solid fa-expand"></i>
                  <span>Inspect Original</span>
                </a>
              </div>
            </div>

            <!-- Holding Selfie -->
            <div class="border border-slate-200 rounded-xl p-3 bg-slate-50 space-y-2">
              <span class="text-[10px] font-extrabold text-slate-500 uppercase flex items-center justify-between">
                <span>2. Selfie Holding ID</span>
                <i class="fa-solid fa-camera text-slate-400"></i>
              </span>
              <div class="h-36 rounded-lg bg-slate-900 border border-slate-300 overflow-hidden relative group">
                <img src="{{ $resident?->proof_of_residency ?? $resident?->photo ?? asset('assets/images/logo.svg') }}" alt="Selfie with ID" class="w-full h-full object-contain p-1">
                <a href="{{ $resident?->proof_of_residency ?? $resident?->photo ?? asset('assets/images/logo.svg') }}" target="_blank" class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 flex items-center justify-center text-white text-xs font-bold transition-opacity gap-1.5">
                  <i class="fa-solid fa-expand"></i>
                  <span>Inspect Original</span>
                </a>
              </div>
            </div>
          </div>

          @if($resident?->verification_remarks)
            <div class="p-4 rounded-xl {{ ($resident?->verification_status ?? '') === 'Rejected' ? 'bg-rose-50 border border-rose-200 text-rose-950' : 'bg-amber-50 border border-amber-200 text-amber-900' }} text-xs space-y-1">
              <span class="font-bold uppercase text-[10px] {{ ($resident?->verification_status ?? '') === 'Rejected' ? 'text-rose-900' : 'text-amber-950' }} flex items-center gap-1.5">
                <i class="fa-solid {{ ($resident?->verification_status ?? '') === 'Rejected' ? 'fa-triangle-exclamation text-rose-600' : 'fa-bullhorn text-amber-600' }}"></i>
                <span>Secretary Notes / Evaluation Remarks:</span>
              </span>
              <p class="leading-relaxed font-medium">{{ $resident->verification_remarks }}</p>
            </div>
          @endif
        </div>

        <!-- Real-time Checker Action Card -->
        <div class="p-5 rounded-2xl bg-emerald-50/70 border border-emerald-200 flex flex-col sm:flex-row items-center justify-between gap-4">
          <div class="space-y-1 text-center sm:text-left">
            <h4 class="font-extrabold text-xs text-emerald-950 flex items-center justify-center sm:justify-start gap-1.5">
              <span class="w-2 h-2 rounded-full bg-emerald-500 animate-ping"></span>
              <span>Live Automatic Status Polling</span>
            </h4>
            <p class="text-[11px] text-emerald-800">
              This screen automatically checks every few seconds. Once approved by the Secretary, you will be redirected automatically.
            </p>
          </div>

          <div class="flex items-center gap-2.5 w-full sm:w-auto">
            <button 
              type="button" 
              onclick="checkStatusNow(true)" 
              id="checkStatusBtn"
              class="flex-1 sm:flex-none px-4 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 active:scale-95 text-white font-extrabold text-xs shadow-md shadow-emerald-900/10 transition-all flex items-center justify-center gap-2"
            >
              <i class="fa-solid fa-arrows-rotate" id="checkIcon"></i>
              <span>Check Status Now</span>
            </button>
          </div>
        </div>

        <!-- Office Window Guidelines -->
        <div class="border-t border-slate-100 pt-5 text-center text-xs text-slate-500 space-y-1">
          <p>
            Prefer in-person assistance? Visit <strong>Barangay Hall Window 1 (Records & Secretary)</strong>.
          </p>
          <p class="text-[11px] text-slate-400">
            Office Hours: Monday to Friday • 8:00 AM – 5:00 PM • Barangay Dacutan, Dumangas, Iloilo
          </p>
        </div>

      </div>

    </div>

  </main>

  <!-- Citizen Footer -->
  <footer class="py-4 text-center text-xs text-slate-500 border-t border-slate-200 bg-white">
    <p>© {{ date('Y') }} Barangay Dacutan, Dumangas, Iloilo • Republic of the Philippines</p>
  </footer>

  <script>
    // SweetAlert2 GovPH Config
    const GovSwal = Swal.mixin({
      customClass: {
        popup: 'rounded-3xl shadow-2xl font-sans border border-slate-200',
        confirmButton: 'px-5 py-2.5 rounded-xl font-extrabold text-xs shadow-md transition-all',
        cancelButton: 'px-4 py-2.5 rounded-xl font-bold text-xs transition-all',
      },
      buttonsStyling: true,
    });

    // PST Clock updater
    function updateClock() {
      const now = new Date();
      const options = { timeZone: 'Asia/Manila', hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: true };
      const el = document.getElementById('pstClock');
      if (el) el.textContent = now.toLocaleTimeString('en-US', options) + ' PST';
    }
    setInterval(updateClock, 1000);
    updateClock();

    // Flash Messages
    @if(session('info'))
      GovSwal.fire({
        icon: 'info',
        title: 'Account Verification Notice',
        text: {!! json_encode(session('info')) !!},
        confirmButtonColor: '#059669',
        confirmButtonText: 'Understood',
      });
    @endif

    @if(session('success'))
      GovSwal.fire({
        icon: 'success',
        title: 'Success',
        text: {!! json_encode(session('success')) !!},
        confirmButtonColor: '#059669',
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

    // Sign Out confirmation
    function confirmLogout() {
      GovSwal.fire({
        title: 'Sign Out?',
        text: 'You will be signed out of your pending registration session.',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#e11d48',
        cancelButtonColor: '#64748b',
        confirmButtonText: 'Yes, Sign Out',
        cancelButtonText: 'Cancel',
      }).then((result) => {
        if (result.isConfirmed) {
          document.getElementById('logoutForm').submit();
        }
      });
    }

    // Status Checker via AJAX
    let pollingInterval = null;

    async function checkStatusNow(isManual = false) {
      const checkIcon = document.getElementById('checkIcon');
      if (checkIcon) checkIcon.classList.add('fa-spin');

      try {
        const response = await fetch("{{ route('resident.verification.status') }}", {
          headers: {
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          }
        });

        if (!response.ok) throw new Error('Status check failed');

        const data = await response.json();

        if (data.is_verified) {
          if (pollingInterval) clearInterval(pollingInterval);

          GovSwal.fire({
            icon: 'success',
            title: 'Identity Validated!',
            html: `Mabuhay! Your identity has been officially approved and verified by the Barangay Secretary.<br><br><strong>DAC ID:</strong> <span class="font-mono text-emerald-700 font-bold">${data.resident_id || ''}</span><br>Redirecting to your resident dashboard...`,
            confirmButtonColor: '#059669',
            confirmButtonText: '<i class="fa-solid fa-arrow-right mr-1"></i> Enter Resident Portal',
            timer: 4000,
            timerProgressBar: true,
          }).then(() => {
            window.location.href = data.redirect || "{{ route('resident.dashboard') }}";
          });

          return;
        }

        if (data.is_rejected) {
          if (pollingInterval) clearInterval(pollingInterval);

          GovSwal.fire({
            icon: 'error',
            title: 'Identity Verification Deficiencies',
            html: `<div class="text-left text-xs text-slate-700 space-y-2"><p>The Barangay Secretary examined your submission and noted the following remarks:</p><div class="p-3 bg-rose-50 border border-rose-200 rounded-xl text-rose-900 font-medium">${data.remarks || 'Please visit Barangay Hall Window 1 with valid proof of identity.'}</div></div>`,
            confirmButtonColor: '#e11d48',
            confirmButtonText: 'Acknowledge',
          });

          return;
        }

        if (isManual) {
          GovSwal.fire({
            icon: 'info',
            title: 'Verification In Progress',
            html: `Your identity documents are currently queued at the Barangay Secretary's Verification Desk.<br><br>Status: <strong class="text-amber-600">${data.status}</strong>`,
            confirmButtonColor: '#059669',
            confirmButtonText: 'Keep Waiting',
          });
        }

      } catch (err) {
        console.error('Status check error:', err);
        if (isManual) {
          GovSwal.fire({
            icon: 'error',
            title: 'Connection Issue',
            text: 'Could not connect to the barangay verification service. Please try again.',
            confirmButtonColor: '#64748b'
          });
        }
      } finally {
        if (checkIcon) checkIcon.classList.remove('fa-spin');
      }
    }

    // Auto-poll every 6 seconds
    pollingInterval = setInterval(() => {
      checkStatusNow(false);
    }, 6000);
  </script>
</body>
</html>
