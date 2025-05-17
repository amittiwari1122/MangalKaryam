<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserMobile extends Model
{
    use HasFactory;
    protected $fillable = [
        'mobile', 'user_id', 'otp', 'status'
    ];
}
