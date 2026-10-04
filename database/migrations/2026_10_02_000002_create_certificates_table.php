<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('certificates', function (Blueprint $table) {
            $table->id();
            $table->string('control_no')->unique(); // e.g. DAC-2026-0042 or CLR-2026-08001
            $table->foreignId('resident_id')->nullable()->constrained('residents')->onDelete('set null');
            $table->string('citizen_name');
            $table->string('contact_no')->nullable();
            $table->string('email')->nullable();
            $table->string('purok');
            $table->string('doc_type'); // Barangay Clearance, Certificate of Indigency, Certificate of Residency, First Time Job Seeker (RA 11261), Barangay Business Clearance
            $table->string('purpose');
            $table->string('ctc_no')->nullable();
            $table->string('or_no')->nullable();
            $table->decimal('amount_paid', 8, 2)->default(0.00);
            $table->enum('status', ['Pending', 'Evaluated', 'Approved', 'Ready for Release', 'Claimed', 'Rejected', 'Cancelled'])->default('Pending');
            $table->string('issued_by')->nullable();
            $table->date('issue_date')->nullable();
            $table->date('expiry_date')->nullable();
            $table->text('remarks')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('certificates');
    }
};
