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
        Schema::create('website_content', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->json("nav")->nullable();
            $table->json("hero")->nullable();
            $table->json("cta")->nullable();
            $table->json("service")->nullable();
            $table->json("membership")->nullable();
            $table->json("testimony")->nullable();
            $table->json("footer")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('website_content');
    }
};
