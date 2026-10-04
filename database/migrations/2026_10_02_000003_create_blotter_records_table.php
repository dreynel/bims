<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('blotter_records', function (Blueprint $table) {
            $table->id();
            $table->string('case_no')->unique(); // e.g. BLT-2026-001
            $table->string('complainant_name');
            $table->string('complainant_address')->nullable();
            $table->string('complainant_contact')->nullable();
            $table->string('respondent_name');
            $table->string('respondent_address')->nullable();
            $table->string('incident_type'); // Boundary Dispute, Noise Complaint, Physical Injury, Livestock Damage, etc.
            $table->string('incident_location');
            $table->dateTime('incident_date');
            $table->text('narrative');
            $table->enum('status', ['Pending', 'In Mediation', 'Settled', 'Referred to PNP', 'Dismissed'])->default('Pending');
            $table->string('presiding_officer')->nullable();
            $table->dateTime('hearing_date')->nullable();
            $table->text('resolution_details')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('blotter_records');
    }
};
