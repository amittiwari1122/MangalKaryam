<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImportUser extends Model
{
    use HasFactory;
    protected $fillable = [
        'first_name','middle_name','last_name', 'email', 'mobile', 'dob', 'gender', 'created_by', 'refer_by', 'height', 'qualification', 'alt_number', 'address', 'state', 'country','pincode', 'height_from', 'height_to', 'age_from', 'age_to','annual_income','diet_type','work_type','caste','gotra','marital_status','quality'
    ];
}