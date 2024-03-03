<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AllergiesInfo extends Model
{
    use HasFactory;
    protected $fillable = [
        'allergy_id',
        'medical_record_id',
        'doctor_id',
        'allergy_type',
        'severity_level',
        'body_response',
        // Add more fields here if needed
    ];

    // Define relationships
    public function allergy()
    {
        return $this->belongsTo(Allergies::class, 'allergy_id', 'allergy_id');
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
