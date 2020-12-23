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
            $table->string('title')->nullable();
            $table->integer('year')->nullable();
            $table->string('genre')->nullable();
            $table->integer('duration')->nullable();
            $table->string('country')->nullable();
            $table->string('language')->nullable();
            $table->string('director')->nullable();
            $table->string('writer')->nullable();
            $table->mediumText('actors')->nullable();
            $table->longText('description')->nullable();
            $table->double('avg_vote')->nullable();
            $table->integer('votes')->nullable();
            $table->integer('reviews_from_users')->nullable();
            $table->integer('reviews_from_critics')->nullable();
            $table->boolean('is_usa')->nullable();
            $table->boolean('is_europe')->nullable();
            $table->boolean('is_top')->nullable();
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
