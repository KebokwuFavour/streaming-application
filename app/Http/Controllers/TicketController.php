<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TicketController extends Controller
{
    // verify ticket payment
    public function verify(Request $request)
    {
        // $reference = $request->reference;

        // // Call Paystack verify API
        // $response = Http::withToken(config('services.paystack.secret'))
        //     ->get("https://api.paystack.co/transaction/verify/{$reference}");

        // if ($response->successful() && $response['data']['status'] === 'success') {
        //     $user = $request->user();

        //     // Issue ticket (1-day validity for example)
        //     $user->tickets()->updateOrCreate(
        //         ['user_id' => $user->id],
        //         ['expires_at' => now()->addDay()]
        //     );

        //     return response()->json(['status' => 'success']);
        // }

        // return response()->json(['status' => 'failed'], 400);


        

        $user = $request->user(); // get authenticated user making this request
        $movieId = $request->movieId; // get movie ID from the request

        // Issue ticket (5-mins validity for example)
        $user->tickets()->create(
            [
                'user_id' => $user->id,
                'movie_id' => $movieId,
                'expires_at' => now()->addMinutes(5), // 5-min ticket
                // 'expires_at' => now()->addDay(), // 1-day ticket
            ], // values to update
        );

        // return success status reponse in JSON format
        return response()->json(['status' => 'success']);
    }
}