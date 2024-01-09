<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Color;
use App\Models\included_item;
use App\Models\item;
use App\Models\Item_details;
use App\Models\Item_quantity;
use App\Models\ItemCategory;
use App\Models\product_set;
use App\Models\Size;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ItemsController extends Controller
{
    public function index()
    {
        $categ = Category::all();
        $items = item::where('stash', null)->get();
        $icateg = ItemCategory::all();
        $colorses = Color::all();
        $tabCategories =  ItemCategory::with('items')->get();
        $sizes = Size::all();

        // $combi =  Category::with('products')->get();
        return view('admin.items', compact('categ', 'items', 'icateg', 'colorses', 'tabCategories', 'sizes'));
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

        $name = $request->input('name');
        $image = $request->file('image');
        $quantity = $request->input('quantity');
        $Itemcateg = $request->input('category');
        $Itemcolor = $request->input('Color');
        $itemSize = $request->input('size');

        $randomCode = Str::random(10);
        $imageName = $randomCode . '.' . $image->getClientOriginalExtension();
        $image->storeAs('item_images', $imageName, 'public');
        $itemId = DB::table('items')->insertGetId([
            'item_code' => $randomCode,
            'cleanlink' => 'httpslarosarentalonlinelarosashowSingleProd' . $randomCode,
            'link' => 'https://larosarental.online/larosa/showSingleProd/' . $randomCode,
            'item_category_id' => $Itemcateg,
            'color_id' => $Itemcolor,
            'size_id' => $itemSize,
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
        return redirect()->back()->with('success', 'Item added successfully.');
    }

    public function detailP($id)
    {
        $item = item::find($id);
        $thoseItems = Item_details::where('item_id', $id)->get();
        $colors = Color::all();
        $ItemCategs = ItemCategory::all();
        $totActiveRentors = Item_details::where('item_id', $id)->where('status', '!=', 'in-possesion')->count();

        $minToDec = Item_details::where('item_id', $id)->where('set_id', 0)->where('set_id2', 0)->where('status', 'in-possesion')->count();

        return view('admin.prodDetailSingle', compact('item', 'thoseItems', 'colors', 'ItemCategs', 'minToDec', 'id', 'totActiveRentors'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'newName' => 'required|string|max:20',
        ]);
        $item = item::find($id);

        $item->name = $request->newName;
        $item->color_id = $request->newColor;
        $item->item_category_id = $request->newCategory;
        if ($request->hasFile('image')) {

            /* Storage::disk('public')->delete('product_images/' . $request->input('old_image')); */
            Storage::disk('public')->delete('item_images/' . $request->input('old_image'));

            $newImage = $request->file('image');
            $imageName = Str::random(10) . '.' . $newImage->getClientOriginalExtension();
            $newImage->storeAs('item_images', $imageName, 'public');
            $item->productImage = $imageName;
        }
        $item->save();
        return redirect()->back()->with('success', 'Item edited successfully.');
    }

    public function decreaseItem(Request $request)
    {
        $quantity = $request->input('quantity');
        $idTodel = $request->input('itemId');

        $itemQuan = Item_quantity::where('item_id', $idTodel)->first();
        $itemQuan->total = intval($itemQuan->total) - intval($quantity);
        $itemQuan->remaining = intval($itemQuan->remaining) - intval($quantity);
        $itemQuan->save();
        for ($i = 0; $i < $quantity; $i++) {
            $itemToDelete = Item_details::where('item_id', $idTodel)->where('set_id', 0)->where('set_id2', 0)->first();
            $itemToDelete->delete();
        }
        return redirect()->back()->with('success', 'Dropped ' . $quantity . ' Item(s) Succesfully');
    }

    public function increaseItem(Request $request)
    {
        $quantity = $request->input('quantity');
        $idToAdd = $request->input('itemId');

        $itemQuan = Item_quantity::where('item_id', $idToAdd)->first();
        $itemQuan->total = intval($itemQuan->total) + intval($quantity);
        $itemQuan->remaining = intval($itemQuan->remaining) + intval($quantity);
        $itemQuan->save();
        for ($i = 0; $i < $quantity; $i++) {
            $randomCodes = Str::random(10);
            DB::table('item_details')->insert([
                'item_code' => $randomCodes,
                'item_id' => $idToAdd,
                'set_id' => 0,
                'set_id2' => 0,
                'status' => "in-possesion",
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        return redirect()->back()->with('success', 'Added new ' . $quantity . ' Item(s) Succesfully');
    }
    public function dropItem(Request $request)
    {
        $reqId = $request->input('id');
        $thisItemUsedinSet = Item_details::where('item_id', $reqId)->where('set_id2', '>', 0)->count();
        $thisItemRented = Item_details::where('item_id', $reqId)->where('set_id', '>', 0)->count();

        if ($thisItemUsedinSet > 0 || $thisItemRented > 0) {
            return redirect()->back()->with('error', 'This item is being used somewhere!');
        } else {

            $itemDetailToDelete = Item_details::where('item_id', $reqId);
            $itemDetailToDelete->delete();

            $itemQuanToDelete = Item_quantity::find($reqId);
            $itemQuanToDelete->delete();

            $itemToDelete = item::find($reqId);
            $itemToDelete->stash = now();
            $itemToDelete->save();

            return redirect('/inventory/items')->with('success', 'Succesfully dropped the Item!');
        }
    }


    public function detailP2($id)
    {
        $item = product_set::find($id);
        $thoseItems = included_item::where('product_set_id', $id)->get();
        $colors = Color::all();
        $ItemCategs = Category::all();
        $sizes = Size::all();


        $minimumQuan = PHP_INT_MAX;

        foreach ($thoseItems as $thoseItem) {
            $mainQuan = Item_details::where('item_id', $thoseItem->item_id)->where('set_id2', 0)->where('set_id', 0)->count();
            if ($mainQuan < $minimumQuan) {
                $minimumQuan = $mainQuan;
            }
        }



        return view('admin.prodDetailSet', compact('item', 'thoseItems', 'id', 'colors', 'ItemCategs', 'sizes', 'minimumQuan'));
    }
}
