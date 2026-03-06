<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AppointmentRating extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "appointment_ratings";
    protected $fillable = [
        'booked_appointment_id', 'fromable_id', 'fromable_type', 'to_id','to_type','rating','comment','deleted_at'
    ];

    public function scopeWithAll($query)
    {
        return ;
    }
    public function getFromAbleTypeAttribute() {
        if ($this->attributes['fromable_type'] == 'App\Models\Customer') {
            return 'customer';
         }
         if ($this->attributes['fromable_type'] == 'App\Models\Lawyer') {
            return 'lawyer';
         }  if ($this->attributes['fromable_type'] == 'App\Models\LawFirm') {
            return 'law_firm';
         }
    }
    public function getToAbleTypeAttribute() {
        if ($this->attributes['to_type'] == 'App\Models\Customer') {
            return 'customer';
         }
         if ($this->attributes['to_type'] == 'App\Models\Lawyer') {
            return 'lawyer';
         }  if ($this->attributes['to_type'] == 'App\Models\LawFirm') {
            return 'law_firm';
         }
    }
    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }
    public function lawyer()
    {
        return $this->belongsTo(Lawyer::class);
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    public function appointment()
    {
        return $this->belongsTo(BookAppointment::class, 'booked_appointment_id');
    }
    public function from()
    {
        return $this->morphTo('fromable');
    }
    public function to()
    {
        return $this->morphTo('to');
    }


}
