@extends('layouts.public')

@section('title', 'Barangay Dacutan Public Citizen Portal - Dumangas, Iloilo')

@section('content')

<!-- 1. HERO SHOWCASE & CITIZEN WELCOME BANNER -->
<div class="relative rounded-3xl overflow-hidden bg-gradient-to-r from-slate-900 via-blue-950 to-emerald-950 text-white p-6 sm:p-10 lg:p-12 shadow-xl border border-slate-700/50">
  
  <!-- Subtle Ambient Glow -->
  <div class="absolute -top-24 -left-24 w-96 h-96 bg-emerald-500/15 rounded-full blur-3xl pointer-events-none"></div>
  <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-blue-500/15 rounded-full blur-3xl pointer-events-none"></div>

  <div class="relative z-10 grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
    <div class="lg:col-span-8 space-y-4">
      
      <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-emerald-500/20 text-emerald-300 text-xs font-bold border border-emerald-500/30">
        <i class="fa-solid fa-landmark text-amber-400"></i>
        <span>Republika ng Pilipinas • Lalawigan ng Iloilo • Bayan ng Dumangas</span>
      </div>

      <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-white leading-tight">
        Barangay Dacutan <br>
        <span class="gradient-text-emerald">Citizen E-Services Portal</span>
      </h2>

      <p class="text-slate-300 text-sm sm:text-base leading-relaxed max-w-2xl font-medium">
        Welcome to the official digital service window of Barangay Dacutan, Dumangas, Iloilo. Apply for official barangay documents online, track real-time application status, and stay informed with official community advisories.
      </p>

      <div class="flex flex-wrap gap-3 pt-3">
        <a href="{{ route('login') }}" class="px-5 py-3 rounded-xl bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-400 hover:to-teal-400 text-slate-950 font-black text-xs sm:text-sm shadow-lg shadow-emerald-950/40 transition-all flex items-center gap-2">
          <i class="fa-solid fa-right-to-bracket text-base"></i>
          <span>Sign In to Portal</span>
        </a>
        <a href="{{ route('register') }}" class="px-5 py-3 rounded-xl bg-white/10 hover:bg-white/20 text-white font-bold text-xs sm:text-sm border border-white/20 backdrop-blur-md transition-all flex items-center gap-2">
          <i class="fa-solid fa-id-card text-amber-400"></i>
          <span>Resident Sign Up & Verify</span>
        </a>
        <a href="#services-section" class="px-5 py-3 rounded-xl bg-slate-800/80 hover:bg-slate-700 text-white font-bold text-xs sm:text-sm border border-slate-700 transition-all flex items-center gap-2">
          <i class="fa-solid fa-file-signature text-emerald-400"></i>
          <span>Apply for Documents</span>
        </a>
        <a href="#tracker-section" class="px-5 py-3 rounded-xl bg-white/10 hover:bg-white/20 text-white font-bold text-xs sm:text-sm border border-white/20 backdrop-blur-md transition-all flex items-center gap-2">
          <i class="fa-solid fa-magnifying-glass text-amber-400"></i>
          <span>Track Application</span>
        </a>
        <a href="#hotlines-section" class="px-5 py-3 rounded-xl bg-rose-600/20 hover:bg-rose-600/30 text-rose-300 font-bold text-xs sm:text-sm border border-rose-500/30 backdrop-blur-md transition-all flex items-center gap-2">
          <i class="fa-solid fa-phone-volume"></i>
          <span>Hotlines</span>
        </a>
      </div>
    </div>

    <!-- Quick Stats / Public Hall Info Card -->
    <div class="lg:col-span-4 gov-card p-6 rounded-2xl bg-white/95 backdrop-blur-md text-slate-900 shadow-2xl border-2 border-emerald-500/40 space-y-4">
      <div class="flex items-center gap-3 border-b border-slate-200 pb-3">
        <img src="{{ asset('assets/images/logo.svg') }}" alt="Seal" class="w-11 h-11 drop-shadow">
        <div>
          <h3 class="font-bold text-sm text-slate-900 leading-tight">Barangay Hall of Dacutan</h3>
          <p class="text-[11px] text-slate-500 font-medium">Main Road, Brgy. Dacutan, Dumangas</p>
        </div>
      </div>

      <div class="space-y-2.5 text-xs font-semibold">
        <div class="flex justify-between items-center p-2 rounded-xl bg-slate-50">
          <span class="text-slate-600 flex items-center gap-2">
            <i class="fa-regular fa-clock text-emerald-600"></i> Office Hours:
          </span>
          <span class="text-slate-900 font-bold">Mon - Fri: 8:00 AM - 5:00 PM</span>
        </div>
        <div class="flex justify-between items-center p-2 rounded-xl bg-slate-50">
          <span class="text-slate-600 flex items-center gap-2">
            <i class="fa-solid fa-phone text-blue-600"></i> Hall Desk:
          </span>
          <span class="text-blue-900 font-mono font-bold">(033) 396-1024</span>
        </div>
        <div class="flex justify-between items-center p-2 rounded-xl bg-slate-50">
          <span class="text-slate-600 flex items-center gap-2">
            <i class="fa-solid fa-shield-halved text-rose-600"></i> Tanod Duty:
          </span>
          <span class="text-rose-900 font-mono font-bold">24/7 On-Call Desk</span>
        </div>
      </div>

      <div class="pt-2 border-t border-slate-200/80 flex items-center justify-between text-[11px] text-slate-500">
        <span>Punong Barangay:</span>
        <span class="font-bold text-slate-900">Hon. Roberto D. Dacutan</span>
      </div>
    </div>
  </div>
</div>

