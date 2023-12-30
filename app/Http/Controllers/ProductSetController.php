<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Color;
use App\Models\item;
use App\Models\ItemCategory;
use App\Models\product_set;
use App\Models\Size;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class ProductSetController extends Controller
{
    public function index()
    {
        $categ = Category::all();
        $icateg = ItemCategory::all();
        $colorses = Color::all();
        $size = Size::all();
        $items = item::all();
        $includedItems = Cart::instance('itemselected')->content();
        // $Product = product_set::find($id);
        // $combi =  Category::with('products')->get();
        return view('admin.addSet', compact('categ', 'colorses', 'size', 'items', 'icateg', 'includedItems'));
    }
}
