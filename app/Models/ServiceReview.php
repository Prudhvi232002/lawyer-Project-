<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceReview extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "service_reviews";
    protected $fillable = [
        'booked_service_id', 'service_id','customer_id','lawyer_id','law_firm_id','rating','experience','communication','service','is_active','is_featured','is_approved','comment','deleted_at'
    ];

    public function scopeWithAll($query)
    {
        return $query->with('customer')->with('lawyer')->with('law_firm');
    }
    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    public function lawyer()
    {
        return $this->belongsTo(Lawyer::class);
    }
    public function law_firm()
    {
        return $this->belongsTo(LawFirm::class);
    }
    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }


}
