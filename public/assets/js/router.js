/**
 * BIMS Barangay Dacutan - Client-Side SPA Router
 * Handles hash navigation, asynchronous view loading, template caching,
 * view transitions, and route lifecycle hooks.
 */

class SPARouter {
  constructor(options = {}) {
    this.container = document.querySelector(options.containerSelector || '#app-content');
    this.defaultRoute = options.defaultRoute || '/public';
    this.routes = new Map();
    this.viewCache = new Map();
    this.currentRoute = null;
    this.fallbackTemplates = new Map();

    window.addEventListener('hashchange', () => this.handleRouting());
    window.addEventListener('DOMContentLoaded', () => this.handleRouting());
  }

  /**
   * Register a new route definition
   */
  addRoute(path, config) {
    this.routes.set(path, {
      path,
      title: config.title || 'BIMS Dacutan',
      view: config.view,
      onMount: config.onMount || null,
      onDestroy: config.onDestroy || null,
      isPublicPortal: config.isPublicPortal || false
    });
    return this;
  }

  /**
   * Register inline fallback templates (ensures app functions even under file:// protocol)
   */
  registerFallback(path, htmlContent) {
    this.fallbackTemplates.set(path, htmlContent);
    return this;
  }

  /**
   * Get current route path from URL hash
   */
  getHashPath() {
    let hash = window.location.hash || '';
    if (hash.startsWith('#/')) {
      const p = hash.slice(1);
      return (p === '/' || p === '') ? this.defaultRoute : p;
    }
    if (hash.startsWith('#')) {
      const p = hash.slice(1);
      return (!p || p === '/') ? this.defaultRoute : p;
    }
    return this.defaultRoute;
  }

  /**
   * Route navigation handler
   */
  async handleRouting() {
    let path = this.getHashPath();
    if (!path || path === '/' || path === '') {
      path = this.defaultRoute;
    }

    // Ensure the hash in the address bar reflects the path
    if (window.location.hash !== '#' + path) {
      window.location.hash = '#' + path;
      return;
    }

    // Lookup matching route
    const route = this.routes.get(path);

    if (!route) {
      this.renderNotFound(path);
      return;
    }

    // Call onDestroy on previous route
    if (this.currentRoute && typeof this.currentRoute.onDestroy === 'function') {
      try {
        this.currentRoute.onDestroy();
      } catch (err) {
        console.warn('Error in onDestroy hook:', err);
      }
    }

    // Update document title
    document.title = route.title;

    // Load view HTML
    this.showLoading();
    let html = '';

    try {
      html = await this.loadView(route);
    } catch (err) {
      console.warn(`Could not fetch ${route.view}, falling back to template registry`, err);
      html = this.fallbackTemplates.get(path) || this.getGenericErrorView(path, err);
    }

    // Apply view with transition
    this.applyViewTransition(route, html);
  }

  /**
   * Load view HTML from cache or network fetch
   */
  async loadView(route) {
    if (this.viewCache.has(route.view)) {
      return this.viewCache.get(route.view);
    }

    // Attempt fetch
    const response = await fetch(route.view, { cache: 'no-cache' });
    if (!response.ok) {
      throw new Error(`HTTP ${response.status}: Failed to load ${route.view}`);
    }
    const html = await response.text();
    this.viewCache.set(route.view, html);
    return html;
  }

  /**
   * Render view into container with smooth transition
   */
  applyViewTransition(route, html) {
    const render = () => {
      if (!this.container) {
        this.container = document.querySelector('#app-content');
      }
      if (this.container) {
        this.container.innerHTML = html;
        this.container.scrollTop = 0;

        // Add view enter animation
        this.container.classList.remove('view-enter');
        void this.container.offsetWidth; // Trigger reflow
        this.container.classList.add('view-enter');

        // Update layout state (e.g. public portal full-width vs admin layout)
        this.updateLayoutMode(route);

        // Update active nav indicators
        this.updateActiveNavLinks(route.path);

        // Auto close mobile drawer if open
        const sidebar = document.getElementById('sidebar');
        if (sidebar && !sidebar.classList.contains('-translate-x-full') && window.innerWidth < 1024) {
          sidebar.classList.add('-translate-x-full');
        }

        // Call onMount hook
        this.currentRoute = route;
        if (typeof route.onMount === 'function') {
          try {
            route.onMount();
          } catch (err) {
            console.error(`Error in onMount for route ${route.path}:`, err);
          }
        }
      }
    };

    // Use native View Transitions API if supported
    if (document.startViewTransition) {
      document.startViewTransition(() => render());
    } else {
      render();
    }
  }

