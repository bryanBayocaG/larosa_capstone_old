<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Color;
use App\Models\Item_details;
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
        $messages = [
            'name.required|string|max:20',
            'image.required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ];
        $request->validate([
            'name' => 'required|string|max:20',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ], $messages);


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
            'cleanlink' => 'httpslarosarentalonlinelarosashowSetProd' . $randomCode,
            'link' => 'https://larosarental.online/larosa/showSetProd/' . $randomCode,
            'name' => $name,
            'quantity' => $quantity,
            'remaining' => $quantity,
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

            DB::table('item_details')
                ->where('item_id', $item->id)
                ->where('status', 'in-possesion')
                ->where('set_id2', 0)
                ->limit(intval($quan))
                ->update([
                    'set_id2' => $itemId,
                    'updated_at' => now(),
                ]);
        };
        Cart::instance('itemselected')->destroy();
        return redirect()->back()->with('success', 'Product set added successfully.');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'newName' => 'required|string|max:20',
        ]);
        $item = product_set::find($id);

        $item->name = $request->newName;
        $item->color_id = $request->newColor;
        $item->category_id = $request->newCategory;
        $item->size_id = $request->newSize;
        if ($request->hasFile('image')) {

            Storage::disk('public')->delete('product_images/' . $request->input('old_image'));

            $newImage = $request->file('image');
            $imageName = Str::random(10) . '.' . $newImage->getClientOriginalExtension();
            $newImage->storeAs('product_images', $imageName, 'public');
            $item->productImage = $imageName;
        }
        $item->save();
        return redirect()->back()->with('success', 'Item edited successfully.');
    }
}