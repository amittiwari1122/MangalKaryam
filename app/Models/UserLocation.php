<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLocation extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'living_place', 'city', 'state_id', 'country_id', 'user_id', 'lat', 'long'
    ];
}
