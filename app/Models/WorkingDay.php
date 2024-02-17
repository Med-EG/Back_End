<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkingDay extends Model
{
    use HasFactory;

    protected $fillable = [
        'doctor_id',
        'day_of_week'
    ];

    protected $primaryKey ='working_day_id';

    public function doctor()
    {
        return $this->belongsTo(Doctor::class , 'doctor_id' , 'doctor_id');
    }
}
