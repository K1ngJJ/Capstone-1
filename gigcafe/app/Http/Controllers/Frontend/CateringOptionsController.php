<?php

namespace App\Http\Controllers\Frontend;


use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\CateringOptions;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;


class CateringOptionsController extends Controller
{
    
    public function index()
{
    $cateringoptions = CateringOptions::all();
    return view('options.index', compact('cateringoptions'));
}

    public function show(CateringOptions $cateringoptions)
    {
        $cateringoptions = CateringOptions::all();      
        return view('options.show', compact('cateringoptions'));
    }
    
    
}

