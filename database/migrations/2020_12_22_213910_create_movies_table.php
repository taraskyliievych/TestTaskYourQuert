<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('imdb_title_id');
            $table->string('title');
            $table->year('year');
            $table->string('genre');
            $table->integer('duration');
            $table->string('country');
            $table->string('language');
            $table->string('director');
            $table->string('writer');
            $table->string('actors');
            $table->longText('description');
            $table->double('avg_vote');
            $table->integer('votes');
            $table->integer('reviews_from_users');
            $table->integer('reviews_from_critics');
            $table->boolean('is_usa');
            $table->boolean('is_europe');
            $table->boolean('is_top');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movies');
    }
}
