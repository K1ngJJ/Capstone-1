<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Menu;
use File;


class MenuController extends Controller
{
    public function index() {
        $menus = Menu::get();
        return view('menu', compact('menus'));
    }

    /**
     * Store a newly created menu in database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        // Validate user inputs
        $request->validate([
            'menuName' => 'required',
            'menuDescription' => 'required',
            'menuPrice' => 'required|regex:/^\d+(\.\d{1,2})?/',
            'menuEstCost' => 'required|regex:/^\d+(\.\d{1,2})?/',
            'menuSize' => 'required',
            'menuImage' => 'required|mimes:jpg,png,jpeg|max:10240'
        ]);
        
        $newImageName = time() . '-' . $request->menuName . '.' .
        $request->menuImage->extension();
        $request->menuImage->move(public_path('menuImages'), $newImageName);

        // Create new menu item and save into database
        $newMenuItem = new Menu();
        $newMenuItem->type = $request->menuType;
        $newMenuItem->name = $request->menuName;
        $newMenuItem->description = $request->menuDescription;
        $newMenuItem->price = $request->menuPrice;
        $newMenuItem->estCost = $request->menuEstCost;
        $newMenuItem->image = $newImageName;
        $newMenuItem->size = $request->menuSize;
        $newMenuItem->allergic = $request->menuAllergic;
        $newMenuItem->vegetarian = $request->menuVegetarian;
        $newMenuItem->vegan = $request->menuVegan;
        $newMenuItem->save();
        
        return redirect('/menu/filter?menuType=');
    }

    // Display the specific menu item details fields for edit
    public function showDetails($id)
    {
        $menu = Menu::find($id);
        return view('editMenuDetails', ['menu' => $menu]);
    }

    // Display the specific menu image field for edit
    public function showImages($id)
    {
        $menu = Menu::find($id);
        return view('editMenuImages', ['menu' => $menu]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateDetails(Request $request)
    {
        // Validate user inputs
        $request->validate([
            'menuName' => 'required',
            'menuDescription' => 'required',
            'menuPrice' => 'required|regex:/^\d+(\.\d{1,2})?/',
            'menuEstCost' => 'required|regex:/^\d+(\.\d{1,2})?/',
            'menuSize' => 'required',
        ]);
        
        // Update menu details
        $menu = Menu::find($request->menuID);
        $menu->type = $request->menuType;
        $menu->name = $request->menuName;
        $menu->description = $request->menuDescription;
        $menu->price = $request->menuPrice;
        $menu->estCost = $request->menuEstCost;
        $menu->size = $request->menuSize;
        $menu->allergic = $request->menuAllergic;
        $menu->vegetarian = $request->menuVegetarian;
        $menu->vegan = $request->menuVegan;
        $menu->save();

        return redirect()->route('menu');
    }

    public function updateImages(Request $request)
    {
        if($request->hasFile('menuImage'))
        {
            $menu = Menu::find($request->menuID);

            // Validate user input
            $request->validate([
                'menuImage' => 'required|mimes:jpg,png,jpeg|max:10240'
            ]);
            
            // Delete the original image in the public/menuImages folder
            $imagePath = 'menuImages/' . $menu->image;

            if(File::exists($imagePath))
            {
                File::delete($imagePath);
            }


            // Save the file locally in the storage/public/ folder under a new folder named /menuImages
            $newImageName = time() . '-' . $menu->name . '.' .
            $request->menuImage->extension();

            $request->menuImage->move(public_path('menuImages'), $newImageName);


            $menu->image = $newImageName;
            $menu->save();
        }   
        return redirect()->route('menu');
    }

    // Query database according to filtering options
    public function filter(Request $request)
    {
        $menu = Menu::query();

        if($request->filled('menuType'))
        {
            $menu->where('type', $request->menuType);
        }

        if($request->filled('fromPrice'))
        {
            $menu->where('price', '>=', $request->fromPrice);
        }

        if($request->filled('toPrice'))
        {
            $menu->where('price', '<=', $request->toPrice);
        }

        if($request->filled('menuSize'))
        {
            $menu->where('size', $request->menuSize);
        }

        if($request->filled('menuAllergic'))
        {
            $menu->where('allergic', $request->menuAllergic);
        }

        if($request->filled('menuVegetarian'))
        {
            $menu->where('vegetarian', $request->menuVegetarian);
        }

        if($request->filled('menuVegan'))
        {
            $menu->where('vegan', $request->menuVegan);
        }

        return view('menu', [
            'menus' => $menu->get()
        ]);
    }

    /**
     * Remove the specified menu item from database.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $menu = Menu::find($id);
        $imagePath = 'menuImages/' . $menu->image;
        // Delete the image in the public/menuImages folder
        if(File::exists($imagePath))
        {
            File::delete($imagePath);
        }

        $menu->delete();
        return redirect()->route('menu');
    }
}
