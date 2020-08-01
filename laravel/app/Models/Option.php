<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    //
        /**
     * The options that belong to the game.
     */
    public function game()
    {
        return $this->belongsToMany('App\Game', 'game_options');
    }

}
