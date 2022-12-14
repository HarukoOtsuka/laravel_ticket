<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Follow;

class User extends Authenticatable
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
    
    //リレーションを設定
    public function tickets(){
        return $this->hasMany('App\Ticket');
    }
    
    public function follows(){
        return $this->hasMany('App\Follow');
    }
    
    public function follow_users(){
        return $this->belongsToMany('App\User', 'follows', 'user_id', 'follow_id');
    }
    
    public function isFollowing($user){
        $result = $this->follow_users->pluck('id')->contains($user->id);
        return $result;
    }
}
