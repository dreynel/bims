/**
 * BIMS Barangay Dacutan - Application Bootstrap & Route Controller Registry
 * Connects views to data models and manages page-specific interactivity.
 */

// Global State
let currentResidentsList = [];

// Check if running inside the Admin Portal (admin.html) or Public Portal (index.html)
const isAdminPortal = window.location.pathname.endsWith('admin.html') || document.body.classList.contains('is-admin-mode');

// Initialize SPA Router
const router = new SPARouter({
  containerSelector: '#app-content',
  defaultRoute: isAdminPortal ? '/dashboard' : '/public'
});

// ==========================================
// 1. DASHBOARD CONTROLLER
// ==========================================
function setupDashboard() {
  if (typeof initDashboardCharts === 'function') {
    initDashboardCharts();
  }
}

function cleanupDashboard() {
  if (typeof destroyDashboardCharts === 'function') {
    destroyDashboardCharts();
  }
}

// ==========================================
// 2. RESIDENTS CONTROLLER
// ==========================================
function setupResidents() {
  if (typeof BIMS_DATA !== 'undefined' && BIMS_DATA.residents) {
    currentResidentsList = [...BIMS_DATA.residents];
    renderResidents(currentResidentsList);
  }
}

function renderResidents(list) {
  const tbody = document.getElementById('residentTableBody');
  if (!tbody) return;

  if (!list || list.length === 0) {
    tbody.innerHTML = `
      <tr>
        <td colspan="7" class="px-4 py-8 text-center text-slate-500 font-medium">
          <i class="fa-solid fa-user-slash text-2xl text-slate-400 mb-2 block"></i>
          No resident records matched your search or filters.
        </td>
      </tr>
    `;
    return;
  }

  tbody.innerHTML = list.map(r => `
    <tr class="hover:bg-slate-50 transition-all">
      <td class="px-4 py-3.5 font-mono text-emerald-800 font-bold text-xs">${r.residentId}</td>
      <td class="px-4 py-3.5">
        <div class="flex items-center gap-3">
          <img src="${r.photo}" alt="${r.firstName}" class="w-8 h-8 rounded-full object-cover border border-slate-300">
          <div>
            <p class="font-bold text-slate-900">${r.firstName} ${r.middleName ? r.middleName + ' ' : ''}${r.lastName} ${r.suffix || ''}</p>
            <p class="text-[10px] text-slate-500 font-medium">${r.civilStatus}</p>
          </div>
        </div>
      </td>
      <td class="px-4 py-3.5 text-xs text-slate-700 font-medium">${r.age} yrs old • ${r.gender}</td>
      <td class="px-4 py-3.5 text-xs">
        <p class="font-bold text-slate-900">${r.purok}</p>
        <p class="text-[10px] text-slate-500 font-medium">${r.address}</p>
      </td>
      <td class="px-4 py-3.5 text-xs text-slate-700 font-medium">${r.occupation || 'N/A'}</td>
      <td class="px-4 py-3.5">
        <div class="flex flex-wrap gap-1">
          <span class="badge ${r.voterStatus === 'Registered' ? 'badge-voter' : 'badge-nonvoter'}">${r.voterStatus === 'Registered' ? 'Voter' : 'Non-Voter'}</span>
          ${r.isSenior ? '<span class="badge badge-senior">Senior</span>' : ''}
          ${r.isPwd ? '<span class="badge badge-pwd">PWD</span>' : ''}
          ${r.is4ps ? '<span class="badge badge-4ps">4Ps</span>' : ''}
          ${r.isSoloParent ? '<span class="badge badge-soloparent">Solo Parent</span>' : ''}
        </div>
      </td>
      <td class="px-4 py-3.5 text-right space-x-1">
        <button onclick="viewResident(${r.id})" class="px-2.5 py-1 rounded bg-slate-100 hover:bg-slate-200 text-slate-800 font-semibold text-xs border border-slate-300 transition-all">View</button>
      </td>
    </tr>
  `).join('');
}

