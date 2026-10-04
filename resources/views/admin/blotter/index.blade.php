@extends('layouts.app')

@section('title', 'Katarungang Pambarangay Blotter • Barangay Dacutan BIMS')
@section('header_title', 'Katarungang Pambarangay Blotter Records')
@section('header_subtitle', 'Lupon Tagapamayapa Dispute Mediation & Peacekeeping Case Tracking')

@section('content')
<div class="space-y-6">

  <!-- 1. HEADER & SUMMARY METRICS -->
  <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white p-4 sm:p-5 rounded-2xl border border-slate-200/80 shadow-sm">
    <div class="flex items-center gap-4">
      <div class="w-12 h-12 rounded-2xl bg-rose-50 text-rose-600 flex items-center justify-center text-xl">
        <i class="fa-solid fa-scale-balanced"></i>
      </div>
      <div>
        <h2 class="text-lg font-extrabold text-slate-900">Lupon Tagapamayapa Case Registry</h2>
        <div class="flex items-center gap-3 text-xs text-slate-500 mt-0.5">
          <span class="flex items-center gap-1 font-bold text-amber-600">
            <i class="fa-solid fa-clock-rotate-left"></i>
            {{ $activeCount }} In Mediation
          </span>
          <span>•</span>
          <span class="flex items-center gap-1 font-bold text-emerald-600">
            <i class="fa-solid fa-circle-check"></i>
            {{ $settledCount }} Amicably Settled
          </span>
        </div>
      </div>
    </div>

    <button 
      type="button" 
      onclick="openFileModal()" 
      class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-rose-600 hover:bg-rose-500 text-white font-bold text-xs shadow-md shadow-rose-950/20 transition-all hover:scale-[1.02]"
    >
      <i class="fa-solid fa-file-circle-plus text-sm"></i>
      <span>File Blotter Incident</span>
    </button>
  </div>

  <!-- 2. SEARCH & FILTER BAR -->
  <div class="bg-white p-4 sm:p-5 rounded-2xl border border-slate-200/80 shadow-sm">
    <form method="GET" action="{{ route('admin.blotter.index') }}" class="grid grid-cols-1 sm:grid-cols-3 gap-3">
      
      <!-- Search Keyword -->
      <div class="relative sm:col-span-2">
        <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
          <i class="fa-solid fa-magnifying-glass text-xs"></i>
        </span>
        <input 
          type="text" 
          name="search" 
          value="{{ request('search') }}" 
          placeholder="Search Case #, Complainant, Respondent or Incident Type..." 
          class="w-full pl-9 pr-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-rose-500"
        >
      </div>

      <!-- Filter by Status -->
      <div class="flex items-center gap-2">
        <select 
          name="status" 
          onchange="this.form.submit()" 
          class="flex-1 px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-800 font-medium focus:outline-none focus:ring-2 focus:ring-rose-500"
        >
          <option value="All">All Case Statuses</option>
          <option value="In Mediation" {{ request('status') == 'In Mediation' ? 'selected' : '' }}>In Mediation</option>
          <option value="Settled" {{ request('status') == 'Settled' ? 'selected' : '' }}>Amicably Settled</option>
          <option value="Referred to PNP" {{ request('status') == 'Referred to PNP' ? 'selected' : '' }}>Referred to PNP / Court</option>
          <option value="Dismissed" {{ request('status') == 'Dismissed' ? 'selected' : '' }}>Dismissed</option>
        </select>

        @if(request()->hasAny(['search', 'status']))
          <a href="{{ route('admin.blotter.index') }}" class="py-2 px-3 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-600 font-bold text-xs" title="Reset Filters">
            Reset
          </a>
        @endif
      </div>

    </form>
  </div>

  <!-- 3. BLOTTER CASES TABLE -->
  <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
    @if($records->isEmpty())
      <div class="p-12 text-center text-slate-400 space-y-3">
        <i class="fa-solid fa-scale-unbalanced text-4xl text-slate-300"></i>
        <p class="text-sm font-bold text-slate-600">No blotter cases found.</p>
        <p class="text-xs text-slate-400">Click "File Blotter Incident" above to record a new dispute.</p>
      </div>
    @else
      <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse text-xs">
          <thead>
            <tr class="bg-slate-50/75 border-b border-slate-200 text-[11px] font-bold text-slate-500 uppercase tracking-wider">
              <th class="py-3.5 px-4">Case #</th>
              <th class="py-3.5 px-4">Parties Involved</th>
              <th class="py-3.5 px-4">Incident Nature & Location</th>
              <th class="py-3.5 px-4">Incident Date</th>
              <th class="py-3.5 px-4">Next Hearing</th>
              <th class="py-3.5 px-4">Mediation Status</th>
              <th class="py-3.5 px-4 text-right">Actions</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-slate-100 font-normal text-slate-700">
            @foreach($records as $rec)
              <tr class="hover:bg-slate-50/80 transition-colors">
                
                <!-- Case # -->
                <td class="py-3.5 px-4">
                  <span class="font-mono font-bold text-slate-900 block">{{ $rec->case_no }}</span>
                  <span class="text-[10px] text-slate-400">Officer: {{ $rec->presiding_officer ?? 'Hon. Roberto S. Alen' }}</span>
                </td>

                <!-- Complainant vs Respondent -->
                <td class="py-3.5 px-4">
                  <p class="font-bold text-slate-900">
                    <span class="text-rose-600 font-extrabold mr-1">C:</span>{{ $rec->complainant_name }}
                  </p>
                  <p class="font-bold text-slate-700 mt-0.5">
                    <span class="text-blue-600 font-extrabold mr-1">R:</span>{{ $rec->respondent_name }}
                  </p>
                </td>

                <!-- Incident Nature & Location -->
                <td class="py-3.5 px-4">
                  <p class="font-semibold text-slate-800">{{ $rec->incident_type }}</p>
                  <p class="text-[10px] text-slate-400 truncate max-w-xs">{{ $rec->incident_location }}</p>
                </td>

                <!-- Incident Date -->
                <td class="py-3.5 px-4 text-slate-600 whitespace-nowrap">
                  {{ $rec->incident_date->format('M d, Y') }}
                </td>

                <!-- Hearing Date -->
                <td class="py-3.5 px-4 whitespace-nowrap">
                  @if($rec->hearing_date)
                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded bg-blue-50 text-blue-700 font-bold text-[10px] border border-blue-200">
                      <i class="fa-regular fa-calendar-days"></i>
                      {{ $rec->hearing_date->format('M d, Y') }}
                    </span>
                  @else
                    <span class="text-slate-400 text-[10px] italic">Not scheduled</span>
                  @endif
                </td>

                <!-- Status Badge -->
                <td class="py-3.5 px-4">
                  @php
                    $statusStyles = [
                      'In Mediation' => 'bg-amber-100 text-amber-800 border-amber-300',
                      'Settled' => 'bg-emerald-100 text-emerald-800 border-emerald-300',
                      'Referred to PNP' => 'bg-rose-100 text-rose-800 border-rose-300',
                      'Dismissed' => 'bg-slate-100 text-slate-700 border-slate-300',
                    ];
                    $badgeClass = $statusStyles[$rec->status] ?? 'bg-slate-100 text-slate-700 border-slate-300';
                  @endphp
                  <span class="inline-block px-2.5 py-0.5 rounded-full text-[10px] font-bold border {{ $badgeClass }}">
                    {{ $rec->status }}
                  </span>
                </td>

                <!-- Actions -->
                <td class="py-3.5 px-4 text-right space-x-1 whitespace-nowrap">
                  <!-- View Details Modal -->
                  <button 
                    type="button" 
                    onclick="viewBlotter({{ $rec->toJson() }})" 
                    class="p-1.5 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-700 transition-colors"
                    title="View Full Incident Narrative"
                  >
                    <i class="fa-solid fa-eye text-xs"></i>
                  </button>

                  <!-- Update Status / Mediation Modal -->
                  <button 
                    type="button" 
                    onclick="editBlotter({{ $rec->toJson() }})" 
                    class="p-1.5 rounded-lg bg-rose-50 hover:bg-rose-100 text-rose-700 transition-colors"
                    title="Update Hearing / Mediation Status"
                  >
                    <i class="fa-solid fa-scale-balanced text-xs"></i>
                  </button>
                </td>

              </tr>
            @endforeach
          </tbody>
        </table>
      </div>

      <!-- Pagination -->
      <div class="p-4 border-t border-slate-100 bg-slate-50/50 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-slate-500">
        <div>
          Showing <span class="font-bold text-slate-800">{{ $records->firstItem() }}</span> to <span class="font-bold text-slate-800">{{ $records->lastItem() }}</span> of <span class="font-bold text-slate-800">{{ $records->total() }}</span> records
        </div>
        <div>
          {{ $records->links() }}
        </div>
      </div>
    @endif
  </div>

