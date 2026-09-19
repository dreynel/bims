/**
 * BIMS Barangay Dacutan - Main Interactivity & UI Manager
 * Manages toast notifications, modal dialogues, mobile navigation drawer, and print utilities.
 */

document.addEventListener('DOMContentLoaded', () => {
  initHeaderAndNav();
  createToastContainer();
  initGlobalKeyboardShortcuts();
});

// Toast Notification Engine
function showToast(message, type = 'success') {
  const container = document.getElementById('toastContainer') || createToastContainer();
  const toast = document.createElement('div');
  
  const colors = {
    success: 'bg-emerald-700 border-emerald-500 text-white',
    error: 'bg-rose-700 border-rose-500 text-white',
    info: 'bg-blue-700 border-blue-500 text-white',
    warning: 'bg-amber-600 border-amber-400 text-white'
  };

  const icons = {
    success: 'fa-circle-check',
    error: 'fa-circle-xmark',
    info: 'fa-circle-info',
    warning: 'fa-triangle-exclamation'
  };

  toast.className = `flex items-center gap-3 px-4 py-3 rounded-xl border shadow-xl text-sm font-medium transition-all duration-300 transform translate-y-2 opacity-0 ${colors[type] || colors.info}`;
  toast.innerHTML = `
    <i class="fa-solid ${icons[type] || icons.info} text-lg"></i>
    <span>${message}</span>
    <button onclick="this.parentElement.remove()" class="ml-auto opacity-70 hover:opacity-100 p-1">
      <i class="fa-solid fa-xmark"></i>
    </button>
  `;

  container.appendChild(toast);
  setTimeout(() => {
    toast.classList.remove('translate-y-2', 'opacity-0');
  }, 10);

  setTimeout(() => {
    toast.classList.add('opacity-0', 'translate-y-2');
    setTimeout(() => toast.remove(), 300);
  }, 4500);
}

function createToastContainer() {
  let container = document.getElementById('toastContainer');
  if (!container) {
    container = document.createElement('div');
    container.id = 'toastContainer';
    container.className = 'fixed bottom-5 right-5 z-50 flex flex-col gap-2 max-w-sm w-full pointer-events-auto';
    document.body.appendChild(container);
  }
  return container;
}

// Global Nav & Header initialization
function initHeaderAndNav() {
  const sidebar = document.getElementById('sidebar');
  const sidebarToggleBtn = document.getElementById('sidebarToggleBtn');
  
  if (sidebarToggleBtn && sidebar) {
    sidebarToggleBtn.addEventListener('click', (e) => {
      e.stopPropagation();
      sidebar.classList.toggle('-translate-x-full');
    });

    // Close sidebar on mobile when clicking outside
    document.addEventListener('click', (e) => {
      if (window.innerWidth < 1024 && sidebar && !sidebar.contains(e.target) && !sidebarToggleBtn.contains(e.target)) {
        if (!sidebar.classList.contains('-translate-x-full')) {
          sidebar.classList.add('-translate-x-full');
        }
      }
    });
  }
}

// Global modal handling & keyboard shortcuts
function initGlobalKeyboardShortcuts() {
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
      // Close any open modals
      document.querySelectorAll('.modal-backdrop:not(.hidden)').forEach(modal => {
        closeModal(modal.id);
      });
    }
  });

  // Close modal when clicking backdrop area
  document.addEventListener('click', (e) => {
    if (e.target.classList.contains('modal-backdrop')) {
      closeModal(e.target.id);
    }
  });
}

// Modal Trigger Utility
function openModal(modalId) {
  const modal = document.getElementById(modalId);
  if (modal) {
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    const content = modal.querySelector('.modal-content') || modal.children[0];
    if (content) {
      content.classList.remove('animate-pop-in');
      void content.offsetWidth;
      content.classList.add('animate-pop-in');
    }
  }
}

function closeModal(modalId) {
  const modal = document.getElementById(modalId);
  if (modal) {
    modal.classList.add('hidden');
    modal.classList.remove('flex');
  }
}

// Print Handler for Certificate Generator
function printCertificate() {
  window.print();
}

// 1. Philippine Standard Time (PST - UTC+8) Live Clock
function initPstClock() {
  const clockEl = document.getElementById('pstClock');
  if (!clockEl) return;

  function update() {
    const now = new Date();
    // Format options for Philippine Standard Time
    const options = {
      timeZone: 'Asia/Manila',
      hour: '2-digit',
      minute: '2-digit',
      second: '2-digit',
      hour12: true,
      day: 'numeric',
      month: 'short',
      year: 'numeric'
    };
    try {
      const formatted = new Intl.DateTimeFormat('en-PH', options).format(now);
      clockEl.textContent = `${formatted} PST`;
    } catch (e) {
      clockEl.textContent = now.toLocaleTimeString() + ' PST';
    }
  }

  update();
  setInterval(update, 1000);
}

