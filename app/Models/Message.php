<?php

namespace App\Models;

use App\Events\MessageCreated;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    // mass assignable attributes
    protected $fillable = [
        'user_id',
        'content',
    ];
    
    protected static function booted()
    {
        
        // static::created(fn($msg) => broadcast(new MessageCreated($msg))->toOthers()); // broadcast to all except the sender

        static::created(fn($msg) => broadcast(new MessageCreated($msg))); // broadcast to all including the sender

    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}