<?php

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Auth;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('chat', function ($user) {
    return Auth::check();
    // return $user != null;
});

Broadcast::channel('typing', function ($user) {
    return Auth::check();
    // return $user != null;
});