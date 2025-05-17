<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSearching extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'height_from','height_to','age_from','age_to','annual_income_id','diet_type_id','marital_status','caste_id','gotra_id','weight_id','quality_id','work_type', 'user_id'
    ];
}
