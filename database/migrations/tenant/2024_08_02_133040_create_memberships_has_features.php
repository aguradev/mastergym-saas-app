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
        Schema::create('memberships_has_features', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->foreignUuid("membership_id")->references("id")->on("membership_plans");
            $table->foreignUuid("feature_id")->references("id")->on("membership_plan_features");
            $table->timestampsTz();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('memberships_has_features');
    }
};
