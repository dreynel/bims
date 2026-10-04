<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Resident;
use App\Models\Certificate;
use App\Models\BlotterRecord;
use App\Models\AidDistribution;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use App\Mail\CertificateStatusUpdated;

class BimsCapstoneTest extends TestCase
{
    protected $captain;
    protected $secretary;
    protected $residentUser;
    protected $createdTestResident = false;

    protected function setUp(): void
    {
        parent::setUp();
        $this->captain = User::where('role', 'captain')->first();
        $this->secretary = User::where('role', 'secretary')->first();
        
        $this->residentUser = User::where('email', 'juan.dacutan@gmail.com')->first();
        if (!$this->residentUser) {
            $this->residentUser = User::create([
                'name' => 'Juan Dela Cruz Dacutan',
                'email' => 'juan.dacutan@gmail.com',
                'username' => 'resident_juan',
                'password' => bcrypt('resident2026'),
                'role' => 'resident',
                'email_verified_at' => now(),
            ]);
        }

        $res = Resident::where('user_id', $this->residentUser->id)->orWhere('resident_id', 'DAC-2026-0001')->first();
        if (!$res) {
            $res = Resident::create([
                'user_id' => $this->residentUser->id,
                'resident_id' => 'DAC-2026-0001',
                'first_name' => 'Juan',
                'middle_name' => 'Dela Cruz',
                'last_name' => 'Dacutan',
                'gender' => 'Male',
                'birth_date' => '1962-04-12',
                'civil_status' => 'Married',
                'purok' => 'Purok 1',
                'address' => 'Main Road, Brgy. Dacutan',
                'contact_no' => '09171234567',
                'email' => 'juan.dacutan@gmail.com',
                'voter_status' => 'Registered',
                'verification_status' => 'Verified',
            ]);
        } else {
            $res->update([
                'user_id' => $this->residentUser->id,
                'first_name' => 'Juan',
                'middle_name' => 'Dela Cruz',
                'last_name' => 'Dacutan',
                'verification_status' => 'Verified',
            ]);
        }

        if (!Certificate::where('control_no', 'DAC-2026-0042')->exists()) {
            Certificate::create([
                'control_no' => 'DAC-2026-0042',
                'resident_id' => $res->id,
                'citizen_name' => $res->full_name,
                'contact_no' => $res->contact_no,
                'email' => $this->residentUser->email,
                'purok' => $res->purok,
                'doc_type' => 'Barangay Clearance',
                'purpose' => 'Local Employment & Postal ID',
                'amount_paid' => 50.00,
                'status' => 'Ready for Release',
                'issue_date' => '2026-09-19',
            ]);
        }

        if (!AidDistribution::where('program_name', 'LGU Coastal Typhoon Calamity Relief & Food Packs')->exists()) {
            AidDistribution::create([
                'program_name' => 'LGU Coastal Typhoon Calamity Relief & Food Packs',
                'distribution_date' => '2026-09-14',
                'resident_id' => $res->id,
                'beneficiary_name' => $res->full_name,
                'purok' => $res->purok,
                'assistance_type' => 'Emergency Relief Food Pack',
                'amount_or_quantity' => '2 Rice Packs (10kg)',
                'status' => 'Claimed',
            ]);
        }
    }

    /** 1. Public Portal Loading */
    public function test_public_portal_loads_successfully(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('BARANGAY DACUTAN');
        $response->assertSee('Citizen Portal');
    }

