<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicationInfo extends Model
{
    use HasFactory;
    protected $fillable = [
        'medicine_id',
        'medical_record_id',
        'doctor_id',
        'dose',
        'frequency',
        'notes',
    ];

    // Define relationships
    public function medication()
    {
        return $this->belongsTo(Medication::class, 'medicine_id', 'medicine_id');
    }

    public function medicalRecord()
    {
        return $this->belongsTo(BasicMedicalInfo::class, 'medical_record_id', 'medical_record_id');
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class , 'doctor_id' , 'doctor_id');
    }
}
