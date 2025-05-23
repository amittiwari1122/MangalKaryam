<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSubscribe extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'subscriber_id', 'status', 'created_at'
    ];
}
