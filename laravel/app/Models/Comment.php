<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
       /**
     * Get the post of this comment.
     */
    public function post()
    {
        return $this->belongsTo('App\Post', 'post_id');
    }


       //
       /**
     * Get the post of this user
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

}