# Barangay Information Management System (BIMS)
### Barangay Dacutan, Municipality of Dumangas, Province of Iloilo
**Undergraduate Information Technology / Computer Science Capstone Project**

---

## 🏛️ Project Overview
The **Barangay Information Management System (BIMS)** is a full-stack, web-based local governance portal designed to streamline barangay administrative workflows, resident census profiling, online document issuance, dispute mediation (Katarungang Pambarangay), and emergency calamity assistance (Ayuda).

Built in accordance with Philippine local government standards (DILG / Republic Act 7160 - Local Government Code of 1991), the system features an authentic **GovPH aesthetic**, real-time Philippine Standard Time (PST), dual public/admin architecture, and complete data persistence powered by **PHP Laravel** and **MySQL 8.0**.

---

## 🛠️ Technology Stack
- **Backend Framework**: PHP 8.2+ with Laravel 12 (MVC Architecture, Eloquent ORM, Migrations, Seeders)
- **Database**: MySQL 8.0 (`root` / `007622`, Database: `bims_dacutan`)
- **Frontend / Styling**: Tailwind CSS, FontAwesome 6 Icons, Custom GovPH Style System
- **Testing**: PHPUnit / Laravel Test Suite (100% Passing Feature Tests)

---

## 👥 Dual-Portal Architecture

### 1. Citizen Public Landing Portal (`/`)
- **GovPH Masthead**: Displays Philippine national colors, region, and live Philippine Standard Time (PST).
- **Public E-Services**: Online application for Barangay Clearance, Certificate of Indigency, Certificate of Residency, First Time Jobseeker (RA 11261), and Business Clearances.
- **Instant Tracking Code**: Citizen receives unique tracking code (e.g., `DAC-2026-XXXX`) upon form submission, recorded directly to MySQL.
- **Live 4-Stage Status Visualizer**: Citizens can enter their reference number to track processing progress in real time (Submitted -> Evaluated -> Approved -> Ready for Release).
- **Barangay Directory & Hotlines**: MDRRMO Rescue, PNP Dumangas, BHERT/Tanod desk, and council member roster.

### 2. Administrative Command Terminal (`/admin/dashboard`)
- **Executive Dashboard**: Real-time demographic counters (Total Population, Registered Voters, Seniors, PWDs, 4Ps, Indigents, Solo Parents), monthly revenue collections, and incoming citizen request queue.
- **Resident Profiling Directory (`/admin/residents`)**:
  - Full CRUD operations with auto-generated citizen IDs (`DAC-YYYY-XXXX`).
  - Search by name or ID.
  - Multi-filtering by territory (Purok 1–7, Sitio Ilawod, Sitio Ilaya) and sector eligibility (Senior, PWD, 4Ps, Solo Parent, Voter).
  - Modal profiling views and record editors.
- **Certificates & Clearances Desk (`/admin/certificates`)**:
  - Review online citizen requests and issue new clearances.
  - Automatic OR No., CTC Cedula tracking, and fee calculation.
  - **A4 Printable Clearance (`/admin/certificates/{id}/print`)**: Official Philippine Republic document layout with dual seals (Dumangas & Dacutan), council roster sidebar, thumbmark specimen boxes, and official dry seal watermark.
- **Katarungang Pambarangay Blotter (`/admin/blotter`)**:
  - Record disputes (land boundaries, debts, altercations, noise disturbances).
  - Schedule Lupon Tagapamayapa hearing dates.
  - Track mediation statuses (`In Mediation`, `Amicably Settled`, `Referred to PNP`, `Dismissed`).
- **Ayuda & Calamity Relief Distribution (`/admin/aid-distribution`)**:
  - Track relief distributions (DSWD SAP, Typhoon food packs, cash aid, emergency shelter).
  - Filter by program and log disbursements per verified resident.
- **Sign Out Button**:
  - Prominently positioned in the administrative header and sidebar with CSRF protection (`POST /logout`).

---

## 🔑 Default Official Login Accounts

| Role | Official Name | Email / Username | Password |
| :--- | :--- | :--- | :--- |
| **Punong Barangay (Captain)** | Hon. Roberto S. Alen | `captain.dacutan@dumangas.gov.ph` | `dacutan2026` |
| **Barangay Secretary** | Mrs. Ma. Elena Balleza | `sec.fernandez@dumangas.gov.ph` | `sec2026` |
| **Records / Admin Clerk** | Mark Anthony Solis | `clerk.mark@dumangas.gov.ph` | `clerk2026` |

> [!TIP]
> The login page at `/login` includes **1-Click Quick Demo Access** buttons for instant evaluation during your capstone defense.

---

## 🚀 How to Run the System

### Method 1: 1-Click Launch (Recommended for Oral Defense)
Simply double-click:
```powershell
run_server.bat
```
This automatically tests the database connection and launches the web application at:
- Public Citizen Portal: **`http://127.0.0.1:8000`**
- Staff Admin Login: **`http://127.0.0.1:8000/login`**

### Method 2: Manual Terminal Command
```powershell
cd d:\xampp\htdocs\BIMS
php artisan serve
```

### Database Migration & Seeding Shortcut
To refresh the database with fresh test data at any time:
```powershell
setup_database.bat
# OR
php artisan migrate:fresh --seed
```

---

## 🧪 Verification & Automated Tests
To execute the automated capstone test suite covering all 13 core modules:
```powershell
php artisan test --filter BimsCapstoneTest
```
All 13 tests and 45 assertions pass cleanly against MySQL 8.0.

---

## 📌 Scope & Delimitations
- **SMS & Email Notifications**: Non-functional / logged locally as requested, focusing 100% of effort on core governance, records, dispute mediation, and document issuance modules.
- **Database Engine**: Local MySQL 8.0 server (`127.0.0.1:3306`) with user `root` and password `007622`.
