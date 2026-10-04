<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PublicPortalController;
use App\Http\Controllers\ResidentPortalController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ResidentController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\BlotterController;
use App\Http\Controllers\AidDistributionController;

// 1. PUBLIC CITIZEN PORTAL ROUTES
Route::get('/', [PublicPortalController::class, 'index'])->name('public.home');
Route::post('/apply-clearance', [PublicPortalController::class, 'submitRequest'])->name('public.apply');
Route::get('/track-document', [PublicPortalController::class, 'trackDocument'])->name('public.track');

// 2. AUTHENTICATION & CITIZEN REGISTRATION ROUTES
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
Route::get('/quick-login/{role}', [AuthController::class, 'quickLogin'])->name('quick.login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// 3. BRGY RESIDENT PORTAL ROUTES (Role 1: resident)
Route::middleware(['auth', 'role:resident'])->prefix('resident')->name('resident.')->group(function () {
    Route::get('/', function () {
        return redirect()->route('resident.dashboard');
    });
    Route::get('/pending-approval', [ResidentPortalController::class, 'pendingApproval'])->name('pending');
    Route::get('/verification-status', [ResidentPortalController::class, 'checkVerificationStatus'])->name('verification.status');
    Route::get('/dashboard', [ResidentPortalController::class, 'dashboard'])->name('dashboard');
    Route::get('/requests', [ResidentPortalController::class, 'requests'])->name('requests');
    Route::get('/requests/{id}/details', [ResidentPortalController::class, 'showRequest'])->name('requests.show');
    Route::post('/apply', [ResidentPortalController::class, 'submitApplication'])->name('apply');
    Route::post('/requests/{id}/cancel', [ResidentPortalController::class, 'cancelApplication'])->name('requests.cancel');
    Route::get('/requests/{id}/claim-stub', [ResidentPortalController::class, 'printClaimStub'])->name('requests.claim-stub');
    Route::get('/profile', [ResidentPortalController::class, 'profile'])->name('profile');
    Route::post('/profile', [ResidentPortalController::class, 'updateProfile'])->name('profile.update');
    Route::get('/aid-history', [ResidentPortalController::class, 'aidHistory'])->name('aid.history');
    Route::get('/help-desk', [ResidentPortalController::class, 'helpDesk'])->name('help');
    Route::get('/certificates/{id}/print', [ResidentPortalController::class, 'printCertificate'])->name('certificates.print');
});

// 4. BARANGAY OFFICIAL ADMIN ROUTES (Role 2: captain [Punong Brgy] & Role 3: secretary [Brgy Secretary & Clerk])
Route::middleware(['auth', 'role:captain,secretary'])->prefix('admin')->name('admin.')->group(function () {
    // Executive Dashboard
    Route::get('/', function () {
        return redirect()->route('admin.dashboard');
    });
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Residents Census Masterlist & Identity Verification Reviews
    Route::resource('residents', ResidentController::class);
    Route::post('/residents/{id}/verify', [ResidentController::class, 'verifyIdentity'])->name('residents.verify');
    Route::post('/residents/{id}/reject-verification', [ResidentController::class, 'rejectIdentity'])->name('residents.reject-verification');

    // Certificates & Clearances (Secretary review & Punong Barangay approval)
    Route::get('/certificates', [CertificateController::class, 'index'])->name('certificates.index');
    Route::post('/certificates', [CertificateController::class, 'store'])->name('certificates.store');
    Route::post('/certificates/{id}/status', [CertificateController::class, 'updateStatus'])->name('certificates.status');
    Route::get('/certificates/{id}/print', [CertificateController::class, 'print'])->name('certificates.print');

    // Katarungang Pambarangay Blotter
    Route::get('/blotter', [BlotterController::class, 'index'])->name('blotter.index');
    Route::post('/blotter', [BlotterController::class, 'store'])->name('blotter.store');
    Route::put('/blotter/{id}', [BlotterController::class, 'update'])->name('blotter.update');

    // Calamity & SAP Aid Distribution
    Route::get('/aid-distribution', [AidDistributionController::class, 'index'])->name('aid.index');
    Route::post('/aid-distribution', [AidDistributionController::class, 'store'])->name('aid.store');
});
