<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use Illuminate\Filesystem\Filesystem;

return new class extends Migration
{
    public function up()
    {
        //Delete files if migrations were not downed correctly
        $files = Storage::disk('local')->allFiles('publications');
        Storage::delete($files);

        //Create table
        Storage::disk('local')->makeDirectory('publications');
        Schema::create('publications', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description');
            $table->string('file_path');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('publications');
        // Delete Files
        $files = Storage::disk('local')->allFiles('publications');
        Storage::delete($files);
    }
};
