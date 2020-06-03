<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $fillable = [
        'title',
        'subtitle',
        'text',
        'image',
        'user_id'
    ];

    /**
     * get the comments the belong to this post
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

        /**
     * get the comments the belong to this post
     */
    public function likedPosts()
    {
        return $this->hasMany(LikedPost::class);
    }
}
