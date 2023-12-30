<?php

namespace App\Livewire;

use App\Models\item;
use App\Models\product_set;
use App\Models\ProductVar;
use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;

use Livewire\Attributes\Url;

class ProductsTable extends Component
{
    public $price = [];
    // public $products;
    public $productSet;

    public $search = '';


    public function mount()
    {
        // $this->products = Product::all();
        // $this->products = Product::where('name','like', '%' .$this->search.'%')->get();
        // $this->productSets = product_set::where('name', 'like', '%' . $this->search . '%')->get();
        /* $this->productVar = ProductVar::with('product')->get(); */
        // $this->productSet = product_set::all();
    }

    public function render()
    {
        $cart = Cart::instance('shopping')->content();
        $items = item::where('name', 'like', '%' . $this->search . '%')->get();

        return view('livewire.products-table', compact('cart', 'items'));
    }

    public function addToCart($product_id)
    {
        $product = product_set::findOrFail($product_id);
        $image = $product->image_path;
        $code = $product->code;
        //Cart::add('id', 'name', quantity, price, weight);
        Cart::add(
            $product->id,
            $product->apparelName,
            1,
            $this->price[$product_id],
            0,
            ['size' => 'large', 'image' => $image, 'code' => $code]
        );

        $this->dispatch(event: 'cartUpdated');
    }
}
