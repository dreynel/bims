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
        Welcome to the official digital service window of Barangay Dacutan, Dumangas, Iloilo. Schedule a document request appointment online for fast-track physical claiming at the Barangay Hall, track real-time processing status, and view official barangay ordinances and profile records.
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
          <i class="fa-solid fa-calendar-check text-emerald-400"></i>
          <span>Book Document Appointment</span>
        </a>
        <a href="#tracker-section" class="px-5 py-3 rounded-xl bg-white/10 hover:bg-white/20 text-white font-bold text-xs sm:text-sm border border-white/20 backdrop-blur-md transition-all flex items-center gap-2">
          <i class="fa-solid fa-magnifying-glass text-amber-400"></i>
          <span>Track Request</span>
        </a>
        <a href="#profile-summary-section" class="px-5 py-3 rounded-xl bg-blue-600/20 hover:bg-blue-600/30 text-blue-200 font-bold text-xs sm:text-sm border border-blue-400/30 backdrop-blur-md transition-all flex items-center gap-2">
          <i class="fa-solid fa-chart-pie"></i>
          <span>2025 Brgy. Profile</span>
        </a>
      </div>
    </div>

    <!-- Quick Stats / Public Hall Info Card -->
    <div class="lg:col-span-4 gov-card p-6 rounded-2xl bg-white/95 backdrop-blur-md text-slate-900 shadow-2xl border-2 border-emerald-500/40 space-y-4">
      <div class="flex items-center gap-3 border-b border-slate-200 pb-3">
        <img src="{{ asset('assets/images/logo.svg') }}" alt="Seal" class="w-11 h-11 drop-shadow">
        <div>
          <h3 class="font-bold text-sm text-slate-900 leading-tight">Barangay Hall of Dacutan</h3>
          <p class="text-[11px] text-slate-500 font-medium">2.5 km from Poblacion • 7 Puroks • Dumangas, Iloilo</p>
        </div>
      </div>

      <div class="space-y-2.5 text-xs font-semibold">
        <div class="flex justify-between items-center p-2 rounded-xl bg-slate-50">
          <span class="text-slate-600 flex items-center gap-2">
            <i class="fa-regular fa-clock text-emerald-600"></i> Claiming Hours:
          </span>
          <span class="text-slate-900 font-bold">Mon - Fri: 8:00 AM - 5:00 PM</span>
        </div>
        <div class="flex justify-between items-center p-2 rounded-xl bg-slate-50">
          <span class="text-slate-600 flex items-center gap-2">
            <i class="fa-solid fa-stamp text-blue-600"></i> Release Policy:
          </span>
          <span class="text-blue-900 font-bold">Walk-In Pickup Only (Dry Seal)</span>
        </div>
        <div class="flex justify-between items-center p-2 rounded-xl bg-slate-50">
          <span class="text-slate-600 flex items-center gap-2">
            <i class="fa-solid fa-users text-amber-600"></i> 2025 Population:
          </span>
          <span class="text-slate-900 font-mono font-bold">2,337 (562 Households)</span>
        </div>
      </div>

      <div class="pt-2 border-t border-slate-200/80 flex items-center justify-between text-[11px] text-slate-500">
        <span>Punong Barangay:</span>
        <span class="font-bold text-slate-900">{{ $officials[0]['name'] ?? 'Hon. Reynaldo M. Dela Cruz' }}</span>
      </div>
    </div>
  </div>
</div>

