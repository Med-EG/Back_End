<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicationInfo extends Model
{
    use HasFactory;
    public function doctor()
    {
        return $this->belongsTo(Doctor::class , 'doctor_id' , 'doctor_id');
    }
}