  /**
   * Update layout mode (e.g., adapt navbar or layout for public portal)
   */
  updateLayoutMode(route) {
    const publicBadge = document.getElementById('publicPortalNavBadge');
    if (publicBadge) {
      if (route.isPublicPortal) {
        publicBadge.classList.add('ring-2', 'ring-blue-500');
      } else {
        publicBadge.classList.remove('ring-2', 'ring-blue-500');
      }
    }
  }

  /**
   * Update active link styling in sidebar
   */
  updateActiveNavLinks(activePath) {
    const navLinks = document.querySelectorAll('.nav-link, [data-route]');
    navLinks.forEach(link => {
      const href = link.getAttribute('href') || link.getAttribute('data-route') || '';
      const targetPath = href.replace(/^#/, '');

      if (targetPath === activePath) {
        link.classList.add('bg-emerald-600/10', 'text-emerald-700', 'font-bold', 'border-l-4', 'border-emerald-600');
        link.classList.remove('text-slate-700', 'font-medium', 'border-l-0');
      } else {
        link.classList.remove('bg-emerald-600/10', 'text-emerald-700', 'font-bold', 'border-l-4', 'border-emerald-600');
        link.classList.add('text-slate-700', 'font-medium');
      }
    });
  }

  /**
   * Display loading state during route change
   */
  showLoading() {
    if (!this.container) return;
    // We only show subtle loading if content is empty
    if (!this.container.innerHTML.trim()) {
      this.container.innerHTML = `
        <div class="flex items-center justify-center min-h-[400px]">
          <div class="flex flex-col items-center gap-3">
            <div class="w-10 h-10 border-4 border-emerald-200 border-t-emerald-700 rounded-full animate-spin"></div>
            <p class="text-xs font-semibold text-slate-500">Loading module...</p>
          </div>
        </div>
      `;
    }
  }

  /**
   * Render 404 page
   */
  renderNotFound(path) {
    if (!this.container) return;
    this.container.innerHTML = `
      <div class="gov-card p-10 rounded-2xl text-center space-y-4 max-w-lg mx-auto my-12">
        <div class="w-16 h-16 rounded-2xl bg-amber-100 border border-amber-300 flex items-center justify-center text-amber-700 mx-auto text-2xl">
          <i class="fa-solid fa-triangle-exclamation"></i>
        </div>
        <h2 class="text-2xl font-extrabold text-slate-900">Module Not Found</h2>
        <p class="text-xs text-slate-500 font-medium leading-relaxed">
          The requested administrative module <code>#${path}</code> could not be located.
        </p>
        <div class="pt-2">
          <a href="#/dashboard" class="px-5 py-2.5 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-xs inline-flex items-center gap-2 shadow-md transition-all">
            <i class="fa-solid fa-house"></i>
            <span>Return to Dashboard</span>
          </a>
        </div>
      </div>
    `;
  }

  /**
   * Generic error view
   */
  getGenericErrorView(path, err) {
    return `
      <div class="gov-card p-8 rounded-2xl text-center space-y-4 max-w-lg mx-auto my-12 border-rose-200">
        <div class="w-14 h-14 rounded-2xl bg-rose-100 border border-rose-300 flex items-center justify-center text-rose-700 mx-auto text-xl">
          <i class="fa-solid fa-circle-exclamation"></i>
        </div>
        <h3 class="text-lg font-bold text-slate-900">Module Loading Error</h3>
        <p class="text-xs text-slate-600 font-medium">Unable to load view for <code>#${path}</code>: ${err.message}</p>
        <div class="pt-2">
          <a href="#/dashboard" class="px-4 py-2 rounded-xl bg-slate-900 text-white text-xs font-bold shadow">Go to Dashboard</a>
        </div>
      </div>
    `;
  }
}

window.SPARouter = SPARouter;

