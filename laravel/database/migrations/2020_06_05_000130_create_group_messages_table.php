<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_messages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned(); // sender
            $table->integer('lobby_id')->unsigned(); // sender
            $table->text('text');
            $table->timestamps();
        });
        /*
        Schema::table('group_messages', function($table) {
            $table->foreign('lobby_id')->references('id')->on('lobbies')->onDelete('cascade')->onUpdate('cascade');
        });*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('group_messages');
    }
}
