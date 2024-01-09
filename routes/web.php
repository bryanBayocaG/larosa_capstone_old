<?php

use App\Http\Controllers\AddSelectController;
use App\Http\Controllers\AttributeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemCategController;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\PrintController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductReportController;
use App\Http\Controllers\ProductSetController;
use App\Http\Controllers\PublicShowController;
use App\Http\Controllers\RentorController;
use App\Http\Controllers\RentoutController;
use App\Http\Controllers\ReturnController;
use App\Http\Controllers\SizeController;

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
Route::get('/home/filterDueDate', [HomeController::class, 'filterDueDate'])->name('filterDueDate');


Route::get('/setCategPage', [HomeController::class, 'setCategPage'])->name('setCategPage');
Route::get('/itemCategPage', [HomeController::class, 'itemCategPage'])->name('itemCategPage');
Route::get('/sizePage', [HomeController::class, 'sizePage'])->name('sizePage');
Route::get('/colorPage', [HomeController::class, 'colorPage'])->name('colorPage');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';


Route::get('/inventory/attributes', [AttributeController::class, 'index'])->name('attributes.page');
Route::get('/delete_category/{id}', [AttributeController::class, 'delete_category']);
Route::get('/delete_Icategory2/{id}', [AttributeController::class, 'delete_category2']);
Route::get('/delete_color/{id}', [AttributeController::class, 'delete_color']);
Route::get('/delete_size/{id}', [AttributeController::class, 'delete_size']);

Route::resource('/category', CategoryController::class)->only(['update']);
Route::resource('/category2', ItemCategController::class)->only(['update']);
Route::resource('/size', SizeController::class)->only(['update']);

Route::post('/addSetCategory', [CategoryController::class, 'addSetCategory'])->name('addSetCategory');
Route::post('/addItemCategory', [ItemCategController::class, 'addItemCategory'])->name('addItemCategory');
Route::post('/addsize', [SizeController::class, 'addsize'])->name('addsize');
Route::post('addColor', [ColorController::class, 'addColor'])->name('addColor');
Route::resource('/color', ColorController::class)->only(['update']);


Route::get('/inventory/productset', [ProductController::class, 'index'])->name('productset.page');
Route::post('/addProduct', [ProductController::class, 'store'])->name('addProduct');


Route::get('/inventory/items', [ItemsController::class, 'index'])->name('items.page');
Route::post('/addItem', [ItemsController::class, 'store'])->name('addItem');
Route::post('/decreaseItem', [ItemsController::class, 'decreaseItem'])->name('decreaseItem');
Route::post('/increaseItem', [ItemsController::class, 'increaseItem'])->name('increaseItem');
Route::post('dropItem', [ItemsController::class, 'dropItem'])->name('dropItem');

Route::get('/inventory/items/detail/{id}', [ItemsController::class, 'detailP']);
Route::resource('/editItem', ItemsController::class)->only(['update']);


Route::get('/inventory/set/detail/{id}', [ItemsController::class, 'detailP2']);
Route::resource('/editSet', ProductController::class)->only(['update']);
Route::post('/increaseSet', [ProductSetController::class, 'increaseSet'])->name('increaseSet');
Route::post('/decreaseSet', [ProductSetController::class, 'decreaseSet'])->name('decreaseSet');
Route::post('dropSet', [ProductSetController::class, 'dropSet'])->name('dropSet');

Route::get('inventory/productset/addProductSet', [ProductSetController::class, 'index']);
// Route::post('/updateProductSet/{id}', [ProductController::class, 'update']);

Route::post('/inludeItem', [AddSelectController::class, 'store'])->name('include.selected');
Route::get('/inludeItemRemove/{id}', [AddSelectController::class, 'destroy']);
Route::post('/addItemInSet', [AddSelectController::class, 'store2'])->name('addItemInSet');


Route::get('/renting', [RentoutController::class, 'index'])->name('renting.page');
Route::post('/checkout', [RentoutController::class, 'checkout']);
Route::get('/qrCheck/{code}', [RentoutController::class, 'qrCodeCheck']);


Route::post('/cartstore', [CartController::class, 'store'])->name('cart.store');
Route::post('/cartstoreI', [CartController::class, 'store2'])->name('cart.storeI');
Route::get('/cartRemove/{id}', [CartController::class, 'destroy']);


Route::get('/rentor', [RentorController::class, 'index'])->name('rentor.page');

Route::get('/rentor/rentorDetails/{id}', [RentorController::class, 'detailP']);
Route::post('/addPayment', [RentorController::class, 'pay']);


Route::get('/print_pdf/{id}', [PrintController::class, 'singleItemPrint']);
Route::get('/download_pdf/{id}', [PrintController::class, 'singleItemDL']);

Route::get('/print_pdf2/{id}', [PrintController::class, 'setItemPrint']);
Route::get('/download_pdf2/{id}', [PrintController::class, 'setItemDL']);


Route::post('/returnSingleRent', [ReturnController::class, 'returnSingle']);
Route::post('/returnSetRent', [ReturnController::class, 'returnSet']);

Route::get('/reportSingleItem', [ProductReportController::class, 'reportSingleItem'])->name('reportSingleItem');
Route::get('/reportSingleItem/filterSingleItem', [ProductReportController::class, 'filterSingleItem'])->name('filterSingleItem');

Route::get('/larosa/showSingleProd/{code}', [PublicShowController::class, 'singleItem']);
Route::get('/larosa/showSetProd/{code}', [PublicShowController::class, 'setItem']);
// Route::get('/larosa/showSingleProd/{code}', [PublicShowController::class, 'setItem']);