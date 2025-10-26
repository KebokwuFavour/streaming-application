<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    // mass assignable attributes
    protected $fillable = ['user_id', 'movie_id', 'expires_at'];

    // cast expires_at to a datetime (Carbon instance)
    protected $casts = [
        'expires_at' => 'datetime', // this makes it a Carbon instance
    ];

    public function isActive()
    {
        // return !$this->expires_at || $this->expires_at->isFuture();
        return !$this->expires_at || $this->expires_at > now();
    }
}