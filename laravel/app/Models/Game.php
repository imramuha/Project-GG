<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    //
            /**
     * get the comments the belong to this user
     */
    public function usergamedata()
    {
        return $this->hasMany(UserGameData::class);
    }

        //
    /**
     * The users that belong to the role.
     */
    public function options()
    {
        return $this->belongsToMany('App\Option', 'game_options');
    }
}
