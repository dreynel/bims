@extends('layouts.app')

@section('title', 'Calamity & SAP Aid Distribution • Barangay Dacutan BIMS')
@section('header_title', 'Ayuda & Relief Aid Distribution Registry')
@section('header_subtitle', 'Calamity Assistance, SAP Subsidies & Vulnerable Household Support')

@section('content')
<div class="space-y-6">

  <!-- 1. HEADER & METRICS -->
  <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white p-4 sm:p-5 rounded-2xl border border-slate-200/80 shadow-sm">
    <div class="flex items-center gap-4">
      <div class="w-12 h-12 rounded-2xl bg-teal-50 text-teal-600 flex items-center justify-center text-xl">
        <i class="fa-solid fa-hand-holding-heart"></i>
      </div>
      <div>
        <h2 class="text-lg font-extrabold text-slate-900">Community Relief & Subsidies Desk</h2>
        <div class="flex items-center gap-3 text-xs text-slate-500 mt-0.5">
          <span class="flex items-center gap-1 font-bold text-teal-600">
            <i class="fa-solid fa-circle-check"></i>
            {{ $totalClaimed }} Relief Packages Disbursed
          </span>
          <span>•</span>
          <span class="text-slate-500 font-medium">Targeting 4Ps, OSCA Seniors, PWDs & Indigents</span>
        </div>
      </div>
    </div>

    <button 
      type="button" 
      onclick="openAidModal()" 
      class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-teal-600 hover:bg-teal-500 text-white font-bold text-xs shadow-md shadow-teal-950/20 transition-all hover:scale-[1.02]"
    >
      <i class="fa-solid fa-box-open text-sm"></i>
      <span>Log Relief Assistance</span>
    </button>
  </div>

  <!-- 2. FILTER BAR -->
  <div class="bg-white p-4 sm:p-5 rounded-2xl border border-slate-200/80 shadow-sm">
    <form method="GET" action="{{ route('admin.aid.index') }}" class="grid grid-cols-1 sm:grid-cols-3 gap-3">
      
      <!-- Filter by Program -->
      <div class="sm:col-span-2">
        <select 
          name="program" 
          onchange="this.form.submit()" 
          class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-800 font-medium focus:outline-none focus:ring-2 focus:ring-teal-500"
        >
          <option value="All">All Relief & Ayuda Programs</option>
          <option value="DSWD Social Amelioration Program (SAP)" {{ request('program') == 'DSWD Social Amelioration Program (SAP)' ? 'selected' : '' }}>DSWD Social Amelioration Program (SAP)</option>
          <option value="Typhoon Calamity Food Pack Relief" {{ request('program') == 'Typhoon Calamity Food Pack Relief' ? 'selected' : '' }}>Typhoon Calamity Food Pack Relief</option>
          <option value="Senior Citizen Quarterly Cash Assistance" {{ request('program') == 'Senior Citizen Quarterly Cash Assistance' ? 'selected' : '' }}>Senior Citizen Quarterly Cash Assistance</option>
          <option value="TUPAD Emergency Employment" {{ request('program') == 'TUPAD Emergency Employment' ? 'selected' : '' }}>TUPAD Emergency Employment</option>
        </select>
      </div>

      <div class="flex items-center gap-2">
        <button type="submit" class="flex-1 py-2 px-3 rounded-xl bg-slate-800 hover:bg-slate-700 text-white font-bold text-xs">
          Filter Registry
        </button>
        @if(request()->has('program'))
          <a href="{{ route('admin.aid.index') }}" class="py-2 px-3 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-600 font-bold text-xs" title="Reset Filters">
            Reset
          </a>
        @endif
      </div>

    </form>
  </div>

  <!-- 3. AID DISTRIBUTION TABLE -->
  <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
    @if($distributions->isEmpty())
      <div class="p-12 text-center text-slate-400 space-y-3">
        <i class="fa-solid fa-box-tissue text-4xl text-slate-300"></i>
        <p class="text-sm font-bold text-slate-600">No aid distribution records logged.</p>
        <p class="text-xs text-slate-400">Click "Log Relief Assistance" to record aid disbursements to vulnerable residents.</p>
      </div>
    @else
      <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse text-xs">
          <thead>
            <tr class="bg-slate-50/75 border-b border-slate-200 text-[11px] font-bold text-slate-500 uppercase tracking-wider">
              <th class="py-3.5 px-4">Beneficiary Resident</th>
              <th class="py-3.5 px-4">Relief / Ayuda Program</th>
              <th class="py-3.5 px-4">Assistance Type</th>
              <th class="py-3.5 px-4">Quantity / Amount</th>
              <th class="py-3.5 px-4">Distribution Date</th>
              <th class="py-3.5 px-4">Status</th>
              <th class="py-3.5 px-4 text-right">Disbursed By</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-slate-100 font-normal text-slate-700">
            @foreach($distributions as $aid)
              <tr class="hover:bg-slate-50/80 transition-colors">
                
                <!-- Beneficiary -->
                <td class="py-3.5 px-4">
                  <p class="font-bold text-slate-900">{{ $aid->beneficiary_name }}</p>
                  <p class="text-[10px] text-slate-400">{{ $aid->purok }}</p>
                </td>

                <!-- Program Name -->
                <td class="py-3.5 px-4 font-semibold text-slate-800">
                  {{ $aid->program_name }}
                </td>

                <!-- Assistance Type -->
                <td class="py-3.5 px-4">
                  <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-teal-50 text-teal-800 border border-teal-200 font-medium text-[11px]">
                    <i class="fa-solid fa-gift text-teal-600 text-[10px]"></i>
                    {{ $aid->assistance_type }}
                  </span>
                </td>

                <!-- Quantity / Amount -->
                <td class="py-3.5 px-4 font-mono font-bold text-slate-900">
                  {{ $aid->amount_or_quantity }}
                </td>

                <!-- Distribution Date -->
                <td class="py-3.5 px-4 text-slate-600 whitespace-nowrap">
                  {{ $aid->distribution_date->format('M d, Y') }}
                </td>

                <!-- Status -->
                <td class="py-3.5 px-4">
                  <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800 border border-emerald-300">
                    <i class="fa-solid fa-circle-check text-[9px]"></i>
                    {{ $aid->status }}
                  </span>
                </td>

                <!-- Distributor -->
                <td class="py-3.5 px-4 text-right text-slate-500 font-medium">
                  {{ $aid->distributor_name }}
                </td>

              </tr>
            @endforeach
          </tbody>
        </table>
      </div>

      <!-- Pagination -->
      <div class="p-4 border-t border-slate-100 bg-slate-50/50 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-slate-500">
        <div>
          Showing <span class="font-bold text-slate-800">{{ $distributions->firstItem() }}</span> to <span class="font-bold text-slate-800">{{ $distributions->lastItem() }}</span> of <span class="font-bold text-slate-800">{{ $distributions->total() }}</span> records
        </div>
        <div>
          {{ $distributions->links() }}
        </div>
      </div>
    @endif
  </div>