<!-- 2. ONE-STOP BARANGAY DOCUMENT APPOINTMENT SERVICES (ORDINANCE NO. 2020-01) -->
<section id="services-section" class="space-y-5 pt-4">
  <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 border-b border-slate-200 pb-3">
    <div>
      <h3 class="text-xl sm:text-2xl font-extrabold text-slate-900 tracking-tight flex items-center gap-2.5">
        <i class="fa-solid fa-calendar-check text-emerald-700"></i>
        <span>Barangay Document Appointment & Pre-Application Services</span>
      </h3>
      <p class="text-xs sm:text-sm text-slate-500 font-medium">
        Rates governed by <strong>Barangay Ordinance No. 2020-01</strong> • Online requests book a pre-processed appointment for physical claiming at Window 1 (no digitalized certificates issued online)
      </p>
    </div>
    <span class="badge badge-green self-start sm:self-auto">Ordinance No. 2020-01 Compliant</span>
  </div>

  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
    
    <!-- Service 1: Barangay Clearance (Employment / Proper ID / Residency / Good Moral) -->
    <div class="gov-card p-6 rounded-2xl bg-white border border-slate-200 hover:border-emerald-500 shadow-sm hover:shadow-md transition-all flex flex-col justify-between group">
      <div class="space-y-3">
        <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-700 flex items-center justify-center text-xl font-bold border border-emerald-200 group-hover:scale-105 transition-transform">
          <i class="fa-solid fa-file-shield"></i>
        </div>
        <div>
          <div class="flex items-center justify-between">
            <h4 class="font-bold text-base text-slate-900">Barangay Clearance</h4>
            <span class="text-xs font-bold text-emerald-800 bg-emerald-100 px-2 py-0.5 rounded-full">₱ 30.00</span>
          </div>
          <p class="text-xs text-slate-600 mt-2 leading-relaxed">
            Per Sec. 3.A of Brgy. Ordinance No. 2020-01: Employment, Proper Identification, TIN ID, Residency, Good Moral Character, and Electrification (ILECO) clearances (₱50.00 for Loan / Postal ID).
          </p>
        </div>
      </div>
      <div class="pt-4 mt-4 border-t border-slate-100 flex items-center justify-between">
        <span class="text-[11px] text-slate-400 font-medium">Pickup: Window 1 (Dry Seal)</span>
        <button onclick="selectServiceForRequest('Barangay Clearance')" class="px-3.5 py-1.5 rounded-xl bg-emerald-50 hover:bg-emerald-700 hover:text-white text-emerald-800 font-bold text-xs transition-all flex items-center gap-1.5">
          <span>Book Appointment</span>
          <i class="fa-solid fa-arrow-right text-[10px]"></i>
        </button>
      </div>
    </div>

    <!-- Service 2: Section 5 Free Certifications (Indigency, Student, Senior, PWD, Solo Parent) -->
    <div class="gov-card p-6 rounded-2xl bg-white border border-slate-200 hover:border-blue-500 shadow-sm hover:shadow-md transition-all flex flex-col justify-between group">
      <div class="space-y-3">
        <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-700 flex items-center justify-center text-xl font-bold border border-blue-200 group-hover:scale-105 transition-transform">
          <i class="fa-solid fa-hand-holding-heart"></i>
        </div>
        <div>
          <div class="flex items-center justify-between">
            <h4 class="font-bold text-base text-slate-900">Indigency, PWD, Senior & Student</h4>
            <span class="text-xs font-bold text-blue-800 bg-blue-100 px-2 py-0.5 rounded-full">100% FREE</span>
          </div>
          <p class="text-xs text-slate-600 mt-2 leading-relaxed">
            Per Sec. 5 of Brgy. Ordinance No. 2020-01: No fee collected for Students (Educational Purposes), Senior Citizens, Persons with Disability (PWD), Solo Parents, and Indigents.
          </p>
        </div>
      </div>
      <div class="pt-4 mt-4 border-t border-slate-100 flex items-center justify-between">
        <span class="text-[11px] text-slate-400 font-medium">Pickup: Window 1 (Dry Seal)</span>
        <button onclick="selectServiceForRequest('Certificate of Indigency')" class="px-3.5 py-1.5 rounded-xl bg-blue-50 hover:bg-blue-700 hover:text-white text-blue-800 font-bold text-xs transition-all flex items-center gap-1.5">
          <span>Book Appointment</span>
          <i class="fa-solid fa-arrow-right text-[10px]"></i>
        </button>
      </div>
    </div>

    <!-- Service 3: Special Barangay Certifications (ILECO, RSBSA, Delayed Reg, Live-In, Deceased, Loan) -->
    <div class="gov-card p-6 rounded-2xl bg-white border border-slate-200 hover:border-amber-500 shadow-sm hover:shadow-md transition-all flex flex-col justify-between group">
      <div class="space-y-3">
        <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-700 flex items-center justify-center text-xl font-bold border border-amber-200 group-hover:scale-105 transition-transform">
          <i class="fa-solid fa-file-lines"></i>
        </div>
        <div>
          <div class="flex items-center justify-between">
            <h4 class="font-bold text-base text-slate-900">Special Barangay Certifications</h4>
            <span class="text-xs font-bold text-amber-800 bg-amber-100 px-2 py-0.5 rounded-full">₱ 30.00 – ₱ 50.00</span>
          </div>
          <p class="text-xs text-slate-600 mt-2 leading-relaxed">
            Certifications for Delayed Registration, ILECO / Electrical Permit, RSBSA Member (Farmers/Fisherfolks), TIN ID, Live-In, Deceased / House (₱30.00), and Loan Purposes (₱50.00).
          </p>
        </div>
      </div>
      <div class="pt-4 mt-4 border-t border-slate-100 flex items-center justify-between">
        <span class="text-[11px] text-slate-400 font-medium">Pickup: Window 1 (Dry Seal)</span>
        <button onclick="selectServiceForRequest('Certification for RSBSA Member')" class="px-3.5 py-1.5 rounded-xl bg-amber-50 hover:bg-amber-700 hover:text-white text-amber-800 font-bold text-xs transition-all flex items-center gap-1.5">
          <span>Book Appointment</span>
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
            Under Republic Act 11261, first-time jobseekers are 100% exempt from barangay clearance fees. Requires in-person signing of Oath of Undertaking at Window 1.
          </p>
        </div>
      </div>
      <div class="pt-4 mt-4 border-t border-slate-100 flex items-center justify-between">
        <span class="text-[11px] text-slate-400 font-medium">Pickup: Window 1 (Dry Seal)</span>
        <button onclick="selectServiceForRequest('First-Time Jobseeker Certification (RA 11261)')" class="px-3.5 py-1.5 rounded-xl bg-purple-50 hover:bg-purple-700 hover:text-white text-purple-800 font-bold text-xs transition-all flex items-center gap-1.5">
          <span>Book Appointment</span>
          <i class="fa-solid fa-arrow-right text-[10px]"></i>
        </button>
      </div>
    </div>

    <!-- Service 5: Business, Aquatic Resources & Building Clearances -->
    <div class="gov-card p-6 rounded-2xl bg-white border border-slate-200 hover:border-teal-500 shadow-sm hover:shadow-md transition-all flex flex-col justify-between group">
      <div class="space-y-3">
        <div class="w-12 h-12 rounded-2xl bg-teal-50 text-teal-700 flex items-center justify-center text-xl font-bold border border-teal-200 group-hover:scale-105 transition-transform">
          <i class="fa-solid fa-shop"></i>
        </div>
        <div>
          <div class="flex items-center justify-between">
            <h4 class="font-bold text-base text-slate-900">Business, Fishery & Building</h4>
            <span class="text-xs font-bold text-teal-800 bg-teal-100 px-2 py-0.5 rounded-full">₱ 30 – ₱ 500</span>
          </div>
          <p class="text-xs text-slate-600 mt-2 leading-relaxed">
            Sec. 3.B & 3.C: Sari-Sari Store / Eatery / Water Station (₱100), Aquatic Resources — Pumpboat, Talaba, Tahong, Punot, Kasagan, Saluran, Fishpond (₱100), Building Permit (₱200–₱500).
          </p>
        </div>
      </div>
      <div class="pt-4 mt-4 border-t border-slate-100 flex items-center justify-between">
        <span class="text-[11px] text-slate-400 font-medium">Pickup: Window 1 & 2</span>
        <button onclick="selectServiceForRequest('Barangay Business Clearance / Permit')" class="px-3.5 py-1.5 rounded-xl bg-teal-50 hover:bg-teal-700 hover:text-white text-teal-800 font-bold text-xs transition-all flex items-center gap-1.5">
          <span>Book Appointment</span>
          <i class="fa-solid fa-arrow-right text-[10px]"></i>
        </button>
      </div>
    </div>

    <!-- Walk-In Claiming Policy Card -->
    <div class="gov-card p-6 rounded-2xl bg-gradient-to-br from-slate-900 to-slate-800 text-white border border-slate-700 shadow-sm flex flex-col justify-between">
      <div class="space-y-3">
        <div class="w-12 h-12 rounded-2xl bg-emerald-500/20 text-emerald-400 flex items-center justify-center text-xl font-bold border border-emerald-500/30">
          <i class="fa-solid fa-stamp"></i>
        </div>
        <div>
          <h4 class="font-bold text-base text-white">Physical Dry Seal & Appointment Policy</h4>
          <p class="text-xs text-slate-300 mt-2 leading-relaxed">
            Online requests serve as a <strong>pre-application appointment</strong> so your document is prepared ahead of time. Official certificates are <strong>not issued digitally</strong>—claim your wet-signed & dry-sealed paper at Window 1.
          </p>
        </div>
      </div>
      <div class="pt-4 mt-4 border-t border-slate-700 flex items-center justify-between">
        <span class="text-[11px] text-emerald-400 font-bold flex items-center gap-1">
          <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
          Mon-Fri 8am-5pm
        </span>
        <a href="#request-section" class="px-3.5 py-1.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs transition-all flex items-center gap-1.5">
          <i class="fa-solid fa-calendar-plus text-[10px]"></i>
          <span>Schedule Pickup</span>
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
        Are you a resident of Barangay Dacutan? Sign up for your official resident account with identity verification (PhilSys ID, Driver's License, or Voter's ID). Verified residents can schedule document appointments with 1-click auto-fill, track real-time processing status, and generate an Official Appointment & Claim Stub for walk-in pickup at Barangay Hall Window 1.
      </p>

      <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 pt-2">
        <div class="p-3 rounded-2xl bg-white/5 border border-white/10 text-xs">
          <i class="fa-solid fa-id-card text-emerald-400 text-base mb-1 block"></i>
          <span class="font-bold text-white block">Identity Verification</span>
          <span class="text-[11px] text-slate-400">PhilSys, Driver's, UMID, Voter's ID</span>
        </div>
        <div class="p-3 rounded-2xl bg-white/5 border border-white/10 text-xs">
          <i class="fa-solid fa-calendar-check text-amber-400 text-base mb-1 block"></i>
          <span class="font-bold text-white block">1-Click Appointment</span>
          <span class="text-[11px] text-slate-400">Pre-processed before walk-in</span>
        </div>
        <div class="p-3 rounded-2xl bg-white/5 border border-white/10 text-xs">
          <i class="fa-solid fa-receipt text-blue-400 text-base mb-1 block"></i>
          <span class="font-bold text-white block">Claim Stub & Tracking</span>
          <span class="text-[11px] text-slate-400">Physical dry-sealed release at Hall</span>
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
        <span>Verification & Claiming Requirements:</span>
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
          <span>Present Reference # / Claim Stub at Window 1 for wet signature & Barangay Dry Seal</span>
        </li>
        <li class="flex items-start gap-2">
          <i class="fa-solid fa-check text-emerald-400 mt-0.5"></i>
          <span>Exemptions under Sec. 5: Students, Seniors, PWDs, Indigents & RA 11261</span>
        </li>
      </ul>
      <div class="pt-2 border-t border-slate-800 text-[11px] text-slate-400">
        Clerical verification handled by: <strong class="text-slate-200">Barangay Secretary Desk (Window 1)</strong>
      </div>
    </div>
  </div>
