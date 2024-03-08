<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disease extends Model
{
    use HasFactory;
    protected $fillable = ['disease_name'];
    protected $primaryKey = 'disease_id';
    public function disease()
    {
        return $this->hasMany(DiseaseInfo::class, 'disease_id', 'disease_id');
    }
}
