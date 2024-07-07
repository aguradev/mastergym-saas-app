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
        Schema::create('tenant_transactions', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->foreignUuid("tenant_plan_id")->references("id")->on("tenant_plan_versions");
            $table->string("full_name");
            $table->string("email")->unique();
            $table->string("phone_number");
            $table->decimal("total", 10, 2);
            $table->decimal("tax", 10, 2);
            $table->enum("status", ["REGISTERED", "PENDING", "PAID", "NEED CONFIRM"]);
            $table->text("transaction_token_access")->nullable();
            $table->timestampTz("transaction_expired_at")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenant_transactions');
    }
};
