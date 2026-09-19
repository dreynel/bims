# Barangay Information Management System with AI Integration (BIMS-AI)
**Barangay Dacutan, Dumangas, Iloilo**

A modern, responsive web application designed for **Barangay Dacutan, Dumangas, Iloilo**, cleanly divided into a **Public Citizen Side** and an **Administrative Staff Side**.

---

## System Architecture: Public Side vs. Admin Side

The system is organized into two distinct entrypoints and folder structures:

```
d:/xampp/htdocs/BIMS/
├── index.html                  # 🌐 PUBLIC SIDE: Citizen Information & Services Portal
├── admin.html                  # 🔒 ADMIN SIDE: Council & Staff Management System (SPA Container)
├── README.md                   # Setup guide and architecture overview
├── views/
│   ├── public/                 # Citizen Views
│   │   └── home.html           # Public Portal (Announcements, Request Clearance, Track Status, Hotlines, AI Helpdesk)
│   └── admin/                  # Administrative Views (Dynamically loaded in admin.html)
│       ├── dashboard.html      # Executive Demographic Analytics & AI Alerts
│       ├── residents.html      # Resident Records & Registration Modals
│       ├── certificates.html   # E-Clearance Generator with Live Printable A4 Preview
│       ├── blotter.html        # Katarungang Pambarangay Incident Log & AI Advice
│       ├── aid-distribution.html# Calamity & SAP Relief Logistics
│       └── ai-assistant.html   # Dacutan AI Copilot Interactive Workspace
├── assets/
│   ├── css/
│   │   └── style.css           # Government theme styling, print rules & SPA transitions
│   ├── js/
│   │   ├── app.js              # Application bootstrap & route controller registry
│   │   ├── router.js           # Dynamic SPA router (hash navigation & template cache)
│   │   ├── main.js             # Global UI utilities (toasts, modal dialogs, drawer)
│   │   ├── mockData.js         # Realistic Dacutan population dataset
│   │   ├── charts.js           # Chart.js analytics with safe lifecycle cleanup
│   │   └── ai-copilot.js       # AI NLP simulation and response engine
│   └── images/
│       └── logo.svg            # Official Barangay Dacutan SVG Seal
└── database/
    └── schema.sql              # MySQL relational database schema and seed records
```

---

## Portals & Routing

### 1. Public Citizen Side (`index.html`)
- **URL**: `http://localhost/BIMS/` or `index.html`
- **Target Audience**: Citizens, residents, and visitors.
- **Features**:
  - Community announcements & bulletins.
  - Online barangay document & clearance application form.
  - Live clearance control number status tracking.
  - 24/7 Emergency hotlines directory.
  - Dacutan AI Citizen Helpdesk chatbot.
  - Direct **Staff Admin Portal** button linking to `admin.html`.

### 2. Admin Side (`admin.html`)
- **URL**: `http://localhost/BIMS/admin.html`
- **Target Audience**: Punong Barangay, Barangay Secretary, Treasurer, Kagawads, and Lupon.
- **Features**:
  - Persistent administrative sidebar with mobile toggle drawer.
  - Single Page Application (SPA) dynamic loading for all admin modules.
  - **Exit to Public Site** button linking back to `index.html`.
  - Routes:
    - `admin.html#/dashboard` (Executive Dashboard & Demographic Charts)
    - `admin.html#/residents` (Resident Database & Registration)
    - `admin.html#/certificates` (E-Clearance Generator & Printable Preview)
    - `admin.html#/blotter` (KP Dispute Log & AI Conciliation Advice)
    - `admin.html#/aid-distribution` (Disaster Relief & SAP Allocation)
    - `admin.html#/ai-assistant` (Full Dacutan AI Copilot Workspace)

---

## How to View Locally

1. Launch **XAMPP Control Panel** and start **Apache** (and **MySQL** when ready).
2. Open your browser:
   - For citizens: `http://localhost/BIMS/` (opens the **Public Side**).
   - For officials: `http://localhost/BIMS/admin.html` (opens the **Admin Side**).
