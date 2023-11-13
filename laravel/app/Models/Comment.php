<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'comment',
        'user_id',
        'post_id',
    ];
    //
       /**
     * Get the post of this comment.
     */
    public function post()
    {
        return $this->belongsTo('App\Models\Post', 'post_id');
    }


       //
       /**
     * Get the post of this user
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

}
