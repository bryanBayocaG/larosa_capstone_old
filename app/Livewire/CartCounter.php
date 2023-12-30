<?php

namespace App\Livewire;

use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartCounter extends Component
{
    public function render()
    {
        $cart_count = Cart::instance('shopping')->count();
        $cart = Cart::instance('shopping')->content();
        return view('livewire.cart-counter', compact('cart_count', 'cart'));
    }
}
