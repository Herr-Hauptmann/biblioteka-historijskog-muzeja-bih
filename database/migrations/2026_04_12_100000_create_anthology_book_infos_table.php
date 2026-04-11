<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('anthology_book_infos', function (Blueprint $table) {
            $table->id();
            $table->string('issn')->nullable();
            $table->string('publisher_name')->nullable();
            $table->string('publisher_address')->nullable();
            $table->string('publisher_phone')->nullable();
            $table->string('publisher_email')->nullable();
            $table->string('publisher_website')->nullable();
            $table->string('for_publisher')->nullable();
            $table->text('editorial_reviews')->nullable();
            $table->string('editor_in_chief')->nullable();
            $table->string('managing_editor')->nullable();
            $table->timestamps();
        });

        DB::table('anthology_book_infos')->insert([
            'issn' => '2566 - 3747',
            'publisher_name' => 'Historijski muzej Bosne i Hercegovine',
            'publisher_address' => 'Zmaja od Bosne 5, Sarajevo',
            'publisher_phone' => '+ 387 61 240 850',
            'publisher_email' => 'histmuz@bih.net.ba',
            'publisher_website' => 'www.muzej.ba',
            'for_publisher' => 'Elma Hašimbegović',
            'editorial_reviews' => "Amra Čusto\nJames Gow\nMelisa Forić\nAsja Mandić\nKenneth Morrison\nEdin Radušić",
            'editor_in_chief' => 'Elma Hašimbegović',
            'managing_editor' => 'Elma Hodžić',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('anthology_book_infos');
    }
};
