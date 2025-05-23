<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserFollow extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'follow_id', 'created_by'
    ];
}