function filterResidents() {
  const searchInput = document.getElementById('searchInput');
  const purokFilter = document.getElementById('purokFilter');
  const sectorFilter = document.getElementById('sectorFilter');

  const search = searchInput ? searchInput.value.toLowerCase().trim() : '';
  const purok = purokFilter ? purokFilter.value : 'All';
  const sector = sectorFilter ? sectorFilter.value : 'All';

  let filtered = BIMS_DATA.residents.filter(r => {
    const fullName = `${r.firstName} ${r.middleName} ${r.lastName} ${r.residentId}`.toLowerCase();
    const matchesSearch = !search || fullName.includes(search);
    const matchesPurok = purok === 'All' || r.purok === purok;

    let matchesSector = true;
    if (sector === 'Senior') matchesSector = r.isSenior;
    if (sector === 'PWD') matchesSector = r.isPwd;
    if (sector === 'Indigent') matchesSector = r.isIndigent || r.is4ps;
    if (sector === 'SoloParent') matchesSector = r.isSoloParent;

    return matchesSearch && matchesPurok && matchesSector;
  });

  renderResidents(filtered);
}

function resetFilters() {
  const sInput = document.getElementById('searchInput');
  const pFilter = document.getElementById('purokFilter');
  const secFilter = document.getElementById('sectorFilter');

  if (sInput) sInput.value = '';
  if (pFilter) pFilter.value = 'All';
  if (secFilter) secFilter.value = 'All';

  if (typeof BIMS_DATA !== 'undefined' && BIMS_DATA.residents) {
    renderResidents(BIMS_DATA.residents);
  }
}

function viewResident(id) {
  if (typeof BIMS_DATA === 'undefined' || !BIMS_DATA.residents) return;
  const r = BIMS_DATA.residents.find(res => res.id === id);
  if (!r) return;

  const mName = document.getElementById('modalName');
  const mResId = document.getElementById('modalResId');
  const mPhoto = document.getElementById('modalPhoto');
  const mAgeGender = document.getElementById('modalAgeGender');
  const mCivilStatus = document.getElementById('modalCivilStatus');
  const mAddress = document.getElementById('modalAddress');
  const mOccupation = document.getElementById('modalOccupation');
  const mVoter = document.getElementById('modalVoter');
  const mContact = document.getElementById('modalContact');

  if (mName) mName.textContent = `${r.firstName} ${r.middleName || ''} ${r.lastName} ${r.suffix || ''}`;
  if (mResId) mResId.textContent = r.residentId;
  if (mPhoto) mPhoto.src = r.photo;
  if (mAgeGender) mAgeGender.textContent = `${r.age} Years Old • ${r.gender}`;
  if (mCivilStatus) mCivilStatus.textContent = r.civilStatus;
  if (mAddress) mAddress.textContent = `${r.purok}, ${r.address}`;
  if (mOccupation) mOccupation.textContent = `${r.occupation || 'N/A'} (Est. ₱${r.monthlyIncome ? r.monthlyIncome.toLocaleString() : '0'}/mo)`;
  if (mVoter) mVoter.textContent = `${r.voterStatus} (Precinct ${r.precinct || 'N/A'})`;
  if (mContact) mContact.textContent = r.contactNo;

  openModal('viewResidentModal');
}

function handleAddResident(e) {
  e.preventDefault();
  closeModal('addResidentModal');
  showToast('New resident registered successfully to Barangay Dacutan database!', 'success');
  e.target.reset();
}

// ==========================================
// 3. CERTIFICATES CONTROLLER
// ==========================================
function setupCertificates() {
  populateResidentDropdown();
  const dateInput = document.getElementById('certDate');
  if (dateInput && !dateInput.value) {
    const today = new Date().toISOString().split('T')[0];
    dateInput.value = today;
  }
  updateCertPreview();
}

