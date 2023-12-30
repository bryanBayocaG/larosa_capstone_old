<?php

namespace App\Livewire;

use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;

class ShowCartItems extends Component
{
    protected $listeners = ['cartUpdated' => 'render'];
    public function render()
    {
        $cart = Cart::instance('shopping')->content();
        return view('livewire.show-cart-items', compact('cart'));
    }
}
