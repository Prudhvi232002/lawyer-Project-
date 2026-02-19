<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LawFirmSetting extends Model
{
    use HasFactory;
    protected $table = "law_firm_settings";
    protected $fillable = ['law_firm_id','name', 'display_name', 'value', 'is_specific', 'type'];
}
