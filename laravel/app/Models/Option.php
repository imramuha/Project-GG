<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    //
        /**
     * The roles that belong to the user.
     */
    public function game()
    {
        return $this->belongsToMany('App\Game', 'game_options');
    }

}
