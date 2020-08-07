<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupMessage extends Model
{
    /**
     * Get the lobby this groupmessage belongs to.
     */
    public function lobby()
    {
        return $this->belongsTo('App\Models\Lobby', 'lobby_id');
    }

    //
       /**
     * Get the user this message belongs to
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

}
