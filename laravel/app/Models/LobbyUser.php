<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LobbyUser extends Model
{
    /**
     * Get the lobby this groupmessage belongs to.
     */
    public function lobby() {
        return $this->belongsTo('App\Models\Lobby');
    }    

}