</div>

<!-- 4. MODAL: LOG RELIEF ASSISTANCE -->
<div id="logAidModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm hidden">
  <div class="bg-white rounded-2xl max-w-lg w-full max-h-[90vh] flex flex-col shadow-2xl border border-slate-200 overflow-hidden animate-fade-in">
    
    <div class="px-6 py-4 bg-slate-900 text-white flex items-center justify-between">
      <div class="flex items-center gap-2.5">
        <div class="w-8 h-8 rounded-lg bg-teal-500/20 text-teal-400 flex items-center justify-center font-bold">
          <i class="fa-solid fa-hand-holding-heart"></i>
        </div>
        <div>
          <h3 class="text-sm font-extrabold">Log Aid Disbursement</h3>
          <p class="text-[10px] text-slate-400">Barangay Dacutan Social Welfare Desk</p>
        </div>
      </div>
      <button onclick="closeAidModal()" class="text-slate-400 hover:text-white">
        <i class="fa-solid fa-xmark text-lg"></i>
      </button>
    </div>

    <form action="{{ route('admin.aid.store') }}" method="POST" class="p-6 space-y-4 overflow-y-auto flex-1">
      @csrf

      <!-- Select Resident -->
      <div>
        <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1">Select Beneficiary Resident *</label>
        <select name="resident_id" required class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-900 font-medium focus:ring-2 focus:ring-teal-500">
          <option value="">-- Choose Beneficiary Resident --</option>
          @foreach($residents as $res)
            <option value="{{ $res->id }}">
              {{ $res->last_name }}, {{ $res->first_name }} ({{ $res->purok }} - {{ $res->is_senior ? 'Senior ' : '' }}{{ $res->is_4ps ? '4Ps ' : '' }}{{ $res->is_pwd ? 'PWD ' : '' }}{{ $res->is_indigent ? 'Indigent' : '' }})
            </option>
          @endforeach
        </select>
      </div>

      <!-- Program Name -->
      <div>
        <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1">Assistance / Relief Program *</label>
        <input 
          type="text" 
          name="program_name" 
          required 
          placeholder="e.g. Typhoon Relief Food Pack or DSWD SAP"
          class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-900 focus:ring-2 focus:ring-teal-500"
        >
      </div>

      <!-- Assistance Type & Quantity -->
      <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
        <div>
          <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1">Assistance Type *</label>
          <select name="assistance_type" required class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-900 focus:ring-2 focus:ring-teal-500">
            <option value="Food Pack / Groceries">Food Pack / Groceries</option>
            <option value="Financial / Cash Ayuda">Financial / Cash Ayuda</option>
            <option value="Medical & Hygiene Kit">Medical & Hygiene Kit</option>
            <option value="Agricultural Seeds / Fertilizer">Agricultural Seeds / Fertilizer</option>
            <option value="Emergency Shelter Kit">Emergency Shelter Kit</option>
          </select>
        </div>
        <div>
          <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1">Quantity / Amount *</label>
          <input 
            type="text" 
            name="amount_or_quantity" 
            required 
            placeholder="e.g. ₱5,000.00 Cash or 1 Box (Rice + Goods)"
            class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-900 focus:ring-2 focus:ring-teal-500"
          >
        </div>
      </div>

      <!-- Date & Distributor -->
      <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
        <div>
          <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1">Distribution Date *</label>
          <input type="date" name="distribution_date" value="{{ date('Y-m-d') }}" required class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-900 focus:ring-2 focus:ring-teal-500">
        </div>
        <div>
          <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1">Distributor / Team</label>
          <input type="text" name="distributor_name" value="Barangay Dacutan Council" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-900 focus:ring-2 focus:ring-teal-500">
        </div>
      </div>

      <div class="pt-4 border-t border-slate-200 flex items-center justify-end gap-3">
        <button type="button" onclick="closeAidModal()" class="px-4 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold">
          Cancel
        </button>
        <button type="submit" class="px-5 py-2 rounded-xl bg-teal-600 hover:bg-teal-500 text-white text-xs font-bold shadow-md shadow-teal-950/20 transition-all">
          Record Disbursement
        </button>
      </div>
    </form>

  </div>
</div>
@endsection

@section('scripts')
<script>
  function openAidModal() {
    document.getElementById('logAidModal').classList.remove('hidden');
  }
  function closeAidModal() {
    document.getElementById('logAidModal').classList.add('hidden');
  }
</script>
@endsection
