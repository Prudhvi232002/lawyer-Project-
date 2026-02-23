<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LawyerReview extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "lawyer_reviews";
    protected $fillable = ['lawyer_id', 'customer_id', 'rating','experience','communication','service', 'comment', 'is_active', 'deleted_at'];


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
    public function lawyer()
    {
        return $this->belongsTo(Lawyer::class);
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
