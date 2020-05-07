<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $fillable = [
        'title',
        'date',
        'time',
    ];

    /**
     * get the comments the belong to this post
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
