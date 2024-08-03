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
        Schema::create('membership_plans', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->string("title");
            $table->enum("period_type", ["Monthly", "Half Yearly", "Yearly"]);
            $table->decimal("amount", 10, 2);
            $table->enum("status", ["ACTIVE", "INACTIVE"]);
            $table->timestampsTz();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('membership_plans');
    }
};
