<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        if (auth()->user()->role != 'admin')
            abort(403, 'This route is only meant for restaurant admins.');
        $users = User::all();
        return view('accounts/index', compact('users'));
    }

    public function update($userId) {
        if (auth()->user()->role != 'admin')
            abort(403, 'This route is only meant for restaurant admins.');
        $users = User::find($userId);
        if($users){
            if($users->status){
                $users->status = 0;
            }
            else{
                $users->status = 1;
            }
            $users->save();
        }
        return back();
    }
}
