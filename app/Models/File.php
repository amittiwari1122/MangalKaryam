<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'status', 'file_type_id', 'file_name', 'file_path', 'file_original', 'file_size', 'post_id', 'review_id', 'contactus_id', 'feedback_id'
    ];
}
