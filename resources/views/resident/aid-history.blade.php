@extends('layouts.resident')

@section('title', 'Aid & Relief History • Resident Portal • Barangay Dacutan')

@section('content')
<div class="space-y-6">

  <!-- PAGE HEADER -->
  <div class="bg-white p-6 rounded-3xl border border-slate-200/80 shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-4">
    <div class="flex items-center gap-3.5">
      <div class="w-14 h-14 rounded-2xl bg-rose-100 text-rose-700 flex items-center justify-center font-bold text-2xl flex-shrink-0">
        <i class="fa-solid fa-hand-holding-heart"></i>
      </div>
      <div>
        <div class="flex items-center gap-2">
          <h2 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight">
            Aid & Relief Distribution Registry
          </h2>
          <span class="px-2.5 py-0.5 rounded-full bg-emerald-100 text-emerald-800 text-[10px] font-extrabold border border-emerald-300">
            Citizen Assistance Desk
          </span>
        </div>
        <p class="text-xs text-slate-500 font-medium">
          Transparent record of typhoon calamity assistance, food packs, and social amelioration distributions received by your household.
        </p>
      </div>
    </div>

    <div>
      <a href="{{ route('resident.help') }}" class="px-4 py-2.5 rounded-xl border border-slate-200 text-slate-700 hover:bg-slate-50 text-xs font-bold transition-all inline-flex items-center gap-2">
        <i class="fa-solid fa-circle-question text-emerald-600"></i>
        <span>Relief Inquiries & Hotlines</span>
      </a>
    </div>
  </div>

  <!-- ACTIVE RELIEF ADVISORIES BANNER -->
  <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    @foreach($reliefPrograms as $prog)
      <div class="bg-white rounded-3xl p-5 border border-slate-200/80 shadow-sm space-y-3">
        <div class="flex items-start justify-between gap-2">
          <h3 class="font-extrabold text-xs text-slate-900 leading-snug">{{ $prog['title'] }}</h3>
          <span class="px-2 py-0.5 rounded-full text-[9px] font-extrabold bg-blue-100 text-blue-800 border border-blue-200 flex-shrink-0">
            {{ $prog['status'] }}
          </span>
        </div>
        <div class="space-y-1 text-[11px] text-slate-500">
          <p><strong class="text-slate-700">Schedule:</strong> {{ $prog['schedule'] }}</p>
          <p><strong class="text-slate-700">Center:</strong> {{ $prog['location'] }}</p>
          <p><strong class="text-slate-700">Eligibility:</strong> {{ $prog['target'] }}</p>
        </div>
      </div>
    @endforeach
  </div>

  <!-- MY HOUSEHOLD AID DISTRIBUTION HISTORY TABLE -->
  <div class="bg-white rounded-3xl border border-slate-200/80 shadow-sm overflow-hidden space-y-0">
    <div class="p-6 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
      <div>
        <h3 class="text-base font-extrabold text-slate-900 flex items-center gap-2">
          <i class="fa-solid fa-clock-rotate-left text-emerald-600"></i>
          <span>My Calamity & Relief Distribution Records</span>
        </h3>
        <p class="text-xs text-slate-500">Beneficiary records officially recorded under <strong class="text-slate-800">{{ $user->name }}</strong> ({{ $resident?->purok ?? 'Dacutan' }})</p>
      </div>

      <span class="text-xs text-slate-400">Total Releases: <strong class="text-slate-800">{{ $aidDistributions->count() }}</strong></span>
    </div>

    @if($aidDistributions->isEmpty())
      <div class="p-12 text-center text-slate-400 space-y-3">
        <div class="w-14 h-14 rounded-2xl bg-slate-100 text-slate-400 flex items-center justify-center mx-auto text-2xl">
          <i class="fa-solid fa-boxes-packing"></i>
        </div>
        <h4 class="text-sm font-extrabold text-slate-700">No aid distributions recorded yet</h4>
        <p class="text-xs text-slate-400 max-w-md mx-auto">
          When disaster relief, SAP assistance, or emergency subsidies are disbursed and claimed at the Barangay Hall or Evacuation Center, they will be archived here.
        </p>
      </div>
    @else
      <div class="overflow-x-auto">
        <table class="w-full text-left text-xs">
          <thead class="bg-slate-50 border-b border-slate-200 text-[11px] font-bold text-slate-500 uppercase tracking-wider">
            <tr>
              <th class="py-3.5 px-4">Distribution Date</th>
              <th class="py-3.5 px-4">Program / Calamity Title</th>
              <th class="py-3.5 px-4">Assistance Type</th>
              <th class="py-3.5 px-4">Quantity / Amount</th>
              <th class="py-3.5 px-4">Releasing Officer</th>
              <th class="py-3.5 px-4 text-right">Status</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-slate-100">
            @foreach($aidDistributions as $aid)
              <tr class="hover:bg-slate-50/70 transition-colors">
                <td class="py-3.5 px-4 font-mono font-bold text-slate-900 whitespace-nowrap">
                  {{ $aid->distribution_date ? $aid->distribution_date->format('M d, Y') : 'N/A' }}
                </td>
                <td class="py-3.5 px-4 font-bold text-slate-800">
                  {{ $aid->program_name }}
                  <span class="block text-[10px] text-slate-400 font-normal">{{ $aid->purok }}</span>
                </td>
                <td class="py-3.5 px-4 text-slate-700">
                  {{ $aid->assistance_type }}
                </td>
                <td class="py-3.5 px-4 font-extrabold text-emerald-800">
                  {{ $aid->amount_or_quantity }}
                </td>
                <td class="py-3.5 px-4 text-slate-600 text-[11px]">
                  {{ $aid->distributor_name ?? 'Barangay Dacutan Relief Council' }}
                </td>
                <td class="py-3.5 px-4 text-right whitespace-nowrap">
                  <span class="inline-block px-2.5 py-0.5 rounded-full text-[10px] font-extrabold bg-emerald-100 text-emerald-800 border border-emerald-300">
                    <i class="fa-solid fa-circle-check mr-1"></i> {{ $aid->status }}
                  </span>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    @endif
  </div>

</div>
@endsection

