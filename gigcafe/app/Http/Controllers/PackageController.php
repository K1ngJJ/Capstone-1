<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\PackageStoreRequest;
use App\Models\Service;
use App\Models\Package;
use App\Enums\PackageStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $packages = Package::all();
        return view('packages.index', compact('packages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $services = Service::all();
        return view('packages.create', compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PackageStoreRequest $request)
    {
        $image = $request->file('image')->store('public/packages');

        $package = Package::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $image,
            'guest_number' => $request->guest_number,
            'status' => $request->status,
            'price' => $request->price
        ]);

        if ($request->has('services')) {
            $package->services()->attach($request->services);
        }

        return redirect()->route('packages.index')->with('success', 'Package created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Package $package)
    {
        $packages = Package::where('status', PackageStatus::Available)->get();
        $services = Service::all();
        return view('packages.edit', compact('package', 'services', 'packages'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Package $package)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'guest_number' => 'required',
            'status' => 'required',
            'price' => 'required'
        ]);
        $image = $package->image;
        if ($request->hasFile('image')) {
            Storage::delete($package->image);
            $image = $request->file('image')->store('public/packages');
        }

        $package->update([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $image,
            'guest_number' => $request->guest_number,
            'status' => $request->status,
            'price' => $request->price
        ]);

        if ($request->has('services')) {
            $package->services()->sync($request->services);
        }
        return redirect()->route('packages.index')->with('success', 'Package updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Package $package)
    {
        Storage::delete($package->image);
        $package->services()->detach();
        $package->delete();
        return redirect()->route('packages.index')->with('danger', 'Package deleted successfully.');
    }
}
