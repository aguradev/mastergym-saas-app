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
            $table->integer("order_id")->default(time());
            $table->string("full_name");
            $table->longText("address");
            $table->string("email")->unique();
            $table->string("phone_number");
            $table->decimal("total", 10, 2);
            $table->decimal("tax", 10, 2);
            $table->enum("period_type", ["Monthly", "Yearly"]);
            $table->enum("payment_type", ["manual_transfer", "payment_gateway"]);
            $table->text("payment_gateway_url")->nullable();
            $table->text("transaction_token_access")->nullable();
            $table->enum("status", ["REGISTERED", "PENDING", "PAID", "NEED CONFIRM", "EXPIRED"]);
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
