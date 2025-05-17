<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserContact extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id','mobile','email','alt_mobile','address', 'state', 'pincode','country_id','city','district'
    ];
}
