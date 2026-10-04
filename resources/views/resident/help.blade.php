@extends('layouts.resident')

@section('title', 'Barangay Services & Directory • Resident Portal • Barangay Dacutan')

@section('content')
<div class="space-y-6">

  <!-- PAGE HEADER -->
  <div class="bg-white p-6 rounded-3xl border border-slate-200/80 shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-4">
    <div class="flex items-center gap-3.5">
      <div class="w-14 h-14 rounded-2xl bg-amber-100 text-amber-700 flex items-center justify-center font-bold text-2xl flex-shrink-0">
        <i class="fa-solid fa-circle-question"></i>
      </div>
      <div>
        <div class="flex items-center gap-2">
          <h2 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight">
            Barangay Directory & Citizen Service Guide
          </h2>
          <span class="px-2.5 py-0.5 rounded-full bg-emerald-100 text-emerald-800 text-[10px] font-extrabold border border-emerald-300">
            Citizen's Charter
          </span>
        </div>
        <p class="text-xs text-slate-500 font-medium">
          Barangay Hall service windows, turnaround times, documentary checklists, and 24/7 emergency hotlines.
        </p>
      </div>
    </div>

    <div>
      <button 
        type="button" 
        onclick="openResidentApplyModal()" 
        class="px-5 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs shadow-md transition-all flex items-center gap-2"
      >
        <i class="fa-solid fa-file-circle-plus"></i>
        <span>Request Document</span>
      </button>
    </div>
  </div>

  <!-- 3 SERVICE WINDOWS DIRECTORY -->
  <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    
    <!-- Window 1 -->
    <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-sm space-y-3 relative overflow-hidden">
      <div class="w-12 h-12 rounded-2xl bg-blue-100 text-blue-700 flex items-center justify-center font-black text-lg">
        W-1
      </div>
      <div class="space-y-1">
        <h3 class="font-extrabold text-sm text-slate-900">Window 1: Document Processing & Releasing</h3>
        <p class="text-xs text-slate-500">In-Charge: <strong class="text-slate-800">Mrs. Ma. Elena Balleza</strong> (Barangay Secretary)</p>
      </div>
      <ul class="text-xs text-slate-600 space-y-1.5 pt-2 border-t border-slate-100">
        <li class="flex items-center gap-2"><i class="fa-solid fa-check text-emerald-600 text-xs"></i> <span>Barangay Clearance & Residency</span></li>
        <li class="flex items-center gap-2"><i class="fa-solid fa-check text-emerald-600 text-xs"></i> <span>Certificate of Indigency & Good Moral</span></li>
        <li class="flex items-center gap-2"><i class="fa-solid fa-check text-emerald-600 text-xs"></i> <span>First Time Jobseeker (RA 11261)</span></li>
        <li class="flex items-center gap-2"><i class="fa-solid fa-check text-emerald-600 text-xs"></i> <span>Claiming stamped & dry-sealed papers</span></li>
      </ul>
      <div class="text-[11px] font-bold text-blue-700 bg-blue-50 p-2 rounded-xl border border-blue-200">
        Turnaround: 15 - 30 minutes
      </div>
    </div>

    <!-- Window 2 -->
    <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-sm space-y-3 relative overflow-hidden">
      <div class="w-12 h-12 rounded-2xl bg-emerald-100 text-emerald-700 flex items-center justify-center font-black text-lg">
        W-2
      </div>
      <div class="space-y-1">
        <h3 class="font-extrabold text-sm text-slate-900">Window 2: Treasury, Assessment & Cedula</h3>
        <p class="text-xs text-slate-500">In-Charge: <strong class="text-slate-800">Barangay Treasurer's Desk</strong></p>
      </div>
      <ul class="text-xs text-slate-600 space-y-1.5 pt-2 border-t border-slate-100">
        <li class="flex items-center gap-2"><i class="fa-solid fa-check text-emerald-600 text-xs"></i> <span>Community Tax Certificate (Cedula)</span></li>
        <li class="flex items-center gap-2"><i class="fa-solid fa-check text-emerald-600 text-xs"></i> <span>Official Receipt (OR) issuance</span></li>
        <li class="flex items-center gap-2"><i class="fa-solid fa-check text-emerald-600 text-xs"></i> <span>Business Permit Clearance Fee: ₱150</span></li>
        <li class="flex items-center gap-2"><i class="fa-solid fa-check text-emerald-600 text-xs"></i> <span>Statutory fee waiver verification</span></li>
      </ul>
      <div class="text-[11px] font-bold text-emerald-700 bg-emerald-50 p-2 rounded-xl border border-emerald-200">
        Turnaround: Immediate / Real-time
      </div>
    </div>

    <!-- Window 3 -->
    <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-sm space-y-3 relative overflow-hidden">
      <div class="w-12 h-12 rounded-2xl bg-purple-100 text-purple-700 flex items-center justify-center font-black text-lg">
        W-3
      </div>
      <div class="space-y-1">
        <h3 class="font-extrabold text-sm text-slate-900">Window 3: Lupong Tagapamayapa & KP Desk</h3>
        <p class="text-xs text-slate-500">Presiding: <strong class="text-slate-800">Hon. Roberto D. Dacutan</strong> (Punong Brgy)</p>
      </div>
      <ul class="text-xs text-slate-600 space-y-1.5 pt-2 border-t border-slate-100">
        <li class="flex items-center gap-2"><i class="fa-solid fa-check text-emerald-600 text-xs"></i> <span>Barangay Blotter Filing & Mediation</span></li>
        <li class="flex items-center gap-2"><i class="fa-solid fa-check text-emerald-600 text-xs"></i> <span>Certification to File Action (CFA)</span></li>
        <li class="flex items-center gap-2"><i class="fa-solid fa-check text-emerald-600 text-xs"></i> <span>Peace & Order public assistance</span></li>
        <li class="flex items-center gap-2"><i class="fa-solid fa-check text-emerald-600 text-xs"></i> <span>Neighborhood amicable settlement</span></li>
      </ul>
      <div class="text-[11px] font-bold text-purple-700 bg-purple-50 p-2 rounded-xl border border-purple-200">
        Turnaround: As scheduled / Hearing dates
      </div>
    </div>

  </div>

  <!-- EMERGENCY HOTLINES & OPERATING HOURS -->
  <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    
    <!-- Emergency Hotlines Directory -->
    <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-sm space-y-4">
      <div class="flex items-center gap-2.5 border-b border-slate-100 pb-3">
        <i class="fa-solid fa-phone-volume text-rose-600 text-lg"></i>
        <h3 class="font-extrabold text-sm text-slate-900">24/7 Emergency & Public Safety Hotlines</h3>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-xs">
        <div class="p-3.5 rounded-2xl bg-rose-50/60 border border-rose-200 space-y-1">
          <span class="text-[10px] uppercase font-bold text-rose-800 block">Barangay Tanod / BPAT:</span>
          <p class="font-mono font-bold text-slate-900 text-sm">0917-555-DACU (3228)</p>
          <span class="text-[10px] text-slate-500">Barangay Dacutan Patrol</span>
        </div>

        <div class="p-3.5 rounded-2xl bg-slate-50 border border-slate-200 space-y-1">
          <span class="text-[10px] uppercase font-bold text-slate-600 block">Dumangas PNP Police:</span>
          <p class="font-mono font-bold text-slate-900 text-sm">(033) 361-2111</p>
          <span class="text-[10px] text-slate-500">Municipal Police Station</span>
        </div>

        <div class="p-3.5 rounded-2xl bg-slate-50 border border-slate-200 space-y-1">
          <span class="text-[10px] uppercase font-bold text-slate-600 block">BFP Bureau of Fire Protection:</span>
          <p class="font-mono font-bold text-slate-900 text-sm">(033) 361-2999</p>
          <span class="text-[10px] text-slate-500">Dumangas Fire Station</span>
        </div>

        <div class="p-3.5 rounded-2xl bg-slate-50 border border-slate-200 space-y-1">
          <span class="text-[10px] uppercase font-bold text-slate-600 block">MDRRMO / Ambulance:</span>
          <p class="font-mono font-bold text-slate-900 text-sm">0920-999-DUMA (3862)</p>
          <span class="text-[10px] text-slate-500">Disaster & Medical Rescue</span>
        </div>
      </div>
    </div>

    <!-- Operating Hours & Claiming Protocol -->
    <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-sm space-y-4">
      <div class="flex items-center gap-2.5 border-b border-slate-100 pb-3">
        <i class="fa-regular fa-clock text-emerald-600 text-lg"></i>
        <h3 class="font-extrabold text-sm text-slate-900">Barangay Hall Office Hours & Claiming Rules</h3>
      </div>

      <div class="space-y-3 text-xs text-slate-600">
        <div class="flex items-start gap-2.5">
          <i class="fa-solid fa-calendar-check text-emerald-600 mt-0.5"></i>
          <div>
            <strong class="text-slate-800">Regular Working Days:</strong>
            <p class="text-slate-500">Monday to Friday • 8:00 AM to 5:00 PM (No Noon Break for Document Releasing)</p>
          </div>
        </div>

        <div class="flex items-start gap-2.5">
          <i class="fa-solid fa-id-badge text-blue-600 mt-0.5"></i>
          <div>
            <strong class="text-slate-800">Requirements for Walk-in Pickup:</strong>
            <p class="text-slate-500">Bring at least 1 valid government ID (PhilSys, Driver's, Voter's, Postal) and your Printed Claim Stub or mobile screen showing Reference Number.</p>
          </div>
        </div>

        <div class="flex items-start gap-2.5">
          <i class="fa-solid fa-hand-holding-dollar text-purple-600 mt-0.5"></i>
          <div>
            <strong class="text-slate-800">Statutory Fee Exemptions:</strong>
            <p class="text-slate-500">First-Time Jobseekers under Republic Act 11261, certified indigent residents, and registered solo parents are fully exempt from clearance fees.</p>
          </div>
        </div>
      </div>
    </div>

  </div>

</div>
@endsection

