<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPost extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'title', 'post', 'status', 'like_count', 'dislike_count', 'comment_count'
    ];
}