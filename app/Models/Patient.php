<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BasicMedicalInfo;
use App\Models\medicineAlert;
use App\Models\PatientEmergencyContact;
use App\Models\PatientFaceID;


class Patient extends Model
{
    use HasFactory;
    protected $fillable=['first_name','last_name','username','password','gender','national_id','email','Address','birth_date','phone_number','Personal_image'
];
    protected $primaryKey='patient_id';
    public function basicMedicalInfo()
    {
        return $this->hasOne(BasicMedicalInfo::class, 'patient_id', 'patient_id');
    }
    public function medicineAlert()
    {
        return $this->hasMany(medicineAlert::class, 'patient_id');
    }
   
    public function patientFaceID()
    {
        return $this->hasMany(PatientFaceID::class, 'patient_id');
    }
    public function emergencyContacts()
    {
        return $this->hasMany(PatientEmergencyContact::class, 'patient_id');
    }
   
}
