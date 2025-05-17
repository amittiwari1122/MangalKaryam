<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserMatch extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'matching_id', 'agent_id'
    ];
}
