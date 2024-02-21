<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Allergies extends Model
{
    use HasFactory;
    protected $fillable = ['allergy_name'];
    protected $primaryKey = "allergy_id";
    public function allergiesInfo()
    {
        return $this->hasMany(AllergiesInfo::class, 'allergy_id', 'allergy_id');
    }
}
