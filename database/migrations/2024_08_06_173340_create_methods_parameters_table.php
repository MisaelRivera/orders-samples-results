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
        Schema::create('methods_parameters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('method_id_foreign')->references('method_id')->on('methods');
            $table->foreignId('parameter_id_foreign')->references('parameter_id')->on('parameters');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('methods_parameters');
    }
};
