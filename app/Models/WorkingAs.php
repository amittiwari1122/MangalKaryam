<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkingAs extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'status', 'order'
    ];
}