<!-- 2. ONE-STOP BARANGAY E-SERVICES SECTION -->
<section id="services-section" class="space-y-5 pt-4">
  <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 border-b border-slate-200 pb-3">
    <div>
      <h3 class="text-xl sm:text-2xl font-extrabold text-slate-900 tracking-tight flex items-center gap-2.5">
        <i class="fa-solid fa-stamp text-emerald-700"></i>
        <span>Official Barangay E-Services</span>
      </h3>
      <p class="text-xs sm:text-sm text-slate-500 font-medium">Select a document to apply online for fast-track processing at the Barangay Hall</p>
    </div>
    <span class="badge badge-green self-start sm:self-auto">5 Active Services Available</span>
  </div>

  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
    
    <!-- Service 1: Barangay Clearance -->
    <div class="gov-card p-6 rounded-2xl bg-white border border-slate-200 hover:border-emerald-500 shadow-sm hover:shadow-md transition-all flex flex-col justify-between group">
      <div class="space-y-3">
        <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-700 flex items-center justify-center text-xl font-bold border border-emerald-200 group-hover:scale-105 transition-transform">
          <i class="fa-solid fa-file-shield"></i>
        </div>
        <div>
          <div class="flex items-center justify-between">
            <h4 class="font-bold text-base text-slate-900">Barangay Clearance</h4>
            <span class="text-xs font-bold text-emerald-800 bg-emerald-100 px-2 py-0.5 rounded-full">₱ 50.00</span>
          </div>
          <p class="text-xs text-slate-600 mt-2 leading-relaxed">
            Certifies good moral standing and residency for Local Employment, Postal ID, Police Clearance, NBI, and Travel requirements.
          </p>
        </div>
      </div>
      <div class="pt-4 mt-4 border-t border-slate-100 flex items-center justify-between">
        <span class="text-[11px] text-slate-400 font-medium">Processing: Same Day</span>
        <button onclick="selectServiceForRequest('Barangay Clearance')" class="px-3.5 py-1.5 rounded-xl bg-emerald-50 hover:bg-emerald-700 hover:text-white text-emerald-800 font-bold text-xs transition-all flex items-center gap-1.5">
          <span>Apply Now</span>
          <i class="fa-solid fa-arrow-right text-[10px]"></i>
        </button>
      </div>
    </div>

    <!-- Service 2: Certificate of Indigency -->
    <div class="gov-card p-6 rounded-2xl bg-white border border-slate-200 hover:border-blue-500 shadow-sm hover:shadow-md transition-all flex flex-col justify-between group">
      <div class="space-y-3">
        <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-700 flex items-center justify-center text-xl font-bold border border-blue-200 group-hover:scale-105 transition-transform">
          <i class="fa-solid fa-hand-holding-heart"></i>
        </div>
        <div>
          <div class="flex items-center justify-between">
            <h4 class="font-bold text-base text-slate-900">Certificate of Indigency</h4>
            <span class="text-xs font-bold text-blue-800 bg-blue-100 px-2 py-0.5 rounded-full">100% FREE</span>
          </div>
          <p class="text-xs text-slate-600 mt-2 leading-relaxed">
            Issued to qualified low-income residents for Medical Assistance at WVMC/RHU, Hospital Bills, PAO Legal Assistance, and DSWD Aid.
          </p>
        </div>
      </div>
      <div class="pt-4 mt-4 border-t border-slate-100 flex items-center justify-between">
        <span class="text-[11px] text-slate-400 font-medium">Processing: Same Day</span>
        <button onclick="selectServiceForRequest('Certificate of Indigency')" class="px-3.5 py-1.5 rounded-xl bg-blue-50 hover:bg-blue-700 hover:text-white text-blue-800 font-bold text-xs transition-all flex items-center gap-1.5">
          <span>Apply Now</span>
          <i class="fa-solid fa-arrow-right text-[10px]"></i>
        </button>
      </div>
    </div>

    <!-- Service 3: Certificate of Residency -->
    <div class="gov-card p-6 rounded-2xl bg-white border border-slate-200 hover:border-amber-500 shadow-sm hover:shadow-md transition-all flex flex-col justify-between group">
      <div class="space-y-3">
        <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-700 flex items-center justify-center text-xl font-bold border border-amber-200 group-hover:scale-105 transition-transform">
          <i class="fa-solid fa-house-chimney-user"></i>
        </div>
        <div>
          <div class="flex items-center justify-between">
            <h4 class="font-bold text-base text-slate-900">Certificate of Residency</h4>
            <span class="text-xs font-bold text-amber-800 bg-amber-100 px-2 py-0.5 rounded-full">₱ 50.00</span>
          </div>
          <p class="text-xs text-slate-600 mt-2 leading-relaxed">
            Official proof of domicile in Barangay Dacutan. Required for Bank Account opening, School Enrollment, Voter Registration, and utility connections.
          </p>
        </div>
      </div>
      <div class="pt-4 mt-4 border-t border-slate-100 flex items-center justify-between">
        <span class="text-[11px] text-slate-400 font-medium">Processing: Same Day</span>
        <button onclick="selectServiceForRequest('Certificate of Residency')" class="px-3.5 py-1.5 rounded-xl bg-amber-50 hover:bg-amber-700 hover:text-white text-amber-800 font-bold text-xs transition-all flex items-center gap-1.5">
          <span>Apply Now</span>
          <i class="fa-solid fa-arrow-right text-[10px]"></i>
        </button>
      </div>
    </div>

    <!-- Service 4: First Time Job Seeker (RA 11261) -->
    <div class="gov-card p-6 rounded-2xl bg-white border border-slate-200 hover:border-purple-500 shadow-sm hover:shadow-md transition-all flex flex-col justify-between group">
      <div class="space-y-3">
        <div class="w-12 h-12 rounded-2xl bg-purple-50 text-purple-700 flex items-center justify-center text-xl font-bold border border-purple-200 group-hover:scale-105 transition-transform">
          <i class="fa-solid fa-graduation-cap"></i>
        </div>
        <div>
          <div class="flex items-center justify-between">
            <h4 class="font-bold text-base text-slate-900">First-Time Jobseeker</h4>
            <span class="text-xs font-bold text-purple-800 bg-purple-100 px-2 py-0.5 rounded-full">FREE (RA 11261)</span>
          </div>
          <p class="text-xs text-slate-600 mt-2 leading-relaxed">
            Under Republic Act 11261, newly graduated students and first-time workers are exempted from government document fees.
          </p>
        </div>
      </div>
      <div class="pt-4 mt-4 border-t border-slate-100 flex items-center justify-between">
        <span class="text-[11px] text-slate-400 font-medium">Processing: Same Day</span>
        <button onclick="selectServiceForRequest('First Time Job Seeker (RA 11261)')" class="px-3.5 py-1.5 rounded-xl bg-purple-50 hover:bg-purple-700 hover:text-white text-purple-800 font-bold text-xs transition-all flex items-center gap-1.5">
          <span>Apply Now</span>
          <i class="fa-solid fa-arrow-right text-[10px]"></i>
        </button>
      </div>
    </div>

    <!-- Service 5: Barangay Business Clearance -->
    <div class="gov-card p-6 rounded-2xl bg-white border border-slate-200 hover:border-teal-500 shadow-sm hover:shadow-md transition-all flex flex-col justify-between group">
      <div class="space-y-3">
        <div class="w-12 h-12 rounded-2xl bg-teal-50 text-teal-700 flex items-center justify-center text-xl font-bold border border-teal-200 group-hover:scale-105 transition-transform">
          <i class="fa-solid fa-shop"></i>
        </div>
        <div>
          <div class="flex items-center justify-between">
            <h4 class="font-bold text-base text-slate-900">Barangay Business Clearance</h4>
            <span class="text-xs font-bold text-teal-800 bg-teal-100 px-2 py-0.5 rounded-full">₱ 150.00</span>
          </div>
          <p class="text-xs text-slate-600 mt-2 leading-relaxed">
            Required for sari-sari stores, coastal fisheries, agri-enterprises, and commercial stalls operating within Barangay Dacutan jurisdiction.
          </p>
        </div>
      </div>
      <div class="pt-4 mt-4 border-t border-slate-100 flex items-center justify-between">
        <span class="text-[11px] text-slate-400 font-medium">Processing: 1-2 Days</span>
        <button onclick="selectServiceForRequest('Barangay Business Clearance')" class="px-3.5 py-1.5 rounded-xl bg-teal-50 hover:bg-teal-700 hover:text-white text-teal-800 font-bold text-xs transition-all flex items-center gap-1.5">
          <span>Apply Now</span>
          <i class="fa-solid fa-arrow-right text-[10px]"></i>
        </button>
      </div>
    </div>

    <!-- Fast Helpdesk Card -->
    <div class="gov-card p-6 rounded-2xl bg-gradient-to-br from-slate-900 to-slate-800 text-white border border-slate-700 shadow-sm flex flex-col justify-between">
      <div class="space-y-3">
        <div class="w-12 h-12 rounded-2xl bg-emerald-500/20 text-emerald-400 flex items-center justify-center text-xl font-bold border border-emerald-500/30">
          <i class="fa-solid fa-headset"></i>
        </div>
        <div>
          <h4 class="font-bold text-base text-white">Barangay Information Desk</h4>
          <p class="text-xs text-slate-300 mt-2 leading-relaxed">
            Have questions about clearance requirements, Cedula fees, or Lupon conciliation? Contact the Barangay Secretary desk directly.
          </p>
        </div>
      </div>
      <div class="pt-4 mt-4 border-t border-slate-700 flex items-center justify-between">
        <span class="text-[11px] text-emerald-400 font-bold flex items-center gap-1">
          <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
          Mon-Fri 8am-5pm
        </span>
        <a href="tel:09178899123" class="px-3.5 py-1.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs transition-all flex items-center gap-1.5">
          <i class="fa-solid fa-phone text-[10px]"></i>
          <span>Call Desk</span>
        </a>
      </div>
    </div>

  </div>