function populateResidentDropdown() {
  const select = document.getElementById('residentSelect');
  if (!select || typeof BIMS_DATA === 'undefined' || !BIMS_DATA.residents) return;

  select.innerHTML = BIMS_DATA.residents.map(r => `
    <option value="${r.firstName} ${r.middleName ? r.middleName + ' ' : ''}${r.lastName}">
      ${r.firstName} ${r.lastName} (${r.purok})
    </option>
  `).join('');
}

function updateCertPreview() {
  const typeSelect = document.getElementById('certTypeSelect');
  const residentSelect = document.getElementById('residentSelect');
  const purposeInput = document.getElementById('certPurpose');
  const ctcInput = document.getElementById('certCtcNo');
  const orNoInput = document.getElementById('certOrNo');
  const feeInput = document.getElementById('certFee');
  const dateInput = document.getElementById('certDate');

  const type = typeSelect ? typeSelect.value : 'Barangay Clearance';
  const resident = residentSelect ? residentSelect.value : 'Juan Dela Cruz Dacutan';
  const purpose = purposeInput ? purposeInput.value : 'General Legal Requirement';
  const ctcNo = ctcInput ? ctcInput.value : 'CTC-2026-08144';
  const orNo = orNoInput ? orNoInput.value : 'OR-2026-9981';
  let fee = feeInput ? feeInput.value : '₱ 50.00';
  const dateVal = dateInput ? dateInput.value : new Date().toISOString().split('T')[0];

  // Auto-adjust default fee when type changes if not manually set
  if (type.includes('Indigency') || type.includes('Job Seeker')) {
    if (feeInput && feeInput.value === '₱ 50.00') {
      feeInput.value = '₱ 0.00 (Free)';
      fee = '₱ 0.00 (Free)';
    }
  } else if (type.includes('Business')) {
    if (feeInput && feeInput.value === '₱ 50.00') {
      feeInput.value = '₱ 150.00';
      fee = '₱ 150.00';
    }
  }

  // Generate appropriate Control No prefix
  const prefixMap = {
    'Barangay Clearance': 'CLR',
    'Certificate of Indigency': 'IND',
    'Certificate of Residency': 'RES',
    'First Time Job Seeker (RA 11261)': 'JOB',
    'Barangay Business Clearance': 'BIZ'
  };
  const prefix = prefixMap[type] || 'DOC';
  const docControlEl = document.getElementById('docControlNo');
  if (docControlEl) {
    docControlEl.textContent = `${prefix}-2026-08001`;
  }

  const docTitle = document.getElementById('docTitlePreview');
  const docResident = document.getElementById('docResidentName');
  const docPurpose = document.getElementById('docPurposePreview');
  const docCtc = document.getElementById('docCtcPreview');
  const docOrNo = document.getElementById('docOrNoPreview');
  const docFee = document.getElementById('docFeePreview');
  const docDay = document.getElementById('docDay');
  const docMonthYear = document.getElementById('docMonthYear');

  if (docTitle) docTitle.textContent = type.toUpperCase();
  if (docResident) docResident.textContent = resident.toUpperCase();
  if (docPurpose) docPurpose.textContent = purpose;
  if (docCtc) docCtc.textContent = ctcNo;
  if (docOrNo) docOrNo.textContent = orNo;
  if (docFee) docFee.textContent = fee;

  if (dateVal && docDay && docMonthYear) {
    const d = new Date(dateVal);
    if (!isNaN(d.getTime())) {
      const day = d.getDate();
      const monthYear = d.toLocaleDateString('en-US', { month: 'long', year: 'numeric' });
      docDay.textContent = day + getOrdinalSuffix(day);
      docMonthYear.textContent = monthYear;
    }
  }
}

function getOrdinalSuffix(d) {
  if (d > 3 && d < 21) return 'th';
  switch (d % 10) {
    case 1:  return "st";
    case 2:  return "nd";
    case 3:  return "rd";
    default: return "th";
  }
}

// ==========================================
// 4. BLOTTER CONTROLLER
// ==========================================
function setupBlotter() {
  renderBlotters();
}

