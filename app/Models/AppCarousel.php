<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class AppCarousel extends Model
{
    use HasFactory, SoftDeletes, HasTranslations;
    protected $table = "app_carousel";
    public $translatable = ['name','description'];
    protected $fillable = ['name', 'description','image', 'is_active', 'deleted_at'];


    public function scopeWithAll($query)
    {
        return $query;
    }
    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }
}
