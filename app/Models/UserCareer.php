<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCareer extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'profession','annual_income_id','qualification_id','education_fields','university_name','user_id'
    ];
}
