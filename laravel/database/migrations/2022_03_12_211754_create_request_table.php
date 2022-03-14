<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->string('title', '64');
            $table->boolean('traditional_art');
            $table->boolean('digital_art');
            $table->boolean('pixel_art');
            $table->enum('commercial_use', ['yes', 'no']);
            $table->string('descriptions', '64');
            $table->date('start_date');
            $table->date('end_date');
            $table->float('start_price');
            $table->float('end_price');
            $table->bigInteger('genre_id');
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
        Schema::dropIfExists('request');
    }
}
