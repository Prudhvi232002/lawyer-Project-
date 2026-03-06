<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Service extends Model
{
    use HasFactory, SoftDeletes , HasTranslations;
    protected $table = "services";
    public $translatable = ['name','description'];
    protected $fillable = ['lawyer_id','law_firm_id','service_category_id', 'name', 'description', 'slug', 'sort_order', 'image','video','price','is_approved','is_featured','approved_at', 'is_active', 'deleted_at'];


    public function scopeWithAll($query)
    {
        return $query->with('lawyer')->with('law_firm')->with('tags')->with('faqs')->with('service_category');
    }
    public function scopeWithChildrens($query){
        return $query->with('booked_services')->with('reviews',function($q){
            $q->withAll();
        });
    }

    public function scopeHasModulePermissions($query){
        return $query->whereHas('lawyer',function($q){
            $q->whereHas('pricing_plan',function($y){{
                $y->whereHas('lawyer_modules',function($z){
                    $z->where('pricing_plan_modules.module_code','lawyer-services');
                });
            }});
        })->orWhereHas('law_firm',function($q){
            $q->whereHas('pricing_plan',function($y){{
                $y->whereHas('law_firm_modules',function($z){
                    $z->where('pricing_plan_modules.module_code','law_firm-services');
                });
            }});
        })->doesntHave('lawyer', 'or')->doesntHave('law_firm' , 'or');
    }
    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }
    public function scopeApproved($query)
    {
        return $query->where('is_approved', 1);
    }
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', 1);
    }
    public function lawyer()
    {
        return $this->belongsTo(Lawyer::class);
    }
    public function law_firm()
    {
        return $this->belongsTo(LawFirm::class);
    }
    public function service_category()
    {
        return $this->belongsTo(ServiceCategory::class);
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'service_tag');
    }
    public function faqs()
    {
        return $this->hasMany(ServiceFaq::class, 'service_id');
    }
    public function reviews()
    {
        return $this->hasMany(ServiceReview::class, 'service_id');
    }
    public function booked_services()
    {
        return $this->hasMany(BookedService::class, 'service_id');
    }
}
