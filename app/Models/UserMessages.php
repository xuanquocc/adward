<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserMessages extends Model
{
    use HasFactory;

    public $table = 'user_messages';
    protected $fillable = [
        'message_id',
        'sender_id',
        'receiver_id',
        'type',
        'seen_status',
        'deliver_status',
    ];
}
