<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DynamicContent extends Model
{
    use HasFactory;
    protected $fillable = [
        'content', 'page_wise_id', 'section', 'status','title', 'user_type'
    ];
}
