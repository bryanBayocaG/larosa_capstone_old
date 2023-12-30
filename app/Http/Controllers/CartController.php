<?php

namespace App\Http\Controllers;

use App\Models\product_set;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function store(Request $request)
    {
        $product = product_set::findOrFail($request->input('setID'));
        $image = $product->productImage;
        $code = $product->set_code;
        $size = $product->size_id;
        $color = $product->color_id;
        $price = str_replace(',', '', $request->input('price'));
        $quan = $request->input('quantity');
        //Cart::add('id', 'name', quantity, price, weight);

        Cart::instance('shopping')->add(
            $product->id,
            $product->name,
            $quan,
            $price,
            0,
            ['size' => $size, 'image' => $image, 'code' => $code, 'color' => $color]
        );

        $seetUpdate = product_set::find($request->input('setID'));
        $seetUpdate->quantity = $request->input('currentQuan') - $quan;
        $seetUpdate->save();


        return redirect()->back()->with('message', 'Product Added to Cart');
    }
    public function destroy($id)
    {
        $rowId = $id;
        $itemSet = Cart::instance('shopping')->get($rowId);
        $seetUpdate = product_set::find($itemSet->id);
        $currentQuan = $seetUpdate->quantity;
        $seetUpdate->quantity = $currentQuan + $itemSet->qty;
        $seetUpdate->save();

        Cart::instance('shopping')->remove($rowId);
        return redirect()->back()->with('message', 'Product Remove from Cart');
    }
}
