<?php

namespace App\Http\Controllers;

use App\Events\TypingMessage;
use Illuminate\Http\Request;

class TypingController extends Controller
{
    //
    public function __invoke(Request $request)
    {
        broadcast(new TypingMessage($request->user()))->toOthers();
        return response()->json(['status' => 'ok']);
    }
}