// 2. Public Citizen Portal E-Services Helpers
function selectServiceForRequest(docType) {
  const select = document.getElementById('appDocType');
  if (select) {
    select.value = docType;
    updateFeePreview();
  }
  const section = document.getElementById('request-section');
  if (section) {
    section.scrollIntoView({ behavior: 'smooth' });
  }
}

function updateFeePreview() {
  const select = document.getElementById('appDocType');
  const display = document.getElementById('feeDisplay');
  if (!select || !display) return;

  const fees = {
    'Barangay Clearance': '₱ 50.00 (Payable upon pick-up)',
    'Certificate of Indigency': '₱ 0.00 (100% Free for Qualified Indigents)',
    'Certificate of Residency': '₱ 50.00 (Payable upon pick-up)',
    'First Time Job Seeker (RA 11261)': '₱ 0.00 (100% Free under RA 11261 Waiver)',
    'Barangay Business Clearance': '₱ 150.00 (Commercial/Micro Business)'
  };

  display.textContent = fees[select.value] || '₱ 50.00 (Payable upon pick-up)';
}

let lastGeneratedRef = 'DAC-2026-0042';

function handlePublicDocSubmission(e) {
  e.preventDefault();
  const name = document.getElementById('appFullName')?.value;
  const docType = document.getElementById('appDocType')?.value || 'Barangay Clearance';
  
  // Generate random tracking number
  const randNum = Math.floor(1000 + Math.random() * 9000);
  lastGeneratedRef = `DAC-2026-${randNum}`;

  const refEl = document.getElementById('generatedRefNumber');
  if (refEl) refEl.textContent = lastGeneratedRef;

  const modal = document.getElementById('publicDocSuccessModal');
  if (modal) {
    modal.classList.remove('hidden');
    modal.classList.add('flex');
  }

  showToast(`Application submitted! Tracking Ref: ${lastGeneratedRef}`, 'success');
}

function closePublicDocModal() {
  const modal = document.getElementById('publicDocSuccessModal');
  if (modal) {
    modal.classList.add('hidden');
    modal.classList.remove('flex');
  }
}

function viewApplicationInTracker() {
  closePublicDocModal();
  const trackerSection = document.getElementById('tracker-section');
  if (trackerSection) {
    trackerSection.scrollIntoView({ behavior: 'smooth' });
  }
  const input = document.getElementById('trackingInput');
  if (input) {
    input.value = lastGeneratedRef;
    performPublicTracking();
  }
}

function performPublicTracking() {
  const input = document.getElementById('trackingInput');
  const ref = input ? input.value.trim() : '';

  if (!ref) {
    showToast('Please enter an Application Reference Number', 'warning');
    return;
  }

  const container = document.getElementById('trackingResultContainer');
  const refDisplay = document.getElementById('trackRefNo');
  
  if (container) {
    container.classList.remove('hidden');
    if (refDisplay) refDisplay.textContent = ref.toUpperCase();
    showToast(`Tracking status loaded for ${ref.toUpperCase()}`, 'info');
  }
}

function loadSampleTracking(sampleRef) {
  const input = document.getElementById('trackingInput');
  if (input) {
    input.value = sampleRef;
    performPublicTracking();
  }
}

function openCitizenHelpdesk() {
  showToast("Dacutan AI Citizen Helpdesk is active. Type your inquiry in the assistant or call (033) 396-1024.", "info");
}

// Auto-initialize PST clock on load
document.addEventListener('DOMContentLoaded', initPstClock);

window.showToast = showToast;
window.openModal = openModal;
window.closeModal = closeModal;
window.printCertificate = printCertificate;
window.initPstClock = initPstClock;
window.selectServiceForRequest = selectServiceForRequest;
window.updateFeePreview = updateFeePreview;
window.handlePublicDocSubmission = handlePublicDocSubmission;
window.closePublicDocModal = closePublicDocModal;
window.viewApplicationInTracker = viewApplicationInTracker;
window.performPublicTracking = performPublicTracking;
window.loadSampleTracking = loadSampleTracking;
window.openCitizenHelpdesk = openCitizenHelpdesk;

