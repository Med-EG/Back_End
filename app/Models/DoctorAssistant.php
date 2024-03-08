<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
class DoctorAssistant extends Authenticatable
{
    use HasFactory,HasApiTokens;
    protected $fillable = [
        'doctor_id',
        'assistant_name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    protected $primaryKey ='assistant_id';

    public function doctor()
    {
        return $this->belongsTo(Doctor::class , 'doctor_id' , 'doctor_id');
    }
}
