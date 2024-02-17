<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorContactNumber extends Model
{
    use HasFactory;
    protected $fillable = [
        'doctor_id',
        'contact_number'
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class , 'doctor_id' , 'doctor_id');
    }
}