    /** 2. Citizen Online Clearance Application */
    public function test_citizen_can_submit_online_clearance_application(): void
    {
        $payload = [
            'first_name' => 'Eduardo',
            'last_name' => 'Villanueva',
            'purok' => 'Purok 5',
            'contact_no' => '0917-889-1122',
            'email' => 'eduardo.v@example.com',
            'doc_type' => 'Barangay Clearance',
            'purpose' => 'Employment Application - Capstone Verification',
        ];

        $response = $this->postJson('/apply-clearance', $payload);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
        ]);

        $data = $response->json();
        $controlNo = $data['control_no'];
        $this->assertNotEmpty($controlNo);

        $this->assertDatabaseHas('certificates', [
            'control_no' => $controlNo,
            'citizen_name' => 'Eduardo Villanueva',
            'purok' => 'Purok 5',
            'status' => 'Pending',
        ]);
    }

    /** 3. Citizen Document Live Tracking */
    public function test_citizen_can_track_application_status(): void
    {
        $cert = Certificate::first();
        $this->assertNotNull($cert);

        $response = $this->get('/track-document?ref=' . $cert->control_no);
        $response->assertStatus(200);
        $response->assertJson([
            'found' => true,
            'control_no' => $cert->control_no,
        ]);
    }

    /** 4. Login Page */
    public function test_official_login_page_renders(): void
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
        $response->assertSee('Single Sign-In Portal');
        $response->assertSee('Hon. Roberto S. Alen');
    }

    /** 5. Quick Demo Authentication */
    public function test_quick_demo_login_authenticates_punong_barangay(): void
    {
        $response = $this->get('/quick-login/captain');
        $response->assertRedirect('/admin/dashboard');
        $this->assertAuthenticatedAs($this->captain);
    }

    /** 6. Admin Executive Dashboard */
    public function test_admin_dashboard_metrics_render_properly(): void
    {
        $response = $this->actingAs($this->captain)->get('/admin/dashboard');
        $response->assertStatus(200);
        $response->assertSee('Executive Dashboard');
        $response->assertSee('Total Population');
        $response->assertSee('Collections');
    }

    /** 7. Resident Directory Index */
    public function test_resident_directory_displays_masterlist(): void
    {
        $response = $this->actingAs($this->captain)->get('/admin/residents');
        $response->assertStatus(200);
        $response->assertSee('Masterlist of Residents');
        $response->assertSee('Register New Resident');
    }

    /** 8. Resident Registration (CRUD Create) */
    public function test_admin_can_register_new_resident(): void
    {
        $newResident = [
            'first_name' => 'Teresa',
            'middle_name' => 'D.',
            'last_name' => 'Montinola',
            'gender' => 'Female',
            'birth_date' => '1992-08-20',
            'civil_status' => 'Married',
            'purok' => 'Purok 3',
            'address' => 'Lot 8, Sunflower St, Purok 3',
            'contact_no' => '0939-555-1234',
            'occupation' => 'Public School Teacher',
            'monthly_income' => 28000.00,
            'voter_status' => 'Registered',
            'voter_precinct' => 'PRECINCT-0015B',
        ];

        $response = $this->actingAs($this->captain)->post('/admin/residents', $newResident);
        $response->assertRedirect('/admin/residents');

        $this->assertDatabaseHas('residents', [
            'first_name' => 'Teresa',
            'last_name' => 'Montinola',
            'purok' => 'Purok 3',
        ]);
    }

    /** 9. Certificates Desk & Issuance */
    public function test_admin_can_issue_official_clearance(): void
    {
        $resident = Resident::first();
        $this->assertNotNull($resident);

        $certPayload = [
            'resident_id' => $resident->id,
            'doc_type' => 'Barangay Clearance',
            'purpose' => 'Philippine Passport Application',
            'amount_paid' => 50.00,
            'issue_date' => date('Y-m-d'),
        ];

        $response = $this->actingAs($this->captain)->post('/admin/certificates', $certPayload);
        $response->assertRedirect('/admin/certificates');

        $this->assertDatabaseHas('certificates', [
            'resident_id' => $resident->id,
            'doc_type' => 'Barangay Clearance',
            'purpose' => 'Philippine Passport Application',
            'amount_paid' => 50.00,
        ]);
    }

    /** 10. Authentic A4 Printable Layout */
    public function test_printable_a4_layout_renders(): void
    {
        $cert = Certificate::first();
        $response = $this->actingAs($this->captain)->get('/admin/certificates/' . $cert->id . '/print');
        $response->assertStatus(200);
        $response->assertSee('Republic of the Philippines');
        $response->assertSee('BARANGAY DACUTAN');
        $response->assertSee('HON. ROBERTO S. ALEN');
    }

    /** 11. Katarungang Pambarangay Blotter Desk */
    public function test_blotter_desk_and_case_filing(): void
    {
        $blotterPayload = [
            'complainant_name' => 'Rolando S. Perez',
            'complainant_address' => 'Purok 2, Dacutan',
            'complainant_contact' => '0917-777-8888',
            'respondent_name' => 'Nestor G. Alcantara',
            'respondent_address' => 'Purok 2, Dacutan',
            'incident_type' => 'Neighborhood Disturbance',
            'incident_location' => 'Purok 2 Residential Area',
            'incident_date' => date('Y-m-d'),
            'narrative' => 'Late night noise disturbance and verbal confrontation regarding vehicle parking blocking pathway.',
            'presiding_officer' => 'Hon. Roberto S. Alen',
            'hearing_date' => date('Y-m-d', strtotime('+3 days')),
        ];

        $response = $this->actingAs($this->captain)->post('/admin/blotter', $blotterPayload);
        $response->assertRedirect('/admin/blotter');

        $this->assertDatabaseHas('blotter_records', [
            'complainant_name' => 'Rolando S. Perez',
            'respondent_name' => 'Nestor G. Alcantara',
            'status' => 'In Mediation',
        ]);
    }

    /** 12. Aid & Relief Distribution Registry */
    public function test_aid_distribution_logging(): void
    {
        $resident = Resident::first();

        $aidPayload = [
            'program_name' => 'Typhoon Relief Calamity Assistance',
            'distribution_date' => date('Y-m-d'),
            'resident_id' => $resident->id,
            'assistance_type' => 'Food Pack / Groceries',
            'amount_or_quantity' => '1 Box (Rice + Canned Goods)',
            'distributor_name' => 'Barangay Dacutan Disaster Relief Team',
        ];

        $response = $this->actingAs($this->captain)->post('/admin/aid-distribution', $aidPayload);
        $response->assertRedirect('/admin/aid-distribution');

        $this->assertDatabaseHas('aid_distributions', [
            'resident_id' => $resident->id,
            'program_name' => 'Typhoon Relief Calamity Assistance',
            'status' => 'Claimed',
        ]);
    }

    /** 13. Two-Tier Approval Hierarchy & Automated Status Email Dispatch */
    public function test_two_tier_clearance_approval_workflow_with_email_notifications(): void
    {
        Mail::fake();

        // Step 1: Citizen submits application
        $citizenPayload = [
            'citizen_name' => 'Maria Santos Balleza',
            'purok' => 'Purok 2',
            'contact_no' => '0918-123-4567',
            'email' => 'maria.balleza@example.com',
            'doc_type' => 'Barangay Clearance',
            'purpose' => 'Overseas Employment Document Review',
        ];

        $submitRes = $this->postJson('/apply-clearance', $citizenPayload);
        $submitRes->assertStatus(200);
        $controlNo = $submitRes->json('control_no');
        $this->assertNotEmpty($controlNo);

        $cert = Certificate::where('control_no', $controlNo)->first();
        $this->assertNotNull($cert);
        $this->assertEquals('Pending', $cert->status);

        // Verification: Initial submission email was sent
        Mail::assertSent(CertificateStatusUpdated::class, function ($mail) use ($cert) {
            return $mail->certificate->control_no === $cert->control_no;
        });

        // Step 2: Tier 1 - Secretary reviews & evaluates application
        $secRes = $this->actingAs($this->secretary)->post("/admin/certificates/{$cert->id}/status", [
            'status' => 'Evaluated',
        ]);
        $secRes->assertSessionHas('success');
        $cert->refresh();
        $this->assertEquals('Evaluated', $cert->status);
        $this->assertStringContainsString('Secretary', $cert->remarks);

        // Step 3: Tier 2 - Punong Barangay grants executive approval
        $captRes = $this->actingAs($this->captain)->post("/admin/certificates/{$cert->id}/status", [
            'status' => 'Approved',
        ]);
        $captRes->assertSessionHas('success');
        $cert->refresh();
        $this->assertEquals('Approved', $cert->status);
        $this->assertStringContainsString('Punong Barangay', $cert->remarks);

        // Step 4: Stamped & Ready for Release
        $readyRes = $this->actingAs($this->secretary)->post("/admin/certificates/{$cert->id}/status", [
            'status' => 'Ready for Release',
        ]);
        $readyRes->assertSessionHas('success');
        $cert->refresh();
        $this->assertEquals('Ready for Release', $cert->status);

        // Step 5: Claimed by Citizen
        $claimRes = $this->actingAs($this->secretary)->post("/admin/certificates/{$cert->id}/status", [
            'status' => 'Claimed',
        ]);
        $claimRes->assertSessionHas('success');
        $cert->refresh();
        $this->assertEquals('Claimed', $cert->status);

        // Verify multiple status emails were dispatched across the workflow
        Mail::assertSent(CertificateStatusUpdated::class, 5);
    }

    /** 14. Document Issuance Across Document Categories and Fees */
    public function test_admin_can_issue_various_document_types_with_correct_fees(): void
    {
        $resident = Resident::first();

        // 1. Fee Exempt: Certificate of Indigency (₱0.00)
        $indigency = [
            'resident_id' => $resident->id,
            'doc_type' => 'Certificate of Indigency',
            'purpose' => 'DSWD Financial / Medical Assistance',
            'amount_paid' => 0.00,
            'issue_date' => date('Y-m-d'),
        ];
        $this->actingAs($this->secretary)->post('/admin/certificates', $indigency);
        $this->assertDatabaseHas('certificates', [
            'doc_type' => 'Certificate of Indigency',
            'amount_paid' => 0.00,
        ]);

        // 2. Business Clearance (₱150.00)
        $business = [
            'resident_id' => $resident->id,
            'doc_type' => 'Barangay Business Clearance',
            'purpose' => 'Dacutan General Merchandise Store',
            'amount_paid' => 150.00,
            'issue_date' => date('Y-m-d'),
        ];
        $this->actingAs($this->secretary)->post('/admin/certificates', $business);
        $this->assertDatabaseHas('certificates', [
            'doc_type' => 'Barangay Business Clearance',
            'amount_paid' => 150.00,
        ]);

        // 3. Building Clearance (₱200.00)
        $building = [
            'resident_id' => $resident->id,
            'doc_type' => 'Barangay Building / Construction Clearance',
            'purpose' => 'Residential House Extension Project',
            'amount_paid' => 200.00,
            'issue_date' => date('Y-m-d'),
        ];
        $this->actingAs($this->secretary)->post('/admin/certificates', $building);
        $this->assertDatabaseHas('certificates', [
            'doc_type' => 'Barangay Building / Construction Clearance',
            'amount_paid' => 200.00,
        ]);
    }

    /** 15. Authentic A4 Printable Layout For Diverse Document Offerings */
    public function test_all_document_offerings_render_in_a4_printable_template(): void
    {
        $resident = Resident::first();

        $docsToTest = [
            'Certificate of Indigency' => 'INDIGENT FAMILY',
            'First Time Job Seeker (RA 11261)' => 'FIRST TIME JOBSEEKER',
            'Certificate of Good Moral Character' => 'GOOD MORAL CHARACTER',
            'Barangay Business Clearance' => 'business clearance is hereby granted',
            'Certificate of No Objection (CNO)' => 'NO OBJECTION',
            'Certification to File Action' => 'NO AMICABLE SETTLEMENT WAS REACHED',
        ];

        foreach ($docsToTest as $docType => $expectedPhrase) {
            $cert = Certificate::create([
                'control_no' => 'TEST-' . date('Y') . '-' . mt_rand(1000, 9999),
                'resident_id' => $resident->id,
                'citizen_name' => $resident->full_name,
                'purok' => $resident->purok,
                'doc_type' => $docType,
                'purpose' => 'Compliance Verification Testing',
                'amount_paid' => 50.00,
                'status' => 'Approved',
                'issue_date' => now()->toDateString(),
            ]);

            $response = $this->actingAs($this->captain)->get('/admin/certificates/' . $cert->id . '/print');
            $response->assertStatus(200);
            $response->assertSee($expectedPhrase);
        }
    }

    /** 16. Quick Demo Login for Resident */
    public function test_quick_demo_login_authenticates_resident_and_redirects_to_resident_portal(): void
    {
        $response = $this->get('/quick-login/resident');
        $response->assertRedirect('/resident/dashboard');
        $this->assertAuthenticatedAs($this->residentUser);
    }

    /** 17. Resident Self-Registration with Identity Verification Documents & Secretary Approval */
    public function test_resident_can_register_on_landing_page_with_identity_verification_documents(): void
    {
        Storage::fake('public');
        $uniq = uniqid();
        $email = "carla_{$uniq}@example.com";
        $username = "carla_{$uniq}";

        $payload = [
            'first_name' => 'Carla',
            'middle_name' => 'Marie',
            'last_name' => 'Divinagracia',
            'suffix' => '',
            'gender' => 'Female',
            'birth_date' => '1998-05-15',
            'civil_status' => 'Single',
            'purok' => 'Purok 4',
            'address' => 'House 42, Purok 4, Brgy Dacutan',
            'contact_no' => '0919-555-8899',
            'email' => $email,
            'username' => $username,
            'password' => 'secret123',
            'password_confirmation' => 'secret123',
            'id_type' => 'PhilSys National ID',
            'id_number' => '9876-5432-1098-7654',
            'id_photo' => UploadedFile::fake()->create('philsys_id.jpg', 100, 'image/jpeg'),
            'proof_of_residency' => UploadedFile::fake()->create('selfie_with_id.jpg', 100, 'image/jpeg'),
            'sworn_statement' => '1',
        ];

        // Step 1: Submit Registration Form (redirects directly to Pending Verification page)
        $response = $this->post('/register', $payload);
        $response->assertRedirect(route('resident.pending'));

        $this->assertDatabaseHas('users', [
            'name' => 'Carla Marie Divinagracia',
            'email' => $email,
            'username' => $username,
            'role' => 'resident',
        ]);

        $this->assertDatabaseHas('residents', [
            'first_name' => 'Carla',
            'last_name' => 'Divinagracia',
            'purok' => 'Purok 4',
            'id_type' => 'PhilSys National ID',
            'id_number' => '9876-5432-1098-7654',
            'verification_status' => 'Pending Verification',
        ]);

        $createdResident = Resident::where('email', $email)->first();
        $this->assertNotNull($createdResident);
        $this->assertEquals('Pending Verification', $createdResident->verification_status);

        // Step 2: Secretary reviews attached ID/selfie and approves verification
        $verifyRes = $this->actingAs($this->secretary)->post("/admin/residents/{$createdResident->id}/verify");
        $verifyRes->assertSessionHas('success');

        $createdResident->refresh();
        $this->assertEquals('Verified', $createdResident->verification_status);
        $this->assertStringContainsString('Secretary', $createdResident->verification_remarks);
    }

    /** 18. Resident Can Apply For Document From Resident Portal */
    public function test_resident_can_apply_for_document_from_resident_dashboard(): void
    {
        $payload = [
            'doc_type' => 'Certificate of Residency',
            'purpose' => 'Bank Account Requirement',
        ];

        $response = $this->actingAs($this->residentUser)->post('/resident/apply', $payload);
        $response->assertRedirect('/resident/dashboard');

        $this->assertDatabaseHas('certificates', [
            'citizen_name' => $this->residentUser->name,
            'doc_type' => 'Certificate of Residency',
            'purpose' => 'Bank Account Requirement',
            'status' => 'Pending',
        ]);
    }

    /** 19. Role Security Boundary: Resident Cannot Access Admin Dashboard */
    public function test_resident_cannot_access_admin_dashboard_due_to_role_boundary(): void
    {
        $response = $this->actingAs($this->residentUser)->get('/admin/dashboard');
        $response->assertRedirect('/resident/dashboard');
        $response->assertSessionHas('error');
    }

    /** 20. Official Can Access Admin Dashboard */
    public function test_official_can_access_admin_dashboard(): void
    {
        $captRes = $this->actingAs($this->captain)->get('/admin/dashboard');
        $captRes->assertStatus(200);

        $secRes = $this->actingAs($this->secretary)->get('/admin/dashboard');
        $secRes->assertStatus(200);
    }

    /** 21. Official Sign Out */
    public function test_user_can_sign_out_of_system(): void
    {
        $response = $this->actingAs($this->captain)->post('/logout');
        $response->assertRedirect('/login');
        $this->assertGuest();
    }

    /** 22. Landing Page Has Single Sign In Button */
    public function test_landing_page_renders_single_sign_in_button(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Sign In');
        $response->assertSee('/login');
    }

    /** 23. Single Sign In Automatically Detects Official Roles */
    public function test_single_sign_in_automatically_detects_official_and_redirects_to_admin_dashboard(): void
    {
        // 1. Captain login
        $captainResponse = $this->post('/login', [
            'login' => $this->captain->email,
            'password' => 'dacutan2026',
        ]);
        $captainResponse->assertRedirect(route('admin.dashboard'));
        $this->assertAuthenticatedAs($this->captain);

        // Sign out
        $this->post('/logout');

        // 2. Secretary login
        $secretaryResponse = $this->post('/login', [
            'login' => $this->secretary->email,
            'password' => 'sec2026',
        ]);
        $secretaryResponse->assertRedirect(route('admin.dashboard'));
        $this->assertAuthenticatedAs($this->secretary);
    }

    /** 24. Single Sign In Automatically Detects Resident Role */
    public function test_single_sign_in_automatically_detects_resident_and_redirects_to_resident_portal(): void
    {
        $residentResponse = $this->post('/login', [
            'login' => $this->residentUser->email,
            'password' => 'resident2026',
        ]);
        $residentResponse->assertRedirect(route('resident.dashboard'));
        $this->assertAuthenticatedAs($this->residentUser);
    }

    /** 25. Secretary Can Reject Identity Verification With Deficiencies */
    public function test_secretary_can_reject_identity_verification_with_remarks(): void
    {
        $uniq = uniqid();
        $pendingUser = User::create([
            'name' => "Applicant {$uniq}",
            'email' => "applicant_{$uniq}@example.com",
            'username' => "app_{$uniq}",
            'password' => bcrypt('secret123'),
            'role' => 'resident',
        ]);

        $pendingResident = Resident::create([
            'user_id' => $pendingUser->id,
            'resident_id' => 'DAC-2026-TEST-' . mt_rand(1000, 9999),
            'first_name' => 'Applicant',
            'last_name' => "Reject {$uniq}",
            'gender' => 'Male',
            'birth_date' => '1995-01-01',
            'civil_status' => 'Single',
            'purok' => 'Purok 1',
            'address' => 'Address 1',
            'email' => $pendingUser->email,
            'id_type' => 'PhilSys National ID',
            'id_number' => '1111-2222',
            'verification_status' => 'Pending Verification',
        ]);

        $response = $this->actingAs($this->secretary)->post("/admin/residents/{$pendingResident->id}/reject-verification", [
            'remarks' => 'Uploaded ID is blurred. Please present physical ID at Window 1.',
        ]);
        $response->assertSessionHas('info');

        $pendingResident->refresh();
        $this->assertEquals('Rejected', $pendingResident->verification_status);
        $this->assertStringContainsString('Uploaded ID is blurred', $pendingResident->verification_remarks);
    }

    /** 26. Secretary Can Approve Pending Resident Identity Verification */
    public function test_secretary_can_approve_pending_resident_identity_verification(): void
    {
        $uniq = uniqid();
        $pendingUser = User::create([
            'name' => "Resident {$uniq}",
            'email' => "resident_{$uniq}@example.com",
            'username' => "res_{$uniq}",
            'password' => bcrypt('secret123'),
            'role' => 'resident',
        ]);

        $pendingResident = Resident::create([
            'user_id' => $pendingUser->id,
            'resident_id' => 'DAC-2026-APPR-' . mt_rand(1000, 9999),
            'first_name' => 'Resident',
            'last_name' => "Approve {$uniq}",
            'gender' => 'Female',
            'birth_date' => '1996-02-02',
            'civil_status' => 'Single',
            'purok' => 'Purok 2',
            'address' => 'Address 2',
            'email' => $pendingUser->email,
            'id_type' => "Driver's License (LTO)",
            'id_number' => 'N02-99-123456',
            'verification_status' => 'Pending Verification',
        ]);

        $response = $this->actingAs($this->secretary)->post("/admin/residents/{$pendingResident->id}/verify");
        $response->assertSessionHas('success');

        $pendingResident->refresh();
        $this->assertEquals('Verified', $pendingResident->verification_status);
    }

    /** 26b. Secretary Cannot Reject Identity Verification Without Providing Remarks */
    public function test_secretary_cannot_reject_verification_without_remarks(): void
    {
        $uniq = uniqid();
        $pendingUser = User::create([
            'name' => "Applicant {$uniq}",
            'email' => "applicant_noremarks_{$uniq}@example.com",
            'username' => "app_nr_{$uniq}",
            'password' => bcrypt('secret123'),
            'role' => 'resident',
        ]);

        $pendingResident = Resident::create([
            'user_id' => $pendingUser->id,
            'resident_id' => 'DAC-2026-VAL-' . mt_rand(1000, 9999),
            'first_name' => 'Applicant',
            'last_name' => "NoRemarks {$uniq}",
            'gender' => 'Male',
            'birth_date' => '1998-05-05',
            'civil_status' => 'Single',
            'purok' => 'Purok 3',
            'address' => 'Address 3',
            'email' => $pendingUser->email,
            'id_type' => 'PhilSys National ID',
            'id_number' => '3333-4444',
            'verification_status' => 'Pending Verification',
        ]);

        $response = $this->actingAs($this->secretary)->post("/admin/residents/{$pendingResident->id}/reject-verification", [
            'remarks' => '',
        ]);
        $response->assertSessionHasErrors('remarks');

        $pendingResident->refresh();
        $this->assertEquals('Pending Verification', $pendingResident->verification_status);
    }

    /** 26c. Admin Can Inspect Full Resident Profile Dossier via AJAX */
    public function test_admin_resident_show_api_returns_dossier_and_documents(): void
    {
        $uniq = uniqid();
        $user = User::create([
            'name' => "Dossier User {$uniq}",
            'email' => "dossier_{$uniq}@example.com",
            'username' => "dos_{$uniq}",
            'password' => bcrypt('secret123'),
            'role' => 'resident',
        ]);

        $resident = Resident::create([
            'user_id' => $user->id,
            'resident_id' => 'DAC-2026-DOS-' . mt_rand(1000, 9999),
            'first_name' => 'Dossier',
            'last_name' => "Inspection {$uniq}",
            'gender' => 'Female',
            'birth_date' => '1990-10-10',
            'civil_status' => 'Single',
            'purok' => 'Purok 4',
            'address' => 'Purok 4 Coastal Road',
            'email' => $user->email,
            'id_type' => 'PhilSys National ID',
            'id_number' => '5555-6666-7777',
            'id_photo' => 'https://example.com/id.jpg',
            'proof_of_residency' => 'https://example.com/selfie.jpg',
            'verification_status' => 'Pending Verification',
        ]);

        $response = $this->actingAs($this->secretary)->get("/admin/residents/{$resident->id}");
        $response->assertStatus(200);
        $response->assertJson([
            'id' => $resident->id,
            'resident_id' => $resident->resident_id,
            'first_name' => 'Dossier',
            'last_name' => "Inspection {$uniq}",
            'id_type' => 'PhilSys National ID',
            'id_number' => '5555-6666-7777',
            'id_photo' => 'https://example.com/id.jpg',
            'proof_of_residency' => 'https://example.com/selfie.jpg',
            'verification_status' => 'Pending Verification',
        ]);
    }

    /** 26d. Secretary Can Re-Approve A Previously Rejected Resident After Correction */
    public function test_secretary_can_reapprove_previously_rejected_resident(): void
    {
        $uniq = uniqid();
        $user = User::create([
            'name' => "Reapprove {$uniq}",
            'email' => "reapprove_{$uniq}@example.com",
            'username' => "reapp_{$uniq}",
            'password' => bcrypt('secret123'),
            'role' => 'resident',
        ]);

        $resident = Resident::create([
            'user_id' => $user->id,
            'resident_id' => 'DAC-2026-REAPP-' . mt_rand(1000, 9999),
            'first_name' => 'Reapprove',
            'last_name' => "Citizen {$uniq}",
            'gender' => 'Male',
            'birth_date' => '1992-03-03',
            'civil_status' => 'Single',
            'purok' => 'Purok 5',
            'address' => 'Address 5',
            'email' => $user->email,
            'id_type' => 'Postal ID',
            'id_number' => 'POST-999',
            'verification_status' => 'Rejected',
            'verification_remarks' => 'Initial photo too dark.',
        ]);

        // Now secretary approves after in-person inspection or correction
        $response = $this->actingAs($this->secretary)->post("/admin/residents/{$resident->id}/verify");
        $response->assertSessionHas('success');

        $resident->refresh();
        $this->assertEquals('Verified', $resident->verification_status);
        $this->assertStringContainsString('approved', strtolower($resident->verification_remarks));
    }

    /** 27. Unverified Resident Is Gated And Redirected To Pending Approval Screen */
    public function test_unverified_resident_is_redirected_to_pending_approval_screen(): void
    {
        $uniq = uniqid();
        $unverifiedUser = User::create([
            'name' => "Unverified {$uniq}",
            'email' => "unverified_{$uniq}@example.com",
            'username' => "unver_{$uniq}",
            'password' => bcrypt('secret123'),
            'role' => 'resident',
        ]);

        $unverifiedResident = Resident::create([
            'user_id' => $unverifiedUser->id,
            'resident_id' => 'DAC-2026-UNV-' . mt_rand(1000, 9999),
            'first_name' => 'Unverified',
            'last_name' => "User {$uniq}",
            'gender' => 'Female',
            'birth_date' => '2000-01-01',
            'civil_status' => 'Single',
            'purok' => 'Purok 3',
            'address' => 'Address 3',
            'email' => $unverifiedUser->email,
            'verification_status' => 'Pending Verification',
        ]);

        // Attempting to access resident dashboard without Secretary verification redirects to pending approval screen
        $response = $this->actingAs($unverifiedUser)->get('/resident/dashboard');
        $response->assertRedirect(route('resident.pending'));

        // Resident can view the pending approval screen
        $pendingViewRes = $this->actingAs($unverifiedUser)->get(route('resident.pending'));
        $pendingViewRes->assertStatus(200);
        $pendingViewRes->assertSee('Awaiting Approval by Barangay Secretary');
        $pendingViewRes->assertSee('Pending Verification');
    }

    /** 28. Resident Can Access Requests Review Menu & Filter By Status */
    public function test_resident_can_access_requests_review_menu_and_filter(): void
    {
        $response = $this->actingAs($this->residentUser)->get(route('resident.requests'));
        $response->assertStatus(200);
        $response->assertSee('My Requests & Clearance Review', false);
        $response->assertSee('All Requests');
        $response->assertSee('Under Review');
        $response->assertSee('Ready for Pickup');
        $response->assertSee('Claimed');

        // Test status filtering
        $filterRes = $this->actingAs($this->residentUser)->get(route('resident.requests', ['status' => 'ready']));
        $filterRes->assertStatus(200);
    }

    /** 29. Resident Can Fetch Request Details JSON For Interactive Review Modal */
    public function test_resident_can_fetch_request_details_json_for_review_modal(): void
    {
        $cert = Certificate::where('email', $this->residentUser->email)->first();
        $this->assertNotNull($cert);

        $response = $this->actingAs($this->residentUser)->get(route('resident.requests.show', $cert->id));
        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'certificate' => [
                'control_no' => $cert->control_no,
                'doc_type' => $cert->doc_type,
            ],
            'timeline' => [
                'submitted' => [
                    'label' => 'Application Filed',
                    'completed' => true,
                ],
            ],
        ]);
    }

    /** 30. Resident Can Cancel A Pending Request */
    public function test_resident_can_cancel_pending_request(): void
    {
        $pendingCert = Certificate::create([
            'control_no' => 'DAC-TEST-CANCEL-' . mt_rand(1000, 9999),
            'email' => $this->residentUser->email,
            'citizen_name' => $this->residentUser->name,
            'purok' => 'Purok 1',
            'doc_type' => 'Certificate of Residency',
            'purpose' => 'Test Cancellation Flow',
            'amount_paid' => 50.00,
            'status' => 'Pending',
        ]);

        $response = $this->actingAs($this->residentUser)->post(route('resident.requests.cancel', $pendingCert->id));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('certificates', [
            'id' => $pendingCert->id,
            'status' => 'Cancelled',
        ]);
    }

    /** 31. Resident Can View And Print Official Claim Stub */
    public function test_resident_can_view_and_print_official_claim_stub(): void
    {
        $cert = Certificate::where('email', $this->residentUser->email)->first();
        $this->assertNotNull($cert);

        $response = $this->actingAs($this->residentUser)->get(route('resident.requests.claim-stub', $cert->id));
        $response->assertStatus(200);
        $response->assertSee('Document Application Claim Stub');
        $response->assertSee($cert->control_no);
        $response->assertSee('Window 1 (Document Releasing Desk)');
    }

    /** 32. Resident Can Access Profile And Update Contact Information */
    public function test_resident_can_access_profile_and_update_contact_information(): void
    {
        $response = $this->actingAs($this->residentUser)->get(route('resident.profile'));
        $response->assertStatus(200);
        $response->assertSee('My Resident Profile & Identity Records', false);
        $response->assertSee('Digital Barangay Citizen Card', false);

        $updateResponse = $this->actingAs($this->residentUser)->post(route('resident.profile.update'), [
            'contact_no' => '0919-888-7766',
            'address' => 'Updated Home Address, Purok 1, Brgy Dacutan',
        ]);
        $updateResponse->assertSessionHas('success');

        $this->assertDatabaseHas('residents', [
            'user_id' => $this->residentUser->id,
            'contact_no' => '0919-888-7766',
            'address' => 'Updated Home Address, Purok 1, Brgy Dacutan',
        ]);
    }

    /** 33. Resident Can View Aid & Relief Distribution Registry */
    public function test_resident_can_view_aid_and_relief_history(): void
    {
        $response = $this->actingAs($this->residentUser)->get(route('resident.aid.history'));
        $response->assertStatus(200);
        $response->assertSee('Aid & Relief Distribution Registry', false);
        $response->assertSee('LGU Coastal Typhoon Calamity Relief');
    }

    /** 34. Resident Can Access Help Desk & Services Directory */
    public function test_resident_can_access_help_desk_and_services_directory(): void
    {
        $response = $this->actingAs($this->residentUser)->get(route('resident.help'));
        $response->assertStatus(200);
        $response->assertSee('Barangay Directory & Citizen Service Guide', false);
        $response->assertSee('Window 1: Document Processing & Releasing', false);
        $response->assertSee('24/7 Emergency & Public Safety Hotlines', false);
    }

    /** 35. Resident Can Poll Live Verification Status Via AJAX */
    public function test_resident_can_poll_verification_status_via_ajax(): void
    {
        $unique = uniqid();
        $email = "polling.{$unique}@example.com";
        $username = "poll_{$unique}";

        $unverifiedUser = User::create([
            'name' => 'Polling Test Resident',
            'email' => $email,
            'username' => $username,
            'role' => 'resident',
            'password' => bcrypt('password123'),
        ]);

        $resRecord = Resident::create([
            'user_id' => $unverifiedUser->id,
            'resident_id' => "DAC-POLL-{$unique}",
            'first_name' => 'Polling',
            'last_name' => 'Resident',
            'gender' => 'Male',
            'birth_date' => '1995-05-15',
            'civil_status' => 'Single',
            'purok' => 'Purok 2',
            'address' => 'Zone 2, Barangay Dacutan',
            'contact_no' => '0918-111-2222',
            'email' => $email,
            'id_type' => 'PhilSys ID',
            'id_number' => "PS-{$unique}",
            'verification_status' => 'Pending Verification',
        ]);

        // Status is pending
        $pollRes = $this->actingAs($unverifiedUser)->getJson(route('resident.verification.status'));
        $pollRes->assertStatus(200);
        $pollRes->assertJson([
            'success' => true,
            'status' => 'Pending Verification',
            'is_verified' => false,
            'is_rejected' => false,
        ]);

        // Secretary approves
        $this->actingAs($this->secretary)->post(route('admin.residents.verify', $resRecord->id));

        // Status changes to verified
        $pollResAfter = $this->actingAs($unverifiedUser)->getJson(route('resident.verification.status'));
        $pollResAfter->assertStatus(200);
        $pollResAfter->assertJson([
            'success' => true,
            'status' => 'Verified',
            'is_verified' => true,
            'is_rejected' => false,
            'redirect' => route('resident.dashboard'),
        ]);

        $resRecord->delete();
        $unverifiedUser->delete();
    }
}
