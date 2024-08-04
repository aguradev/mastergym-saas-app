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
        Schema::create('trainers', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->string("profile")->default("profile.png");
            $table->string("full_name");
            $table->email("email");
            $table->text("address");
            $table->string("phone_number");
            $table->enum("gender", ["Male", "Female"]);
            $table->enum("status", ["ACTIVE", "INACTIVE"]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trainers');
    }
};
