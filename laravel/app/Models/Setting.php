<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'nightmode',
        'anonymity',
        'voice',
        "language",
        "timezone",
        'user_id',
    ];
    //
    public function user()
    {
        return $this->hasOne('App\Models\User');
    }
}
