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
        Schema::create('tenant_subscription_plan', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->string("name");
            $table->enum("status", ["ACTIVE", "ARCHIVE", "DEACTIVED"])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenant_subscription_plan');
    }
};
