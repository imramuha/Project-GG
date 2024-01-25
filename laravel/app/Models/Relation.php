<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Relation extends Model
{
    /**
     * The users that belong to the role.
     */
    public function users()
    {
        return $this->belongsToMany('App\Models\User', 'user_relations', 'user_id_one', 'user_id_two');
    }
/*
    public function usersOne()
    {
        return $this->belongsToMany('App\Models\User', 'user_relations', "relation_id", "user_id_two")->withPivot(["user_id_one", "user_id_two"]);
    }

    public function usersTwo()
    {
        return $this->belongsToMany('App\Models\User', 'user_relations', "relation_id", "user_id_one")->withPivot(["user_id_one", "user_id_two"]);;
    }*/
}
