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
            $table->integer('changes_in_casts')->default(0);
            $table->integer('changes_in_countries')->default(0);
            $table->integer('changes_in_genres')->default(0);
            $table->integer('changes_in_languages')->default(0);;
            $table->integer('changes_in_movies')->default(0);
            $table->integer('changes_in_new_movies')->default(0);
            $table->integer('changes_in_old_movies')->default(0);
            $table->integer('parse_time')->default(0);
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
