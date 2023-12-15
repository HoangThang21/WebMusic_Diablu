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
        Schema::create('nhac', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tennhac');
            $table->string('nhaclink');
            $table->string('imagemusic');
            $table->integer('luotnghe')->default(0);
            $table->timestamps();
            $table->unsignedInteger('album_idnhac');
            // $table->foreign('album_id')->references('id')->on('albums');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nhac');
    }
};