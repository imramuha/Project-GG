<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Rest omitted for brevity
    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * The roles that belong to the user.
     */
    public function roles()
    {
        return $this->belongsToMany('App\Role', 'user_roles');
    }

    /**
     * The users that belong to the role.
     */
    public function relationOne()
    {
        return $this->belongsToMany('App\Relation', 'user_relations', 'user_id_one')->withPivot(["user_id_one", "user_id_two"]);
    }

      /**
     * The users that belong to the role.
     */
    public function relationTwo()
    {
        return $this->belongsToMany('App\Relation', 'user_relations', 'user_id_two')->withPivot(["user_id_one", "user_id_two"]);
    }

    /**
     * Get the roles of users.
     */
    public function status()
    {
        return $this->belongsTo('App\Status', 'status_id');
    }


    /**
     * get the comments the belong to this user
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }


        //
    /**
     * Get the category that the product belongs to.
     */
    public function reviews()
    {
        return $this->hasMany(Reviews::class);
    }


        /**
     * get the comments the belong to this user
     */
    public function usergamedata()
    {
        return $this->hasMany(UserGameData::class);
    }


            /**
     * get the comments the belong to this post
     */
    public function likedPosts()
    {
        return $this->hasMany(LikedPost::class);
    }

}
