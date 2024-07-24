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
        Schema::create('tenants_subscription_lists', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->foreignUuid("tenant_id")->references("id")->on("tenants");
            $table->foreignUuid("invoice_transaction_id")->references("id")->on("tenant_transactions");
            $table->timestampTz("start_date");
            $table->timestampTz("due_date");
            $table->enum("status", ["ACTIVE", "INACTIVE", "SUSPENSED"])->default("ACTIVE");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenant_subscription_lists');
    }
};
