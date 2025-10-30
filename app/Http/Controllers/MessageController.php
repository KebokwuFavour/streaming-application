<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    //
    public function index()
    {
        return Message::with('user')->latest()->take(50)->get()->reverse()->values();
        // return Message::with('user')->latest()->take(50)->where('created_at', '=', today())->get()->reverse()->values();
    }

    public function store(Request $request)
    {

        $requestContent = trim($request->validate(['content' => 'required|string|max:5000'])['content']);

        $message = Message::create([
            'user_id' => $request->user()->id,
            'content' => $requestContent,
        ]);

        return response()->json($message->load('user'));
    }

}