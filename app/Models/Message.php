<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $fillable = [
        'message_id', 'chat_id', 'sender' , 'content'
    ];
    protected $primaryKey = 'message_id';


    public function message()
    {
        return $this->belongsTo(Chat::class, 'chat_id','chat_id');
    }
}
