<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Color;
use App\Models\product_set;
use App\Models\Size;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $categ = Category::all();
        $color = Color::all();
        $size = Size::all();
        $Products = product_set::all();
        // $combi =  Category::with('products')->get();
        return view('admin.products', compact('categ', 'color', 'size', 'Products'));
    }
    public function store(Request $request)
    {

        $quan = $request->input('quantity');
        $cartContent = Cart::instance('itemselected')->content();
        $name = $request->input('name');
        $category_id = $request->input('category');
        $size_id = $request->input('size');
        $color_id = $request->input('color');
        $quantity = $quan;
        $image = $request->file('image');

        $randomCode = Str::random(10);
        $imageName = $randomCode . '.' . $image->getClientOriginalExtension();
        $image->storeAs('product_images', $imageName, 'public');
        $itemId = DB::table('product_sets')->insertGetId([
            'set_code' => $randomCode,
            'name' => $name,
            'quantity' => $quantity,
            // 'remaining' => $quantity,
            'category_id' => $category_id,
            'size_id' => $size_id,
            'color_id' => $color_id,
            'productImage' => $imageName,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        foreach (Cart::instance('itemselected')->content() as $item) {
            DB::table('included_items')->insert([
                'product_set_id' => $itemId,
                'item_id' => $item->id,
                'quantity' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            DB::table('item_quantities')
                ->where('item_id', $item->id)
                ->update([
                    'remaining' => DB::raw('remaining - ' . $quan),
                    'updated_at' => now(),
                ]);
        };
        Cart::instance('itemselected')->destroy();
        return redirect()->back()->with('message', 'Product set added successfully.');
    }
}
