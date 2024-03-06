<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BasicMedicalInfo;
use App\Models\medicineAlert;
use App\Models\PatientEmergencyContact;
use App\Models\PatientFaceId;
use App\Models\Chat;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Patient extends Authenticatable
{
    use HasFactory, HasApiTokens;
    protected $fillable = [
        'first_name', 'last_name', 'username', 'password', 'gender', 'national_id', 'email', 'address', 'birth_date', 'phone_number', 'personal_image'
    ];
    protected $primaryKey = 'patient_id';
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
        return $this->hasMany(PatientFaceId::class, 'patient_id');
    }
    public function emergencyContacts()
    {
        return $this->hasMany(PatientEmergencyContact::class, 'patient_id');
    }
    public function chats()
    {
        return $this->hasMany(Chat::class, 'doctor_id', 'doctor_id');
    }
}
