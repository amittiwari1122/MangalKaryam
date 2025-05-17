<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSecurityquestion extends Model
{
    use HasFactory;
    protected $fillable = [
        'question_id', 'answer', 'user_id'
    ];
}
