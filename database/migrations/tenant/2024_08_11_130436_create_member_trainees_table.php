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
        Schema::create('member_trainees', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->integer("invoice_id")->default(time());
            $table->foreignUuid("user_id")->references("id")->on("tenant_users");
            $table->foreignUuid("membership_id")->references("id")->on("membership_plans");
            $table->timestamp("membership_start_date")->nullable();
            $table->timestamp("membership_expired_date")->nullable();
            $table->text("fitness_goal")->nullable();
            $table->string("file_invoice_upload")->nullable();
            $table->enum("membership_status", ["ACTIVE", "INACTIVE"])->nullable();
            $table->enum("transaction_status", ["PAID", "NEED CONFIRM", "CANCEL", "PENDING"])->default("PENDING");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('member_trainees');
    }
};
