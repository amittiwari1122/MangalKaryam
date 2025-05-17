<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserBasicDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'age_id', 'height_id', 'weight_id','dob','birth_time','birth_place','caste_id','gotra_id','body_tone_id','manglik_type_id','allergic_type_id','drink_type_id','beard_type_id','body_type','nationality_id','distict_id','religion_id', 'final_fee', 'intial_fee','state', 'marital_status', 'pin', 'address', 'about_me_long','about_me_short','lat','long',
    ];

}
