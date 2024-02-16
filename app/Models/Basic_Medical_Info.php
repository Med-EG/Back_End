<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Basic_Medical_Info extends Model
{
    use HasFactory;
    protected $table = 'basic_medical_info';

    protected $primaryKey = 'medical_record_id';

    protected $fillable = [
        'patient_id',
        'weight',
        'height',
        'blood_type',
        'alcoholic',
        'alcoholic_level',
        'smoker',
        'smoking_level',
        'job',
        'marital_status',
        'past_fracrues',
        'sleeping_hours',
        'sleeping_quality',
        'father',
        'mother',
        'second_degree',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id', 'patient_id');
    }
}
