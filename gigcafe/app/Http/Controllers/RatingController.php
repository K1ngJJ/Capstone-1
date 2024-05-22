<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rating;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function submitRating(Request $request)
    {
        $request->validate([
            'reserv_id' => 'required|exists:reservations,id',
            'service_id' => 'required|exists:services,id',
            'package_id' => 'required|exists:packages,id',
            'service_rating' => 'required|integer|min:1|max:5',
            'package_rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
        ]);

        Rating::create([
            'reserv_id' => $request->input('reserv_id'),
            'user_id' => $request->input('user_id'),
            'service_id' => $request->input('service_id'),
            'package_id' => $request->input('package_id'),
            'user_id' => Auth::id(),
            'service_rating' => $request->input('service_rating'),
            'package_rating' => $request->input('package_rating'),
            'comment' => $request->input('comment'),
            'rated' => 1,
            
        ]);

        return response()->json(['message' => 'Rating submitted successfully'], 200);
    }
}
