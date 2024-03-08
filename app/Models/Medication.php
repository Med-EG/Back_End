<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medication extends Model
{
    use HasFactory;
    protected $fillable = ['medication_name'];
    protected $primaryKey = 'medicine_id';
    public function medicationInfo()
    {
        return $this->hasMany(MedicationInfo::class, 'medicine_id', 'medicine_id');
    }
}
