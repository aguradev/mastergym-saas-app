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
        Schema::create('tenant_users', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->string("username")->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->string("first_name");
            $table->string("last_name");
            $table->string("phone_number")->nullable();
            $table->string("profile_url")->default("profile.png");
            $table->timestamp('email_verified_at')->nullable();
            $table->enum("status", ["ACTIVE", "INACTIVE"])->default("ACTIVE");
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenant_users');
    }
};
