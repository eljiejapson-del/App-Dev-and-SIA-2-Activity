<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('platform');
            $table->integer('year_released');
            $table->enum('condition', ['Mint', 'Good', 'Fair', 'Poor'])->default('Good');
            $table->string('image')->nullable(); // For the Bonus Image Upload
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};