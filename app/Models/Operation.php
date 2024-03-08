<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operation extends Model
{
    use HasFactory;
    protected $fillable = ['operation_name'];
    protected $primaryKey = 'operation_id';
    public function operationinfo()
    {
        return $this->hasMany(OperationInfo::class, 'operation_id', 'operation_id');
    }
}
