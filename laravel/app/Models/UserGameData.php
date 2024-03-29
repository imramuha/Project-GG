<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserGameData extends Model
{
    protected $fillable = [
        'user_id',
        'data_id',
        'game_id',
    ];
    /**
     * Get the post of this user
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
        /**
     * Get the post of this user
     */
    public function game()
    {
        return $this->belongsTo('App\Models\Game', 'game_id');
    }
        /**
     * Get the post of this user
     */
    public function data()
    {
        return $this->belongsTo('App\Models\Data', 'data_id');
    }
}
