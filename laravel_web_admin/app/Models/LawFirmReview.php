<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LawFirmReview extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "law_firm_reviews";
    protected $fillable = ['law_firm_id', 'customer_id', 'rating','experience','communication','service', 'comment', 'is_active', 'deleted_at'];


    public function scopeWithAll($query)
    {
        return $query->with('customer');
    }
    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', 1);
    }
    public function law_firm()
    {
        return $this->belongsTo(LawFirm::class);
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
