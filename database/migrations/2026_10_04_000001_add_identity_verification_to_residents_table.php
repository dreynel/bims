<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('residents', function (Blueprint $table) {
            if (!Schema::hasColumn('residents', 'user_id')) {
                $table->foreignId('user_id')->nullable()->after('id')->constrained('users')->onDelete('set null');
            }
            if (!Schema::hasColumn('residents', 'id_type')) {
                $table->string('id_type')->nullable()->after('is_solo_parent');
            }
            if (!Schema::hasColumn('residents', 'id_number')) {
                $table->string('id_number')->nullable()->after('id_type');
            }
            if (!Schema::hasColumn('residents', 'id_photo')) {
                $table->string('id_photo')->nullable()->after('id_number');
            }
            if (!Schema::hasColumn('residents', 'proof_of_residency')) {
                $table->string('proof_of_residency')->nullable()->after('id_photo');
            }
            if (!Schema::hasColumn('residents', 'verification_status')) {
                $table->string('verification_status')->default('Pending Verification')->after('proof_of_residency');
            }
            if (!Schema::hasColumn('residents', 'verification_remarks')) {
                $table->text('verification_remarks')->nullable()->after('verification_status');
            }
        });
    }

    public function down(): void
    {
        Schema::table('residents', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn([
                'user_id',
                'id_type',
                'id_number',
                'id_photo',
                'proof_of_residency',
                'verification_status',
                'verification_remarks',
            ]);
        });
    }
};
