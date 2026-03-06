<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Event extends Model
{
    use HasFactory, SoftDeletes , HasTranslations;
    protected $table = "events";
    public $translatable = ['name','description'];
    protected $fillable = ['lawyer_id','law_firm_id','event_category_id', 'is_featured' ,'is_approved', 'name', 'description', 'slug', 'sort_order', 'image','is_active','starts_at','ends_at','address_line_1','address_line_2','sponsor', 'deleted_at'];
    protected $casts = [
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
    ];

    public function scopeWithAll($query)
    {
        return $query->with('lawyer')->with('tags')->with('law_firm')->with('sponsers')->with('event_category');
    }
    public function scopeHasModulePermissions($query){
        return $query->whereHas('lawyer',function($q){
            $q->whereHas('pricing_plan',function($y){{
                $y->whereHas('lawyer_modules',function($z){
                    $z->where('pricing_plan_modules.module_code','lawyer-podcasts');
                });
            }});
        })->orWhereHas('law_firm',function($q){
            $q->whereHas('pricing_plan',function($y){{
                $y->whereHas('law_firm_modules',function($z){
                    $z->where('pricing_plan_modules.module_code','law_firm-podcasts');
                });
            }});
        })->orWhere(function($q){
           $q->doesntHave('lawyer')->doesntHave('law_firm');
        });
    }
    public function scopeUpcoming($query){
        return $query->whereDate('starts_at', '>=', Carbon::today()->toDateString());
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
    public function event_category()
    {
        return $this->belongsTo(EventCategory::class);
    }
    public function lawyer()
    {
        return $this->belongsTo(Lawyer::class);
    }
    public function law_firm()
    {
        return $this->belongsTo(LawFirm::class);
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'event_tag');
    }
    public function sponsers()
    {
        return $this->hasMany(EventSponser::class, 'event_id');
    }
}
