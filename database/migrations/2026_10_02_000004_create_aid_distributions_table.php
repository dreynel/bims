<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('aid_distributions', function (Blueprint $table) {
            $table->id();
            $table->string('program_name'); // e.g. LGU Dumangas Coastal Typhoon Relief, Senior Citizen Financial Assistance
            $table->date('distribution_date');
            $table->foreignId('resident_id')->nullable()->constrained('residents')->onDelete('cascade');
            $table->string('beneficiary_name');
            $table->string('purok')->nullable();
            $table->string('assistance_type'); // Cash Stipend, Food Pack & Water, Medical Supplies, Rice & Fertilizer
            $table->string('amount_or_quantity');
            $table->enum('status', ['Claimed', 'Pending', 'Unclaimed'])->default('Claimed');
            $table->string('distributor_name')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('aid_distributions');
    }
};
