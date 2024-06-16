<?php

use App\Models\CentralModel\TenantSubscriptionPlan;
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
        Schema::create('tenant_plan_versions', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->foreignIdFor(TenantSubscriptionPlan::class)->references("id")->on("tenant_subscription_plan");
            $table->decimal("price_per_year", 10, 2);
            $table->decimal("price_per_month", 10, 2);
            $table->string("version")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_tenant_plan_version');
    }
};
