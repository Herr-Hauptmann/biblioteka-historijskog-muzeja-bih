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
        Schema::table('books', function (Blueprint $table) {
            // Drop unique constraints
            $table->dropUnique(['signature']);
            $table->dropUnique(['inventory_number']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            // Re-add unique constraints in case of rollback
            $table->unique('signature');
            $table->unique('inventory_number');
        });
    }
};
