<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGameOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_options', function (Blueprint $table) {
            $table->id();
            $table->integer('game_id')->nullable()->unsigned();
            $table->integer('option_id')->unsigned()->nullable();
            $table->timestamps();
        });

        // once the table is created use a raw query to ALTER it and add the MEDIUMBLOB
        DB::statement("ALTER TABLE games ADD image LONGBLOB");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('game_options');
    }
}
