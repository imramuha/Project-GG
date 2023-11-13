<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'comment',
        'score',
        'user_id',
        'reviewer_id',
    ];
       /**
     * Get the post of this user
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
           //
       /**
     * Get the post of this user
     */
    public function reviewer()
    {
        return $this->belongsTo('App\Models\User', 'reviewer_id');
    }
}