function renderBlotters() {
  const tbody = document.getElementById('blotterTableBody');
  if (!tbody || typeof BIMS_DATA === 'undefined' || !BIMS_DATA.blotterRecords) return;

  tbody.innerHTML = BIMS_DATA.blotterRecords.map(b => `
    <tr class="hover:bg-slate-50 transition-all">
      <td class="px-4 py-3.5 font-mono text-rose-800 font-bold text-xs">${b.caseNo}</td>
      <td class="px-4 py-3.5">
        <p class="font-bold text-slate-900 text-xs">${b.complainant}</p>
        <p class="text-[10px] text-slate-500 font-medium">vs ${b.respondent}</p>
      </td>
      <td class="px-4 py-3.5 text-xs text-slate-800 font-semibold">${b.incidentType}</td>
      <td class="px-4 py-3.5 text-xs text-slate-600 font-medium">${b.location}</td>
      <td class="px-4 py-3.5 text-xs font-semibold">${b.incidentDate}</td>
      <td class="px-4 py-3.5">
        ${b.status === 'Settled' ? '<span class="badge badge-green">Settled</span>' : '<span class="badge badge-yellow">In Mediation</span>'}
      </td>
      <td class="px-4 py-3.5 text-right">
        <button onclick="showToast('Case #${b.caseNo} selected for review', 'info')" class="px-2.5 py-1 rounded bg-slate-100 hover:bg-slate-200 text-slate-800 font-semibold text-xs border border-slate-300 transition-all">Manage</button>
      </td>
    </tr>
  `).join('');
}

function triggerAILegalSummary() {
  if (typeof AI_COPILOT === 'undefined') return;
  const res = AI_COPILOT.processQuery('blotter case advice');
  const txt = document.getElementById('aiSummaryText');
  const box = document.getElementById('aiSummaryBox');
  if (txt) txt.textContent = res.text;
  if (box) box.classList.remove('hidden');
}

function handleAddBlotter(e) {
  e.preventDefault();
  closeModal('addBlotterModal');
  showToast('New blotter entry logged successfully to Katarungang Pambarangay!', 'success');
  e.target.reset();
}

// ==========================================
// 5. AID DISTRIBUTION CONTROLLER
// ==========================================
function setupAid() {
  renderAidTable();
}

function renderAidTable() {
  const tbody = document.getElementById('aidTableBody');
  if (!tbody || typeof BIMS_DATA === 'undefined' || !BIMS_DATA.aidDistributions) return;

  tbody.innerHTML = BIMS_DATA.aidDistributions.map(a => `
    <tr class="hover:bg-slate-50 transition-all">
      <td class="px-4 py-3.5 font-bold text-slate-900 text-xs">${a.program}</td>
      <td class="px-4 py-3.5 text-xs text-slate-800 font-medium">${a.beneficiary}</td>
      <td class="px-4 py-3.5 text-xs text-teal-800 font-bold">${a.assistanceType} (${a.qty})</td>
      <td class="px-4 py-3.5 text-xs text-slate-600 font-semibold">${a.date}</td>
      <td class="px-4 py-3.5"><span class="badge badge-green">${a.status}</span></td>
      <td class="px-4 py-3.5 text-right font-mono text-[10px] text-slate-500 font-semibold">${a.recommender}</td>
    </tr>
  `).join('');
}

function triggerAIAidMatrix() {
  if (typeof AI_COPILOT === 'undefined') return;
  const res = AI_COPILOT.processQuery('relief aid priority');
  const txt = document.getElementById('aiAidText');
  const box = document.getElementById('aiAidBox');
  if (txt) txt.textContent = res.text;
  if (box) box.classList.remove('hidden');
}

// ==========================================
// 6. AI ASSISTANT CONTROLLER
// ==========================================
function setupAiAssistant() {
  // Sync language buttons
  if (typeof AI_COPILOT !== 'undefined') {
    setLanguage(AI_COPILOT.language || 'en');
  }
}

