<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parsers', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('items_in_file');
            $table->integer('changes_in_casts');
            $table->integer('changes_in_countries');
            $table->integer('changes_in_genres');
            $table->integer('changes_in_languages');
            $table->integer('changes_in_movies');
            $table->integer('changes_in_new_movies');
            $table->integer('changes_in_old_movies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parsers');
    }
}
