<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Color;
use App\Models\included_item;
use App\Models\item;
use App\Models\Item_details;
use App\Models\ItemCategory;
use App\Models\product_set;
use App\Models\Size;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductSetController extends Controller
{
    public function index()
    {
        $categ = Category::all();
        $icateg = ItemCategory::all();
        $colorses = Color::all();
        $size = Size::all();
        $items = item::all();

        // $includedItems = Cart::instance('itemselected')->content();
        // $Product = product_set::find($id);
        // $combi =  Category::with('products')->get();
        return view('admin.addSet', compact('categ', 'colorses', 'size', 'items', 'icateg'));
    }

    public function increaseSet(Request $request)
    {
        $quan = $request->quantity;
        $itemId = $request->itemId;

        $Theitems = included_item::where('product_set_id', $itemId)->get();
        DB::table('product_sets')
            ->where('id', $itemId)
            ->update([
                'quantity' => DB::raw('quantity + ' . $quan),
                'remaining' => DB::raw('remaining + ' . $quan),
                'updated_at' => now(),
            ]);

        foreach ($Theitems as $damay) {



            DB::table('item_quantities')
                ->where('item_id', $damay->item_id)
                ->update([
                    'remaining' => DB::raw('remaining - ' . $quan),
                    'updated_at' => now(),
                ]);
            // $itemQuaQua = Item_quantity::where('item_id', $damay->item_id)

            DB::table('item_details')
                ->where('item_id', $damay->item_id)
                ->where('status', 'in-possesion')
                ->where('set_id2', 0)
                ->limit(intval($quan))
                ->update([
                    'set_id2' => $itemId,
                    'updated_at' => now(),
                ]);
        }


        return redirect()->back()->with('success', 'Added new ' . $quan . ' Set(s) Succesfully');
    }
    public function decreaseSet(Request $request)
    {
        $quan = $request->quantity;
        $itemId = $request->itemId;

        $Theitems = included_item::where('product_set_id', $itemId)->get();

        DB::table('product_sets')
            ->where('id', $itemId)
            ->update([
                'quantity' => DB::raw('quantity - ' . $quan),
                'remaining' => DB::raw('remaining - ' . $quan),
                'updated_at' => now(),
            ]);

        foreach ($Theitems as $damay) {
            DB::table('item_quantities')
                ->where('item_id', $damay->item_id)
                ->update([
                    'remaining' => DB::raw('remaining + ' . $quan),
                    'updated_at' => now(),
                ]);

            DB::table('item_details')
                ->where('item_id', $damay->item_id)
                ->where('status', 'in-possesion')
                ->where('set_id2', $itemId)
                ->limit(intval($quan))
                ->update([
                    'set_id2' => 0,
                    'updated_at' => now(),
                ]);
        }


        return redirect()->back()->with('success', 'Dropped ' . $quan . ' Set(s) Succesfully');
    }

    public function dropSet(Request $request)
    {
        $SetId = $request->input('SetId');
        $SetQuan = $request->input('SetQuan');

        $Theitems = included_item::where('product_set_id', $SetId)->get();

        foreach ($Theitems as $damay) {
            $thisItemUsedinSet = Item_details::where('item_id', $damay->item_id)->where('set_id2', $SetId)->where('set_id', '>', 0)->count();
            // $thisItemRented = Item_details::where('item_id', $damay->item_id)->where('set_id', '>', 0)->count();
        }



        if ($thisItemUsedinSet > 0) {
            return redirect()->back()->with('error', 'This Set is being rented by customer!');
        } else {

            $itemIncludedToDelete = included_item::where('product_set_id', $SetId)->get();

            foreach ($itemIncludedToDelete as $itemZ) {
                DB::table('item_details')
                    ->where('item_id', $itemZ->item_id)
                    ->where('status', 'in-possesion')
                    ->where('set_id2', $SetId)
                    ->limit(intval($SetQuan))
                    ->update([
                        'set_id2' => 0,
                        'updated_at' => now(),
                    ]);

                DB::table('item_quantities')
                    ->where('item_id', $itemZ->item_id)
                    ->update([
                        'remaining' => DB::raw('remaining + ' . $SetQuan),
                        'updated_at' => now(),
                    ]);
            };

            $setToDelete = product_set::find($SetId);
            $setToDelete->stash = now();
            $setToDelete->save();

            $itemIncludedToDelete2 = included_item::where('product_set_id', $SetId);
            $itemIncludedToDelete2->delete();

            return redirect('/inventory/productset')->with('success', 'Succesfully dropped the Set!');
        }
    }
}