</section>

<!-- 3. INTERACTIVE DOCUMENT STATUS TRACKER (CONNECTED TO MYSQL) -->
<section id="tracker-section" class="gov-card p-6 sm:p-8 rounded-3xl bg-white border border-slate-200 shadow-sm space-y-6">
  <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 border-b border-slate-200 pb-4">
    <div>
      <h3 class="text-xl font-extrabold text-slate-900 tracking-tight flex items-center gap-2.5">
        <i class="fa-solid fa-magnifying-glass text-blue-700"></i>
        <span>Live Document Tracking System</span>
      </h3>
      <p class="text-xs text-slate-500 font-medium">Verify the real-time MySQL progress of your submitted clearance or indigency certificate</p>
    </div>
    <div class="flex items-center gap-2">
      <button type="button" onclick="loadSampleTracking('DAC-2026-0042')" class="text-xs font-bold text-blue-700 hover:text-blue-800 bg-blue-50 px-3 py-1.5 rounded-xl border border-blue-200 transition-all">
        Try Sample: DAC-2026-0042
      </button>
    </div>
  </div>

  <!-- Search Input Area -->
  <div class="max-w-2xl mx-auto">
    <div class="flex gap-2">
      <div class="relative flex-1">
        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
          <i class="fa-solid fa-barcode text-sm"></i>
        </div>
        <input 
          type="text" 
          id="trackingInput" 
          placeholder="Enter Application Ref No. (e.g. DAC-2026-0042)" 
          class="w-full pl-10 pr-4 py-3 rounded-2xl border border-slate-300 bg-slate-50/50 text-slate-900 font-bold text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
      </div>
      <button 
        type="button" 
        onclick="performPublicTracking()" 
        class="px-6 py-3 rounded-2xl bg-blue-700 hover:bg-blue-800 text-white font-bold text-sm shadow-md transition-all flex items-center gap-2">
        <i class="fa-solid fa-search"></i>
        <span>Track</span>
      </button>
    </div>
    <p id="trackingErrorMsg" class="text-xs text-rose-600 font-bold mt-2 hidden text-center"></p>
  </div>

  <!-- Real-Time Progress Visualizer -->
  <div id="trackingResultContainer" class="hidden pt-4 border-t border-slate-200/80">
    <div class="bg-slate-50 rounded-2xl p-5 border border-slate-200 space-y-6">
      <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 pb-3 border-b border-slate-200">
        <div>
          <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Application Reference</span>
          <h4 class="text-base font-extrabold text-slate-900 font-mono" id="trackRefNo">DAC-2026-0042</h4>
          <p class="text-xs text-slate-500 font-medium" id="trackApplicant">Juan Dela Cruz Dacutan</p>
        </div>
        <div class="flex items-center gap-3">
          <span class="text-xs font-bold text-slate-600" id="trackDocType">Barangay Clearance</span>
          <span class="badge badge-green" id="trackStatusBadge">Ready for Release</span>
        </div>
      </div>

      <!-- Step Progress Bar -->
      <div class="grid grid-cols-1 sm:grid-cols-4 gap-4">
        <!-- Step 1 -->
        <div class="flex sm:flex-col items-center gap-3 text-center" id="stepNode1">
          <div class="step-circle w-10 h-10 rounded-full bg-emerald-600 text-white flex items-center justify-center font-bold text-sm shadow-sm shrink-0">
            <i class="fa-solid fa-check"></i>
          </div>
          <div class="text-left sm:text-center">
            <p class="text-xs font-bold text-slate-900">1. Submitted</p>
            <p class="text-[10px] text-slate-500">Online Queue</p>
          </div>
        </div>

        <!-- Step 2 -->
        <div class="flex sm:flex-col items-center gap-3 text-center" id="stepNode2">
          <div class="step-circle w-10 h-10 rounded-full bg-emerald-600 text-white flex items-center justify-center font-bold text-sm shadow-sm shrink-0">
            <i class="fa-solid fa-check"></i>
          </div>
          <div class="text-left sm:text-center">
            <p class="text-xs font-bold text-slate-900">2. Evaluated</p>
            <p class="text-[10px] text-slate-500">Secretary Verified</p>
          </div>
        </div>

        <!-- Step 3 -->
        <div class="flex sm:flex-col items-center gap-3 text-center" id="stepNode3">
          <div class="step-circle w-10 h-10 rounded-full bg-emerald-600 text-white flex items-center justify-center font-bold text-sm shadow-sm shrink-0">
            <i class="fa-solid fa-check"></i>
          </div>
          <div class="text-left sm:text-center">
            <p class="text-xs font-bold text-slate-900">3. Approved</p>
            <p class="text-[10px] text-slate-500">Punong Brgy Signed</p>
          </div>
        </div>

        <!-- Step 4 -->
        <div class="flex sm:flex-col items-center gap-3 text-center" id="stepNode4">
          <div class="step-circle w-10 h-10 rounded-full bg-emerald-600 text-white flex items-center justify-center font-bold text-sm shadow-sm shrink-0 animate-bounce">
            <i class="fa-solid fa-building-flag"></i>
          </div>
          <div class="text-left sm:text-center">
            <p class="text-xs font-bold text-emerald-800">4. Ready for Release</p>
            <p class="text-[10px] text-emerald-600 font-semibold">Pick up at Hall</p>
          </div>
        </div>
      </div>

      <div class="p-3.5 bg-emerald-50 rounded-xl border border-emerald-200 text-xs text-emerald-800 flex items-center justify-between">
        <div class="flex items-center gap-2">
          <i class="fa-solid fa-circle-check text-emerald-600 text-sm"></i>
          <span id="trackStatusMsg">Document is ready for release. Please present valid ID at Barangay Hall Window 1.</span>
        </div>
        <span class="font-bold font-mono" id="trackFee">Fee: ₱ 50.00</span>
      </div>
    </div>
  </div>
