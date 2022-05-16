<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles(){
        return $this->belongsToMany('App\Models\Role');
    }

    // Check if the user has any role

    public function hasAnyRoles($roles)
    {
        // Check if there are any roles in the 'name' column
        // whereIn() - pass an array and check if it is within the table's (roles) column
        if($this->roles()->whereIn('name', $roles)->first()){
            return true;
        }
        return false;
    }
    
    // Check if the user has a certain role

    public function hasRole($role)
    {
        // where() - pass a string and check if it is within the table's (roles) column
        if($this->roles()->where('name', $role)->first()){
            return true;
        }
        return false;
    }
}
