<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRegistrationPercentage extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'basic', 'looking_for', 'contact', 'career', 'family', 'location', 'hobby'
    ];
}
