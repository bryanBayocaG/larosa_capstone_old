<?php

namespace App\Http\Controllers;

use App\Models\item;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AddSelectController extends Controller
{
    public function store(Request $request)
    {
        // $item = item::findOrFail($request->input('item_id'));
        // $image = $item->productImage;
        // $code = $item->item_code;
        // $quan = $request->input('quantity');
        // $color = $request->input('color');
        // //Cart::add('id', 'name', quantity, price, weight);

        // Cart::instance('itemselected')->add(
        //     $item->id,
        //     $item->name,
        //     $quan,
        //     1,
        //     0,
        //     ['image' => $image, 'code' => $code, 'color' => $color]
        // );
        // return redirect()->back()->with('message', 'Item included to set!');
    }
    public function store2(Request $request)
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

        $item = item::findOrFail($itemId);
        $image = $item->productImage;
        $code = $item->item_code;
        $color = $request->input('color');
        //Cart::add('id', 'name', quantity, price, weight);

        Cart::instance('itemselected')->add(
            $item->id,
            $item->name,
            $quantity,
            1,
            0,
            ['image' => $image, 'code' => $code, 'color' => $color]
        );
        return redirect()->back()->with('message', 'Item included to set!');
    }
    public function destroy($id)
    {
        $rowId = $id;

        Cart::instance('itemselected')->remove($rowId);
        return redirect()->back()->with('message', 'Product Remove from Cart!');
    }
}