</section>

<!-- 4. ONLINE DOCUMENT REQUEST & APPOINTMENT FORM (SAVES DIRECTLY TO MYSQL) -->
<section id="request-section" class="gov-card p-6 sm:p-8 rounded-3xl bg-white border border-slate-200 shadow-sm space-y-6">
  <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 border-b border-slate-200 pb-4">
    <div>
      <h3 class="text-xl font-extrabold text-slate-900 tracking-tight flex items-center gap-2.5">
        <i class="fa-solid fa-calendar-plus text-emerald-700"></i>
        <span>Online Document Request & Pickup Appointment Form</span>
      </h3>
      <p class="text-xs text-slate-500 font-medium">
        Submit your document request below to queue preparation at the Barangay Hall. <strong>Note:</strong> Official certifications are claimed in person at Window 1 with wet signature & dry seal.
      </p>
    </div>
    <span class="badge badge-blue self-start sm:self-auto">Walk-In Pickup Appointment</span>
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
          <span>Email Address (For Pickup Notification)</span>
          <span class="text-[10px] text-emerald-600 font-semibold"><i class="fa-solid fa-envelope"></i> Recommended</span>
        </label>
        <input 
          type="email" 
          name="email" 
          id="appEmail" 
          placeholder="juan.delacruz@gmail.com" 
          class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 bg-slate-50/50 text-slate-900 text-xs font-semibold focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500">
      </div>

      <!-- Purok (7 Official Puroks per 2025 Barangay Profile) -->
      <div>
        <label class="block text-xs font-bold text-slate-700 mb-1.5">Purok Residence (Purok 1 – 7) *</label>
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
        </select>
      </div>

      <!-- Document Type Requested (Per Ordinance No. 2020-01 & Official Certifications List) -->
      <div>
        <label class="block text-xs font-bold text-slate-700 mb-1.5">Document Type (Ordinance No. 2020-01) *</label>
        <select 
          name="doc_type" 
          id="appDocType" 
          required 
          onchange="updateFeePreview()"
          class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 bg-slate-50/50 text-slate-900 text-xs font-bold focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500">
          <optgroup label="── Sec. 3.A: Barangay Clearances (₱30.00 – ₱50.00) ──">
            <option value="Barangay Clearance">Barangay Clearance (Employment / Proper ID) — ₱30.00</option>
            <option value="Certificate of Residency">Certificate of Residency — ₱30.00</option>
            <option value="Certificate of Good Moral Character">Certificate of Good Moral Character — ₱30.00</option>
            <option value="Barangay Clearance (Postal ID / Loan)">Barangay Clearance (Postal ID / Loan Purposes) — ₱50.00</option>
            <option value="Barangay ID">Barangay ID / Personal Identification — ₱30.00</option>
          </optgroup>
          <optgroup label="── Official Barangay Certifications (Certifications List) ──">
            <option value="Certification for Delayed Registration">Certification for Delayed Registration — ₱30.00</option>
            <option value="Certification for ILECO (Electrification)">Certification for ILECO (Electrification) — ₱30.00</option>
            <option value="Certification for Electrical Permit">Certification for Electrical Permit — ₱30.00</option>
            <option value="Certification for TIN ID">Certification for TIN ID — ₱30.00</option>
            <option value="Certification for RSBSA Member">Certification for RSBSA Member (Farmer/Fisherfolk) — ₱30.00</option>
            <option value="Certification for Live-In">Certification for Live-In — ₱30.00</option>
            <option value="Certification for Deceased / House">Certification for Deceased / House — ₱30.00</option>
            <option value="Certification for Loan">Certification for Loan — ₱50.00</option>
          </optgroup>
          <optgroup label="── Sec. 5 & RA 11261: Free / Exempt Certifications (₱0.00) ──">
            <option value="Certificate of Indigency">Certificate of Indigency — FREE (Sec. 5)</option>
            <option value="First-Time Jobseeker Certification (RA 11261)">Certification for First Time Job Seeker (RA 11261) — FREE</option>
            <option value="Certification for PWD">Certification for PWD (Person with Disability) — FREE (Sec. 5)</option>
            <option value="Solo Parent Barangay Certification">Certification for Solo Parent — FREE</option>
            <option value="Student / Senior Citizen Clearance (Sec. 5 Exemption)">Student Educational / Senior Citizen Clearance — FREE (Sec. 5)</option>
          </optgroup>
          <optgroup label="── Sec. 3.B, 3.C & Sec. 4: Business, Aquatic & Building ──">
            <option value="Barangay Business Clearance / Permit">Barangay Business Clearance (Sari-Sari Store / Commercial) — ₱100.00</option>
            <option value="Aquatic Resources / Fisherfolk Clearance">Aquatic Resources Clearance (Pumpboat/Talaba/Tahong/Punot/Kasagan/Fishpond) — ₱100.00</option>
            <option value="Barangay Building / Construction Clearance">Certification for Building Permit / Construction (Sec. 4) — ₱200.00</option>
            <option value="Certificate of No Objection (CNO)">Certificate of No Objection (CNO) — ₱100.00</option>
          </optgroup>
          <optgroup label="── Sec. 3.A.7, Sec. 7 & Sec. 8: Lupon & Official Copies ──">
            <option value="Barangay Blotter Certification">Filing Fee on Barangay Case / Blotter Record — ₱100.00</option>
            <option value="Certification to File Action">Certification to File Action (CFA - Sec. 8) — ₱300.00</option>
            <option value="Certified True Copy of Barangay Document">Certified True Copy of Official Document (Sec. 7) — ₱5.00</option>
          </optgroup>
        </select>
      </div>

      <!-- Purpose of Request -->
      <div>
        <label class="block text-xs font-bold text-slate-700 mb-1.5">Specific Purpose / Business Category *</label>
        <input 
          type="text" 
          name="purpose" 
          id="appPurpose" 
          required 
          placeholder="e.g. Local Employment, ILECO Connection, Sari-Sari Store, Talaba Culture" 
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

    <!-- Fee Calculation & Appointment Disclaimer Banner -->
    <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200 flex flex-col sm:flex-row sm:items-center justify-between gap-3 text-xs">
      <div class="flex items-center gap-3">
        <div class="w-9 h-9 rounded-xl bg-emerald-100 text-emerald-800 flex items-center justify-center font-bold text-sm shrink-0">
          <i class="fa-solid fa-calendar-check"></i>
        </div>
        <div>
          <span class="text-slate-500">Assessed Fee (Per Barangay Ordinance No. 2020-01):</span>
          <p class="font-extrabold text-sm text-emerald-800" id="feeDisplay">₱ 30.00 (Payable upon walk-in claiming at Window 2)</p>
          <p class="text-[10px] text-slate-500 mt-0.5"><i class="fa-solid fa-stamp text-emerald-600"></i> Submitting schedules your pickup appointment. Claim physical dry-sealed document at Window 1 (Mon–Fri, 8:00 AM – 5:00 PM).</p>
        </div>
      </div>
      <button 
        type="submit" 
        id="submitAppBtn"
        class="px-6 py-3 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-xs shadow-md flex items-center justify-center gap-2 transition-all">
        <i class="fa-solid fa-calendar-plus"></i>
        <span>Book Document Appointment</span>
      </button>
    </div>
  </form>
