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
        return view('galleries.gallery', compact('galleries', 'services'));
    }

    // Display the specific gallery image field for edit
    public function showImages($id)
    {
        $galleries = Gallery::find($id);
        return view('galleries.editGalleryImages', ['gallery' => $galleries]);
    }

    public function store(Request $request)
    {
        if (auth()->user()->role == 'customer')
        abort(403, 'This route is only meant for restaurant staffs.');

        $request->validate([
            'category' => 'required',
            'image' => 'required|mimes:jpg,png,jpeg|max:10240'
        ]);
        
        $newImageName = time() . '-' . $request->image->getClientOriginalName();
        $request->image->move(public_path('galleryImages'), $newImageName);
    
        $newImage = new Gallery();
        $newImage->category = $request->category;
        $newImage->image = $newImageName;
        $newImage->save();
        
        return redirect('gallery')->with('success', 'Image uploaded successfully!');
    }

    public function updateImages(Request $request)
    {
        if (auth()->user()->role == 'customer')
        abort(403, 'This route is only meant for restaurant staffs.');

        if ($request->hasFile('galleryImages')) {
            $gallery = Gallery::find($request->galleryID);
    
            // Validate user input
            $request->validate([
                'galleryImages' => 'required|image|mimes:jpg,png,jpeg|max:10240'
            ]);
            
            // Delete the original image if it exists
            $imagePath = public_path('galleryImages/' . $gallery->image);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
    
            // Save the new image
            $newImageName = time() . '-' . $gallery->name . '.' .
            $request->file('galleryImages')->getClientOriginalExtension();
    
            $request->file('galleryImages')->move(public_path('galleryImages'), $newImageName);
    
            // Update the image path in the database
            $gallery->image = $newImageName;
            $gallery->save();
        }   
    
        return redirect()->route('gallery');
    }


    public function filter(Request $request)
    {
        $galleryQuery = Gallery::query();
    
        if($request->filled('galleryType'))
        {
            $galleryQuery->where('category', $request->galleryType);
        }
    
        $galleries = $galleryQuery->get(); // Fetch filtered galleries
    
        $services = Service::all(); // Fetch services
    
        return view('galleries.gallery', [
            'galleries' => $galleries, // Pass filtered galleries to the view
            'services' => $services, // Pass services to the view
        ]);
    }
    
    
    
    public function delete($id)
    {
        if (auth()->user()->role == 'customer')
        abort(403, 'This route is only meant for restaurant staffs.');

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
