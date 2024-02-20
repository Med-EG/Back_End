<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlertTime extends Model
{
    use HasFactory;
    protected $fillable = [
        'alert_id',
        'alert_time',
    ];

    public function medicineAlert()
    {
        return $this->belongsTo(MedicineAlert::class, 'alert_id');
    }
}
