<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Color;
use App\Models\included_item;
use App\Models\item;
use App\Models\Item_details;
use App\Models\ItemCategory;
use App\Models\product_set;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ItemsController extends Controller
{
    public function index()
    {
        $categ = Category::all();
        $items = item::all();
        $icateg = ItemCategory::all();
        $colorses = Color::all();
        $tabCategories =  ItemCategory::with('items')->get();

        // $combi =  Category::with('products')->get();
        return view('admin.items', compact('categ', 'items', 'icateg', 'colorses', 'tabCategories'));
    }
    public function store(Request $request)
    {
        $name = $request->input('name');
        $image = $request->file('image');
        $quantity = $request->input('quantity');
        $Itemcateg = $request->input('category');
        $Itemcolor = $request->input('Color');

        $randomCode = Str::random(10);
        $imageName = $randomCode . '.' . $image->getClientOriginalExtension();
        $image->storeAs('item_images', $imageName, 'public');
        $itemId = DB::table('items')->insertGetId([
            'item_code' => $randomCode,
            'item_category_id' => $Itemcateg,
            'color_id' => $Itemcolor,
            'name' => $name,
            'productImage' => $imageName,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('item_quantities')->insert([
            'item_id' => $itemId,
            'total' => $quantity,
            'remaining' => $quantity,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        for ($i = 0; $i < $quantity; $i++) {
            $randomCodes = Str::random(10);
            DB::table('item_details')->insert([
                'item_code' => $randomCodes,
                'item_id' => $itemId,
                'set_id' => 0,
                'set_id2' => 0,
                'status' => "in-possesion",
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        return redirect()->back()->with('message', 'Item added successfully.');
    }
    public function detailP($id)
    {
        $item = item::find($id);
        $thoseItems = Item_details::where('item_id', $id)->get();

        return view('admin.prodDetailSingle', compact('item', 'thoseItems'));
    }
    public function detailP2($id)
    {
        $item = product_set::find($id);
        $thoseItems = included_item::where('product_set_id', $id)->get();

        return view('admin.prodDetailSet', compact('item', 'thoseItems', 'id'));
    }
}
