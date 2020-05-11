<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
       /**
     * Get the post of this user
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
           //
       /**
     * Get the post of this user
     */
    public function reviewer()
    {
        return $this->belongsTo('App\User', 'reviewer_id');
    }
}
