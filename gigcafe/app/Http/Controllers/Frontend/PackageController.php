<?php

namespace App\Http\Controllers\Frontend;

use App\Enums\PackageStatus;
use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PackageController extends Controller
{
    public function index()
    {
        $packages = Package::where('status', PackageStatus::Available)->get();
        return view('cservices.show', compact('packages'));
    }


    public function getMenuItems(Request $request)
    {
        $menuType = $request->input('menuType');
        $menus = Menu::where('type', $menuType)->get();
        return response()->json($menus);
    }
    


}   