</section>

<!-- 3.5. RESIDENT PORTAL & IDENTITY VERIFICATION SHOWCASE -->
<section id="resident-section" class="rounded-3xl bg-gradient-to-r from-slate-900 via-emerald-950 to-slate-900 text-white p-6 sm:p-8 border border-slate-700 shadow-xl relative overflow-hidden">
  <div class="absolute -right-20 -top-20 w-80 h-80 bg-emerald-500/15 rounded-full blur-3xl pointer-events-none"></div>

  <div class="relative z-10 grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
    <div class="lg:col-span-8 space-y-4">
      <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-500/20 text-emerald-300 text-xs font-bold border border-emerald-500/30">
        <i class="fa-solid fa-shield-check text-emerald-400"></i>
        <span>Official Barangay Dacutan Citizen Digital Identity</span>
      </div>

      <h3 class="text-2xl sm:text-3xl font-black text-white tracking-tight">
        Barangay Residents Portal: Sign Up & Verify
      </h3>

      <p class="text-xs sm:text-sm text-slate-300 leading-relaxed max-w-2xl font-medium">
        Are you a resident of Barangay Dacutan? Sign up for your official resident account with identity verification (PhilSys ID, Driver's License, or Voter's ID). Verified residents can request clearances with 1-click auto-fill, view real-time status history, and download approved certificates directly.
      </p>

      <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 pt-2">
        <div class="p-3 rounded-2xl bg-white/5 border border-white/10 text-xs">
          <i class="fa-solid fa-id-card text-emerald-400 text-base mb-1 block"></i>
          <span class="font-bold text-white block">Identity Verification</span>
          <span class="text-[11px] text-slate-400">PhilSys, Driver's, UMID, Voter's ID</span>
        </div>
        <div class="p-3 rounded-2xl bg-white/5 border border-white/10 text-xs">
          <i class="fa-solid fa-bolt text-amber-400 text-base mb-1 block"></i>
          <span class="font-bold text-white block">1-Click Fast Processing</span>
          <span class="text-[11px] text-slate-400">Auto-filled resident profile</span>
        </div>
        <div class="p-3 rounded-2xl bg-white/5 border border-white/10 text-xs">
          <i class="fa-solid fa-clock-rotate-left text-blue-400 text-base mb-1 block"></i>
          <span class="font-bold text-white block">24/7 Request History</span>
          <span class="text-[11px] text-slate-400">Track and view approved copies</span>
        </div>
      </div>

      <div class="flex flex-wrap gap-3 pt-3">
        <a href="{{ route('register') }}" class="px-6 py-3 rounded-2xl bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-400 hover:to-teal-400 text-slate-950 font-black text-xs sm:text-sm shadow-xl shadow-emerald-950/50 transition-all flex items-center gap-2">
          <i class="fa-solid fa-user-plus text-base"></i>
          <span>Create Resident Account & Verify Now</span>
        </a>
        <a href="{{ route('login') }}" class="px-5 py-3 rounded-2xl bg-white/10 hover:bg-white/20 text-white font-bold text-xs sm:text-sm border border-white/20 backdrop-blur-md transition-all flex items-center gap-2">
          <i class="fa-solid fa-right-to-bracket text-emerald-400"></i>
          <span>Sign In to Resident Portal</span>
        </a>
      </div>
    </div>

    <!-- Identity Verification Checklist Card -->
    <div class="lg:col-span-4 bg-slate-900/90 border border-slate-700/80 rounded-2xl p-5 text-xs space-y-3.5 shadow-2xl">
      <h4 class="font-extrabold text-sm text-white flex items-center gap-2">
        <i class="fa-solid fa-list-check text-amber-400"></i>
        <span>Verification Requirements:</span>
      </h4>
      <ul class="space-y-2 text-slate-300">
        <li class="flex items-start gap-2">
          <i class="fa-solid fa-check text-emerald-400 mt-0.5"></i>
          <span>Bona fide resident of Purok 1 to Purok 7, Dacutan</span>
        </li>
        <li class="flex items-start gap-2">
          <i class="fa-solid fa-check text-emerald-400 mt-0.5"></i>
          <span>1 Valid Gov't ID (PhilSys, Driver's, UMID, Voter's)</span>
        </li>
        <li class="flex items-start gap-2">
          <i class="fa-solid fa-check text-emerald-400 mt-0.5"></i>
          <span>Proof of Residency or Selfie holding valid ID</span>
        </li>
        <li class="flex items-start gap-2">
          <i class="fa-solid fa-check text-emerald-400 mt-0.5"></i>
          <span>Active mobile number & email address</span>
        </li>
      </ul>
      <div class="pt-2 border-t border-slate-800 text-[11px] text-slate-400">
        Clerical verification handled by: <strong class="text-slate-200">Mrs. Ma. Elena Balleza (Secretary & Clerk)</strong>
      </div>
    </div>
  </div>
