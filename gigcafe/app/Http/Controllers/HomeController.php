<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;


class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    
     public function index() {
        $user = Auth::user();
        
    
        if ($user && $user->role == 'admin') {
            return redirect()->route('dashboard');
        } elseif ($user && $user->role == 'kitchenStaff') {
            return redirect()->route('kitchenOrder');
        }
    
        // If the user is not redirected by role, check if the email is verified
        if ($user && !$user->hasVerifiedEmail()) {
            return redirect()->route('verification.notice');
        }
    
        return view('home');
    }

    public function guest() {
        return view('guest');
    }
}
