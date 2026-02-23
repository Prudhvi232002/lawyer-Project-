<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LawyerSetting extends Model
{
    use HasFactory;
    protected $table = "lawyer_settings";
    protected $fillable = ['lawyer_id','name', 'display_name', 'value', 'is_specific', 'type'];
}
