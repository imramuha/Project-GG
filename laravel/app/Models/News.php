<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    //
     /**
     * Get the news of this user
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
