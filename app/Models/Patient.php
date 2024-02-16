<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Basic_Medical_Info;

class Patient extends Model
{
    use HasFactory;
    protected $fillable=['first_name','last_name','username','password','gender','national_id','email','Address','birth_date','phone_number','Personal_image'
];
    protected $primaryKey='patient_id';
    public function basicMedicalInfo()
    {
        return $this->hasOne(Basic_Medical_Info::class, 'patient_id', 'patient_id');
    }
}
