<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserKundali extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'kundali_male_id', 'kundali_female_id', 'info', 'status', 'created_at'
    ];
}
