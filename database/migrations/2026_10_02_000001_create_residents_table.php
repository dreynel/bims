<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('residents', function (Blueprint $table) {
            $table->id();
            $table->string('resident_id')->unique(); // e.g. DAC-2026-0001
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('suffix')->nullable();
            $table->enum('gender', ['Male', 'Female', 'Other'])->default('Male');
            $table->date('birth_date');
            $table->enum('civil_status', ['Single', 'Married', 'Widowed', 'Separated'])->default('Single');
            $table->string('purok'); // Purok 1 to Purok 7, Sitio Ilawod, Sitio Ilaya
            $table->string('address');
            $table->string('contact_no')->nullable();
            $table->string('email')->nullable();
            $table->string('occupation')->nullable();
            $table->decimal('monthly_income', 10, 2)->default(0.00);
            $table->enum('voter_status', ['Registered', 'Not Registered'])->default('Registered');
            $table->string('voter_precinct')->nullable();
            $table->boolean('is_senior')->default(false);
            $table->boolean('is_pwd')->default(false);
            $table->boolean('is_indigent')->default(false);
            $table->boolean('is_4ps')->default(false);
            $table->boolean('is_solo_parent')->default(false);
            $table->string('photo')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('residents');
    }
};
