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
        Schema::create('units_parameters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('unit_id_foreign')->references('unit_id')->on('units');
            $table->foreignId('parameter_id_foreign')->references('parameter_id')->on('parameters');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('units_parameters');
    }
};
