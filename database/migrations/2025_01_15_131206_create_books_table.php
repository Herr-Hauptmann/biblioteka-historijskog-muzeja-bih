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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('signature')->unique();
            $table->string('title');
            $table->string('publisher')->nullable();
            $table->string('location_published')->nullable();
            $table->integer('year_published')->nullable();
            $table->integer('inventory_number')->unique();
            $table->integer('number_of_units')->default('1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
