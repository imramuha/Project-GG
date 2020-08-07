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
        'created_at',
        'updated_at',
    ];
        /**
     * get the comments the belong to this user
     */
    public function users() {
        return $this->belongsToMany('App\User', 'lobby_users');
    }

    /**
     * The users that belong to the role.
     */
    public function groupMessages()
    {
        return $this->hasMany(GroupMessage::class);
    }
}