</div>

<!-- 4. MODAL: FILE NEW BLOTTER INCIDENT -->
<div id="fileBlotterModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm hidden">
  <div class="bg-white rounded-2xl max-w-2xl w-full max-h-[90vh] flex flex-col shadow-2xl border border-slate-200 overflow-hidden animate-fade-in">
    
    <div class="px-6 py-4 bg-slate-900 text-white flex items-center justify-between">
      <div class="flex items-center gap-2.5">
        <div class="w-8 h-8 rounded-lg bg-rose-500/20 text-rose-400 flex items-center justify-center font-bold">
          <i class="fa-solid fa-scale-balanced"></i>
        </div>
        <div>
          <h3 class="text-sm font-extrabold">File Katarungang Pambarangay Blotter</h3>
          <p class="text-[10px] text-slate-400">Lupon Tagapamayapa Official Hearing Docket</p>
        </div>
      </div>
      <button onclick="closeFileModal()" class="text-slate-400 hover:text-white">
        <i class="fa-solid fa-xmark text-lg"></i>
      </button>
    </div>

    <form action="{{ route('admin.blotter.store') }}" method="POST" class="p-6 space-y-4 overflow-y-auto flex-1">
      @csrf

      <!-- Complainant Details -->
      <div class="p-3.5 bg-rose-50/50 rounded-xl border border-rose-100 space-y-2">
        <h4 class="text-xs font-bold text-rose-900 uppercase flex items-center gap-1.5">
          <i class="fa-solid fa-user-shield text-rose-600"></i>
          <span>Complainant (Nagrereklamo)</span>
        </h4>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
          <div>
            <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1">Full Name *</label>
            <input type="text" name="complainant_name" required placeholder="Full Name" class="w-full px-3 py-2 bg-white border border-slate-200 rounded-xl text-xs text-slate-900 focus:ring-2 focus:ring-rose-500">
          </div>
          <div>
            <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1">Contact No</label>
            <input type="text" name="complainant_contact" placeholder="0917-000-0000" class="w-full px-3 py-2 bg-white border border-slate-200 rounded-xl text-xs text-slate-900 focus:ring-2 focus:ring-rose-500">
          </div>
          <div class="sm:col-span-2">
            <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1">Complete Address</label>
            <input type="text" name="complainant_address" placeholder="Purok, Barangay Dacutan" class="w-full px-3 py-2 bg-white border border-slate-200 rounded-xl text-xs text-slate-900 focus:ring-2 focus:ring-rose-500">
          </div>
        </div>
      </div>

      <!-- Respondent Details -->
      <div class="p-3.5 bg-blue-50/50 rounded-xl border border-blue-100 space-y-2">
        <h4 class="text-xs font-bold text-blue-900 uppercase flex items-center gap-1.5">
          <i class="fa-solid fa-user-xmark text-blue-600"></i>
          <span>Respondent (Inirereklamo)</span>
        </h4>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
          <div>
            <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1">Full Name *</label>
            <input type="text" name="respondent_name" required placeholder="Full Name" class="w-full px-3 py-2 bg-white border border-slate-200 rounded-xl text-xs text-slate-900 focus:ring-2 focus:ring-blue-500">
          </div>
          <div>
            <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1">Address / Purok</label>
            <input type="text" name="respondent_address" placeholder="Purok, Barangay Dacutan" class="w-full px-3 py-2 bg-white border border-slate-200 rounded-xl text-xs text-slate-900 focus:ring-2 focus:ring-blue-500">
          </div>
        </div>
      </div>

      <!-- Incident Nature & Details -->
      <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
        <div>
          <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1">Incident Type *</label>
          <select name="incident_type" required class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-900 focus:ring-2 focus:ring-rose-500">
            <option value="Boundary Dispute">Boundary / Land Dispute</option>
            <option value="Neighborhood Disturbance">Neighborhood Noise / Disturbance</option>
            <option value="Unsettled Debt">Unsettled Financial Debt</option>
            <option value="Physical Altercation">Physical Altercation / Harassment</option>
            <option value="Verbal Defamation">Verbal Defamation / Slander</option>
            <option value="Property Damage">Property Damage</option>
            <option value="Other Civic Dispute">Other Civic Dispute</option>
          </select>
        </div>
        <div>
          <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1">Incident Location *</label>
          <input type="text" name="incident_location" required placeholder="e.g. Purok 3 near Plaza" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-900 focus:ring-2 focus:ring-rose-500">
        </div>
        <div>
          <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1">Incident Date *</label>
          <input type="date" name="incident_date" value="{{ date('Y-m-d') }}" required class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-900 focus:ring-2 focus:ring-rose-500">
        </div>
      </div>

      <!-- Hearing Schedule & Presiding Officer -->
      <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
        <div>
          <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1">Presiding Lupon / Officer</label>
          <input type="text" name="presiding_officer" value="Hon. Roberto S. Alen" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-900 focus:ring-2 focus:ring-rose-500">
        </div>
        <div>
          <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1">Scheduled 1st Hearing Date</label>
          <input type="date" name="hearing_date" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-900 focus:ring-2 focus:ring-rose-500">
        </div>
      </div>

      <!-- Incident Narrative -->
      <div>
        <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1">Detailed Sworn Narrative of Incident *</label>
        <textarea name="narrative" required rows="4" placeholder="Detail the sequence of events as recounted by the complainant..." class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-900 focus:ring-2 focus:ring-rose-500"></textarea>
      </div>

      <div class="pt-4 border-t border-slate-200 flex items-center justify-end gap-3">
        <button type="button" onclick="closeFileModal()" class="px-4 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold">
          Cancel
        </button>
        <button type="submit" class="px-5 py-2 rounded-xl bg-rose-600 hover:bg-rose-500 text-white text-xs font-bold shadow-md shadow-rose-950/20 transition-all">
          Record Blotter Case
        </button>
      </div>
    </form>

  </div>
