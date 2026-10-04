<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Resident;
use App\Models\Certificate;
use App\Models\BlotterRecord;
use App\Models\AidDistribution;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. DEFAULT OFFICIAL USERS
        User::create([
            'name' => 'Hon. Roberto D. Dacutan',
            'email' => 'captain.dacutan@dumangas.gov.ph',
            'username' => 'captain',
            'password' => Hash::make('dacutan2026'),
            'role' => 'captain',
            'avatar' => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?auto=format&fit=crop&w=150&q=80',
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Mrs. Ma. Elena Balleza',
            'email' => 'sec.fernandez@dumangas.gov.ph',
            'username' => 'secretary',
            'password' => Hash::make('sec2026'),
            'role' => 'secretary',
            'avatar' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&w=150&q=80',
            'email_verified_at' => now(),
        ]);

        $uResident = User::create([
            'name' => 'Juan Dela Cruz Dacutan',
            'email' => 'juan.dacutan@gmail.com',
            'username' => 'resident',
            'password' => Hash::make('resident2026'),
            'role' => 'resident',
            'avatar' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=150&q=80',
            'email_verified_at' => now(),
        ]);

        // 2. RESIDENTS SEED DATA
        $r1 = Resident::create([
            'user_id' => $uResident->id,
            'resident_id' => 'DAC-2026-0001',
            'first_name' => 'Juan',
            'middle_name' => 'Dela Cruz',
            'last_name' => 'Dacutan',
            'suffix' => '',
            'gender' => 'Male',
            'birth_date' => '1962-04-12',
            'civil_status' => 'Married',
            'purok' => 'Purok 1',
            'address' => 'Main Road, Brgy. Dacutan',
            'contact_no' => '09171234567',
            'email' => 'juan.dacutan@gmail.com',
            'occupation' => 'Rice Farmer',
            'monthly_income' => 8500.00,
            'voter_status' => 'Registered',
            'voter_precinct' => '0012A',
            'is_senior' => true,
            'is_pwd' => false,
            'is_indigent' => true,
            'is_4ps' => true,
            'is_solo_parent' => false,
            'id_type' => 'PhilSys National ID',
            'id_number' => '1234-5678-9012-3456',
            'id_photo' => 'https://images.unsplash.com/photo-1544717305-2782549b5136?auto=format&fit=crop&w=300&q=80',
            'proof_of_residency' => 'https://images.unsplash.com/photo-1589829545856-d10d557cf95f?auto=format&fit=crop&w=300&q=80',
            'verification_status' => 'Verified',
            'verification_remarks' => 'Identity and Barangay residency verified by Secretary Mrs. Ma. Elena Balleza.',
            'photo' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=200&q=80'
        ]);

        $r2 = Resident::create([
            'resident_id' => 'DAC-2026-0002',
            'first_name' => 'Ma. Teresa',
            'middle_name' => 'Solis',
            'last_name' => 'Balleza',
            'suffix' => '',
            'gender' => 'Female',
            'birth_date' => '1985-09-18',
            'civil_status' => 'Married',
            'purok' => 'Purok 3',
            'address' => 'Coastal Zone, Brgy. Dacutan',
            'contact_no' => '09198881234',
            'email' => 'teresa.balleza@gmail.com',
            'occupation' => 'Public School Teacher',
            'monthly_income' => 27000.00,
            'voter_status' => 'Registered',
            'voter_precinct' => '0014B',
            'is_senior' => false,
            'is_pwd' => false,
            'is_indigent' => false,
            'is_4ps' => false,
            'is_solo_parent' => false,
            'photo' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=200&q=80'
        ]);

        $r3 = Resident::create([
            'resident_id' => 'DAC-2026-0003',
            'first_name' => 'Ramon',
            'middle_name' => 'Gonzales',
            'last_name' => 'Bautista',
            'suffix' => 'Jr.',
            'gender' => 'Male',
            'birth_date' => '1988-11-03',
            'civil_status' => 'Single',
            'purok' => 'Purok 2',
            'address' => 'Riverside St., Brgy. Dacutan',
            'contact_no' => '09205551234',
            'email' => 'ramon.bautista@gmail.com',
            'occupation' => 'Fisherman',
            'monthly_income' => 7200.00,
            'voter_status' => 'Registered',
            'voter_precinct' => '0012B',
            'is_senior' => false,
            'is_pwd' => true,
            'is_indigent' => true,
            'is_4ps' => true,
            'is_solo_parent' => false,
            'photo' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=200&q=80'
        ]);

        $r4 = Resident::create([
            'resident_id' => 'DAC-2026-0004',
            'first_name' => 'Elena',
            'middle_name' => 'Palma',
            'last_name' => 'Villanueva',
            'suffix' => '',
            'gender' => 'Female',
            'birth_date' => '1980-02-14',
            'civil_status' => 'Widowed',
            'purok' => 'Sitio Ilawod',
            'address' => 'Lower Ilawod, Brgy. Dacutan',
            'contact_no' => '09993334444',
            'email' => 'elena.villanueva@gmail.com',
            'occupation' => 'Sari-sari Store Owner',
            'monthly_income' => 12000.00,
            'voter_status' => 'Registered',
            'voter_precinct' => '0015A',
            'is_senior' => false,
            'is_pwd' => false,
            'is_indigent' => false,
            'is_4ps' => false,
            'is_solo_parent' => true,
            'photo' => 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?auto=format&fit=crop&w=200&q=80'
        ]);

        $r5 = Resident::create([
            'resident_id' => 'DAC-2026-0005',
            'first_name' => 'Pedro',
            'middle_name' => 'Alcantara',
            'last_name' => 'Demaisip',
            'suffix' => '',
            'gender' => 'Male',
            'birth_date' => '1955-09-30',
            'civil_status' => 'Married',
            'purok' => 'Purok 4',
            'address' => 'Zone 4, Brgy. Dacutan',
            'contact_no' => '09124445555',
            'email' => '',
            'occupation' => 'Retired Barangay Tanod',
            'monthly_income' => 5000.00,
            'voter_status' => 'Registered',
            'voter_precinct' => '0013A',
            'is_senior' => true,
            'is_pwd' => false,
            'is_indigent' => true,
            'is_4ps' => false,
            'is_solo_parent' => false,
            'photo' => 'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?auto=format&fit=crop&w=200&q=80'
        ]);

        $r6 = Resident::create([
            'resident_id' => 'DAC-2026-0006',
            'first_name' => 'Mark Anthony',
            'middle_name' => 'Defensor',
            'last_name' => 'Perez',
            'suffix' => '',
            'gender' => 'Male',
            'birth_date' => '2003-07-22',
            'civil_status' => 'Single',
            'purok' => 'Purok 5',
            'address' => 'Sitio Ilaya, Brgy. Dacutan',
            'contact_no' => '09287778899',
            'email' => 'mark.perez@gmail.com',
            'occupation' => 'Recent College Graduate',
            'monthly_income' => 0.00,
            'voter_status' => 'Registered',
            'voter_precinct' => '0016B',
            'is_senior' => false,
            'is_pwd' => false,
            'is_indigent' => true,
            'is_4ps' => true,
            'is_solo_parent' => false,
            'photo' => 'https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?auto=format&fit=crop&w=200&q=80'
        ]);

        // 3. CERTIFICATES & REQUESTS SEED DATA
        Certificate::create([
            'control_no' => 'CLR-2026-08001',
            'resident_id' => $r1->id,
            'citizen_name' => $r1->full_name,
            'contact_no' => $r1->contact_no,
            'purok' => $r1->purok,
            'doc_type' => 'Barangay Clearance',
            'purpose' => 'Local Employment & Postal ID Requirement',
            'ctc_no' => 'CTC-2026-08144',
            'or_no' => 'OR-2026-9981',
            'amount_paid' => 50.00,
            'status' => 'Ready for Release',
            'issued_by' => 'Mrs. Ma. Elena Balleza',
            'issue_date' => '2026-09-19',
        ]);

        Certificate::create([
            'control_no' => 'DAC-2026-0042',
            'resident_id' => $r1->id,
            'citizen_name' => $r1->full_name,
            'contact_no' => $r1->contact_no,
            'email' => $uResident->email,
            'purok' => $r1->purok,
            'doc_type' => 'Barangay Clearance',
            'purpose' => 'Local Employment & Postal ID',
            'ctc_no' => 'CTC-2026-08144',
            'or_no' => 'OR-2026-9981',
            'amount_paid' => 50.00,
            'status' => 'Ready for Release',
            'issued_by' => 'Mrs. Ma. Elena Balleza',
            'issue_date' => '2026-09-19',
            'remarks' => 'Clerical check passed. Document printed & dry-sealed. Ready for pickup at Window 1.',
        ]);

        Certificate::create([
            'control_no' => 'DAC-2026-0045',
            'resident_id' => $r1->id,
            'citizen_name' => $r1->full_name,
            'contact_no' => $r1->contact_no,
            'email' => $uResident->email,
            'purok' => $r1->purok,
            'doc_type' => 'Certificate of Residency',
            'purpose' => 'Bank Account Opening & Proof of Address',
            'ctc_no' => 'CTC-2026-08144',
            'or_no' => 'OR-2026-8812',
            'amount_paid' => 50.00,
            'status' => 'Claimed',
            'issued_by' => 'Hon. Roberto D. Dacutan',
            'issue_date' => '2026-09-15',
            'remarks' => 'Released to resident at Barangay Hall Window 1 upon identity verification.',
        ]);

        Certificate::create([
            'control_no' => 'DAC-2026-0046',
            'resident_id' => $r1->id,
            'citizen_name' => $r1->full_name,
            'contact_no' => $r1->contact_no,
            'email' => $uResident->email,
            'purok' => $r1->purok,
            'doc_type' => 'Certificate of Indigency',
            'purpose' => 'DSWD Educational Assistance & Medical Subsidies',
            'ctc_no' => null,
            'or_no' => 'EXEMPT-RA',
            'amount_paid' => 0.00,
            'status' => 'Pending',
            'issued_by' => null,
            'issue_date' => null,
            'remarks' => 'Application filed via Resident Portal. Queued for clerical verification.',
        ]);

        Certificate::create([
            'control_no' => 'DAC-2026-0043',
            'resident_id' => $r3->id,
            'citizen_name' => $r3->full_name,
            'contact_no' => $r3->contact_no,
            'purok' => $r3->purok,
            'doc_type' => 'Certificate of Indigency',
            'purpose' => 'Medical Assistance at Western Visayas Medical Center (WVMC)',
            'ctc_no' => null,
            'or_no' => 'EXEMPT',
            'amount_paid' => 0.00,
            'status' => 'Evaluated',
            'issued_by' => 'Mrs. Ma. Elena Balleza',
            'issue_date' => '2026-09-19',
        ]);

        Certificate::create([
            'control_no' => 'DAC-2026-0044',
            'resident_id' => $r6->id,
            'citizen_name' => $r6->full_name,
            'contact_no' => $r6->contact_no,
            'purok' => $r6->purok,
            'doc_type' => 'First Time Job Seeker (RA 11261)',
            'purpose' => 'First-time job application requirement (RA 11261 Fee Exemption)',
            'ctc_no' => null,
            'or_no' => 'RA-11261',
            'amount_paid' => 0.00,
            'status' => 'Pending',
            'issued_by' => null,
            'issue_date' => null,
        ]);

        // 4. BLOTTER RECORDS SEED DATA
        BlotterRecord::create([
            'case_no' => 'BLT-2026-004',
            'complainant_name' => 'Pedro Alcantara Demaisip',
            'complainant_address' => 'Purok 4 Rice Fields, Brgy. Dacutan',
            'complainant_contact' => '09124445555',
            'respondent_name' => 'Nonito "Dodoy" Castor',
            'respondent_address' => 'Purok 4, Brgy. Dacutan',
            'incident_type' => 'Property Boundary & Stray Livestock Damage',
            'incident_location' => 'Purok 4 Rice Fields, Dacutan',
            'incident_date' => '2026-09-15 16:30:00',
            'narrative' => 'Complainant alleged that respondent\'s stray cattle grazed and damaged vegetable beds and banana shoots adjacent to the irrigation canal.',
            'status' => 'In Mediation',
            'presiding_officer' => 'Hon. Roberto D. Dacutan',
            'hearing_date' => '2026-10-05 09:00:00',
            'resolution_details' => 'Lupon hearing set for mutual livestock tethering agreement.',
        ]);

        BlotterRecord::create([
            'case_no' => 'BLT-2026-003',
            'complainant_name' => 'Elena Palma Villanueva',
            'complainant_address' => 'Lower Ilawod, Brgy. Dacutan',
            'complainant_contact' => '09993334444',
            'respondent_name' => 'Gerson Tupas',
            'respondent_address' => 'Lower Ilawod, Brgy. Dacutan',
            'incident_type' => 'Late Night Videoke Noise Violation',
            'incident_location' => 'Lower Ilawod, Dacutan',
            'incident_date' => '2026-09-10 23:45:00',
            'narrative' => 'Loud videoke past the 10:00 PM quiet hour ordinance of Dumangas.',
            'status' => 'Settled',
            'presiding_officer' => 'Hon. Arnel B. Defensor',
            'hearing_date' => '2026-09-12 14:00:00',
            'resolution_details' => 'Respondent signed undertaking to abide by curfew hours and respect neighbors.',
        ]);

        // 5. AID DISTRIBUTIONS SEED DATA
        AidDistribution::create([
            'program_name' => 'LGU Coastal Typhoon Calamity Relief & Food Packs',
            'distribution_date' => '2026-09-14',
            'resident_id' => $r1->id,
            'beneficiary_name' => $r1->full_name,
            'purok' => $r1->purok,
            'assistance_type' => 'Emergency Relief Food Pack',
            'amount_or_quantity' => '2 Rice Packs (10kg) + Canned Provisions',
            'status' => 'Claimed',
            'distributor_name' => 'Hon. Roberto D. Dacutan',
        ]);

        AidDistribution::create([
            'program_name' => 'LGU Dumangas Coastal Typhoon Relief',
            'distribution_date' => '2026-09-14',
            'resident_id' => $r3->id,
            'beneficiary_name' => $r3->full_name,
            'purok' => $r3->purok,
            'assistance_type' => 'Food Pack & Water',
            'amount_or_quantity' => '2 Rice Packs + Hygiene Kit',
            'status' => 'Claimed',
            'distributor_name' => 'Hon. Carmen L. Villanueva',
        ]);

        AidDistribution::create([
            'program_name' => 'Barangay Senior Citizen Financial Subsidy',
            'distribution_date' => '2026-09-18',
            'resident_id' => $r5->id,
            'beneficiary_name' => $r5->full_name,
            'purok' => $r5->purok,
            'assistance_type' => 'Cash Stipend',
            'amount_or_quantity' => '₱ 1,500.00',
            'status' => 'Claimed',
            'distributor_name' => 'Mr. Jose Mari Demaisip',
        ]);
    }
}
