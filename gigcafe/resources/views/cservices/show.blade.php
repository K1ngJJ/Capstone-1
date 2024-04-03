@extends('layouts.app')



@section('bodyID')
{{ 'home' }}@endsection

@section('navTheme')
{{ 'dark' }}@endsection

@section('logoFileName')
{{ URL::asset('/images/Black Logo.png') }}@endsection

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

      

        <!-- Fonts -->

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>

        <style>
            /* Remove outline for quantity input */
            input[type="number"] {
                border: none;
                outline: none;
            }
        </style>
       
    </head>

@section('content')
<section class="banner">
    <div class="container">
  
<br>
<br>
<br>
<br>
<br>
<br>
  
<style>
    .buttonCustom {
        padding-left: 1120px;
    }
    .btn {
        color: white;
        background-color: black;
        border: none;
    }
    .btn:hover {
        color: white;
        background-color: #ce3232;
        transition-duration: 0.5s;
    }
</style>

<div class="container w-full px-5 py-6 mx-auto">
    <h6 class="d-flex justify-content-center menu-title">CATERING PACKAGES</h6>

    <div class="row menu-bar">
    <div class="buttonCustom">

    @if (Auth::check() && auth()->user()->role == 'customer')
    <div class="col-md-1 d-flex align-items-center">
            <div class="dropstart">    
                <button type="button" class="btn btn-success" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside" id="filter-button">
                    <i class="fa fa-plus" aria-hidden="true"></i></i>
                </button>
                <div class="dropdown-menu">    
                    <form method='post'action="{{ route('cservices.save') }}" enctype="multipart/form-data" class="px-4 py-3" style="min-width: 350px">
                        @csrf
                        <div class="dropdown-divider"></div>
                        <div class="mb-1">
                            <label for="ItemName" class="form-label">Name</label>
                            <div class="input-group mb-3">
                                {{ Auth::user()->name }}
                            </div>
                        </div>

                        <div class="dropdown-divider"></div>
                        <div class="mb-1">
                            <label for="ItemName" class="form-label"></label>
                            <div class="input-group mb-3">
                                <input name="menuName" type="text" class="form-control" placeholder="Package Name" aria-label="Item Name" required>
                            </div>
                        </div>

                        <div class="dropdown-divider"></div>
                        <div class="mb-2">
                            <label for="ItemType" class="form-label">Item Type</label>
                            <div class="input-group mb-3">
                                <label class="input-group-text" for="itemTypeInputGroup">Type:</label>
                                <select name="menuType" class="form-select" id="itemTypeInputGroup">
                                    <option value="Silog">Silog</option>
                                    <option value="Sandwich">Sandwich</option>
                                    <option value="Burger">Burger</option>
                                    <option value="Pasta">Pasta</option>
                                    <option value="Snacks">Snacks</option>
                                    <option value="Milk Tea">Milk Tea</option>
                                    <option value="Fruit Tea">Fruit Tea</option>
                                    <option value="Etc.">Etc.</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="dropdown-divider"></div>
                        <h3>Customize Your Menu:</h3>
                        <ul id="menuList">
                            <!-- Menu items will be dynamically inserted here -->
                        </ul>
                        
                        <div class="dropdown-divider"></div>
                        <h3>Selected Menu Items:</h3>
                        <ul id="selectedMenuList">
                            <!-- Selected menu items with quantity inputs will be dynamically inserted here -->
                        </ul>
                        
                        <script>
                            // Function to handle menu item selection and display
                            function handleMenuSelection(menuId, menuName, menuPrice, checkbox) {
                                var selectedMenuList = document.querySelector('#selectedMenuList');
                                if (checkbox.checked) {
                                    var listItem = document.createElement('li');
                                    listItem.id = 'menu_' + menuId;
                                    listItem.innerHTML = `
                                        ${menuName} - ₱${menuPrice}:
                                        <input type="number" name="menu_quantities[${menuId}]" value="1" min="1" style="width: 55px;">
                                        <button onclick="deleteMenuItem(${menuId})"><span style="color:red;">&#x2716;</span></button>`;
                                    selectedMenuList.appendChild(listItem);
                                } else {
                                    var listItem = document.getElementById('menu_' + menuId);
                                    listItem.remove();
                                }
                            }
                        
                            // Function to delete selected menu item
                            function deleteMenuItem(menuId) {
                                var listItem = document.getElementById('menu_' + menuId);
                                listItem.remove();
                            }
                        
                            // Function to update selected menu items list when item type is changed
                            document.getElementById('itemTypeInputGroup').addEventListener('change', function() {
                                var menuType = this.value;
                                fetch('{{ route("get.menu.items") }}?menuType=' + menuType)
                                    .then(response => response.json())
                                    .then(data => {
                                        var menuList = document.querySelector('ul#menuList');
                                        menuList.innerHTML = ''; // Clear existing menu items
                                        data.forEach(menu => {
                                            var li = document.createElement('li');
                                            li.innerHTML = `
                                                <label>
                                                    <input type="checkbox" name="menu_items[]" value="${menu.id}" onclick="handleMenuSelection(${menu.id}, '${menu.name}', ${menu.price}, this)">
                                                    ${menu.name} - ₱${menu.price}
                                                </label>`;
                                            menuList.appendChild(li);
                                        });
                                    })
                                    .catch(error => console.error('Error:', error));
                            });
                        </script>
                        

                        <div class="dropdown-divider"></div>
                        
                        <div class="mb-2">
                            <label for="ItemSize" class="form-label">Portion</label>
                            <div class="input-group mb-3">
                                <label class="input-group-text" for="itemSizeInputGroup">Size:</label>
                                <select name="menuSize" class="form-select" id="itemSizeInputGroup" >
                                    <option name="menuSize" value="1-2">1 - 2 People</option>
                                    <option name="menuSize" value="3-4">3 - 4 People</option>
                                    <option name="menuSize" value=">5">More than 5 People</option>
                                </select>
                            </div>
                        </div>

                     

                        <div class="dropdown-divider"></div>

                        <button type="submit" class="btn btn-outline-success">Save Customization</button>
                    </form>
                </div>
            </div>
        </div>
    @endif
    </div>
    </div>

        <hr class="my-4">
        <div class="grid lg:grid-cols-4 gap-y-6">
            @if($availablePackages->count() > 0)
                @foreach ($availablePackages as $package)
                    <div class="max-w-xs mx-4 mb-2 rounded-lg shadow-lg">
                        <img class="w-full h-48" src="{{ Storage::url($package->image) }}" alt="Image" />
                        <div class="px-6 py-4">
                            <h4 class="mb-3 text-xl font-semibold tracking-tight text-green-600 uppercase">
                                {{ $package->name }}</h4>
                            <p class="leading-normal text-gray-700">
                                {{ $package->description }}
                            </p>
                        </div>
                        <div class="flex items-center justify-between p-4">
                            <span class="text-xl text-green-600">₱{{ $package->price }}</span>
                        </div>
                    </div>
                @endforeach
            @else
                <p>No packages available for this service.</p>
            @endif
        </div>
        
</div>


    <!--div class="container w-full px-5 py-6 mx-auto">
        <div class="grid lg:grid-cols-4 gap-y-6">
            <h6 class="d-flex justify-content-center menu-title">CATERING PACKAGES</h2>
                <hr class="my-4">
            @foreach ($service->packages as $package)
                <div class="max-w-xs mx-4 mb-2 rounded-lg shadow-lg">
                    <img class="w-full h-48" src="{{ Storage::url($package->image) }}" alt="Image" />
                    <div class="px-6 py-4">
                        <h4 class="mb-3 text-xl font-semibold tracking-tight text-green-600 uppercase">
                            {{ $package->name }}</h4>
                        <p class="leading-normal text-gray-700">
                            {{ $package->description }}
                        </p>
                    </div>
                    <div class="flex items-center justify-between p-4">
                        <span class="text-xl text-green-600">₱{{ $package->price }}</span>
                    </div>
                </div>
            @endforeach

        </div>
    </div-->

</div>
</div>
</section>
</html>
@endsection
     
  
