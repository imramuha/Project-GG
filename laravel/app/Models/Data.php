<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    //
            /**
     * get the comments the belong to this user
     */
    public function usergamedata()
    {
        return $this->hasMany(UserGameData::class);
    }
}