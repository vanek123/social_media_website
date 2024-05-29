<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'message_sender', 'message_receiver', 'content', 'status', 'created_at', 'updated_at'];

    public function sender()
    {
        return $this->belongsTo(User::class, 'message_sender');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'message_receiver');
    }
}
