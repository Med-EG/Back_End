<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'gender',
        'specialization',
        'education',
        'license_id',
        'country',
        'city',
        'street',
        'years_of_experince',
        'scientific_degree',
        'doctor_image',
        'price',
        'rating'
    ];
    protected $primaryKey = 'doctor_id';
    public function assistant()
    {
        return $this->hasMany(DoctorAssistant::class , 'doctor_id' , 'doctor_id');
    }
    public function medicalInfo()
    {
        return $this->hasMany(MedicationInfo::class , 'doctor_id' , 'doctor_id');
    }
    public function diseaseInfo()
    {
        return $this->hasMany(DiseaseInfo::class , 'doctor_id' , 'doctor_id');
    }
    public function allergyInfo()
    {
        return $this->hasMany(AllergiesInfo::class , 'doctor_id' , 'doctor_id');
    }
    public function operationInfo()
    {
        return $this->hasMany(OperationInfo::class , 'doctor_id' , 'doctor_id');
    }
    public function contact()
    {
        return $this->hasMany(DoctorContactNumber::class , 'doctor_id' , 'doctor_id');
    }
    public function workingDay()
    {
        return $this->hasMany(WorkingDay::class , 'doctor_id' , 'doctor_id');
    }
}   
