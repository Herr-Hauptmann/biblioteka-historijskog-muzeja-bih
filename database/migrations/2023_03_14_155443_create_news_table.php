<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Delete files if migrations were not downed correctly
        $files = Storage::disk('local')->allFiles('public/news');
        Storage::delete($files);

        //Create the table
        Storage::makeDirectory("public/news");
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description');
            $table->mediumText('article');
            $table->string('image_path');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('news');
        // Delete Files
        $files = Storage::disk('local')->allFiles('news');
        Storage::delete($files);
    }
};
