<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookAppointment extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "booked_appointments";
    protected $fillable = [
        'customer_id', 'lawyer_id', 'law_firm_id','date', 'start_time', 'fee', 'is_paid', 'appointment_type_id', 'end_time', 'question','started_at','ended_at',
        'attachment_url','appointment_status_code','fund_id','deleted_at','phone'
    ];

    public function scopeWithAll($query)
    {
        return $query->with('customer')->with('ratings')->with('appointment_type')->with('appointment_status')->with('lawyer')->with('lay_firm')->with('messages')->with('fund');
    }
    public  function fund()
    {
        return $this->belongsTo(Fund::class);
    }
    public  function lawyer()
    {
        return $this->belongsTo(Lawyer::class);
    }
    public  function lay_firm()
    {
        return $this->belongsTo(LawFirm::class);
    }
    public  function appointment_type()
    {
        return $this->belongsTo(AppointmentType::class);
    }
    public function customer(){
        return $this->belongsTo(Customer::class);
     }
     public function appointment_status(){
        return $this->belongsTo(AppointmentStatus::class,'appointment_status_code','status_code');
     }
     public function messages()
    {
        return $this->hasMany(Message::class,'appointment_id');
    }

    public function ratings()
    {
        return $this->hasMany(AppointmentRating::class, 'booked_appointment_id');

    }
    public function getIsStartedAttribute() {
        return $this->attributes['started_at'] ? true : false;
    }
    public function getIsEndedAttribute() {
        return $this->attributes['ended_at'] ? true : false;
    }
}
