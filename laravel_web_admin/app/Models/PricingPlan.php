<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PricingPlan extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "pricing_plans";
    protected $fillable = ['name', 'description', 'color','is_paid', 'slug','tagline','price','stripe_plan', 'sort_order', 'image','type','is_default', 'is_active', 'deleted_at'];

    public function scopeWithAll($query)
    {
        return $query;
    }
    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }
    public function scopeDefault($query)
    {
        return $query->where('is_default', 1);
    }
    public function scopeLawFirm($query)
    {
        return $query->where('type', 'law_firm');
    }
    public function scopeLawyer($query)
    {
        return $query->where('type', 'lawyer');
    }
    public function scopeBoth($query)
    {
        return $query->where('type', 'both');
    }

    public function modules()
    {
        return $this->belongsToMany(PricingPlanModule::class, 'pricing_plan_module', 'pricing_plan_id', 'module_code', 'id', 'module_code');
    }
    public function lawyer_modules()
    {
        return $this->belongsToMany(PricingPlanModule::class, 'pricing_plan_module', 'pricing_plan_id', 'module_code', 'id', 'module_code')->where('type','lawyer');
    }

    public function law_firm_modules()
    {
        return $this->belongsToMany(PricingPlanModule::class, 'pricing_plan_module', 'pricing_plan_id', 'module_code', 'id', 'module_code')->where('type','law_firm');
    }
}
