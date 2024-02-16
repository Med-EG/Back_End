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
    public function assistants()
    {
        return $this->hasMany(Doctor_Assistant::class);
    }
}
