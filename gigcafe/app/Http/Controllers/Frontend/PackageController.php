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

    public function saveCustomization(Request $request)
    {
        // Validate the request data
        $request->validate([
            'menu_items' => 'required|array',
            'menu_quantities' => 'required|array',
            'menuSize' => 'required'
        ]);

        // Process the form submission
        // Here, you can save the customization data to the database or perform any other action
        // For demonstration purposes, let's just return the submitted data
        return $request->all();
    }
}
