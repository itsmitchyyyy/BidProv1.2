<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fname', 'lname', 'email', 'username', 'password', 'contact', 'address', 'avatar',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles(){
        return $this->belongsToMany(Role::class);
    }

    public function authorizeRoles(){
        if(is_array($roles)){
            return hasAnyRoles($roles) ||
                abort(401, 'This action is unauthorized');
        }
        return hasRoles($roles) ||
            abort(401, 'This action is unauthorized');
    }

    public function hasAnyRoles($roles){
        return null !== $this->roles()->whereIn('name', $roles)->first();
    }
    
    public function hasRoles($roles){
        return null !== $this->roles()->where('name', $roles)->first();
    }
}
