<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceStoreRequest;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::all();
        return view('services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     * 
     */
    public function create()
    {
        return view('services.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ServiceStoreRequest $request)
    {
        $image = $request->file('image')->store('public/services');

        Service::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $image
        ]);

        return redirect()->route('services.index')->with('success', 'service created successfully.');
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
    public function edit(Service $service)
    {
        return view('services.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required'
        ]);
        $image = $service->image;
        if ($request->hasFile('image')) {
            Storage::delete($service->image);
            $image = $request->file('image')->store('public/services');
        }

        $service->update([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $image
        ]);
        return redirect()->route('services.index')->with('success', 'service updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        Storage::delete($service->image);
        $service->packages()->detach();
        $service->delete();

        return redirect()->route('services.index')->with('danger', 'service deleted successfully.');
    }
}
