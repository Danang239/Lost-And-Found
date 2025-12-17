<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('notify_claim_via_email')->default(true);
            $table->boolean('notify_claim_status')->default(true);
            $table->boolean('notify_campus_info')->default(false);
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'notify_claim_via_email',
                'notify_claim_status',
                'notify_campus_info',
            ]);
        });
    }
};
