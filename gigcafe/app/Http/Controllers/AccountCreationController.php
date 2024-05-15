<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;

class AccountCreationController extends Controller
{    
    /**
     * Display the account creation view.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // only admins are allowed to view this page.
        if (auth()->user()->role != 'admin')
            abort(403, 'This route is only meant for restaurant admins.');

        return view('accountCreation'); 
    }

    /**
     * Handle incoming account creation requests.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // validate requests.
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', Rules\Password::defaults()],
            'role' => ['required', 'string']
        ]);

        // after validation, create the user accordingly.
        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'mobile_number' => $request->mobile_number,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);

        // redirect back to account creation page along with a success session.
        return redirect()->route('accountCreation')->with('success', 'Account created!');
    }
}
