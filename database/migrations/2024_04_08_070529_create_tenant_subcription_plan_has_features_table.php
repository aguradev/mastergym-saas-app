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
        Schema::create('tenant_subcription_plan_has_features', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->foreignUuid("subscription_plan_id")->references("id")->on("tenant_subscription_plan");
            $table->foreignUuid("feature_plan_id")->references("id")->on("tenant_plan_features");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenant_subcription_plan_has_features');
    }
};
