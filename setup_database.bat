@echo off
title BIMS Dacutan - MySQL 8.0 Database Setup
echo ========================================================
echo   BIMS Dacutan - Fresh Migration & Seed Script
echo   MySQL 8.0: 127.0.0.1:3306 (root/007622)
echo   Database:  bims_dacutan
echo ========================================================
echo.
echo Running migrate:fresh with default capstone officials & records...
php artisan migrate:fresh --seed
echo.
echo ========================================================
echo [SUCCESS] Database migrated and seeded with:
echo  - 3 Roles: Punong Barangay, Brgy Secretary (Clerk), Brgy Residents
echo  - Demographics: Residents, Purok 1-7, OSCA, PWD, 4Ps
echo  - Clearances & Online Document Requests
echo  - Katarungang Pambarangay Blotter disputes
echo  - Calamity & SAP Aid Distributions
echo ========================================================
pause
