<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArtistImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artist__images', function (Blueprint $table) {
            $table->id();
                // declaring attributes before assigning it to a foreign key
                $table->bigInteger('user_id')->unsigned();
                $table->bigInteger('image_id')->unsigned();
                $table->timestamps();
                // assign foreign keys to the bigIntergers
                $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('restrict');
                $table->foreign('image_id')->references('id')->on('images')->onUpdate('cascade')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('artist__images');
    }
}