function setLanguage(lang) {
  if (typeof AI_COPILOT !== 'undefined') {
    AI_COPILOT.setLanguage(lang);
  }
  document.querySelectorAll('#langEn, #langHil, #langTl').forEach(b => {
    b.classList.remove('bg-emerald-700', 'text-white', 'font-bold', 'shadow-sm');
    b.classList.add('text-slate-700');
  });
  const target = lang === 'en' ? 'langEn' : lang === 'hil' ? 'langHil' : 'langTl';
  const targetEl = document.getElementById(target);
  if (targetEl) {
    targetEl.classList.add('bg-emerald-700', 'text-white', 'font-bold', 'shadow-sm');
  }
  showToast(`Language set to ${lang === 'en' ? 'English' : lang === 'hil' ? 'Hiligaynon' : 'Tagalog'}`, 'info');
}

function handleChatSubmit(e) {
  e.preventDefault();
  const input = document.getElementById('aiInput');
  if (!input) return;
  const text = input.value.trim();
  if (!text) return;

  appendUserMessage(text);
  input.value = '';

  setTimeout(() => {
    if (typeof AI_COPILOT !== 'undefined') {
      const response = AI_COPILOT.processQuery(text);
      appendAIMessage(response);
    }
  }, 350);
}

function sendQuickPrompt(promptText) {
  const input = document.getElementById('aiInput');
  if (input) {
    input.value = promptText;
    handleChatSubmit(new Event('submit'));
  }
}

function appendUserMessage(text) {
  const display = document.getElementById('chatDisplay');
  if (!display) return;
  const div = document.createElement('div');
  div.className = 'flex items-start justify-end gap-3';
  div.innerHTML = `
    <div class="p-3.5 rounded-2xl bg-emerald-700 text-white text-xs max-w-xl shadow-sm">
      <p class="font-medium">${text}</p>
    </div>
  `;
  display.appendChild(div);
  display.scrollTop = display.scrollHeight;
}

function appendAIMessage(res) {
  const display = document.getElementById('chatDisplay');
  if (!display) return;
  const div = document.createElement('div');
  div.className = 'flex items-start gap-3';
  div.innerHTML = `
    <div class="w-9 h-9 rounded-xl bg-emerald-100 border border-emerald-300 flex items-center justify-center text-emerald-800 shrink-0">
      <i class="fa-solid fa-robot"></i>
    </div>
    <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200 max-w-2xl text-xs space-y-2 shadow-sm">
      <div class="flex items-center justify-between font-bold text-emerald-800">
        <span>${res.title}</span>
        <span class="badge badge-green">AI Response</span>
      </div>
      <div class="text-slate-800 leading-relaxed font-mono whitespace-pre-line font-medium">${res.text}</div>
      ${res.actionable ? `<div class="pt-2"><button onclick="showToast('${res.actionable} executed!', 'success')" class="px-3 py-1.5 rounded-lg bg-emerald-100 hover:bg-emerald-700 text-emerald-800 hover:text-white border border-emerald-300 text-[11px] font-bold transition-all"><i class="fa-solid fa-bolt mr-1"></i> ${res.actionable}</button></div>` : ''}
    </div>
  `;
  display.appendChild(div);
  display.scrollTop = display.scrollHeight;
}

// ==========================================
// 7. PUBLIC PORTAL CONTROLLER
// ==========================================
function setupPublicPortal() {
  // Public portal ready
}

function handlePublicRequestSubmit(e) {
  e.preventDefault();
  const ref = "DAC-REQ-2026-" + Math.floor(1000 + Math.random() * 9000);
  showToast(`Application submitted! Your Reference Number is: ${ref}`, 'success');
  e.target.reset();
}

function handleTrackStatus(e) {
  e.preventDefault();
  const box = document.getElementById('trackResultBox');
  if (box) box.classList.remove('hidden');
}

