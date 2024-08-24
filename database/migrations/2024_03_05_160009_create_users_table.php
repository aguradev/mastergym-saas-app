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
        Schema::create('central_users', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->string("username")->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->string("first_name");
            $table->string("last_name");
            $table->string("profile_url")->default("profile.png");
            $table->string("bio");
            $table->rememberToken();
            $table->timestamp('email_verified_at')->nullable();
            $table->enum("status", ["ACTIVE", "INACTIVE"])->default("ACTIVE");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('central_users');
    }
};
