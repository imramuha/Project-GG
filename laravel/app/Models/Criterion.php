<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Criterion extends Model
{
    //
    public $table = "criteria";
    protected $fillable = [
        'name',
    ];
        /**
     * The options that belong to the game.
     */
    public function games()
    {
        return $this->belongsToMany('App\Models\Game', 'game_criteria');
    }

}
