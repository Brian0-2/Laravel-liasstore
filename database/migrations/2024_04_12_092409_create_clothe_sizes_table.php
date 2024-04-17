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
        Schema::create('clothes_sizes', function (Blueprint $table) {
            $table->id();

            $table -> foreignId('clothe_id') -> constrained() -> onDelete('cascade');
            $table -> foreignId('size_id') -> constrained() -> onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clothes_sizes');
    }
};
