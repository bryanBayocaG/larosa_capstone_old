<?php

use App\Http\Controllers\AddSelectController;
use App\Http\Controllers\AttributeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductSetController;
use App\Http\Controllers\RentorController;
use App\Http\Controllers\RentoutController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/home', [HomeController::class, 'index'])->middleware('auth')->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';


Route::get('/inventory/attributes', [AttributeController::class, 'index'])->name('attributes.page');

Route::get('/inventory/productset', [ProductController::class, 'index'])->name('productset.page');
Route::post('/addProduct', [ProductController::class, 'store'])->name('addProduct');


Route::get('/inventory/items', [ItemsController::class, 'index'])->name('items.page');
Route::post('/addItem', [ItemsController::class, 'store'])->name('addItem');

Route::get('inventory/productset/addProductSet', [ProductSetController::class, 'index']);
Route::post('/updateProductSet/{id}', [ProductController::class, 'update']);

Route::post('/inludeItem', [AddSelectController::class, 'store'])->name('include.selected');
Route::get('/inludeItemRemove/{id}', [AddSelectController::class, 'destroy']);
Route::post('/addItemInSet', [AddSelectController::class, 'store2'])->name('addItemInSet');


Route::get('/renting', [RentoutController::class, 'index'])->name('renting.page');
Route::post('/checkout', [RentoutController::class, 'checkout']);


Route::post('/cartstore', [CartController::class, 'store'])->name('cart.store');
Route::get('/cartRemove/{id}', [CartController::class, 'destroy']);


Route::get('/rentor', [RentorController::class, 'index'])->name('rentor.page');
