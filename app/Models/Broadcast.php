<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Broadcast extends Model
{
    use HasFactory, SoftDeletes , HasTranslations;
    protected $table = "broadcasts";
    public $translatable = ['name','description'];
    protected $fillable = ['lawyer_id','law_firm_id', 'broadcast_category_id', 'is_featured', 'name', 'description', 'slug', 'sort_order', 'image','file_type','link_type','file_url','audio','video', 'is_active', 'deleted_at'];


    public function scopeWithAll($query)
    {
        return $query->with('tags')->with('lawyer')->with('law_firm')->with('broadcast_category');
    }
    public function scopeHasModulePermissions($query){
        return $query->whereHas('lawyer',function($q){
            $q->whereHas('pricing_plan',function($y){{
                $y->whereHas('lawyer_modules',function($z){
                    $z->where('pricing_plan_modules.module_code','lawyer-broadcast');
                });
            }});
        })->orWhereHas('law_firm',function($q){
            $q->whereHas('pricing_plan',function($y){{
                $y->whereHas('law_firm_modules',function($z){
                    $z->where('pricing_plan_modules.module_code','law_firm-broadcast');
                });
            }});
        })->doesntHave('lawyer', 'or')->doesntHave('law_firm' , 'or');
    }
    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
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
    public function broadcast_category()
    {
        return $this->belongsTo(BroadcastCategory::class);
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'broadcast_tag');
    }
}
