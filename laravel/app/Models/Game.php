<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $fillable = [
        'name',
        'image'
    ];
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
    public function criteria()
    {
        return $this->belongsToMany('App\Models\Criterion', 'game_criteria');
    }
}
