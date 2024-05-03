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
        Schema::create('order_clothes', function (Blueprint $table) {
            $table->id();

            $table -> foreignId('order_id') ->constrained() -> onDelete('cascade');
            $table -> foreignId('clothe_id') ->constrained() -> onDelete('cascade');
            $table -> integer('amount_total');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_clothes');
    }
};
