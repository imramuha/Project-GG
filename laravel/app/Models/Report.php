<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'reason',
        'type',
        'type_id',
        'reporter_id'
    ];
       /**
     * Get the post of this user
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'reporter_id');
    }
}
