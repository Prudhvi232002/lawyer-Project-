<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThemeSetting extends Model
{
    use HasFactory;
    protected $table = "theme_settings";
    public static $Theme_1 = 'theme_1';
    public static $Theme_2 = 'theme_2';
    public static $Default = 'default';
    public static $Custome = 'custome';
    protected $fillable = ['name', 'display_name', 'value', 'is_specific', 'type', 'is_editable', 'theme_code', 'is_active'];

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }
}
