<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'image',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $appends = ['image_path'];


    public function getFirstNameAttribute($val){
        return ucfirst($val);
    }
    public function getLastNameAttribute($val){
        return ucfirst($val);
    }
    public function getImagePathAttribute($val){
        return asset('uploads/user_images/' . $this->image);
    }


}
