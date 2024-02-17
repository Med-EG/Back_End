<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorAssistant extends Model
{
    use HasFactory;
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