</div>

<!-- 5. MODAL: VIEW BLOTTER DETAILS -->
<div id="viewBlotterModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm hidden">
  <div class="bg-white rounded-2xl max-w-lg w-full shadow-2xl border border-slate-200 overflow-hidden animate-fade-in">
    <div class="px-6 py-4 bg-slate-900 text-white flex items-center justify-between">
      <h3 class="text-sm font-extrabold flex items-center gap-2">
        <i class="fa-solid fa-file-contract text-rose-400"></i>
        <span>Blotter Record Transcript</span>
      </h3>
      <button onclick="closeViewBlotterModal()" class="text-slate-400 hover:text-white">
        <i class="fa-solid fa-xmark text-lg"></i>
      </button>
    </div>
    <div id="viewBlotterContent" class="p-6 space-y-3 text-xs">
      <!-- Injected via JavaScript -->
    </div>
    <div class="px-6 py-3 bg-slate-50 border-t border-slate-200 text-right">
      <button onclick="closeViewBlotterModal()" class="px-4 py-1.5 rounded-lg bg-slate-800 text-white text-xs font-bold">
        Close
      </button>
    </div>
  </div>
</div>

<!-- 6. MODAL: UPDATE MEDIATION / RESOLUTION -->
<div id="editBlotterModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm hidden">
  <div class="bg-white rounded-2xl max-w-md w-full shadow-2xl border border-slate-200 overflow-hidden animate-fade-in">
    
    <div class="px-6 py-4 bg-slate-900 text-white flex items-center justify-between">
      <h3 class="text-sm font-extrabold flex items-center gap-2">
        <i class="fa-solid fa-scale-balanced text-rose-400"></i>
        <span>Update Mediation / Hearing</span>
      </h3>
      <button onclick="closeEditBlotterModal()" class="text-slate-400 hover:text-white">
        <i class="fa-solid fa-xmark text-lg"></i>
      </button>
    </div>

    <form id="editBlotterForm" method="POST" class="p-6 space-y-4">
      @csrf
      @method('PUT')

      <div>
        <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1">Mediation Status *</label>
        <select id="edit_blotter_status" name="status" required class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-900 focus:ring-2 focus:ring-rose-500">
          <option value="In Mediation">In Mediation (Lupon Proceedings)</option>
          <option value="Settled">Amicably Settled (Kasunduan Signed)</option>
          <option value="Referred to PNP">Referred to PNP / Certificate to File Action</option>
          <option value="Dismissed">Dismissed</option>
        </select>
      </div>

      <div>
        <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1">Next Hearing Date</label>
        <input type="date" id="edit_blotter_hearing" name="hearing_date" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-900 focus:ring-2 focus:ring-rose-500">
      </div>

      <div>
        <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1">Presiding Lupon / Officer</label>
        <input type="text" id="edit_blotter_officer" name="presiding_officer" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-900 focus:ring-2 focus:ring-rose-500">
      </div>

      <div>
        <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1">Resolution Details / Amicable Settlement Terms</label>
        <textarea id="edit_blotter_resolution" name="resolution_details" rows="3" placeholder="Enter terms of agreement reached during mediation..." class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-900 focus:ring-2 focus:ring-rose-500"></textarea>
      </div>

      <div class="pt-4 border-t border-slate-200 flex items-center justify-end gap-3">
        <button type="button" onclick="closeEditBlotterModal()" class="px-4 py-2 rounded-xl bg-slate-100 text-slate-700 text-xs font-bold">
          Cancel
        </button>
        <button type="submit" class="px-5 py-2 rounded-xl bg-rose-600 hover:bg-rose-500 text-white text-xs font-bold">
          Save Status
        </button>
      </div>
    </form>
  </div>
