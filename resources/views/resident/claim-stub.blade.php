<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Claim Stub - {{ $certificate->control_no }} - Barangay Dacutan</title>
  
  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
  
  <!-- FontAwesome 6 -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <style>
    @media print {
      .no-print { display: none !important; }
      body { background: white !important; padding: 0 !important; }
      .print-border { border: 2px dashed #64748b !important; }
    }
  </style>
</head>
<body class="bg-slate-100 min-h-screen p-4 sm:p-8 flex flex-col items-center justify-center font-sans text-slate-800">

  <!-- Print Controls Toolbar -->
  <div class="max-w-xl w-full mb-4 flex items-center justify-between no-print">
    <a href="{{ route('resident.requests') }}" class="px-4 py-2 rounded-xl bg-slate-200 hover:bg-slate-300 text-slate-700 text-xs font-bold transition-all flex items-center gap-1.5">
      <i class="fa-solid fa-arrow-left"></i>
      <span>Back to Requests</span>
    </a>

    <button onclick="window.print()" class="px-5 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-bold shadow-md transition-all flex items-center gap-2">
      <i class="fa-solid fa-print"></i>
      <span>Print Claim Stub</span>
    </button>
  </div>

  <!-- CLAIM STUB CARD -->
  <div class="max-w-xl w-full bg-white rounded-3xl p-6 sm:p-8 shadow-xl border-2 border-dashed border-slate-300 print-border space-y-6">
    
    <!-- Official Header -->
    <div class="flex items-center justify-between border-b-2 border-slate-900 pb-4 text-center">
      <img src="{{ asset('assets/images/logo.svg') }}" alt="Seal" class="w-14 h-14 drop-shadow">
      <div>
        <p class="text-[10px] uppercase font-bold tracking-widest text-slate-500">Republic of the Philippines</p>
        <p class="text-xs font-bold text-slate-700">Municipality of Dumangas • Province of Iloilo</p>
        <h2 class="text-base sm:text-lg font-black tracking-tight text-slate-900">BARANGAY DACUTAN</h2>
        <span class="inline-block mt-1 px-3 py-0.5 rounded-full bg-slate-900 text-white text-[10px] font-extrabold tracking-wider uppercase">
          Document Application Claim Stub
        </span>
      </div>
      <img src="{{ asset('assets/images/logo.svg') }}" alt="Seal" class="w-14 h-14 drop-shadow invisible sm:visible">
    </div>

    <!-- Reference Control Barcode Banner -->
    <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200 flex flex-col sm:flex-row sm:items-center justify-between gap-3 text-center sm:text-left">
      <div>
        <span class="text-[10px] uppercase font-bold text-slate-400 block tracking-wider">Reference Control Number</span>
        <span class="font-mono text-xl sm:text-2xl font-black text-slate-900">{{ $certificate->control_no }}</span>
        <span class="block text-[11px] text-slate-500">Filing Date: {{ $certificate->created_at->format('M d, Y h:i A') }}</span>
      </div>
      <div class="self-center sm:self-auto px-3 py-1.5 rounded-xl border border-slate-300 font-mono text-[10px] font-bold bg-white text-slate-700">
        |||| | ||||| || |||||| |
      </div>
    </div>

    <!-- Application Summary Breakdown -->
    <div class="space-y-3 text-xs">
      <div class="grid grid-cols-2 gap-3 pb-3 border-b border-slate-100">
        <div>
          <span class="text-[10px] uppercase font-bold text-slate-400 block">Applicant Name:</span>
          <span class="font-extrabold text-slate-900 text-sm">{{ $certificate->citizen_name }}</span>
        </div>
        <div>
          <span class="text-[10px] uppercase font-bold text-slate-400 block">Purok / Address:</span>
          <span class="font-bold text-slate-800">{{ $certificate->purok }}</span>
        </div>
      </div>

      <div class="grid grid-cols-2 gap-3 pb-3 border-b border-slate-100">
        <div>
          <span class="text-[10px] uppercase font-bold text-slate-400 block">Document Requested:</span>
          <span class="font-extrabold text-slate-900">{{ $certificate->doc_type }}</span>
        </div>
        <div>
          <span class="text-[10px] uppercase font-bold text-slate-400 block">Specific Purpose:</span>
          <span class="font-medium text-slate-700">{{ $certificate->purpose }}</span>
        </div>
      </div>

      <div class="grid grid-cols-2 gap-3 pb-3 border-b border-slate-100">
        <div>
          <span class="text-[10px] uppercase font-bold text-slate-400 block">Official Regulatory Fee:</span>
          @if($certificate->amount_paid == 0)
            <span class="font-black text-emerald-700">₱0.00 (Statutory Exemption)</span>
          @else
            <span class="font-black text-slate-900">₱{{ number_format($certificate->amount_paid, 2) }}</span>
          @endif
        </div>
        <div>
          <span class="text-[10px] uppercase font-bold text-slate-400 block">Official Receipt (OR) #:</span>
          <span class="font-mono font-bold text-slate-800">{{ $certificate->or_no ?? 'Pending Collection' }}</span>
        </div>
      </div>
    </div>

    <!-- Pickup Window & Instructions -->
    <div class="p-4 rounded-2xl bg-amber-50/70 border border-amber-200 text-xs text-amber-900 space-y-1.5">
      <div class="flex items-center gap-2 font-bold text-amber-950">
        <i class="fa-solid fa-circle-exclamation text-amber-600"></i>
        <span>Instructions for Claiming at Barangay Hall</span>
      </div>
      <p class="text-[11px] text-amber-800 leading-relaxed">
        1. Present this claim stub (printed copy or on your mobile device) at <strong>Window 1 (Document Releasing Desk)</strong>.<br>
        2. Present at least one (1) valid Government ID (PhilSys National ID, Driver's License, Voter's, Postal).<br>
        3. If applicable, settle the regulatory fee at Window 2 (Treasury) to receive your official receipt.
      </p>
    </div>

    <!-- Official Attestation Signoff -->
    <div class="pt-4 flex items-center justify-between text-[11px] text-slate-400 border-t border-slate-200">
      <div>
        <p>Released by: <strong>Window 1 Desk</strong></p>
        <p>Barangay Dacutan Administration</p>
      </div>
      <div class="text-right">
        <p>Operating Hours: Mon-Fri 8:00 AM - 5:00 PM</p>
        <p>Dumangas, Iloilo</p>
      </div>
    </div>

  </div>

</body>
</html>

