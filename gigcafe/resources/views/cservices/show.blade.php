@extends('layouts.app')

@section('bodyID')
{{ 'home' }}
@endsection

@section('navTheme')
{{ 'dark' }}
@endsection

@section('logoFileName')
{{ URL::asset('/images/Black Logo.png') }}
@endsection

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
            .btn-red {
                background-color: #ce3232;
                border-color: #ce3232;
            }
            .custom-word-overlay {
                position: absolute;
                top: 0;
                left: 0;
                width: 50%;
                height: 10%;
                display: flex;
                justify-content: center;
                align-items: center;
                background-color: rgba(206, 50, 50, 0.7); 
            }

            .custom-word {
                color: white;
                font-weight: bold; 
            }
        </style>
                <div class="container-fluid px-5 py-6 mx-auto">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-10 col-lg-8">
                        @php
                            $selectedServiceName = ''; 
                            if ($selectedId) {
                                $selectedService = $services->firstWhere('id', $selectedId);
                                if ($selectedService) {
                                    $selectedServiceName = strtoupper($selectedService->name);
                                }
                            }
                        @endphp

                        <h2 class="text-center menu-title" style="font-size: 2.0rem;font-style: italic;">
                            @if ($selectedServiceName)
                                {{ $selectedServiceName }}
                            @else
                                CATERING
                            @endif
                            PACKAGES
                        </h2>
                    </div>
                </div>
            </div>


                    @if (Auth::check() && auth()->user()->role == 'customer')
                    <div class="col-md-1 d-flex align-items-center">
                        <div class="dropstart">
                            <button type="button" class="btn btn-success" data-bs-toggle="dropdown" aria-expanded="false"
                                data-bs-auto-close="outside" id="filter-button">
                                <i class="fa fa-plus" aria-hidden="true"></i></i>
                            </button>
                            <div class="dropdown-menu">
                                <form method="POST" action="{{ route('cservice.store') }}" enctype="multipart/form-data"
                                    class="px-4 py-3" style="min-width: 350px">
                                    @csrf
                                    <label> Custom Package </label>
                                    <div class="dropdown-divider"></div>
                                    <div class="mb-1">
                                        <label for="name" class="form-label"></label>
                                        <div class="input-group mb-3">
                                            <input name="name" id="name" type="text"
                                                class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                                                placeholder="Package Name" aria-label="name" required>
                                        </div>
                                    </div>

                                    @error('name')
                                    <div class="text-sm text-red-400">{{ $message }}</div>
                                    @enderror

                                    <div class="input-group mb-3" hidden>
                                        <input name="description" id="description" type="text"
                                            class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                                            placeholder="description" aria-label="description" required>
                                    </div>

                                    <div class="mb-1">
                                        <label for="image" class="form-label"> Image </label>
                                        <div class="mt-1">
                                            <input type="file" id="image" name="image"
                                                class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                                                required />
                                        </div>
                                    </div>
                                    @error('image')
                                    <div class="text-sm text-red-400">{{ $message }}</div>
                                    @enderror

                                    <div class="mb-2">
                                        <div class="input-group mb-3">
                                            <input type="number" placeholder="Guest Number" id="guest_number"
                                                name="guest_number"
                                                class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                                                required />
                                        </div>
                                    </div>

                                    @error('guest_number')
                                    <div class="text-sm text-red-400">{{ $message }}</div>
                                    @enderror

                                    <div class="mt-1" hidden>
                                        <select id="status" name="status"
                                            class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                                            @foreach (App\Enums\PackageStatus::cases() as $status)
                                            <option value="{{ $status->value }}">{{ $status->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    @error('status')
                                    <div class="text-sm text-red-400">{{ $message }}</div>
                                    @enderror

                                    <div class="mt-1" hidden>
                                        <select id="service" name="services[]"
                                            class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                                            @foreach ($services as $serviceItem)
                                            <option value="{{ $serviceItem->id }}"
                                                @if ($serviceItem->id == $selectedId) selected @endif>{{ $serviceItem->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mt-1" hidden>
                                        <input type="number" min="0.00" max="100000.00" step="0.01" id="price"
                                            name="price" value="7999"
                                            class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                    </div>
                                    @error('price')
                                    <div class="text-sm text-red-400">{{ $message }}</div>
                                    @enderror


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
                                    </ul>

                                    <div class="dropdown-divider"></div>
                                    <h3>Selected Menu Items:</h3>
                                    @error('description')
                                    <div class="text-sm text-red-400">{{ $message }}</div>
                                    @enderror
                                    <ul id="selectedMenuList">
                                    </ul>

                                    <script>
                                        function calculateTotalPrice() {
                                            var selectedMenuList = document.querySelector('#selectedMenuList');
                                            var selectedItems = selectedMenuList.querySelectorAll('li');
                                            var totalPrice = 0;

                                            selectedItems.forEach(item => {
                                                var price = parseFloat(item.textContent.match(/₱(\d+(\.\d+)?)/)[1]);
                                                var quantity = parseInt(item.querySelector('input[type="number"]').value);
                                                totalPrice += price * quantity;
                                            });

                                            document.getElementById('price').value = totalPrice.toFixed(2);
                                        }


                                        function updateMenuQuantity() {
                                        var selectedMenuList = document.querySelector('#selectedMenuList');
                                        var selectedItems = selectedMenuList.querySelectorAll('li');
                                        var totalPrice = 0;

                                        selectedItems.forEach(item => {
                                            var price = parseFloat(item.textContent.match(/₱(\d+(\.\d+)?)/)[1]);
                                            var quantity = parseInt(item.querySelector('input[type="number"]').value);
                                            totalPrice += price * quantity;
                                        });

                                        document.getElementById('price').value = totalPrice.toFixed(2);

                                        var selectedList = Array.from(selectedItems).map(item => {
                                            var itemName = item.textContent.split(' - ')[0];
                                            var itemQuantity = item.querySelector('input[type="number"]').value;
                                            return `${itemName.trim()} (${itemQuantity})`;
                                        });

                                        var descriptionInput = document.getElementById('description');
                                        if (selectedList.length > 0) {
                                            descriptionInput.value = "This package includes " + selectedList.join(', ') + ".";
                                        } else {
                                            descriptionInput.value = "";
                                        }
                                    }

                                    function handleMenuSelection(menuId, menuName, menuPrice, checkbox) {
                                        var selectedMenuList = document.querySelector('#selectedMenuList');

                                        if (checkbox.checked) {
                                            var listItem = document.createElement('li');
                                            listItem.id = 'menu_' + menuId;
                                            listItem.innerHTML = `
                                                ${menuName} - ₱${menuPrice}:
                                                <input type="number" name="menu_quantities[${menuId}]" value="1" min="1" style="width: 55px;" onchange="updateMenuQuantity()">
                                                <button onclick="deleteMenuItem(${menuId})"><span style="color:red;">&#x2716;</span></button>`;
                                            selectedMenuList.appendChild(listItem);
                                        } else {
                                            var listItem = document.getElementById('menu_' + menuId);
                                            listItem.remove();
                                        }

                                        updateMenuQuantity();
                                    }

                                        function deleteMenuItem(menuId) {
                                            var listItem = document.getElementById('menu_' + menuId);
                                            listItem.remove();
                                            calculateTotalPrice();
                                        }

                                        document.getElementById('itemTypeInputGroup').addEventListener('change', function () {
                                            var menuType = this.value;
                                            fetch('{{ route("get.menu.items") }}?menuType=' + menuType)
                                                .then(response => response.json())
                                                .then(data => {
                                                    var menuList = document.querySelector('ul#menuList');
                                                    menuList.innerHTML = '';
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
                                        
                                        document.addEventListener('change', function(event) {
                                            var target = event.target;
                                            if (target.matches('input[type="number"]')) {
                                                updateMenuQuantity();
                                            }
                                        });

                                        document.addEventListener('click', function(event) {
                                            var target = event.target;
                                            if (target.matches('button')) {
                                                var menuItemId = target.parentElement.id.split('_')[1];
                                                deleteMenuItem(menuItemId);
                                            }
                                        });


                                    </script>


                                    <div class="dropdown-divider"></div>



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
            <div class="d-flex flex-wrap mt-4 mb-5">
                @forelse ($availablePackages as $package)
                <div class="card col-md-3 col-6 d-flex align-items-center">
                    <div class="card-body w-100">
                        <div style="height: 200px; overflow: hidden;">
                            <img class="card-img-top menuImage" src="{{ Storage::url($package->image) }}"
                                alt="Image" style="object-fit: cover; width: 100%; height: 100%;" />
                                @if ($package->user_id !== null)
                                <div class="custom-word-overlay">
                                <span class="custom-word">Custom</span>
                            </div>
                            @endif
                        </div>
                        <h5 class="card-title mt-3">{{ $package->name }}</h5>
                        <h6 class="card-subtitle mb-2 text-muted">{{ $package->description }}</h6>
                        <div class="d-flex justify-content-between">
                            <p class="card-text fs-5 fw-bold">₱{{ $package->price }}</p>
                        </div>
                        @if ($package->user_id !== null)
        <div class="d-flex justify-content-end mt-3">
            <!-- Button to trigger modal -->
            <button class="btn btn-danger me-2" data-bs-toggle="modal" data-bs-target="#editModal{{ $package->id }}">
                <i class="fa fa-edit"></i> Edit
            </button>
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $package->id }}">
    Delete
</button>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal{{ $package->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $package->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel{{ $package->id }}">Delete Package</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this package?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form action="{{ route('cservice.destroy', $package->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Delete Modal -->

                    
                    <!-- Edit Modal -->
<div class="modal fade" id="editModal{{ $package->id }}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Package</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <!-- Your edit form goes here -->
                <form method="POST" action="{{ route('packages.update', $package->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <!-- Place your edit form fields here -->
                       @csrf
                                    <label> Custom Package </label>
                                    <div class="dropdown-divider"></div>
                                    <div class="mb-1">
                                        <label for="name" class="form-label"></label>
                                        <div class="input-group mb-3">
                                            <input name="name" id="name" type="text"
                                                class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                                                placeholder="Package Name" aria-label="name" required>
                                        </div>
                                    </div>

                                    @error('name')
                                    <div class="text-sm text-red-400">{{ $message }}</div>
                                    @enderror

                                    <div class="input-group mb-3" hidden>
                                        <input name="description" id="description" type="text"
                                            class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                                            placeholder="description" aria-label="description" required>
                                    </div>

                                    <div class="mb-1">
                                        <label for="image" class="form-label"> Image </label>
                                        <div class="mt-1">
                                            <input type="file" id="image" name="image"
                                                class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                                                required />
                                        </div>
                                    </div>
                                    @error('image')
                                    <div class="text-sm text-red-400">{{ $message }}</div>
                                    @enderror

                                    <div class="mb-2">
                                        <div class="input-group mb-3">
                                            <input type="number" placeholder="Guest Number" id="guest_number"
                                                name="guest_number"
                                                class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                                                required />
                                        </div>
                                    </div>

                                    @error('guest_number')
                                    <div class="text-sm text-red-400">{{ $message }}</div>
                                    @enderror

                                    <div class="mt-1" hidden>
                                        <select id="status" name="status"
                                            class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                                            @foreach (App\Enums\PackageStatus::cases() as $status)
                                            <option value="{{ $status->value }}">{{ $status->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    @error('status')
                                    <div class="text-sm text-red-400">{{ $message }}</div>
                                    @enderror

                                    <div class="mt-1" hidden>
                                        <select id="service" name="services[]"
                                            class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                                            @foreach ($services as $serviceItem)
                                            <option value="{{ $serviceItem->id }}"
                                                @if ($serviceItem->id == $selectedId) selected @endif>{{ $serviceItem->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mt-1" hidden>
                                        <input type="number" min="0.00" max="100000.00" step="0.01" id="price"
                                            name="price" value="7999"
                                            class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                    </div>
                                    @error('price')
                                    <div class="text-sm text-red-400">{{ $message }}</div>
                                    @enderror


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
                                    </ul>

                                    <div class="dropdown-divider"></div>
                                    <h3>Selected Menu Items:</h3>
                                    @error('description')
                                    <div class="text-sm text-red-400">{{ $message }}</div>
                                    @enderror
                                    <ul id="selectedMenuList">
                                    </ul>

                                    <script>
                                        function calculateTotalPrice() {
                                            var selectedMenuList = document.querySelector('#selectedMenuList');
                                            var selectedItems = selectedMenuList.querySelectorAll('li');
                                            var totalPrice = 0;

                                            selectedItems.forEach(item => {
                                                var price = parseFloat(item.textContent.match(/₱(\d+(\.\d+)?)/)[1]);
                                                var quantity = parseInt(item.querySelector('input[type="number"]').value);
                                                totalPrice += price * quantity;
                                            });

                                            document.getElementById('price').value = totalPrice.toFixed(2);
                                        }

                                        function handleMenuSelection(menuId, menuName, menuPrice, checkbox) {
                                            var selectedMenuList = document.querySelector('#selectedMenuList');
                                            var selectedItems = selectedMenuList.querySelectorAll('li');
                                            var selectedList = [];
                                            selectedItems.forEach(item => {
                                                var itemName = item.textContent.split(' - ')[0];
                                                selectedList.push(itemName.trim());
                                            });

                                            if (checkbox.checked) {
                                                var listItem = document.createElement('li');
                                                listItem.id = 'menu_' + menuId;
                                                listItem.innerHTML = `
                                        ${menuName} - ₱${menuPrice}:
                                        <input type="number" name="menu_quantities[${menuId}]" value="1" min="1" style="width: 55px;" onchange="calculateTotalPrice()">
                                        <button onclick="deleteMenuItem(${menuId})"><span style="color:red;">&#x2716;</span></button>`;
                                                selectedMenuList.appendChild(listItem);
                                                selectedList.push(menuName.trim());
                                            } else {
                                                var listItem = document.getElementById('menu_' + menuId);
                                                listItem.remove();
                                                selectedList = selectedList.filter(item => item !== menuName.trim());
                                            }

                                            var descriptionInput = document.getElementById('description');
                                            if (selectedList.length > 0) {
                                                var selectedItemsText = selectedList.join(', ');
                                                descriptionInput.value = "This package includes " + selectedItemsText + ".";
                                            } else {
                                                descriptionInput.value = "";
                                            }

                                            calculateTotalPrice();
                                        }

                                        function deleteMenuItem(menuId) {
                                            var listItem = document.getElementById('menu_' + menuId);
                                            listItem.remove();
                                            calculateTotalPrice();
                                        }

                                        document.getElementById('itemTypeInputGroup').addEventListener('change', function () {
                                            var menuType = this.value;
                                            fetch('{{ route("get.menu.items") }}?menuType=' + menuType)
                                                .then(response => response.json())
                                                .then(data => {
                                                    var menuList = document.querySelector('ul#menuList');
                                                    menuList.innerHTML = '';
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
                </form>
            </div>
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
        </div>
        @endif
                        

            </div>
                </div>
                @empty
                <div class="row">
                    <div class="col-12">
                        <h1>No packages available for this service... <i class="fa fa-frown-o"
                                aria-hidden="true"></i></h1>
                    </div>
                </div>
                @endforelse
            </div>
            <!--hr class="my-4">
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
        </div-->
        
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
</section>
</html>
@endsection