</div>
@endsection

@section('scripts')
<script>
  function openFileModal() {
    document.getElementById('fileBlotterModal').classList.remove('hidden');
  }
  function closeFileModal() {
    document.getElementById('fileBlotterModal').classList.add('hidden');
  }

  function viewBlotter(rec) {
    const modal = document.getElementById('viewBlotterModal');
    const content = document.getElementById('viewBlotterContent');
    const hearing = rec.hearing_date ? new Date(rec.hearing_date).toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' }) : 'None';
    const incidentDate = new Date(rec.incident_date).toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' });

    content.innerHTML = `
      <div class="flex items-center justify-between border-b border-slate-100 pb-3">
        <span class="font-mono text-xs font-bold text-rose-700 bg-rose-50 px-2.5 py-0.5 rounded border border-rose-200">${rec.case_no}</span>
        <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold border ${rec.status === 'Settled' ? 'bg-emerald-100 text-emerald-800 border-emerald-300' : 'bg-amber-100 text-amber-800 border-amber-300'}">${rec.status}</span>
      </div>
      <div class="space-y-1.5 py-1">
        <p><strong>Complainant:</strong> ${rec.complainant_name} (${rec.complainant_address || 'N/A'})</p>
        <p><strong>Respondent:</strong> ${rec.respondent_name} (${rec.respondent_address || 'N/A'})</p>
        <p><strong>Nature:</strong> ${rec.incident_type} at ${rec.incident_location}</p>
        <p><strong>Incident Date:</strong> ${incidentDate}</p>
        <p><strong>Hearing Date:</strong> ${hearing}</p>
        <p><strong>Presiding:</strong> ${rec.presiding_officer || 'Punong Barangay'}</p>
      </div>
      <div class="pt-2 border-t border-slate-100">
        <p class="font-bold text-slate-800 uppercase text-[10px] mb-1">Narrative Statement:</p>
        <div class="p-3 bg-slate-50 rounded-xl border border-slate-200 text-slate-700 italic">
          "${rec.narrative}"
        </div>
      </div>
      ${rec.resolution_details ? `
        <div class="pt-2 border-t border-slate-100">
          <p class="font-bold text-emerald-800 uppercase text-[10px] mb-1">Amicable Settlement Terms:</p>
          <div class="p-3 bg-emerald-50 rounded-xl border border-emerald-200 text-emerald-900">
            ${rec.resolution_details}
          </div>
        </div>
      ` : ''}
    `;
    modal.classList.remove('hidden');
  }

  function closeViewBlotterModal() {
    document.getElementById('viewBlotterModal').classList.add('hidden');
  }

  function editBlotter(rec) {
    const modal = document.getElementById('editBlotterModal');
    const form = document.getElementById('editBlotterForm');
    form.action = `{{ url('admin/blotter') }}/${rec.id}`;

    document.getElementById('edit_blotter_status').value = rec.status || 'In Mediation';
    document.getElementById('edit_blotter_hearing').value = rec.hearing_date ? rec.hearing_date.split('T')[0] : '';
    document.getElementById('edit_blotter_officer').value = rec.presiding_officer || 'Hon. Roberto S. Alen';
    document.getElementById('edit_blotter_resolution').value = rec.resolution_details || '';

    modal.classList.remove('hidden');
  }

  function closeEditBlotterModal() {
    document.getElementById('editBlotterModal').classList.add('hidden');
  }
</script>
@endsection
