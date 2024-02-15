<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    protected $fillable=['first_name','last_name','username','password','gender','national_id','email','Address','birth_date','phone_number','Personal_image'
];
}
