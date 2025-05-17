<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserReviewComment extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'review_id', 'comment'
    ];
}
