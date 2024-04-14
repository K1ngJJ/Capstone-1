@extends(( !Auth::check() || auth()->user()->role == 'customer' ) ? 'layouts.app' : 'layouts.backend' )

@section('links')
<link href="{{ asset('css/menu.css') }}" rel="stylesheet">
@endsection

@section('bodyID')
{{ 'menu' }}@endsection

@section('navTheme')
{{ 'light' }}@endsection

@section('logoFileName')
{{ URL::asset('/images/Black Logo.png') }}@endsection


@section('content')

<style>
.btn-dark {
    background-color: black;
    color: white;
} 

.btn-dark:hover {
    background-color: white;
    color: black;
} 

.btn-success {
    background-color: black;
    color: white;
} 
.btn-success:hover {
    background-color: white;
    color: black;
}

</style>

<section class="menu" style="margin-top: 17vh;">
    <div class="container">
        <a class="menu-title">
            <h2 class="d-flex justify-content-center menu-title">MENU</h2>
        </a>
        @if (session('success'))
        <div class="alert alert-success fixed-bottom" role="alert" style="width:500px;left:30px;bottom:20px">
            {{ session('success') }}
        </div>
        @endif

        <div class="row menu-bar">
        @if (Auth::check() && auth()->user()->role == 'admin')
            <div class="col-md-1 d-flex align-items-center">
                <div class="dropstart">    
                    <button type="button" class="btn btn-success" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside" id="filter-button">
                        <i class="fa fa-plus" aria-hidden="true"></i></i>
                    </button>
                    <div class="dropdown-menu">    
                        <form method='post' action="{{ route('saveMenuItem') }}" enctype="multipart/form-data" class="px-4 py-3" style="min-width: 350px">
                            @csrf
                            <div class="mb-2">
                                <label for="formFile" class="form-label">Item Image</label>
                                <input name="menuImage" class="form-control" type="file" id="item-image" required>
                            </div>
                            
                            <div class="dropdown-divider"></div>

                            <div class="mb-2">
                                <label for="ItemType" class="form-label">Item Type</label>
                                <div class="input-group mb-3">
                                    <label class="input-group-text" for="itemTypeInputGroup">Type:</label>
                                    <select name="menuType" class="form-select" id="itemTypeInputGroup" >
                                        <option name="menuType" value="Silog">Silog</option>
                                        <option name="menuType" value="Sandwich">Sandwich</option>
                                        <option name="menuType" value="Burger">Burger</option>
                                        <option name="menuType" value="Pasta">Pasta</option>
                                        <option name="menuType" value="Snacks">Snacks</option>
                                        <option name="menuType" value="MilkTea">Milk Tea</option>
                                        <option name="menuType" value="FruitTea">Fruit Tea</option>
                                        <option name="menuType" value="Etc.">Etc.</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="dropdown-divider"></div>

                            <div class="mb-1">
                                <label for="ItemName" class="form-label">Item Name</label>
                                <div class="input-group mb-3">
                                    <input name="menuName" type="text" class="form-control" placeholder="Name" aria-label="Item Name" required>
                                </div>
                            </div>

                            <div class="dropdown-divider"></div>

                            <div class="mb-1">
                                <label for="ItemPrice" class="form-label">Item Price</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text">₱</span>
                                    <input name="menuPrice" type="number" min=0 step=0.01 class="form-control price-class" placeholder="Price" aria-label="Item Price" required>
                                    <span class="validity"></span>
                                </div>
                            </div>

                            <div class="dropdown-divider"></div>

                            <div class="mb-1">
                                <label for="ItemCost" class="form-label">Item Estimated Cost</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text">₱</span>
                                    <input name="menuEstCost" type="number" min=0 step=0.01 class="form-control price-class" placeholder="Cost" aria-label="Item Cost" required>
                                    <span class="validity"></span>
                                </div>
                            </div>

                            <div class="dropdown-divider"></div>

                            <div class="mb-1">
                                <label for="ItemDescription" class="form-label">Item Description</label>
                                <div class="input-group mb-3">
                                    <textarea name="menuDescription" class="form-control" placeholder="Description" aria-label="Item Description" required></textarea>
                                </div>
                            </div>

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

                            <div class="mb-1">
                                <label for="SpecialCondition" class="form-label">Special Condition</label>
                                <div class="form-check">
                                    <input name="menuAllergic" type="hidden" value=0>
                                    <input name='menuAllergic' value=1 type="checkbox" class="form-check-input" id="dropdownCheck">
                                    <label class="form-check-label" for="dropdownCheck">
                                    Allergic
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input name="menuVegetarian" type="hidden" value=0>
                                    <input name='menuVegetarian' value=1 type="checkbox" class="form-check-input" id="dropdownCheck">
                                    <label class="form-check-label" for="dropdownCheck">
                                    Vegetarian
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input name="menuVegan" type="hidden" value=0>
                                    <input name='menuVegan' value=1 type="checkbox" class="form-check-input" id="dropdownCheck">
                                    <label class="form-check-label" for="dropdownCheck">
                                    Vegan
                                    </label>
                                </div>
                            </div>

                            <div class="dropdown-divider"></div>

                            <button type="submit" class="btn btn-outline-success">Add Item</button>
                        </form>
                    </div>
                </div>
            </div>
        @endif
        @if (Auth::check() && auth()->user()->role == 'admin')
            <div class="col-md-8 offset-md-1 col-12 text-center menu-type my-3">
                <form method="get" action="{{ route('filterMenu') }}">
                    <button type="submit" name="menuType" value="" class="btn btn-light menu-type-button">All</button>
                    <button type="submit" name="menuType" value="Silog" class="btn btn-light menu-type-button">Silog</button>
                    <button type="submit" name="menuType" value="Sandwich" class="btn btn-light menu-type-button">Sandwich</button>
                    <button type="submit" name="menuType" value="Burger" class="btn btn-light menu-type-button">Burger</button>
                    <button type="submit" name="menuType" value="Pasta" class="btn btn-light menu-type-button">Pasta</button>
                    <button type="submit" name="menuType" value="Snacks" class="btn btn-light menu-type-button">Snacks</button>
                    <button type="submit" name="menuType" value="Milk Tea" class="btn btn-light menu-type-button">Milk Tea</button>
                    <button type="submit" name="menuType" value="Fruit Tea" class="btn btn-light menu-type-button">Fruit Tea</button>
                    <button type="submit" name="menuType" value="Etc." class="btn btn-light menu-type-button">Etc.</button>
                </form>
            </div>
        @else
            <div class="col-md-8 offset-md-2 col-12 text-center menu-type my-3">
                <form method="get" action="{{ route('filterMenu') }}">
                    <button type="submit" name="menuType" value="" class="btn btn-light menu-type-button">All</button>
                    <button type="submit" name="menuType" value="Silog" class="btn btn-light menu-type-button">Silog</button>
                    <button type="submit" name="menuType" value="Sandwich" class="btn btn-light menu-type-button">Sandwich</button>
                    <button type="submit" name="menuType" value="Burger" class="btn btn-light menu-type-button">Burger</button>
                    <button type="submit" name="menuType" value="Pasta" class="btn btn-light menu-type-button">Pasta</button>
                    <button type="submit" name="menuType" value="Snacks" class="btn btn-light menu-type-button">Snacks</button>
                    <button type="submit" name="menuType" value="Milk Tea" class="btn btn-light menu-type-button">Milk Tea</button>
                    <button type="submit" name="menuType" value="Fruit Tea" class="btn btn-light menu-type-button">Fruit Tea</button>
                    <button type="submit" name="menuType" value="Etc." class="btn btn-light menu-type-button">Etc.</button>
                </form>
            </div>
        @endif
            <div class="col-md-2 d-flex align-items-center">
                <div class="dropstart w-100 d-flex justify-content-end">    
                    <button type="button" class="btn btn-dark" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside" id="filter-button">Filter <i class="fa fa-filter" aria-hidden="true"></i></button>
                    <div class="dropdown-menu">
                        <form method="get" action="{{ route('filterMenu') }}" class="px-4 py-3 " style="min-width: 350px">    
                            <div class="mb-2">
                                <label for="ItemType" class="form-label">Item Type</label>
                                <div class="input-group mb-3">
                                    <label class="input-group-text" for="itemTypeInputGroup">Type:</label>
                                    <select name="menuType" class="form-select" id="itemTypeInputGroup" >
                                        <option name="menuType" value="">All</option>
                                        <option name="menuType" value="Silog">Silog</option>
                                        <option name="menuType" value="Sandwich">Sandwich</option>
                                        <option name="menuType" value="Burger">Burger</option>
                                        <option name="menuType" value="Pasta">Pasta</option>
                                        <option name="menuType" value="Snacks">Snacks</option>
                                        <option name="menuType" value="Milk Tea">Milk Tea</option>
                                        <option name="menuType" value="Fruit Tea">Fruit Tea</option>
                                        <option name="menuType" value="Etc.">Etc.</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="dropdown-divider"></div>
                        
                            <div class="col-12 mb-3">
                                <label for="PriceRange" class="form-label">Price range</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text">₱</span>
                                    <input name="fromPrice" type="text" class="form-control" placeholder="From Price" aria-label="From Price">
                                    <span class="input-group-text">~</span>
                                    <input name="toPrice" type="text" class="form-control" placeholder="To Price" aria-label="To Price">
                                </div>
                            </div>
                            
                            <div class="dropdown-divider"></div>
                            

                            <div class="mb-2">
                                <label for="ItemSize" class="form-label">Portion</label>
                                <div class="input-group mb-3">
                                    <label class="input-group-text" for="itemSizeInputGroup">Size:</label>
                                    <select name="menuSize" class="form-select" id="itemSizeInputGroup" >
                                        <option name="menuSize" value="">All</option>
                                        <option name="menuSize" value="1-2">1 - 2 People</option>
                                        <option name="menuSize" value="3-4">3 - 4 People</option>
                                        <option name="menuSize" value=">5">More than 5 People</option>
                                    </select>
                                </div>
                            </div>

                            <div class="dropdown-divider"></div>

                            <div class="mb-3">
                              <label for="SpecialCondition" class="form-label">Special Condition</label>
                                <div class="form-check">
                                    <input name='menuAllergic' value=1 type="checkbox" class="form-check-input" id="dropdownCheck">
                                    <label class="form-check-label" for="dropdownCheck">
                                    Allergic
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input name='menuVegetarian' value=1 type="checkbox" class="form-check-input" id="dropdownCheck">
                                    <label class="form-check-label" for="dropdownCheck">
                                    Vegetarian
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input name='menuVegan' value=1 type="checkbox" class="form-check-input" id="dropdownCheck">
                                    <label class="form-check-label" for="dropdownCheck">
                                    Vegan
                                    </label>
                                </div>
                            </div>

                            <div class="dropdown-divider"></div>
                            <button type="submit" class="btn btn-outline-dark">Filter</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        


        <div class="d-flex flex-wrap mt-4 mb-5">
        @forelse ($menus as $menu)
            
            <div class="card col-md-3 col-6 d-flex align-items-center">
                <div class="card-body w-100">
                    <form class="d-flex flex-column justify-content-between h-100" action="{{ route('addToCart') }}" method="post">
                        @csrf
                        <div class="flex-center">
                            <img class="card-img-top menuImage" src="{{ asset('menuImages/' . $menu->image) }}">
                        </div>

                        <h5 class="card-title mt-3">
                            {{ $menu->name }} 
                        </h5>
                        
                        <h6 class="card-subtitle mb-2 text-muted">{{ $menu->description }}</h6>
                        <h6 class="card-subtitle mb-2 text-muted">For {{ $menu->size }} people</h6>
                        
                        <div class="d-flex justify-content-between">
                            <p class="card-text fs-5 fw-bold">₱ {{ number_format($menu->price, 2) }}</p>
                            <h6 class="card-text flex-center">
                                @if($menu->allergic)
                                <i class="fa fa-exclamation-circle allergic-alert" aria-hidden="true" data-bs-toggle="tooltip" title="Allergic Warning"></i>
                                @endif

                                @if($menu->vegan)
                                <i class="fa fa-tree" aria-hidden="true" data-bs-toggle="tooltip" title="Vegan Friendly"></i>
                                @elseif($menu->vegetarian)
                                <i class="fa fa-leaf" aria-hidden="true" data-bs-toggle="tooltip" title="Vegetarian Friendly"></i>
                                @endif
                            </h6>
                        </div>

                        <input name="menuID" type="hidden" value="{{ $menu->id }}">
                        <input name="menuName" type="hidden" value="{{ $menu->name }}">
                        @if (Auth::check())
                            @if (auth()->user()->role == 'customer')
                                <button type="submit" class="primary-btn w-100 mt-3">Add to Cart</button>
                            @elseif (auth()->user()->role == 'admin')
                                <div class="dropdown w-100 mt-3">
                                    <a href="#" role="button" id="dropdownMenuLink" 
                                        data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                                        <button class="primary-btn w-100">Edit</button>
                                    </a>

                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <li><a class="dropdown-item" href={{"./editMenuImages/".$menu['id']}}>Edit Images</a></li>
                                        <li><a class="dropdown-item" href={{"./editMenuDetails/".$menu['id']}}>Edit Details</a></li>
                                        <li><a class="dropdown-item" href={{"./delete/".$menu['id']}}>Delete</a></li>
                                    </ul>
                                </div>
                            @endif
                        @endif
                    </form>
                </div>
            </div>
        
        @empty
        <div class="row">
            <div class="col-12">
                <h1>No result found... <i class="fa fa-frown-o" aria-hidden="true"></i></h1>
            </div>
        </div>
        @endforelse
        </div>
    </div>
</section>
@endsection