<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        // Check if the logged-in user has the role of 'kitchenStaff' or 'admin'
        if(auth()->user()->role == 'kitchenStaff') {
            // If the user is a kitchenStaff, fetch and display only customer accounts
            $user = User::where('role', 'customer')->get();
        } else if (auth()->user()->role == 'admin') {
            // If the user is an admin, fetch and display all accounts except admin's own account
            $user = User::where('id', '!=', auth()->user()->id)->get();
        }
        
        return view('accounts/index', compact('user'));
    }
    

//  public function index() {
        // Check if the logged-in user has the role of 'kitchenStaff'
//      if(auth()->user()->role == 'kitchenStaff') {
            // If the user is a kitchenStaff, fetch and display only customer accounts
//          $user = User::where('role', 'customer')->get();
//      } else {
            // If the user is not a kitchenStaff (admin), fetch all users
//          $user = User::all();
//      }
        
//      return view('accounts/index', compact('user'));
//  }
    

    public function update($userId) {
  
        $user = User::find($userId);
        if($user){
            if($user->status){
                $user->status = 0;
            }
            else{
                $user->status = 1;
            }
            $user->save();
        }
        return back();
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('edit', compact('user'));
    }

    public function saveChanges(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'contactnum' => 'required|string|max:20',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->contactnum = $request->contactnum;
        $user->save();

        return back()->with('success', 'Changes saved successfully.');
    }


    public function destroy($userId)
    {
        $user = User::find($userId);

        if(!$user) {
            return back()->with('error', 'User not found.');
        }

        if(!$user->delete()) {
            return back()->with('error', 'Failed to delete user.');
        }

        return back()->with('success', 'User deleted successfully.');
    }

}
