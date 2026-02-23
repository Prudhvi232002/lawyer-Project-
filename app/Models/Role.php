<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table = 'roles';
    protected $fillable  = [
        'name', 'description', 'is_active', 'icon', 'role_code','is_editable'
    ];

    public static $SuperAdmin = 'super_admin';
    public static $Admin = 'admin';
    public static $LawFirm = 'law_firm';
    public static $Lawyer = 'lawyer';
    public static $Customer = 'customer';

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function role_permissions()
    {
        return $this->belongsToMany(RolePermission::class, 'role_permission', 'role_code', 'permission_code', 'role_code', 'permission_code');
    }
}
