<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OperationInfo extends Model
{
    use HasFactory;
    protected $fillable = [
        'operation_id',
        'medical_record_id',
        'doctor_id',
        'operation_date',
        'surgeon_name',
        'operation_notes',
        'complications',
    ];

    // Define relationships
    public function operation()
    {
        return $this->belongsTo(Operation::class, 'operation_id', 'operation_id');
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
