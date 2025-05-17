<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserManagement extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'budget', 'details', 'visit_count', 'spacial_notes', 'followup_date'
    ];
}
