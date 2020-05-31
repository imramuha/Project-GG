<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lobby extends Model
{
    //
            /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'code',
    ];
        /**
     * get the comments the belong to this user
     */
    public function users()
    {
        return $this->belongsToMany('App\User', 'lobby_users');
    }

}
