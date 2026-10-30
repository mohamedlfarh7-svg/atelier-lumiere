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
        Schema::create('boules_de_neige', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('tag', ['Grand', 'Moyen', 'Petite'])->nullable();
            $table->decimal('price', 8, 2);
            $table->string('image');
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('boule_de_neiges');
    }
};
