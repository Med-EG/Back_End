<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientFaceId extends Model

{
 protected $table = 'patient_face_id';
 protected $primaryKey = 'image_id';

    protected $fillable = [
        'patient_id',
        'face_image',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }
}
