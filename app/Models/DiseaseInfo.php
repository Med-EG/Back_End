<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiseaseInfo extends Model
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
    public function disease()
    {
        return $this->belongsTo(Disease::class, 'disease_id', 'disease_id');
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
