<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserFamily extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'family_type','religion_id','mother_tounge','father_occupation','mother_occupation','family_income','no_brothers','married_brothers','no_sisters','married_sisters','family_based_out', 'user_id'
    ];
}
