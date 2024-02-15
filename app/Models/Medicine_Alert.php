<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine_Alert extends Model
{
    use HasFactory;
    protected $fillable = [
        'patient_id', 'medicine_name', 'medicine_dose'
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }
}
