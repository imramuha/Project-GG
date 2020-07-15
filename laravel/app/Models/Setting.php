<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'darkmode',
        'anonymity',
        'voice',
        'user_id',
    ];
    //
    public function user()
    {
        return $this->hasOne('App\Models\User');
    }
}
