<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LawyerEducation extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "lawyer_educations";
    protected $fillable = ['lawyer_id', 'institute','degree','subject','description', 'from', 'to', 'image', 'is_active', 'deleted_at'];
    protected $casts = [
        'from' => 'datetime',
        'to' => 'datetime',
    ];

    public function scopeWithAll($query)
    {
        return $query->with('lawyer');
    }
    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function lawyer()
    {
        return $this->belongsTo(Lawyer::class);
    }

}
