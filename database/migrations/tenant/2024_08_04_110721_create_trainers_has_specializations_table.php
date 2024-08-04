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
        Schema::create('trainers_has_specializations', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->foreignUuid("trainer_id")->references("id")->on("trainers");
            $table->foreignUuid("specialist_id")->references("id")->on("trainer_specialists");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trainer_has_specializations');
    }
};
