<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Resident Registration & Identity Verification - Barangay Dacutan BIMS</title>
  
  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
  
  <!-- FontAwesome 6 -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  
  <!-- Custom GovPH Stylesheet -->
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-slate-900 text-slate-100 min-h-screen flex flex-col antialiased selection:bg-emerald-500 selection:text-white relative overflow-x-hidden">

  <!-- Subtle Ambient Glow -->
  <div class="fixed top-0 left-1/4 w-96 h-96 bg-emerald-500/10 rounded-full blur-3xl pointer-events-none"></div>
  <div class="fixed bottom-0 right-1/4 w-96 h-96 bg-blue-500/10 rounded-full blur-3xl pointer-events-none"></div>

  <!-- 1. GOVPH MASTHEAD -->
  <div class="govph-masthead py-1.5 px-4 lg:px-8 flex items-center justify-between text-xs z-20 relative border-b border-slate-800">
    <div class="flex items-center gap-2.5">
      <span class="font-extrabold tracking-wider text-[11px] text-amber-400">GOVPH</span>
      <span class="text-slate-500">|</span>
      <span class="text-[11px] text-slate-300 font-medium">Republic of the Philippines</span>
      <span class="hidden sm:inline text-slate-500">•</span>
      <span class="hidden sm:inline text-[11px] text-slate-300">Municipality of Dumangas, Iloilo</span>
    </div>
    <div class="flex items-center gap-2 text-[11px] text-slate-300">
      <i class="fa-regular fa-clock text-amber-400"></i>
      <span id="pstClock" class="font-mono font-bold text-white">Loading PST...</span>
    </div>
  </div>

  <!-- 2. MAIN REGISTRATION CONTAINER -->
  @php $testRand = rand(100, 999); @endphp
  <main class="flex-1 py-10 px-4 sm:px-6 lg:px-8 max-w-4xl mx-auto w-full z-10 relative">

    <div class="space-y-6">

      <!-- Header & Seal -->
      <div class="text-center space-y-2">
        <a href="{{ route('public.home') }}" class="inline-flex items-center gap-3 group">
          <img src="{{ asset('assets/images/logo.svg') }}" alt="Seal" class="w-14 h-14 drop-shadow group-hover:scale-105 transition-transform mx-auto">
        </a>
        <h1 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight">
          Barangay Resident Account Sign Up
        </h1>
        <p class="text-xs sm:text-sm text-slate-400 max-w-xl mx-auto">
          Official registration and digital identity verification for residents of Barangay Dacutan, Dumangas, Iloilo.
        </p>
      </div>

      <!-- Errors Banner -->
      @if($errors->any())
        <div class="p-4 rounded-2xl bg-red-950/70 border border-red-800 text-red-300 text-xs font-medium space-y-1">
          <div class="flex items-center gap-2 font-bold text-red-200">
            <i class="fa-solid fa-triangle-exclamation text-base"></i>
            <span>Please correct the following errors:</span>
          </div>
          <ul class="list-disc list-inside pl-4 space-y-0.5">
            @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <!-- FAST TEST AUTO-FILL NOTICE & 1-CLICK CONTROLS -->
      <div class="p-4 rounded-2xl bg-emerald-950/60 border-2 border-emerald-500/40 shadow-xl flex flex-col sm:flex-row items-center justify-between gap-3">
        <div class="flex items-center gap-3">
          <div class="w-10 h-10 rounded-xl bg-emerald-500/20 text-emerald-400 flex items-center justify-center text-lg font-bold shrink-0">
            <i class="fa-solid fa-wand-magic-sparkles"></i>
          </div>
          <div>
            <span class="font-extrabold text-sm text-emerald-300">Quick Testing Mode: Pre-filled Default Values</span>
            <p class="text-xs text-slate-300">All demographic fields, credentials, valid ID details, and sample verification files are pre-filled so you can test registration instantly with 1 click.</p>
          </div>
        </div>
        <button 
          type="button" 
          onclick="refreshDemoTestData()" 
          class="px-3.5 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-extrabold text-xs shadow-md transition-all flex items-center gap-1.5 shrink-0"
        >
          <i class="fa-solid fa-arrows-rotate"></i>
          <span>Refresh Test Email</span>
        </button>
      </div>

      <!-- Registration Form Card -->
      <div class="bg-slate-800/90 backdrop-blur-xl border border-slate-700/80 rounded-2xl p-6 sm:p-8 shadow-2xl shadow-black/50">
        
        <form id="registerForm" action="{{ route('register.submit') }}" method="POST" enctype="multipart/form-data" onsubmit="return handleRegisterSubmit(event, this);" class="space-y-8">
          @csrf

          <!-- SECTION 1: PERSONAL INFORMATION -->
          <div class="space-y-4">
            <div class="border-b border-slate-700 pb-2 flex items-center justify-between">
              <h3 class="text-sm font-bold text-emerald-400 uppercase tracking-wider flex items-center gap-2">
                <i class="fa-solid fa-user"></i>
                <span>1. Personal & Demographic Information</span>
              </h3>
              <span class="text-[10px] text-slate-400 font-medium">Bona fide Dacutan Resident</span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
              <div>
                <label class="block text-xs font-bold text-slate-300 uppercase mb-1.5">First Name *</label>
                <input type="text" name="first_name" value="{{ old('first_name', 'Maria Clara') }}" required placeholder="e.g. Juan" class="w-full px-3.5 py-2.5 bg-slate-900 border border-slate-700 rounded-xl text-white text-xs font-medium focus:ring-2 focus:ring-emerald-500">
              </div>

              <div>
                <label class="block text-xs font-bold text-slate-300 uppercase mb-1.5">Middle Name</label>
                <input type="text" name="middle_name" value="{{ old('middle_name', 'Reyes') }}" placeholder="e.g. Dela Cruz" class="w-full px-3.5 py-2.5 bg-slate-900 border border-slate-700 rounded-xl text-white text-xs font-medium focus:ring-2 focus:ring-emerald-500">
              </div>

              <div>
                <label class="block text-xs font-bold text-slate-300 uppercase mb-1.5">Last Name *</label>
                <input type="text" name="last_name" value="{{ old('last_name', 'Dacutan') }}" required placeholder="e.g. Dacutan" class="w-full px-3.5 py-2.5 bg-slate-900 border border-slate-700 rounded-xl text-white text-xs font-medium focus:ring-2 focus:ring-emerald-500">
              </div>

              <div>
                <label class="block text-xs font-bold text-slate-300 uppercase mb-1.5">Suffix</label>
                <input type="text" name="suffix" value="{{ old('suffix', '') }}" placeholder="Jr., III (optional)" class="w-full px-3.5 py-2.5 bg-slate-900 border border-slate-700 rounded-xl text-white text-xs font-medium focus:ring-2 focus:ring-emerald-500">
              </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
              <div>
                <label class="block text-xs font-bold text-slate-300 uppercase mb-1.5">Gender *</label>
                <select name="gender" required class="w-full px-3.5 py-2.5 bg-slate-900 border border-slate-700 rounded-xl text-white text-xs font-medium focus:ring-2 focus:ring-emerald-500">
                  <option value="Male" {{ old('gender', 'Female') == 'Male' ? 'selected' : '' }}>Male</option>
                  <option value="Female" {{ old('gender', 'Female') == 'Female' ? 'selected' : '' }}>Female</option>
                </select>
              </div>

              <div>
                <label class="block text-xs font-bold text-slate-300 uppercase mb-1.5">Date of Birth *</label>
                <input type="date" name="birth_date" value="{{ old('birth_date', '1998-05-15') }}" required class="w-full px-3.5 py-2.5 bg-slate-900 border border-slate-700 rounded-xl text-white text-xs font-medium focus:ring-2 focus:ring-emerald-500">
              </div>

              <div>
                <label class="block text-xs font-bold text-slate-300 uppercase mb-1.5">Civil Status *</label>
                <select name="civil_status" required class="w-full px-3.5 py-2.5 bg-slate-900 border border-slate-700 rounded-xl text-white text-xs font-medium focus:ring-2 focus:ring-emerald-500">
                  <option value="Single" {{ old('civil_status', 'Single') == 'Single' ? 'selected' : '' }}>Single</option>
                  <option value="Married" {{ old('civil_status', 'Single') == 'Married' ? 'selected' : '' }}>Married</option>
                  <option value="Widowed" {{ old('civil_status', 'Single') == 'Widowed' ? 'selected' : '' }}>Widowed</option>
                  <option value="Separated" {{ old('civil_status', 'Single') == 'Separated' ? 'selected' : '' }}>Separated</option>
                </select>
              </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
              <div>
                <label class="block text-xs font-bold text-slate-300 uppercase mb-1.5">Purok / Zone *</label>
                <select name="purok" required class="w-full px-3.5 py-2.5 bg-slate-900 border border-slate-700 rounded-xl text-white text-xs font-medium focus:ring-2 focus:ring-emerald-500">
                  <option value="Purok 1" {{ old('purok', 'Purok 3') == 'Purok 1' ? 'selected' : '' }}>Purok 1</option>
                  <option value="Purok 2" {{ old('purok', 'Purok 3') == 'Purok 2' ? 'selected' : '' }}>Purok 2</option>
                  <option value="Purok 3" {{ old('purok', 'Purok 3') == 'Purok 3' ? 'selected' : '' }}>Purok 3</option>
                  <option value="Purok 4" {{ old('purok', 'Purok 3') == 'Purok 4' ? 'selected' : '' }}>Purok 4</option>
                  <option value="Purok 5" {{ old('purok', 'Purok 3') == 'Purok 5' ? 'selected' : '' }}>Purok 5</option>
                  <option value="Purok 6" {{ old('purok', 'Purok 3') == 'Purok 6' ? 'selected' : '' }}>Purok 6</option>
                  <option value="Purok 7" {{ old('purok', 'Purok 3') == 'Purok 7' ? 'selected' : '' }}>Purok 7</option>
                  <option value="Sitio Ilawod" {{ old('purok', 'Purok 3') == 'Sitio Ilawod' ? 'selected' : '' }}>Sitio Ilawod</option>
                  <option value="Sitio Ilaya" {{ old('purok', 'Purok 3') == 'Sitio Ilaya' ? 'selected' : '' }}>Sitio Ilaya</option>
                </select>
              </div>

              <div class="sm:col-span-2">
                <label class="block text-xs font-bold text-slate-300 uppercase mb-1.5">Complete Home Address in Dacutan *</label>
                <input type="text" name="address" value="{{ old('address', 'House 45, Zone 3, Brgy. Dacutan, Dumangas, Iloilo') }}" required placeholder="House/Lot No., Street / Landmark, Brgy. Dacutan" class="w-full px-3.5 py-2.5 bg-slate-900 border border-slate-700 rounded-xl text-white text-xs font-medium focus:ring-2 focus:ring-emerald-500">
              </div>
            </div>

            <div>
              <label class="block text-xs font-bold text-slate-300 uppercase mb-1.5">Mobile Contact Number *</label>
              <input type="text" name="contact_no" value="{{ old('contact_no', '0917-888-9999') }}" required placeholder="0917-123-4567" class="w-full px-3.5 py-2.5 bg-slate-900 border border-slate-700 rounded-xl text-white text-xs font-medium focus:ring-2 focus:ring-emerald-500">
            </div>
          </div>

          <!-- SECTION 2: ACCOUNT CREDENTIALS -->
          <div class="space-y-4">
            <div class="border-b border-slate-700 pb-2 flex items-center justify-between">
              <h3 class="text-sm font-bold text-emerald-400 uppercase tracking-wider flex items-center gap-2">
                <i class="fa-solid fa-key"></i>
                <span>2. Resident Portal Login Credentials</span>
              </h3>
              <span class="text-[10px] text-slate-400 font-medium">Secured with 256-bit Hash</span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
              <div>
                <label class="block text-xs font-bold text-slate-300 uppercase mb-1.5">Email Address *</label>
                <input type="email" name="email" id="email" value="{{ old('email', 'maria.dacutan' . $testRand . '@example.com') }}" required placeholder="juan.dacutan@example.com" class="w-full px-3.5 py-2.5 bg-slate-900 border border-slate-700 rounded-xl text-white text-xs font-medium focus:ring-2 focus:ring-emerald-500">
                <p class="text-[10px] text-slate-400 mt-1">Official certificate tracking updates will be emailed here.</p>
              </div>

              <div>
                <label class="block text-xs font-bold text-slate-300 uppercase mb-1.5">Username *</label>
                <input type="text" name="username" id="username" value="{{ old('username', 'maria_dacutan' . $testRand) }}" required placeholder="e.g. juan_dacutan" class="w-full px-3.5 py-2.5 bg-slate-900 border border-slate-700 rounded-xl text-white text-xs font-medium focus:ring-2 focus:ring-emerald-500">
                <p class="text-[10px] text-slate-400 mt-1">Letters, numbers, underscores, and dashes only.</p>
              </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
              <div>
                <label class="block text-xs font-bold text-slate-300 uppercase mb-1.5">Password *</label>
                <input type="password" name="password" value="{{ old('password', 'password123') }}" required placeholder="Minimum 6 characters" class="w-full px-3.5 py-2.5 bg-slate-900 border border-slate-700 rounded-xl text-white text-xs font-medium focus:ring-2 focus:ring-emerald-500 font-mono">
              </div>

              <div>
                <label class="block text-xs font-bold text-slate-300 uppercase mb-1.5">Confirm Password *</label>
                <input type="password" name="password_confirmation" value="{{ old('password_confirmation', 'password123') }}" required placeholder="Re-type password" class="w-full px-3.5 py-2.5 bg-slate-900 border border-slate-700 rounded-xl text-white text-xs font-medium focus:ring-2 focus:ring-emerald-500 font-mono">
              </div>
            </div>

            <div class="p-3.5 rounded-xl bg-amber-950/40 border border-amber-800/60 text-xs text-amber-200 flex items-center gap-2.5">
              <i class="fa-solid fa-stamp text-amber-400 text-sm"></i>
              <span><strong>Next Step:</strong> Upon registration, your account is queued for clerical verification by the Barangay Secretary based on your attached Government ID and selfie.</span>
            </div>
          </div>

          <!-- SECTION 3: MANDATORY IDENTITY VERIFICATION REQUIREMENTS -->
          <div class="space-y-4">
            <div class="border-b border-slate-700 pb-2 flex items-center justify-between">
              <h3 class="text-sm font-bold text-amber-400 uppercase tracking-wider flex items-center gap-2">
                <i class="fa-solid fa-id-card"></i>
                <span>3. Mandatory Identity Verification Requirements</span>
              </h3>
              <span class="text-[10px] text-amber-300 bg-amber-950/60 border border-amber-800 px-2 py-0.5 rounded-full font-bold">Required by Barangay</span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
              <div>
                <label class="block text-xs font-bold text-slate-300 uppercase mb-1.5">Valid Government / School ID Type *</label>
                <select name="id_type" required class="w-full px-3.5 py-2.5 bg-slate-900 border border-slate-700 rounded-xl text-white text-xs font-medium focus:ring-2 focus:ring-emerald-500">
                  <option value="PhilSys National ID" {{ old('id_type', 'PhilSys National ID') == 'PhilSys National ID' ? 'selected' : '' }}>PhilSys National ID / ePhilID</option>
                  <option value="Driver's License (LTO)" {{ old('id_type') == "Driver's License (LTO)" ? 'selected' : '' }}>Driver's License (LTO)</option>
                  <option value="UMID Card (SSS/GSIS)" {{ old('id_type') == 'UMID Card (SSS/GSIS)' ? 'selected' : '' }}>UMID Card (SSS/GSIS)</option>
                  <option value="COMELEC Voter's ID / Certification" {{ old('id_type') == "COMELEC Voter's ID / Certification" ? 'selected' : '' }}>COMELEC Voter's ID / Certification</option>
                  <option value="Philippine Postal ID" {{ old('id_type') == 'Philippine Postal ID' ? 'selected' : '' }}>Philippine Postal ID</option>
                  <option value="Barangay Resident ID Card" {{ old('id_type') == 'Barangay Resident ID Card' ? 'selected' : '' }}>Barangay Resident ID Card</option>
                  <option value="Student ID (Minors/Learners)" {{ old('id_type') == 'Student ID (Minors/Learners)' ? 'selected' : '' }}>Student ID (Minors/Learners)</option>
                  <option value="Senior Citizen ID / PWD ID" {{ old('id_type') == 'Senior Citizen ID / PWD ID' ? 'selected' : '' }}>Senior Citizen ID / PWD ID</option>
                  <option value="Passport" {{ old('id_type') == 'Passport' ? 'selected' : '' }}>Philippine Passport</option>
                </select>
              </div>

              <div>
                <label class="block text-xs font-bold text-slate-300 uppercase mb-1.5">ID Serial / Card Number *</label>
                <input type="text" name="id_number" value="{{ old('id_number', '1234-5678-9012') }}" required placeholder="e.g. 1234-5678-9012" class="w-full px-3.5 py-2.5 bg-slate-900 border border-slate-700 rounded-xl text-white text-xs font-medium focus:ring-2 focus:ring-emerald-500 font-mono">
              </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
              <!-- Upload Valid ID -->
              <div class="p-4 rounded-xl bg-slate-900/80 border border-slate-700 space-y-2">
                <label class="block text-xs font-bold text-slate-200 uppercase flex items-center justify-between">
                  <span>Photo of Valid ID (Front)</span>
                  <span class="text-[10px] text-emerald-400 font-bold"><i class="fa-solid fa-check"></i> Sample provided if empty</span>
                </label>
                <input type="file" name="id_photo" accept=".jpeg,.png,.jpg,.pdf" class="w-full text-xs text-slate-300 file:mr-3 file:py-2 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-emerald-600 file:text-white hover:file:bg-emerald-500 cursor-pointer">
                <p class="text-[10px] text-slate-400">Snapshot showing photo & name (Optional during testing evaluation).</p>
              </div>

              <!-- Upload Proof of Residency / Selfie with ID -->
              <div class="p-4 rounded-xl bg-slate-900/80 border border-slate-700 space-y-2">
                <label class="block text-xs font-bold text-slate-200 uppercase flex items-center justify-between">
                  <span>Proof of Residency or Selfie with ID</span>
                  <span class="text-[10px] text-emerald-400 font-bold"><i class="fa-solid fa-check"></i> Sample provided if empty</span>
                </label>
                <input type="file" name="proof_of_residency" accept=".jpeg,.png,.jpg,.pdf" class="w-full text-xs text-slate-300 file:mr-3 file:py-2 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-blue-600 file:text-white hover:file:bg-blue-500 cursor-pointer">
                <p class="text-[10px] text-slate-400">Selfie with ID or billing statement (Optional during testing evaluation).</p>
              </div>
            </div>

            <!-- Sworn Attestation Checkbox -->
            <div class="p-4 rounded-xl bg-emerald-950/40 border border-emerald-800/80 flex items-start gap-3">
              <input type="checkbox" name="sworn_statement" id="sworn_statement" value="1" checked required class="mt-0.5 w-4 h-4 rounded bg-slate-900 border-slate-700 text-emerald-600 focus:ring-emerald-500">
              <label for="sworn_statement" class="text-xs text-slate-300 leading-relaxed cursor-pointer">
                <strong class="text-emerald-400 font-bold uppercase">Sworn Identity Attestation:</strong>
                I solemnly certify under penalty of law that I am a bona fide resident of Barangay Dacutan, Dumangas, Iloilo, that the identity documents submitted are authentic and genuine, and that all declarations herein are true and correct.
              </label>
            </div>
          </div>

          <!-- Submit Button -->
          <div class="pt-4 border-t border-slate-700">
            <button 
              type="submit" 
              class="w-full py-3.5 px-4 rounded-xl bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-500 hover:to-teal-500 text-white font-extrabold text-sm shadow-xl shadow-emerald-950/60 focus:outline-none focus:ring-2 focus:ring-emerald-400 transition-all flex items-center justify-center gap-2 group"
            >
              <i class="fa-solid fa-shield-check text-base group-hover:scale-110 transition-transform"></i>
              <span>Complete Registration & Submit Identity Verification</span>
            </button>
          </div>

        </form>

        <!-- Already have account -->
        <div class="mt-6 pt-4 border-t border-slate-700 text-center text-xs text-slate-400">
          <span>Already have a verified resident account?</span>
          <a href="{{ route('login') }}" class="font-bold text-emerald-400 hover:text-emerald-300 ml-1 transition-colors">
            Sign In to Resident Portal <i class="fa-solid fa-arrow-right text-[10px]"></i>
          </a>
        </div>

      </div>

      <!-- Return Link -->
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
    <p>Republic of the Philippines • Municipality of Dumangas, Province of Iloilo • Barangay Dacutan BIMS</p>
  </footer>

  <script>
    const GovSwal = Swal.mixin({
      customClass: {
        popup: 'rounded-3xl shadow-2xl font-sans border border-slate-200',
        confirmButton: 'px-5 py-2.5 rounded-xl font-extrabold text-xs shadow-md transition-all',
        cancelButton: 'px-4 py-2.5 rounded-xl font-bold text-xs transition-all',
      },
      buttonsStyling: true,
    });

    @if($errors->any())
      GovSwal.fire({
        icon: 'warning',
        title: 'Validation Notice',
        html: '<div class="text-left text-xs space-y-1 text-slate-700"><ul class="list-disc pl-5">@foreach($errors->all() as $err)<li>{{ addslashes($err) }}</li>@endforeach</ul></div>',
        confirmButtonColor: '#d97706',
        confirmButtonText: 'Correct Errors',
      });
    @endif

    @if(session('error'))
      GovSwal.fire({
        icon: 'error',
        title: 'Registration Notice',
        text: {!! json_encode(session('error')) !!},
        confirmButtonColor: '#e11d48',
      });
    @endif

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

    function refreshDemoTestData() {
      const rand = Math.floor(100 + Math.random() * 900);
      const emailEl = document.getElementById('email');
      const userEl = document.getElementById('username');
      if (emailEl) emailEl.value = 'maria.dacutan' + rand + '@example.com';
      if (userEl) userEl.value = 'maria_dacutan' + rand;
    }

    function handleRegisterSubmit(e, form) {
      e.preventDefault();

      const sworn = document.getElementById('sworn_statement');
      if (sworn && !sworn.checked) {
        GovSwal.fire({
          icon: 'warning',
          title: 'Attestation Required',
          text: 'You must check the sworn identity attestation before proceeding.',
          confirmButtonColor: '#d97706',
        });
        return false;
      }

      GovSwal.fire({
        title: 'Submit Identity Verification?',
        html: 'Your registration and uploaded identity credentials will be submitted to the <strong>Barangay Secretary</strong> for identity validation.<br><br><span class="text-xs text-slate-500">Upon submission, your account will be queued for approval.</span>',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#059669',
        cancelButtonColor: '#64748b',
        confirmButtonText: '<i class="fa-solid fa-paper-plane mr-1.5"></i> Yes, Submit Registration',
        cancelButtonText: 'Review Details'
      }).then((result) => {
        if (result.isConfirmed) {
          GovSwal.fire({
            title: 'Submitting Identity Record...',
            text: 'Please wait while we record your information...',
            allowOutsideClick: false,
            didOpen: () => {
              Swal.showLoading();
            }
          });
          form.submit();
        }
      });

      return false;
    }
  </script>

</body>
</html>
