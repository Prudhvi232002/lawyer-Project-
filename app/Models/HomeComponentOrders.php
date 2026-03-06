<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HomeComponentOrders extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "home_component_orders";
    protected $fillable = [
        'name','display_name', 'description', 'sort_order', 'is_active','deleted_at'
    ];

   
    public function scopeWithAll($query)
    {
        return ;
    }
    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }
   
}
