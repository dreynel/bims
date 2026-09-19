/**
 * BIMS Barangay Dacutan - Analytics & Chart.js Configurator (Light Theme)
 * Equipped with SPA lifecycle memory cleanup and safe canvas re-instantiation.
 */

const DashboardCharts = {
  instances: {},

  destroyAll() {
    Object.keys(this.instances).forEach(key => {
      if (this.instances[key] && typeof this.instances[key].destroy === 'function') {
        try {
          this.instances[key].destroy();
        } catch (e) {
          console.warn('Error destroying chart:', e);
        }
      }
    });
    this.instances = {};
  },

  init() {
    const chartFontFamily = "'Plus Jakarta Sans', sans-serif";

    // Safely clear any leftover instances
    this.destroyAll();

    // 1. Purok Population Distribution Bar Chart
    const purokCanvas = document.getElementById('purokChart');
    if (purokCanvas) {
      const existing = Chart.getChart(purokCanvas);
      if (existing) existing.destroy();

      this.instances.purok = new Chart(purokCanvas, {
        type: 'bar',
        data: {
          labels: ['Purok 1', 'Purok 2', 'Purok 3', 'Purok 4', 'Purok 5', 'Purok 6', 'Purok 7', 'Sitio Ilawod', 'Sitio Ilaya'],
          datasets: [{
            label: 'Residents Count',
            data: [320, 290, 410, 315, 260, 240, 210, 245, 190],
            backgroundColor: [
              '#047857',
              '#1d4ed8',
              '#d97706',
              '#7e22ce',
              '#db2777',
              '#0d9488',
              '#4f46e5',
              '#0284c7',
              '#ea580c'
            ],
            borderRadius: 8,
            borderWidth: 0
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: { display: false },
            tooltip: {
              backgroundColor: '#1e293b',
              titleColor: '#ffffff',
              bodyColor: '#cbd5e1',
              titleFont: { family: chartFontFamily, size: 13, weight: 'bold' },
              bodyFont: { family: chartFontFamily, size: 12 },
              padding: 10,
              cornerRadius: 8
            }
          },
          scales: {
            x: {
              ticks: { color: '#475569', font: { family: chartFontFamily, size: 11, weight: '600' } },
              grid: { display: false }
            },
            y: {
              ticks: { color: '#475569', font: { family: chartFontFamily, size: 11, weight: '600' } },
              grid: { color: 'rgba(0, 0, 0, 0.06)' }
            }
          }
        }
      });
    }

    // 2. Demographic Vulnerability Breakdown Doughnut Chart
    const demoCanvas = document.getElementById('demographicsChart');
    if (demoCanvas) {
      const existing = Chart.getChart(demoCanvas);
      if (existing) existing.destroy();

      this.instances.demo = new Chart(demoCanvas, {
        type: 'doughnut',
        data: {
          labels: ['Senior Citizens', '4Ps Beneficiaries', 'PWD', 'Indigent Non-4Ps', 'General Population'],
          datasets: [{
            data: [340, 142, 88, 195, 1715],
            backgroundColor: [
              '#d97706', // Gold Senior
              '#059669', // Emerald 4Ps
              '#7e22ce', // Purple PWD
              '#dc2626', // Red Indigent
              '#2563eb'  // Blue General
            ],
            borderWidth: 3,
            borderColor: '#ffffff'
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: {
              position: 'bottom',
              labels: {
                color: '#334155',
                font: { family: chartFontFamily, size: 11, weight: '600' },
                boxWidth: 12,
                padding: 12
              }
            }
          },
          cutout: '65%'
        }
      });
    }

    // 3. Certificates & Clearances Monthly Trend Line Chart (if canvas present)
    const certCanvas = document.getElementById('certTrendChart');
    if (certCanvas) {
      const existing = Chart.getChart(certCanvas);
      if (existing) existing.destroy();

      this.instances.cert = new Chart(certCanvas, {
        type: 'line',
        data: {
          labels: ['Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug'],
          datasets: [
            {
              label: 'Barangay Clearance',
              data: [95, 110, 105, 130, 122, 128],
              borderColor: '#047857',
              backgroundColor: 'rgba(4, 120, 87, 0.1)',
              fill: true,
              tension: 0.4
            },
            {
              label: 'Indigency Certificate',
              data: [45, 60, 55, 80, 75, 92],
              borderColor: '#d97706',
              backgroundColor: 'transparent',
              tension: 0.4
            }
          ]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: {
              position: 'top',
              labels: { color: '#334155', font: { family: chartFontFamily, size: 11, weight: '600' } }
            }
          },
          scales: {
            x: { ticks: { color: '#475569' }, grid: { display: false } },
            y: { ticks: { color: '#475569' }, grid: { color: 'rgba(0, 0, 0, 0.06)' } }
          }
        }
      });
    }
  }
};

// Global backward-compatible wrapper
function initDashboardCharts() {
  DashboardCharts.init();
}

function destroyDashboardCharts() {
  DashboardCharts.destroyAll();
}

window.DashboardCharts = DashboardCharts;
window.initDashboardCharts = initDashboardCharts;
window.destroyDashboardCharts = destroyDashboardCharts;
