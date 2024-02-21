<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkingHour extends Model
{
    use HasFactory;
    protected $primaryKey = 'working_hour_id';

    protected $fillable = [
        'working_day_id',
        'doctor_id',
        'start_time',
        'end_time',
    ];

    // Define relationships
    public function workingDay()
    {
        return $this->belongsTo(WorkingDay::class, 'working_day_id', 'working_day_id');
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id', 'doctor_id');
    }
}
