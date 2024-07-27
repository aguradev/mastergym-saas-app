<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('tenants_subscription_lists', function (Blueprint $table) {
            $table->enum("status", ["ACTIVE", "INACTIVE", "SUSPENSED"])->default("ACTIVE");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tenant_subscription_lists', function (Blueprint $table) {
            //
        });
    }
};
