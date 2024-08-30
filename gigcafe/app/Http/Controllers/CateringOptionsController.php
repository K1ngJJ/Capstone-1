<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CateringOptionsStoreRequest;
use App\Models\CateringOptions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CateringOptionsController extends Controller
{
    public function __construct() {
        return $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->role == 'customer')
        abort(403, 'This route is only meant for restaurant staffs.');
        $cateringoptions = CateringOptions::all();
        return view('cateringoptions.index', compact('cateringoptions'));
    }

    /**
     * Show the form for creating a new resource.
     * 
     */
    public function create()
    {
        if (auth()->user()->role == 'customer')
        abort(403, 'This route is only meant for restaurant staffs.');
        return view('cateringoptions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CateringOptionsStoreRequest $request)
    {
        if (auth()->user()->role == 'customer')
        abort(403, 'This route is only meant for restaurant staffs.');
        $image = $request->file('image')->store('public/cateringoptions');

        CateringOptions::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $image
        ]);

        return redirect()->route('cateringoptions.index')->with('success', 'service created successfully.');
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
    public function edit(CateringOptions $cateringoption)
    {
        if (auth()->user()->role == 'customer')
        abort(403, 'This route is only meant for restaurant staffs.');
        return view('cateringoptions.edit', compact('cateringoption'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CateringOptions $cateringoption)
    {
        if (auth()->user()->role == 'customer')
        abort(403, 'This route is only meant for restaurant staffs.');
        $request->validate([
            'name' => 'required',
            'description' => 'required'
        ]);
        $image = $cateringoption->image;
        if ($request->hasFile('image')) {
            Storage::delete($cateringoption->image);
            $image = $request->file('image')->store('public/cateringoptions');
        }

        $cateringoption->update([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $image
        ]);
        return redirect()->route('cateringoptions.index')->with('success', 'service updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CateringOptions $cateringoption)
    {
        if (auth()->user()->role == 'customer')
        abort(403, 'This route is only meant for restaurant staffs.');
        Storage::delete($cateringoption->image);
        //$cateringoption->packages()->detach();
        $cateringoption->delete();

        return redirect()->route('cateringoptions.index')->with('danger', 'service deleted successfully.');
    }
}