</section>

<!-- 4. ONLINE APPLICATION FORM (SAVES DIRECTLY TO MYSQL) -->
<section id="request-section" class="gov-card p-6 sm:p-8 rounded-3xl bg-white border border-slate-200 shadow-sm space-y-6">
  <div class="border-b border-slate-200 pb-4">
    <h3 class="text-xl font-extrabold text-slate-900 tracking-tight flex items-center gap-2.5">
      <i class="fa-solid fa-file-circle-plus text-emerald-700"></i>
      <span>Online Document Application Form</span>
    </h3>
    <p class="text-xs text-slate-500 font-medium">Fill out the official request form below. This records directly into the Barangay Dacutan MySQL database.</p>
  </div>

  <form id="publicApplicationForm" action="{{ route('public.apply') }}" method="POST" onsubmit="handleOnlineDocSubmit(event)" class="space-y-5">
    @csrf

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
      
      <!-- Full Name -->
      <div>
        <label class="block text-xs font-bold text-slate-700 mb-1.5">Full Name (First, Middle, Last) *</label>
        <input 
          type="text" 
          name="citizen_name" 
          id="appFullName" 
          required 
          placeholder="e.g. Juan M. Dela Cruz" 
          class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 bg-slate-50/50 text-slate-900 text-xs font-semibold focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500">
      </div>

      <!-- Contact Number -->
      <div>
        <label class="block text-xs font-bold text-slate-700 mb-1.5">Mobile Contact Number *</label>
        <input 
          type="tel" 
          name="contact_no" 
          id="appContact" 
          required 
          placeholder="0917-123-4567" 
          class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 bg-slate-50/50 text-slate-900 text-xs font-semibold focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500">
      </div>

      <!-- Email Address (For Status Updates) -->
      <div>
        <label class="block text-xs font-bold text-slate-700 mb-1.5 flex items-center justify-between">
          <span>Email Address (For Status Updates)</span>
          <span class="text-[10px] text-emerald-600 font-semibold"><i class="fa-solid fa-envelope"></i> Recommended</span>
        </label>
        <input 
          type="email" 
          name="email" 
          id="appEmail" 
          placeholder="juan.delacruz@gmail.com" 
          class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 bg-slate-50/50 text-slate-900 text-xs font-semibold focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500">
      </div>

      <!-- Purok / Sitio -->
      <div>
        <label class="block text-xs font-bold text-slate-700 mb-1.5">Purok / Sitio Residence *</label>
        <select 
          name="purok" 
          id="appPurok" 
          required 
          class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 bg-slate-50/50 text-slate-900 text-xs font-bold focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500">
          <option value="Purok 1">Purok 1</option>
          <option value="Purok 2">Purok 2</option>
          <option value="Purok 3">Purok 3</option>
          <option value="Purok 4">Purok 4</option>
          <option value="Purok 5">Purok 5</option>
          <option value="Purok 6">Purok 6</option>
          <option value="Purok 7">Purok 7</option>
          <option value="Sitio Ilawod">Sitio Ilawod</option>
          <option value="Sitio Ilaya">Sitio Ilaya</option>
        </select>
      </div>

      <!-- Document Type Requested -->
      <div>
        <label class="block text-xs font-bold text-slate-700 mb-1.5">Document Type Requested *</label>
        <select 
          name="doc_type" 
          id="appDocType" 
          required 
          onchange="updateFeePreview()"
          class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 bg-slate-50/50 text-slate-900 text-xs font-bold focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500">
          <optgroup label="── Personal Certificates & Clearances ──">
            <option value="Barangay Clearance">Barangay Clearance / Certificate (For jobs, IDs, bank)</option>
            <option value="Certificate of Residency">Certificate of Residency (Proof of address)</option>
            <option value="Certificate of Indigency">Certificate of Indigency (For medical/financial aid)</option>
            <option value="Certificate of Good Moral Character">Certificate of Good Moral Character (School/work)</option>
            <option value="First-Time Jobseeker Certification (RA 11261)">First-Time Jobseeker Certification (RA 11261 free waiver)</option>
            <option value="Barangay ID">Barangay ID (Local identification card)</option>
            <option value="Solo Parent Barangay Certification">Solo Parent Barangay Certification (For local aid)</option>
          </optgroup>
          <optgroup label="── Business & Property Clearances ──">
            <option value="Barangay Business Clearance / Permit">Barangay Business Clearance / Permit (Starting business)</option>
            <option value="Barangay Building / Construction Clearance">Barangay Building / Construction Clearance (Building/renovation)</option>
            <option value="Certificate of No Objection (CNO)">Certificate of No Objection (CNO) (Special events/projects)</option>
          </optgroup>
          <optgroup label="── Legal & Dispute Records ──">
            <option value="Barangay Blotter Certification">Barangay Blotter Certification (Incident/complaint record)</option>
            <option value="Certification to File Action">Certification to File Action (For court endorsement)</option>
          </optgroup>
        </select>
      </div>

      <!-- Purpose of Request -->
      <div>
        <label class="block text-xs font-bold text-slate-700 mb-1.5">Purpose of Application *</label>
        <input 
          type="text" 
          name="purpose" 
          id="appPurpose" 
          required 
          placeholder="e.g. Local Employment, Bank Requirement, Medical Assistance" 
          class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 bg-slate-50/50 text-slate-900 text-xs font-semibold focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500">
      </div>

      <!-- Cedula / CTC Number -->
      <div>
        <label class="block text-xs font-bold text-slate-700 mb-1.5">Community Tax Cert (Cedula) # (Optional)</label>
        <input 
          type="text" 
          name="ctc_no" 
          id="appCedula" 
          placeholder="e.g. CTC-2026-0981" 
          class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 bg-slate-50/50 text-slate-900 text-xs font-semibold focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500">
      </div>
    </div>

    <!-- Fee Calculation & Disclaimer Banner -->
    <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200 flex flex-col sm:flex-row sm:items-center justify-between gap-3 text-xs">
      <div class="flex items-center gap-3">
        <div class="w-9 h-9 rounded-xl bg-emerald-100 text-emerald-800 flex items-center justify-center font-bold text-sm shrink-0">
          <i class="fa-solid fa-receipt"></i>
        </div>
        <div>
          <span class="text-slate-500">Assessed Fee for Requested Document:</span>
          <p class="font-extrabold text-sm text-emerald-800" id="feeDisplay">₱ 50.00 (Payable upon pick-up)</p>
          <p class="text-[10px] text-slate-500 mt-0.5"><i class="fa-solid fa-envelope-circle-check text-emerald-600"></i> Real-time email updates sent upon Secretary Review & Captain Approval.</p>
        </div>
      </div>
      <button 
        type="submit" 
        id="submitAppBtn"
        class="px-6 py-3 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-xs shadow-md flex items-center justify-center gap-2 transition-all">
        <i class="fa-solid fa-paper-plane"></i>
        <span>Submit Document Application</span>
      </button>
    </div>
  </form>
