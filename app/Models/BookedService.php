<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookedService extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "booked_services";
    protected $fillable = [
        'customer_id', 'service_id','lawyer_id','law_firm_id', 'date', 'price', 'is_paid', 'question','started_at','ended_at',
        'attachment_url','service_status_code','fund_id','deleted_at'
    ];

    public function scopeWithAll($query)
    {
        return $query->with('customer')->with('lawyer')->with('law_firm')->with('reviews')->with('service_status')->with('service')->with('messages');
    }
    public  function fund()
    {
        return $this->belongsTo(Fund::class);
    }
    public  function service()
    {
        return $this->belongsTo(Service::class);
    }
    public function customer(){
        return $this->belongsTo(Customer::class);
     }
     public function lawyer(){
        return $this->belongsTo(Lawyer::class);
     }
     public function law_firm(){
        return $this->belongsTo(LawFirm::class);
     }
     public function service_status(){
        return $this->belongsTo(ServiceStatus::class,'service_status_code','status_code');
     }
     public function messages()
    {
        return $this->hasMany(Message::class,'appointment_id');
    }

    public function reviews()
    {
        return $this->hasMany(ServiceReview::class, 'booked_service_id');

    }
    public function getIsStartedAttribute() {
        return $this->attributes['started_at'] ? true : false;
    }
    public function getIsEndedAttribute() {
        return $this->attributes['ended_at'] ? true : false;
    }
}