function handlePublicChatSubmit(e) {
  e.preventDefault();
  const input = document.getElementById('publicAiInput');
  if (!input) return;
  const query = input.value.trim();
  if (!query) return;

  const display = document.getElementById('publicChatDisplay');
  if (!display) return;
  
  display.innerHTML += `
    <div class="flex items-start justify-end gap-2">
      <div class="p-2.5 rounded-xl bg-emerald-700 text-white max-w-md font-medium">${query}</div>
    </div>
  `;
  input.value = '';

  setTimeout(() => {
    let reply = "Requirements for Barangay Clearance: Valid ID, Residence verification in Barangay Dacutan, and ₱50.00 fee. Office hours are Monday to Friday, 8:00 AM to 5:00 PM.";
    const qLower = query.toLowerCase();
    if (qLower.includes('first time') || qLower.includes('job')) {
      reply = "Under Republic Act 11261 (First Time Job Seekers Act), barangay clearances and certifications are completely FREE of charge for first-time job seekers!";
    } else if (qLower.includes('indigency') || qLower.includes('4ps')) {
      reply = "Certificate of Indigency is issued free of charge for qualified beneficiaries, medical assistance (WVMC/WVSU), and scholarship applications.";
    }
    display.innerHTML += `
      <div class="flex items-start gap-2.5">
        <div class="w-7 h-7 rounded-lg bg-emerald-700 text-white flex items-center justify-center shrink-0 font-bold text-xs">AI</div>
        <div class="p-3 rounded-xl bg-white border border-slate-200 text-slate-800 max-w-xl">
          ${reply}
        </div>
      </div>
    `;
    display.scrollTop = display.scrollHeight;
  }, 350);
}

// ==========================================
// REGISTER ALL SPA ROUTES
// ==========================================
router
  .addRoute('/dashboard', {
    title: 'Executive Dashboard - BIMS Barangay Dacutan',
    view: 'views/admin/dashboard.html',
    onMount: setupDashboard,
    onDestroy: cleanupDashboard
  })
  .addRoute('/residents', {
    title: 'Resident Records - BIMS Barangay Dacutan',
    view: 'views/admin/residents.html',
    onMount: setupResidents
  })
  .addRoute('/certificates', {
    title: 'Certificates & Clearances - BIMS Barangay Dacutan',
    view: 'views/admin/certificates.html',
    onMount: setupCertificates
  })
  .addRoute('/blotter', {
    title: 'Blotter & KP Cases - BIMS Barangay Dacutan',
    view: 'views/admin/blotter.html',
    onMount: setupBlotter
  })
  .addRoute('/aid-distribution', {
    title: 'Calamity & SAP Relief - BIMS Barangay Dacutan',
    view: 'views/admin/aid-distribution.html',
    onMount: setupAid
  })
  .addRoute('/ai-assistant', {
    title: 'Dacutan AI Copilot - BIMS Barangay Dacutan',
    view: 'views/admin/ai-assistant.html',
    onMount: setupAiAssistant
  })
  .addRoute('/public', {
    title: 'Public Citizen Portal - Barangay Dacutan',
    view: 'views/public/home.html',
    onMount: setupPublicPortal,
    isPublicPortal: true
  })
  .addRoute('/', {
    title: 'Public Citizen Portal - Barangay Dacutan',
    view: 'views/public/home.html',
    onMount: setupPublicPortal,
    isPublicPortal: true
  });

// Export all controller functions to window
window.router = router;
window.filterResidents = filterResidents;
window.resetFilters = resetFilters;
window.viewResident = viewResident;
window.handleAddResident = handleAddResident;
window.updateCertPreview = updateCertPreview;
window.triggerAILegalSummary = triggerAILegalSummary;
window.handleAddBlotter = handleAddBlotter;
window.triggerAIAidMatrix = triggerAIAidMatrix;
window.setLanguage = setLanguage;
window.handleChatSubmit = handleChatSubmit;
window.sendQuickPrompt = sendQuickPrompt;
window.handlePublicRequestSubmit = handlePublicRequestSubmit;
window.handleTrackStatus = handleTrackStatus;
window.handlePublicChatSubmit = handlePublicChatSubmit;

