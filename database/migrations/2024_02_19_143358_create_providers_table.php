<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('providers', function (Blueprint $table) {
            $table -> id();

            $table -> string('name');
            $table -> string('store_name');
            $table -> string('nickname');
            $table -> string('address');
            $table -> string('postal_code');
            $table -> string('location');
            $table -> string('municipality');
            $table -> string('state');
            $table -> string('phone_number');

            $table -> timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('providers');
    }
};
