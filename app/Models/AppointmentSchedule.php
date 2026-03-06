<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AppointmentSchedule extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "appointment_schedules";
    protected $fillable = ['lawyer_id','law_firm_id','appointment_type_id', 'fee','commission_amont', 'day', 'is_holiday', 'start_time', 'end_time','slot_duration', 'deleted_at'];


    public function scopeWithAll($query)
    {
         return $query->with('schedule_slots')->with('appointment_type');
    }
    public  function lawyer()
    {
        return $this->belongsTo(Lawyer::class,'user_id','lawyer_id');
    }
    public  function law_firm()
    {
        return $this->belongsTo(LawFirm::class,'user_id','law_firm_id');
    }
    public  function appointment_type()
    {
        return $this->hasOne(AppointmentType::class,'id','appointment_type_id');
    }
    public function schedule_slots()
    {
        return $this->hasMany(AppointmentScheduleSlot::class, 'schedule_id');
    }
}
