<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    //
    /**
     * Get the category that the product belongs to.
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
