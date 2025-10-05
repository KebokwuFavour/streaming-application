<?php

namespace App\Actions\Fortify;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        // return User::create([
        //     'name' => $input['name'],
        //     'email' => $input['email'],
        //     'password' => Hash::make($input['password']),
        // ]);
        
        // perform a db transaction to create a new user record as well as updateOrCreate a new ticket record for this user
        $transaction = DB::transaction(function () use ($input) {
            // create user record
            $user = User::create([
                'name'=> $input['name'],
                'email'=> $input['email'],
                'password'=> Hash::make($input['password']),
            ]);
            
            // // update or create ticket record for this user
            // $ticket = Ticket::updateOrCreate(
            //     ['user_id' => $user->id], // lookup condition
            //     ['expires_at' => now()->addMinutes(5)] // values to update
            // );

            // return the user
            return $user; // important

        });

        // return the transaction which will turn out to be the user instance
        return $transaction;

    }
}