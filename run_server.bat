@echo off
title BIMS Barangay Dacutan - Laravel Server
echo ========================================================
echo   Barangay Dacutan Information Management System (BIMS)
echo   Dumangas, Iloilo - Capstone Web Application
echo   Powered by PHP Laravel 12 & MySQL 8.0
echo ========================================================
echo.
echo [1/2] Verifying database connection...
php artisan test --filter test_the_application_returns_a_successful_response
echo.
echo [2/2] Launching BIMS application server...
echo.
echo Public Citizen Portal: http://127.0.0.1:8000
echo Staff Admin Terminal:  http://127.0.0.1:8000/login
echo.
echo Press Ctrl+C to terminate the server.
echo ========================================================
echo.
php artisan serve --port=8000
pause
