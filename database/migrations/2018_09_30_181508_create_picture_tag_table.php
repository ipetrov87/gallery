<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePictureTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('picture_tag', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('picture_id');
            $table->unsignedInteger('tag_id');
            $table->timestamps();

            $table->foreign('picture_id')
                ->references('id')->on('pictures')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('tag_id')
                ->references('id')->on('tags')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            
            $table->unique(['picture_id', 'tag_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('picture_tag');
    }
}