</section>

<!-- 5. COMMUNITY ADVISORIES & SANGGUNIANG BARANGAY RESOLUTIONS -->
<section id="advisories-section" class="space-y-4">
  <div class="flex items-center justify-between border-b border-slate-200 pb-3">
    <div>
      <h3 class="text-xl font-extrabold text-slate-900 tracking-tight flex items-center gap-2.5">
        <i class="fa-solid fa-bullhorn text-amber-600"></i>
        <span>Community Bulletins & Ordinances</span>
      </h3>
      <p class="text-xs text-slate-500 font-medium">Official announcements from the Sangguniang Barangay of Dacutan</p>
    </div>
    <span class="badge badge-yellow">Updated Today</span>
  </div>

  <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
    
    <!-- Advisory 1: Weather & Flood Warning -->
    <div class="gov-card p-5 rounded-2xl bg-white border border-slate-200 hover:border-blue-400 transition-all space-y-3">
      <div class="flex items-center justify-between text-xs">
        <span class="badge badge-blue">PAGASA Weather Alert</span>
        <span class="text-slate-400 font-medium">Dumangas Coastal</span>
      </div>
      <h4 class="font-bold text-sm text-slate-900">High Tide & Coastal Advisory (Purok 3 & Sitio Ilawod)</h4>
      <p class="text-xs text-slate-600 leading-relaxed font-medium">
        Residents along the coastal zone are advised of a predicted 1.6m high tide at 4:30 PM. Barangay Tanods are deployed for monitoring.
      </p>
    </div>

    <!-- Advisory 2: Health Outreach -->
    <div class="gov-card p-5 rounded-2xl bg-white border border-slate-200 hover:border-emerald-400 transition-all space-y-3">
      <div class="flex items-center justify-between text-xs">
        <span class="badge badge-green">Health Outreach</span>
        <span class="text-slate-400 font-medium">Brgy. Gymnasium</span>
      </div>
      <h4 class="font-bold text-sm text-slate-900">Free Anti-Rabies Vaccination for Pets</h4>
      <p class="text-xs text-slate-600 leading-relaxed font-medium">
        The Municipal Agriculture Office of Dumangas will conduct free rabies shots for dogs and cats this Saturday, 8:00 AM at the Covered Court.
      </p>
    </div>

    <!-- Advisory 3: Peace & Order Curfew -->
    <div class="gov-card p-5 rounded-2xl bg-white border border-slate-200 hover:border-rose-400 transition-all space-y-3">
      <div class="flex items-center justify-between text-xs">
        <span class="badge badge-red">Municipal Ordinance</span>
        <span class="text-slate-400 font-medium">Dumangas LGU</span>
      </div>
      <h4 class="font-bold text-sm text-slate-900">Minor Curfew & Videoke Quiet Hours Notice</h4>
      <p class="text-xs text-slate-600 leading-relaxed font-medium">
        Strict implementation of 10:00 PM curfew for minors under 18 and restriction of loud videoke operations in compliance with Municipal Ordinance No. 2024-04.
      </p>
    </div>

  </div>
</section>

<!-- 6. SANGGUNIANG BARANGAY LEADERSHIP DIRECTORY -->
<section id="officials-section" class="space-y-4">
  <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 border-b border-slate-200 pb-3">
    <div>
      <h3 class="text-xl font-extrabold text-slate-900 tracking-tight flex items-center gap-2.5">
        <i class="fa-solid fa-users-viewfinder text-emerald-700"></i>
        <span>Sangguniang Barangay Leadership Roster</span>
      </h3>
      <p class="text-xs text-slate-500 font-medium">Barangay Dacutan Officials, Committee Chairmanships & Secretariat</p>
    </div>
    <span class="badge badge-green">Term 2023 - 2026</span>
  </div>

  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
    @foreach($officials as $official)
      <div class="gov-card p-4 rounded-2xl bg-white border border-slate-200 shadow-sm text-center space-y-2.5 {{ $official['role'] === 'Punong Barangay' ? 'border-2 border-emerald-500 bg-gradient-to-br from-emerald-50 to-white' : '' }}">
        <img src="{{ $official['avatar'] }}" alt="{{ $official['name'] }}" class="w-16 h-16 rounded-full mx-auto border-2 {{ $official['role'] === 'Punong Barangay' ? 'border-emerald-600' : 'border-slate-300' }} object-cover shadow">
        <div>
          <h4 class="font-bold text-xs text-slate-900">{{ $official['name'] }}</h4>
          <p class="text-[11px] font-bold {{ $official['role'] === 'Punong Barangay' ? 'text-emerald-800' : ($official['role'] === 'SK Chairperson' ? 'text-purple-700' : 'text-blue-700') }} uppercase tracking-wider">
            {{ $official['role'] }}
          </p>
          <p class="text-[10px] text-slate-500 mt-0.5">{{ $official['committee'] }}</p>
        </div>
      </div>
    @endforeach
  </div>
