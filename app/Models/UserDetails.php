<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetails extends Model
{
    use HasFactory;
    protected $fillable = [
        'first_name','middle_name','last_name', 'user_id', 'dob','role_id','gender','created_by','refer_by','group_id','profession_id','subprofession_id','work_with','created_by_user', 'payment_status', 'provider', 'prefer_communication', 'image_hide','active_status','requestcontact_view', 'my_prefer'
    ];
}
