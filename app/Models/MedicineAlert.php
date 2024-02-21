<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicineAlert extends Model
{
    use HasFactory;
    protected $fillable = [
        'patient_id', 'medicine_name', 'medicine_dose'
    ];
    protected $primaryKey = 'alert_id';


    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id','patient_id');
    }
    public function alertTimes()
{
    return $this->hasMany(AlertTime::class, 'alert_id', 'alert_id');
}
}
