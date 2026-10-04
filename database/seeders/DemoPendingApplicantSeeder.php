<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Resident;

class DemoPendingApplicantSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::firstOrCreate(
            ['email' => 'juan.pending@example.com'],
            [
                'name' => 'Juan Dela Cruz',
                'username' => 'juan_applicant',
                'password' => bcrypt('resident2026'),
                'role' => 'resident',
                'email_verified_at' => now(),
            ]
        );

        Resident::firstOrCreate(
            ['user_id' => $user->id],
            [
                'resident_id' => 'DAC-2026-9001',
                'first_name' => 'Juan',
                'middle_name' => 'Santos',
                'last_name' => 'Dela Cruz',
                'gender' => 'Male',
                'birth_date' => '1995-06-15',
                'civil_status' => 'Single',
                'purok' => 'Purok 1',
                'address' => 'Purok 1, Barangay Dacutan, Dumangas, Iloilo',
                'contact_no' => '09171234567',
                'email' => $user->email,
                'id_type' => 'PhilSys National ID',
                'id_number' => '1234-5678-9012',
                'id_photo' => 'https://images.unsplash.com/photo-1544717305-2782549b5136?auto=format&fit=crop&w=600&q=80',
                'proof_of_residency' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=600&q=80',
                'photo' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=600&q=80',
                'verification_status' => 'Pending Verification',
                'verification_remarks' => 'Submitted online self-registration with attached PhilSys National ID and holding selfie. Awaiting review by Barangay Secretary.',
                'voter_status' => 'Registered',
            ]
        );
    }
}