</section>

<!-- 5. BARANGAY ORDINANCE NO. 2020-01 & COMMUNITY BULLETINS -->
<section id="advisories-section" class="space-y-4">
  <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 border-b border-slate-200 pb-3">
    <div>
      <h3 class="text-xl font-extrabold text-slate-900 tracking-tight flex items-center gap-2.5">
        <i class="fa-solid fa-scale-balanced text-amber-600"></i>
        <span>Barangay Ordinance No. 2020-01 & Citizen Charter Advisories</span>
      </h3>
      <p class="text-xs text-slate-500 font-medium">Official schedule of fees, exemptions, aquatic resource permits, and penalties enacted by the Sangguniang Barangay of Dacutan</p>
    </div>
    <span class="badge badge-yellow">Enacted Ordinance No. 2020-01</span>
  </div>

  <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
    
    <!-- Ordinance Card 1: Section 3.A & 3.B Clearances & Business Fees -->
    <div class="gov-card p-5 rounded-2xl bg-white border border-slate-200 hover:border-emerald-400 transition-all space-y-3">
      <div class="flex items-center justify-between text-xs">
        <span class="badge badge-green">Sec. 3.A & 3.B • Fees</span>
        <span class="text-slate-400 font-medium">Brgy. Ordinance 2020-01</span>
      </div>
      <h4 class="font-bold text-sm text-slate-900">Standard Clearance & Business Permit Rates</h4>
      <p class="text-xs text-slate-600 leading-relaxed font-medium">
        <strong>Clearances:</strong> Employment, Proper ID, Residency, Good Moral & Electrification (₱30.00); Loan & Postal ID (₱50.00); Case Filing (₱100.00).<br>
        <strong>Businesses:</strong> Ambulant Vendor (₱30); Tailoring, Dry Goods, Bakery, Auto Repair, Parlor, Photocopier (₱50); Sari-Sari Store, Water Station, Grocery, Eatery, Welding, Car Wash, Tricycle (₱100); Rice/Fruit/Funeral (₱200); Ice Plant & Gas Station (₱300).
      </p>
    </div>

    <!-- Ordinance Card 2: Section 3.C Aquatic Resources & Section 4 Construction -->
    <div class="gov-card p-5 rounded-2xl bg-white border border-slate-200 hover:border-blue-400 transition-all space-y-3">
      <div class="flex items-center justify-between text-xs">
        <span class="badge badge-blue">Sec. 3.C & Sec. 4</span>
        <span class="text-slate-400 font-medium">Coastal & Construction</span>
      </div>
      <h4 class="font-bold text-sm text-slate-900">Aquatic Resources & Construction Clearances</h4>
      <p class="text-xs text-slate-600 leading-relaxed font-medium">
        <strong>Aquatic Resources (₱100.00/yr):</strong> Pumpboat, Tahong Gatherer, Talaba Culture (4 raft), Talaba Vendor, Saluran, Punot, Kasagan, Sira-Sira, Crab Buyer & Fishpond Operator (Outside Tahong Buyer: ₱10/sack).<br>
        <strong>Construction (Sec. 4):</strong> Commercial Edifice / Terminal (₱200.00); Warehouse / Commercial Bldg (₱500.00).
      </p>
    </div>

    <!-- Ordinance Card 3: Section 5 Exemptions, Sec. 8 CFA & Sec. 11 Penalties -->
    <div class="gov-card p-5 rounded-2xl bg-white border border-slate-200 hover:border-rose-400 transition-all space-y-3">
      <div class="flex items-center justify-between text-xs">
        <span class="badge badge-red">Sec. 5, 7, 8 & 11</span>
        <span class="text-slate-400 font-medium">Exemptions & Penalties</span>
      </div>
      <h4 class="font-bold text-sm text-slate-900">Fee Exemptions, Lupon CFA & Ordinance Penalties</h4>
      <p class="text-xs text-slate-600 leading-relaxed font-medium">
        <strong>Sec. 5 (100% FREE):</strong> Students (Educational), Senior Citizens, PWDs, Indigents & First-Time Jobseekers.<br>
        <strong>Sec. 7 & 8:</strong> Certified True Copy (₱5.00); Lupon Certification to File Action / CFA (₱300.00).<br>
        <strong>Sec. 11 Penalties:</strong> 1st Offense: ₱300.00 • 2nd Offense: ₱500.00 • 3rd & Succeeding Offense: ₱1,000.00.
      </p>
    </div>

  </div>
