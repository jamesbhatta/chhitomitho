<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'provider', 'provider_id', 'avatar', 'mobile', 'address', 'gender', 'role'
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
     * Returns the gravatar URL for current user
     *
     * @usage user()->gravatar()
     */
    public function getGravatarAttribute()
    {
        if( $this->avatar != null ) {
            return $this->avatar;
        }

        $hash = md5(strtolower(trim($this->attributes['email'])));
        return "http://www.gravatar.com/avatar/$hash?s=260&d=mp";
    }

    /**
     * Return the role of current user
     */
    public function isRole()
    {
        return $this->role;
    }

    /**
     * Return the role of current user
     */
    public function hasRole($role)
    {
        return $this->role === $role;
    }

    public function scopeAdmin($query)
    {
        return $query->where('role', 'admin');
    }

    public function scopeManagers($query)
    {
        return $query->where('role', 'manager');
    }

    public function scopeCPartners($query)
    {
        return $query->where('role', 'partner');
    }

    public function scopeCouriers($query)
    {
        return $query->where('role', 'courier');
    }

    public function scopeCustomers($query)
    {
        return $query->where('role', 'customer');
    }
}