</section>

<!-- 7. EMERGENCY HOTLINES DIRECTORY -->
<section id="hotlines-section" class="gov-card p-6 sm:p-8 rounded-3xl bg-white border-2 border-rose-200 shadow-sm space-y-5">
  <div class="flex items-center justify-between border-b border-slate-200 pb-3">
    <div>
      <h3 class="text-xl font-extrabold text-slate-900 tracking-tight flex items-center gap-2.5">
        <i class="fa-solid fa-phone-volume text-rose-600"></i>
        <span>Emergency Hotlines Directory</span>
      </h3>
      <p class="text-xs text-slate-500 font-medium">Dumangas Municipality & Barangay Dacutan 24/7 Responders</p>
    </div>
    <span class="badge badge-red">24/7 Responders</span>
  </div>

  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
    <a href="tel:09985986241" class="p-4 rounded-2xl bg-slate-50 hover:bg-blue-50 border border-slate-200 hover:border-blue-300 transition-all flex items-center gap-3.5 group">
      <div class="w-11 h-11 rounded-xl bg-blue-100 text-blue-700 flex items-center justify-center text-lg font-bold group-hover:scale-105 transition-transform">
        <i class="fa-solid fa-shield-halved"></i>
      </div>
      <div>
        <h5 class="text-xs font-bold text-slate-900">Dumangas PNP Police Station</h5>
        <p class="text-xs font-mono font-bold text-blue-700 mt-0.5">(033) 396-1211 / 0998-598-6241</p>
      </div>
    </a>

    <a href="tel:09171234347" class="p-4 rounded-2xl bg-slate-50 hover:bg-rose-50 border border-slate-200 hover:border-rose-300 transition-all flex items-center gap-3.5 group">
      <div class="w-11 h-11 rounded-xl bg-rose-100 text-rose-700 flex items-center justify-center text-lg font-bold group-hover:scale-105 transition-transform">
        <i class="fa-solid fa-fire-extinguisher"></i>
      </div>
      <div>
        <h5 class="text-xs font-bold text-slate-900">Bureau of Fire Protection (BFP)</h5>
        <p class="text-xs font-mono font-bold text-rose-700 mt-0.5">(033) 396-1191 / 0917-123-4347</p>
      </div>
    </a>

    <a href="tel:09209113862" class="p-4 rounded-2xl bg-slate-50 hover:bg-amber-50 border border-slate-200 hover:border-amber-300 transition-all flex items-center gap-3.5 group">
      <div class="w-11 h-11 rounded-xl bg-amber-100 text-amber-700 flex items-center justify-center text-lg font-bold group-hover:scale-105 transition-transform">
        <i class="fa-solid fa-truck-medical"></i>
      </div>
      <div>
        <h5 class="text-xs font-bold text-slate-900">MDRRMO Dumangas Rescue</h5>
        <p class="text-xs font-mono font-bold text-amber-700 mt-0.5">(033) 396-1020 / 0920-911-3862</p>
      </div>
    </a>

    <a href="tel:09178899123" class="p-4 rounded-2xl bg-slate-50 hover:bg-emerald-50 border border-slate-200 hover:border-emerald-300 transition-all flex items-center gap-3.5 group">
      <div class="w-11 h-11 rounded-xl bg-emerald-100 text-emerald-700 flex items-center justify-center text-lg font-bold group-hover:scale-105 transition-transform">
        <i class="fa-solid fa-walkie-talkie"></i>
      </div>
      <div>
        <h5 class="text-xs font-bold text-slate-900">Barangay Tanod & BHERT Desk</h5>
        <p class="text-xs font-mono font-bold text-emerald-700 mt-0.5">0917-889-9123 / (033) 396-1024</p>
      </div>
    </a>

    <a href="tel:0333961033" class="p-4 rounded-2xl bg-slate-50 hover:bg-teal-50 border border-slate-200 hover:border-teal-300 transition-all flex items-center gap-3.5 group">
      <div class="w-11 h-11 rounded-xl bg-teal-100 text-teal-700 flex items-center justify-center text-lg font-bold group-hover:scale-105 transition-transform">
        <i class="fa-solid fa-hospital"></i>
      </div>
      <div>
        <h5 class="text-xs font-bold text-slate-900">Dumangas Rural Health Unit</h5>
        <p class="text-xs font-mono font-bold text-teal-700 mt-0.5">(033) 396-1033</p>
      </div>
    </a>
  </div>
</section>

<!-- APPLICATION SUCCESS MODAL -->
<div id="publicDocSuccessModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/60 backdrop-blur-sm hidden">
  <div class="bg-white rounded-3xl p-6 sm:p-8 max-w-md w-full shadow-2xl border border-slate-200 space-y-5 animate-pop-in text-center">
    <div class="w-16 h-16 bg-emerald-100 text-emerald-700 rounded-full flex items-center justify-center text-2xl mx-auto">
      <i class="fa-solid fa-circle-check"></i>
    </div>
    
    <div>
      <h3 class="text-lg font-extrabold text-slate-900">Application Submitted to MySQL Database!</h3>
      <p class="text-xs text-slate-500 mt-1">Your document request has been queued in the Barangay Dacutan system for evaluation.</p>
    </div>

    <div class="p-4 bg-slate-50 rounded-2xl border border-slate-200 space-y-2">
      <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Your Application Tracking Reference</span>
      <p class="text-xl font-extrabold font-mono text-emerald-700" id="generatedRefNumber">DAC-2026-0042</p>
      <p class="text-[11px] text-slate-500">Please save this reference number to track status or present upon claiming.</p>
    </div>

    <div class="flex gap-2">
      <button type="button" onclick="closePublicDocModal()" class="w-full py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs transition-all">
        Close
      </button>
      <button type="button" onclick="viewApplicationInTracker()" class="w-full py-2.5 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-xs transition-all">
        Track Application
      </button>
    </div>
  </div>
