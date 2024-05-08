<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gallery;
use App\Models\Service;
use File;

class GalleryController extends Controller
{
    public function gallery() {
        $services = Service::all();
        $galleries = Gallery::get();
        return view('gallery', compact('galleries', 'services'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required',
            'image' => 'required|mimes:jpg,png,jpeg|max:10240'
        ]);
        
        $newImageName = time() . '-' . $request->image->getClientOriginalName();
        $request->image->move(public_path('images'), $newImageName);
    
        $newImage = new Gallery();
        $newImage->category = $request->category;
        $newImage->image = $newImageName;
        $newImage->save();
        
        return redirect('gallery')->with('success', 'Image uploaded successfully!');
    }
    
public function delete($id)
{
    $gallery = Gallery::find($id);

    if (!$gallery) {
        return redirect()->back()->with('error', 'Image not found!');
    }

    $imagePath = public_path('images/' . $gallery->image);
    if (File::exists($imagePath)) {
        File::delete($imagePath);
    }

    $gallery->delete();

    return redirect()->route('gallery')->with('success', 'Image deleted successfully!');
}

}
