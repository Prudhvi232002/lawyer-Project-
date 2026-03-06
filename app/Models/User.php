<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Bavix\Wallet\Traits\HasWallet;
use Bavix\Wallet\Interfaces\Wallet;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail, Wallet
{
    use HasApiTokens, HasFactory, Notifiable, HasWallet,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_image_path',
        'role_id'
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

    public function scopeWithAll($query)
    {
        return $query->with('lawyer', function ($q) {
            $q->withAll();
        })->with('law_firm', function ($q) {
            $q->withAll();
        })->with('customer', function ($q) {
            $q->withAll();
        });
    }

    public function lawyer()
    {
        return $this->hasOne(Lawyer::class);
    }
    public function customer()
    {
        return $this->hasOne(Customer::class);
    }
    public function law_firm()
    {
        return $this->hasOne(LawFirm::class);
    }
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_role', 'user_id', 'role_code', 'id', 'role_code');
    }
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function social_accounts()
    {
        return $this->hasMany(socialAccount::class);
    }
    public function withdrawals()
    {
        return $this->hasMany(WithdrawRequest::class);
    }

    public function hasRole($role)
    {
        $role = $this->roles()->where('roles.role_code', $role)->first();
        if ($role) {
            return true;
        }
        return false;
    }
    public function hasPermission($permission_code)
    {
        if ($this->hasRole(Role::$SuperAdmin)) {
            return true;
        } else {

            $role = $this->role->role_permissions()->where('role_permission.permission_code', $permission_code)->first();
            if ($role) {
                return true;
            }
            return false;
        }
    }
}