</div>

@endsection

@section('scripts')
<script>
  let lastGeneratedRef = 'DAC-2026-0042';

  function selectServiceForRequest(docType) {
    const select = document.getElementById('appDocType');
    if (select) {
      select.value = docType;
      updateFeePreview();
    }
    const section = document.getElementById('request-section');
    if (section) section.scrollIntoView({ behavior: 'smooth' });
  }

  function updateFeePreview() {
    const select = document.getElementById('appDocType');
    const display = document.getElementById('feeDisplay');
    if (!select || !display) return;

    const fees = {
      'Barangay Clearance': '₱ 50.00 (Payable upon pick-up)',
      'Certificate of Residency': '₱ 50.00 (Payable upon pick-up)',
      'Certificate of Indigency': '₱ 0.00 (100% Free for Qualified Indigents)',
      'Certificate of Good Moral Character': '₱ 50.00 (Payable upon pick-up)',
      'First-Time Jobseeker Certification (RA 11261)': '₱ 0.00 (100% Free under RA 11261 Waiver)',
      'Barangay ID': '₱ 50.00 (Includes ID Card Lam & Photo Seal)',
      'Solo Parent Barangay Certification': '₱ 0.00 (Free for Qualified Solo Parents)',
      'Barangay Business Clearance / Permit': '₱ 150.00 (Commercial/Micro Business)',
      'Barangay Building / Construction Clearance': '₱ 200.00 (Renovation & Building)',
      'Certificate of No Objection (CNO)': '₱ 100.00 (Special Events / Community Projects)',
      'Barangay Blotter Certification': '₱ 50.00 (Official Incident / Hearing Record)',
      'Certification to File Action': '₱ 100.00 (Lupon Conciliation Court Endorsement)'
    };
    display.textContent = fees[select.value] || '₱ 50.00 (Payable upon pick-up)';
  }

  // AJAX Submission to Laravel Backend
  async function handleOnlineDocSubmit(e) {
    e.preventDefault();
    const form = document.getElementById('publicApplicationForm');
    const btn = document.getElementById('submitAppBtn');
    const formData = new FormData(form);

    btn.disabled = true;
    btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Submitting to Database...';

    try {
      const response = await fetch("{{ route('public.apply') }}", {
        method: "POST",
        headers: {
          'X-Requested-With': 'XMLHttpRequest',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: formData
      });

      const data = await response.json();

      if (data.success) {
        lastGeneratedRef = data.control_no;
        document.getElementById('generatedRefNumber').textContent = data.control_no;
        const modal = document.getElementById('publicDocSuccessModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        form.reset();
        updateFeePreview();
      } else {
        alert("Submission failed. Please check form inputs.");
      }
    } catch (err) {
      console.error(err);
      // Fallback form submit
      form.submit();
    } finally {
      btn.disabled = false;
      btn.innerHTML = '<i class="fa-solid fa-paper-plane"></i> <span>Submit Document Application</span>';
    }
  }

  function closePublicDocModal() {
    const modal = document.getElementById('publicDocSuccessModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
  }

  function viewApplicationInTracker() {
    closePublicDocModal();
    const trackerSection = document.getElementById('tracker-section');
    if (trackerSection) trackerSection.scrollIntoView({ behavior: 'smooth' });
    const input = document.getElementById('trackingInput');
    if (input) {
      input.value = lastGeneratedRef;
      performPublicTracking();
    }
  }

  // Live Tracking querying MySQL via Laravel API
  async function performPublicTracking() {
    const input = document.getElementById('trackingInput');
    const ref = input ? input.value.trim() : '';
    const errorEl = document.getElementById('trackingErrorMsg');
    const container = document.getElementById('trackingResultContainer');

    errorEl.classList.add('hidden');
    if (!ref) {
      errorEl.textContent = 'Please enter an Application Reference Number.';
      errorEl.classList.remove('hidden');
      return;
    }

    try {
      const response = await fetch(`{{ route('public.track') }}?ref=${encodeURIComponent(ref)}`);
      const data = await response.json();

      if (!data.found) {
        errorEl.textContent = data.message;
        errorEl.classList.remove('hidden');
        container.classList.add('hidden');
        return;
      }

      // Populate Visualizer
      document.getElementById('trackRefNo').textContent = data.control_no;
      document.getElementById('trackApplicant').textContent = data.citizen_name + ' • ' + data.purok;
      document.getElementById('trackDocType').textContent = data.doc_type;
      document.getElementById('trackStatusBadge').textContent = data.status;
      document.getElementById('trackStatusMsg').textContent = data.status_message;
      document.getElementById('trackFee').textContent = 'Fee: ₱ ' + data.amount_paid;

      // Update Step Circles (1 to 4)
      for (let i = 1; i <= 4; i++) {
        const node = document.getElementById(`stepNode${i}`);
        const circle = node.querySelector('.step-circle');
        if (i <= data.step) {
          circle.className = 'step-circle w-10 h-10 rounded-full bg-emerald-600 text-white flex items-center justify-center font-bold text-sm shadow-sm shrink-0';
          circle.innerHTML = '<i class="fa-solid fa-check"></i>';
        } else {
          circle.className = 'step-circle w-10 h-10 rounded-full bg-slate-200 text-slate-400 flex items-center justify-center font-bold text-sm shrink-0';
          circle.innerHTML = `<span>${i}</span>`;
        }
      }

      container.classList.remove('hidden');
    } catch (e) {
      console.error(e);
      errorEl.textContent = 'Server communication error while looking up tracking code.';
      errorEl.classList.remove('hidden');
    }
  }

  function loadSampleTracking(sampleRef) {
    const input = document.getElementById('trackingInput');
    if (input) {
      input.value = sampleRef;
      performPublicTracking();
    }
  }
</script>
@endsection
