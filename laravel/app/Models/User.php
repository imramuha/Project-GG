<?php

namespace App\Models;

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
        'username', 'email', 'password',
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

    /**
     * Add a mutator to ensure hashed passwords
     */
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

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
     * Get the role of users.
     */
    public function role()
    {
        return $this->belongsTo('App\Models\Role', 'role_id');
    }

    /**
     * Get the status of users.
     */
    public function status()
    {
        return $this->belongsTo('App\Models\Status', 'status_id');
    }


    /**
     * The users that belong to the role.
     */
    public function relationOne()
    {
        return $this->belongsToMany('App\Models\Relation', 'user_relations', 'user_id_one')->withPivot(["user_id_one", "user_id_two"]);
    }

      /**
     * The users that belong to the role.
     */
    public function relationTwo()
    {
        return $this->belongsToMany('App\Models\Relation', 'user_relations', 'user_id_two')->withPivot(["user_id_one", "user_id_two"]);
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
        return $this->hasMany(Review::class);
    }

            //
    /**
     * Get the category that the product belongs to.
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }


        /**
     * get the comments the belong to this user
     */
    public function usergamedata()
    {
        return $this->hasMany('App\Models\UserGameData');
    }


            /**
     * get the comments the belong to this post
     */
    public function likedPosts()
    {
        return $this->hasMany(LikedPost::class);
    }

           //
       /**
     * Get the post of this user
     */
    public function lobbyUser() {
        return $this->hasOne('App\Models\LobbyUser')->with('lobby');
    }

    public function getLobbyAttribute(){
        return $this->lobbyUser->lobby;
    }

    public function setting()
    {
        return $this->belongsTo('App\Models\Setting');
    }

      //
    /**
     * Get the category that the product belongs to.
     */
    public function news()
    {
        return $this->hasMany(News::class);
    }

            //
    /**
     * Get the category that the product belongs to.
     */
    public function reports()
    {
        return $this->hasMany(Report::class);
    }

       /**
     * get the comments the belong to this user
     */
    public function groupMessages()
    {
        return $this->hasMany(GroupMessage::class);
    }
}
