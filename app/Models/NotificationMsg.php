<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationMsg extends Model
{
    use HasFactory;
    protected $fillable = [
        'title','discription', 'notification_type', 'created_at'
    ];
}
