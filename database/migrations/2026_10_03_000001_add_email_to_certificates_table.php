<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('certificates') && !Schema::hasColumn('certificates', 'email')) {
            Schema::table('certificates', function (Blueprint $table) {
                $table->string('email')->nullable()->after('contact_no');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('certificates') && Schema::hasColumn('certificates', 'email')) {
            Schema::table('certificates', function (Blueprint $table) {
                $table->dropColumn('email');
            });
        }
    }
};