</section>

<!-- 5.5. OFFICIAL BARANGAY PROFILE AS OF 2025 SUMMARY (FROM DOCUMENTATION/BRGY) -->
<section id="profile-summary-section" class="gov-card p-6 sm:p-8 rounded-3xl bg-white border border-slate-200 shadow-sm space-y-6">
  <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 border-b border-slate-200 pb-4">
    <div>
      <h3 class="text-xl font-extrabold text-slate-900 tracking-tight flex items-center gap-2.5">
        <i class="fa-solid fa-chart-column text-emerald-700"></i>
        <span>Barangay Dacutan Profile Summary (As of 2025)</span>
      </h3>
      <p class="text-xs text-slate-500 font-medium">Official demographic, geographic, physical structure, and economic census baseline of Barangay Dacutan, Dumangas, Iloilo</p>
    </div>
    <span class="badge badge-green">Official 2025 Census Summary</span>
  </div>

  <!-- Top Row: 4 Key Demographic Counters -->
  <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
    <div class="p-4 rounded-2xl bg-emerald-50/70 border border-emerald-200 space-y-1">
      <span class="text-[10px] font-extrabold uppercase tracking-wider text-emerald-800 block">Total Population (2025)</span>
      <p class="text-2xl font-black text-slate-900 font-mono">2,337</p>
      <p class="text-[11px] text-slate-600 font-medium">Male: <strong>1,142</strong> • Female: <strong>1,195</strong></p>
    </div>

    <div class="p-4 rounded-2xl bg-blue-50/70 border border-blue-200 space-y-1">
      <span class="text-[10px] font-extrabold uppercase tracking-wider text-blue-800 block">Families & Households</span>
      <p class="text-2xl font-black text-slate-900 font-mono">562 <span class="text-xs font-bold text-slate-500">HH</span></p>
      <p class="text-[11px] text-slate-600 font-medium">Registered Families: <strong>678</strong> • <strong>7 Puroks</strong></p>
    </div>

    <div class="p-4 rounded-2xl bg-amber-50/70 border border-amber-200 space-y-1">
      <span class="text-[10px] font-extrabold uppercase tracking-wider text-amber-800 block">Registered Voters & Sectors</span>
      <p class="text-2xl font-black text-slate-900 font-mono">1,445 <span class="text-xs font-bold text-slate-500">Voters</span></p>
      <p class="text-[11px] text-slate-600 font-medium">Seniors: <strong>556</strong> • PWD: <strong>69</strong> • 4Ps: <strong>69</strong></p>
    </div>

    <div class="p-4 rounded-2xl bg-teal-50/70 border border-teal-200 space-y-1">
      <span class="text-[10px] font-extrabold uppercase tracking-wider text-teal-800 block">Land Area & Routes</span>
      <p class="text-2xl font-black text-slate-900 font-mono">230.72 <span class="text-xs font-bold text-slate-500">km.</span></p>
      <p class="text-[11px] text-slate-600 font-medium">2.5 km to Poblacion • 22 km Coastal to Iloilo</p>
    </div>
  </div>

  <!-- Bottom Row: 3 Detailed Breakdown Cards (Geography/Boundaries, Economic/Livelihood, Housing/Structures) -->
  <div class="grid grid-cols-1 md:grid-cols-3 gap-5 text-xs">
    
    <!-- Geography, Land Use & Boundaries -->
    <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200 space-y-2.5">
      <h4 class="font-extrabold text-slate-900 uppercase tracking-wider text-[11px] flex items-center gap-1.5 border-b border-slate-200 pb-2">
        <i class="fa-solid fa-compass text-emerald-600"></i>
        <span>Territory, Land Use & Boundaries</span>
      </h4>
      <div class="space-y-1 text-slate-600">
        <p class="flex justify-between"><span>Plain / Rice Land:</span> <strong class="text-slate-900">50%</strong></p>
        <p class="flex justify-between"><span>Fishpond Area:</span> <strong class="text-slate-900">30%</strong></p>
        <p class="flex justify-between"><span>Residential / Hilly:</span> <strong class="text-slate-900">15% Res. • 5% Hilly</strong></p>
        <p class="flex justify-between"><span>Coastline & Roads:</span> <strong class="text-slate-900">1.5km Coast • 2.5km Nat'l</strong></p>
      </div>
      <div class="pt-2 border-t border-slate-200/80 space-y-1 text-[11px] text-slate-500">
        <span class="font-bold text-slate-700 block">Adjacent Barangays:</span>
        <p><strong>North:</strong> Sulangan / Binaobao • <strong>South:</strong> Coastal Area</p>
        <p><strong>East:</strong> Talusan / Sapao • <strong>West:</strong> Ermita</p>
      </div>
    </div>

    <!-- Economic & Livelihood Profile -->
    <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200 space-y-2.5">
      <h4 class="font-extrabold text-slate-900 uppercase tracking-wider text-[11px] flex items-center gap-1.5 border-b border-slate-200 pb-2">
        <i class="fa-solid fa-fish-fins text-blue-600"></i>
        <span>Economic & Livelihood Distribution</span>
      </h4>
      <div class="space-y-1 text-slate-600">
        <p class="flex justify-between"><span>Employed / Unemployed:</span> <strong class="text-slate-900">740 Emp. • 505 Unemp.</strong></p>
        <p class="flex justify-between"><span>Farmers (Rice/Agri):</span> <strong class="text-slate-900">52 (27 Male, 25 Female)</strong></p>
        <p class="flex justify-between"><span>Fisherfolks:</span> <strong class="text-slate-900">146 (79 Male, 67 Female)</strong></p>
        <p class="flex justify-between"><span>Overseas Workers (OFW):</span> <strong class="text-slate-900">75 Registered OFWs</strong></p>
      </div>
      <div class="pt-2 border-t border-slate-200/80 text-[11px] text-slate-500">
        <span class="font-bold text-slate-700 block">Aquaculture Breakdown:</span>
        <p>Talabahan: <strong>54</strong> • Kasagan: <strong>26</strong> • Punot: <strong>22</strong> • Pahubas: <strong>7</strong> • Saluran: <strong>3</strong></p>
      </div>
    </div>

    <!-- Physical Structures & Route Access -->
    <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200 space-y-2.5">
      <h4 class="font-extrabold text-slate-900 uppercase tracking-wider text-[11px] flex items-center gap-1.5 border-b border-slate-200 pb-2">
        <i class="fa-solid fa-house-chimney text-amber-600"></i>
        <span>Physical Structures & Access Routes</span>
      </h4>
      <div class="space-y-1 text-slate-600">
        <p class="flex justify-between"><span>Concrete Houses:</span> <strong class="text-slate-900">260 Structures</strong></p>
        <p class="flex justify-between"><span>Light Materials:</span> <strong class="text-slate-900">193 Structures</strong></p>
        <p class="flex justify-between"><span>Semi-Concrete:</span> <strong class="text-slate-900">102 Structures</strong></p>
        <p class="flex justify-between"><span>Barangay Roads:</span> <strong class="text-slate-900">1.5 kms.</strong></p>
      </div>
      <div class="pt-2 border-t border-slate-200/80 text-[11px] text-slate-500">
        <span class="font-bold text-slate-700 block">Dacutan to Iloilo City Distance:</span>
        <p>Via Coastal Route: <strong>22 kms</strong> • Via Zarraga Route: <strong>27.5 kms</strong></p>
      </div>
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
      @php
        $isCaptain = $official['role'] === 'Punong Barangay';
        $isSk = $official['role'] === 'SK Chairperson';
        $isSecretariat = in_array($official['role'], ['Barangay Secretary', 'Barangay Treasurer']);
        $avatarBg = $isCaptain
            ? 'bg-gradient-to-br from-emerald-600 to-teal-800 border-emerald-500 text-white'
            : ($isSk
                ? 'bg-gradient-to-br from-purple-600 to-indigo-800 border-purple-400 text-white'
                : ($isSecretariat
                    ? 'bg-gradient-to-br from-amber-600 to-slate-800 border-amber-400 text-white'
                    : 'bg-gradient-to-br from-blue-700 to-slate-900 border-blue-400 text-white'));
        $badgeBg = $isCaptain
            ? 'bg-emerald-700 text-amber-300 border-emerald-300'
            : ($isSk
                ? 'bg-purple-700 text-white border-purple-300'
                : ($isSecretariat
                    ? 'bg-amber-600 text-white border-amber-200'
                    : 'bg-blue-800 text-white border-blue-300'));
        $initials = $official['initials'] ?? collect(explode(' ', str_replace(['Hon.', 'Mrs.', 'Mr.'], '', $official['name'])))->filter()->map(fn($part) => substr($part, 0, 1))->take(2)->implode('');
      @endphp
      <div class="gov-card p-4 rounded-2xl bg-white border border-slate-200 shadow-sm text-center space-y-2.5 {{ $isCaptain ? 'border-2 border-emerald-500 bg-gradient-to-br from-emerald-50 to-white' : '' }}">
        <div class="relative w-16 h-16 mx-auto">
          <div class="w-16 h-16 rounded-full border-2 {{ $avatarBg }} flex flex-col items-center justify-center shadow-md select-none overflow-hidden" title="{{ $official['name'] }}">
            <i class="fa-solid {{ $isCaptain ? 'fa-user-tie' : ($isSecretariat ? 'fa-user-pen' : 'fa-user') }} text-xl opacity-90"></i>
          </div>
          <span class="absolute -bottom-1 -right-1 px-1.5 py-0.5 rounded-full text-[9px] font-black tracking-tighter border shadow-sm {{ $badgeBg }}">
            {{ $initials }}
          </span>
        </div>
        <div>
          <h4 class="font-bold text-xs text-slate-900">{{ $official['name'] }}</h4>
          <p class="text-[11px] font-bold {{ $isCaptain ? 'text-emerald-800' : ($isSk ? 'text-purple-700' : ($isSecretariat ? 'text-amber-700' : 'text-blue-700')) }} uppercase tracking-wider">
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
      <i class="fa-solid fa-calendar-check"></i>
    </div>
    
    <div>
      <h3 class="text-lg font-extrabold text-slate-900">Document Pickup Appointment Booked!</h3>
      <p class="text-xs text-slate-500 mt-1">Your document request has been queued in the Barangay Dacutan system. Official certificates are issued physically at the Barangay Hall with wet signature &amp; dry seal.</p>
    </div>

    <div class="p-4 bg-slate-50 rounded-2xl border border-slate-200 space-y-2">
      <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Your Appointment &amp; Claim Stub Reference</span>
      <p class="text-xl font-extrabold font-mono text-emerald-700" id="generatedRefNumber">DAC-2026-0042</p>
      <p class="text-[11px] text-slate-500">Present this reference number &amp; valid ID at <strong>Window 1 (Document Releasing Desk)</strong> upon walk-in claiming.</p>
    </div>

    <div class="flex gap-2">
      <button type="button" onclick="closePublicDocModal()" class="w-full py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs transition-all">
        Close
      </button>
      <button type="button" onclick="viewApplicationInTracker()" class="w-full py-2.5 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-xs transition-all">
        Track Appointment
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
      'Barangay Clearance': '₱ 30.00 (Ordinance No. 2020-01 Sec. 3.A.1 • Free for Students/Seniors/PWDs/Indigents)',
      'Certificate of Residency': '₱ 30.00 (Ordinance No. 2020-01 Sec. 3.A.3 • Payable at Window 1)',
      'Certificate of Good Moral Character': '₱ 30.00 (Ordinance No. 2020-01 Sec. 3.A.4 • Payable at Window 1)',
      'Certificate of Indigency': '₱ 0.00 (100% Free under Ordinance No. 2020-01 Sec. 5)',
      'Certification for First Time Job Seeker': '₱ 0.00 (100% Free under RA 11261 Waiver)',
      'First-Time Jobseeker Certification (RA 11261)': '₱ 0.00 (100% Free under RA 11261 Waiver)',
      'Certification for PWD': '₱ 0.00 (100% Free under Ordinance No. 2020-01 Sec. 5)',
      'Certification for Solo Parent': '₱ 0.00 (Free for Qualified Solo Parents)',
      'Solo Parent Barangay Certification': '₱ 0.00 (Free for Qualified Solo Parents)',
      'Certification for Delayed Registration': '₱ 30.00 (Payable upon walk-in claiming at Window 1)',
      'Certification for Loan': '₱ 50.00 (Ordinance No. 2020-01 Sec. 3.A.5 • Loan Purposes)',
      'Certification for ILECO (Electrification)': '₱ 30.00 (Ordinance No. 2020-01 Sec. 3.A.6 • Electrification)',
      'Certification for Electrical Permit': '₱ 30.00 (Ordinance No. 2020-01 Sec. 3.A.6 • Electrical Permit)',
      'Certification for Live-In': '₱ 30.00 (Payable upon walk-in claiming at Window 1)',
      'Certification for Deceased / House': '₱ 30.00 (Payable upon walk-in claiming at Window 1)',
      'Certification for RSBSA Member': '₱ 30.00 (For Farmers & Fisherfolks Registry)',
      'Certification for TIN ID': '₱ 30.00 (Ordinance No. 2020-01 Sec. 3.A.2 • Proper Identification)',
      'Barangay ID': '₱ 30.00 (Ordinance No. 2020-01 Sec. 3.A.2 • Proper Identification)',
      'Certification for Building Permit': '₱ 200.00 (Ordinance No. 2020-01 Sec. 4 • Commercial/Building)',
      'Barangay Building / Construction Clearance': '₱ 200.00 (Ordinance No. 2020-01 Sec. 4 • Construction)',
      'Barangay Business Clearance / Permit': '₱ 100.00 (Ordinance No. 2020-01 Sec. 3.B • ₱30–₱300 by Business Type)',
      'Aquatic Resources / Fisherfolk Clearance': '₱ 100.00 (Ordinance No. 2020-01 Sec. 3.C • Talaba/Kasagan/Punot/Fishpond)',
      'Barangay Blotter Certification': '₱ 100.00 (Ordinance No. 2020-01 Sec. 3.A.7 • Barangay Case Filing)',
      'Certification to File Action': '₱ 300.00 (Ordinance No. 2020-01 Sec. 8 • Lupon CFA Endorsement)'
    };
    display.textContent = fees[select.value] || '₱ 30.00 (Ordinance No. 2020-01 • Payable upon walk-in pickup)';
  }

  // AJAX Submission to Laravel Backend
  async function handleOnlineDocSubmit(e) {
    e.preventDefault();
    const form = document.getElementById('publicApplicationForm');
    const btn = document.getElementById('submitAppBtn');
    const formData = new FormData(form);

    btn.disabled = true;
    btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Booking Pickup Appointment...';

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
      btn.innerHTML = '<i class="fa-solid fa-calendar-check"></i> <span>Book Document Pickup Appointment</span>';
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
