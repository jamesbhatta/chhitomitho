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
        'name', 'email', 'password', 'provider', 'provider_id', 'avatar', 'profile_pic', 'mobile', 'address', 'gender', 'role'
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
     * Route notifications for the Slack channel.
     *
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return string
     */
    public function routeNotificationForSlack($notification)
    {
        return config('notification.slack.url');
    }

    /**
     * Returns the gravatar URL for current user
     *
     * @usage user()->gravatar()
     */
    public function getGravatarAttribute()
    {
        if ($this->profile_pic != null) {
            return asset('storage/'.$this->profile_pic);
        }

        if ($this->avatar != null) {
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

    public function hasRoles($roles)
    {
        foreach ($roles as $role) {
            if ($this->role === $role)
                return true;
        }
        return false;
    }

    /**
     * Local Scopes
     *
     */
    public function scopeAdmin($query)
    {
        return $query->where('role', 'admin');
    }

    public function scopeManagers($query)
    {
        return $query->where('role', 'manager');
    }

    public function scopePartners($query)
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

    public function scopeFilterByRole($query, $role = null)
    {
        if (!is_null($role)) {
            return $query->where('role', $role);
        }
        return $query;
    }

    // Relations
    public function store()
    {
        return $this->hasOne('App\Store');
    }

    public function packages()
    {
        return $this->hasMany('App\Order', 'courier_id');
    }

    public function meta()
    {
        return $this->hasOne('App\UserMeta', 'user_id', 'id')->withDefault();
    }

    public function transactions()
    {
        return $this->hasMany('App\CourierLedger', 'courier_id');
    }
}
