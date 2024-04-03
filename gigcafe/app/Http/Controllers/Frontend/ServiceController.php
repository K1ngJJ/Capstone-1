<?php

namespace App\Http\Controllers\Frontend;

use App\Enums\PackageStatus;
use App\Models\Package;
use App\Models\Menu;
use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;


class ServiceController extends Controller
{
    public function index()
    {
        
        // Fetch only the services that are available
        $services = Service::all();
        
        // Fetch only the packages that are available
        $packages = Package::where('status', PackageStatus::Available)->get();
        
        return view('cservices.index', compact('services', 'packages'));
    }

    public function show(Service $service)
    {
        // Fetch only the packages that are available for the given service
        $availablePackages = $service->packages()->where('status', PackageStatus::Available)->get();
        $menus = Menu::all();
    
        // Pass $service, $availablePackages, and $menus variables to the view
        return view('cservices.show', compact('service', 'availablePackages', 'menus'));
    }
    

   

    
}

