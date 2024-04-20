<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PayPalController;
use App\Http\Controllers\AccountCreationController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\BotManController;

use App\Http\Controllers\Frontend\ReservationController as FrontendReservationController;
use App\Http\Controllers\Frontend\ServiceController as FrontendServiceController;
use App\Http\Controllers\Frontend\PackageController as FrontendPackageController;

require __DIR__.'/auth.php';
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes([
    'verify' => true
]);

Route::get('/', [HomeController::class, 'guest'])
    ->middleware('guest')
    ->name('guest');

Route::middleware(['verified'])->group(function () {
    emotify('success', 'Welcome');
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('/services', ServiceController::class);
    Route::resource('/reservations', ReservationController::class);
    Route::resource('/packages', PackageController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Account Creation
Route::get('/accounts', [UserController::class, 'index'])->name('manageAccount');
Route::get('user/{id}', [UserController::class, 'update'])->name('user.update');
// Route for updating user status
Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
Route::put('/users/{id}/save', [UserController::class, 'saveChanges'])->name('user.saveChanges');
// Route for deleting user
Route::delete('/user/{id}/delete', [UserController::class, 'destroy'])->name('user.delete');

Route::get('/account/create', [AccountCreationController::class, 'create'])->name('accountCreation');
Route::post('/account/create', [AccountCreationController::class, 'store'])->name('accountStoring');

// Menu
Route::get('/menu/filter?menuType=', [MenuController::class, 'index'])->name('menu');
Route::post('/menu/saveMenuItem', [MenuController::class, 'store'])->name('saveMenuItem');
Route::get('/menu/delete/{id}', [MenuController::class, 'delete'])->name('deleteMenuItem');
Route::get('/menu/editMenuDetails/{id}', [MenuController::class, 'showDetails'])->name('showMenuDetails');
Route::get('/menu/editMenuImages/{id}', [MenuController::class, 'showImages'])->name('showMenuImages');
Route::post('/menu/updateDetails', [MenuController::class, 'updateDetails'])->name('updateMenuDetails');
Route::post('/menu/updateImages', [MenuController::class, 'updateImages'])->name('updateMenuImages');
Route::get('/menu/filter', [MenuController::class, 'filter'])->name('filterMenu');

// Discount
Route::get('/discount', [DiscountController::class, 'index'])->name('discount');
Route::get('/discount/create', [DiscountController::class, 'createDiscount'])->name('createDiscount');
Route::post('/discount/create', [DiscountController::class, 'store']);
Route::get('/discount/{discount}', [DiscountController::class, 'specificDiscount'])->name('specificDiscount');
Route::delete('/discount/delete/{discount}', [DiscountController::class, 'destroy'])->name('discountDestroy');
Route::post('/discount/{discount}', [DiscountController::class, 'update'])->name('discountUpdate');

// Cart
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/cart/create', [CartController::class, 'store'])->name('addToCart');
Route::put('/cart/{cart}', [CartController::class, 'update'])->name('cartUpdate');
Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cartCheckout');

// Order
Route::get('/order', [OrderController::class, 'index'])->name('order');
Route::get('/order/{order}', [OrderController::class, 'show'])->name('specificOrder');
Route::get('/staff/order', [OrderController::class, 'kitchenOrder'])->name('kitchenOrder');
Route::get('/staff/order/{order}', [OrderController::class, 'specificKitchenOrder'])->name('specificKitchenOrder');
Route::put('/staff/order/update/{orderItem}', [OrderController::class, 'orderStatusUpdate'])->name('orderStatusUpdate');
Route::get('/staff/previous-order', [OrderController::class, 'previousOrder'])->name('previousOrder');

// PayPal
Route::get('/process-transaction/{transactionAmount}/{orderId}/{discountID}', [PayPalController::class, 'processTransaction'])->name('processTransaction');
Route::get('/success-transaction/{transactionAmount}/{orderId}/{discountID}', [PayPalController::class, 'successTransaction'])->name('successTransaction');
Route::get('/cancel-transaction/{orderId}', [PayPalController::class, 'cancelTransaction'])->name('cancelTransaction');

// Reservations
Route::get('/reservation/history', [FrontendReservationController::class, 'history'])->name('reservations.history');
Route::get('/reservation/step-one', [FrontendReservationController::class, 'stepOne'])->name('reservations.step.one');
Route::post('/reservation/step-one', [FrontendReservationController::class, 'storeStepOne'])->name('reservations.store.step.one');
Route::get('/reservation/step-two', [FrontendReservationController::class, 'stepTwo'])->name('reservations.step.two');
Route::post('/reservation/step-two', [FrontendReservationController::class, 'storeStepTwo'])->name('reservations.store.step.two');
Route::get('/reservation/thankyou', [FrontendReservationController::class, 'thankyou'])->name('reservations.thankyou');
//\Illuminate\Support\Facades\Mail::send(new \App\Mail\NotifReservation());

// Services
Route::get('/cservices', [FrontendServiceController::class, 'index'])->name('cservices.index');
Route::get('/cservices/{service}', [FrontendServiceController::class, 'show'])->name('cservices.show');
Route::post('/cservices/save', [FrontendServiceController::class, 'show'])->name('cservices.show');
Route::post('/cservice', [FrontendServiceController::class, 'store'])->name('cservice.store');
Route::delete('/cservices/{package}', [FrontendServiceController::class, 'destroy'])->name('cservice.destroy');

// Customize Packages
Route::get('/packages', [FrontendPackageController::class, 'index'])->name('packages.index');
Route::get('/get-menu-items', [FrontendPackageController::class, 'getMenuItems'])->name('get.menu.items');
Route::get('get-menu-price', [FrontendPackageController::class, 'getPrice'])->name('get.menu.price');
Route::post('/cservices/save', [FrontendPackageController::class, 'save'])->name('cservices.save');
Route::get('/package/save', [FrontendPackageController::class, 'saveCustomization'])->name('cservices.save');

// Packages
Route::get('/package', [PackageController::class, 'index'])->name('packages.index');

// Inventory
Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory.index');
Route::delete('/inventory/{inventory}', [InventoryController::class, 'destroy'])->name('inventory.destroy');
Route::get('/inventory/{inventory}/edit', [InventoryController::class, 'edit'])->name('inventory.edit');
Route::post('/inventory/store', [InventoryController::class, 'store'])->name('inventory.store');
Route::get('/inventory/create', [InventoryController::class, 'create'])->name('inventory.create');
Route::put('/inventory/{inventory}', [InventoryController::class, 'update'])->name('inventory.update');

// Chatbot

Route::match(['get', 'post'], '/botman', [BotManController::class, 'handle']);
