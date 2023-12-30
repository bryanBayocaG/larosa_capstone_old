<?php

namespace App\Livewire;

use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;

class ToBeAddedItems extends Component
{
    public function render()
    {
        $cartItem = Cart::instance('tobeAdded')->content();
        return view('livewire.to-be-added-items', compact('cartItem'));
    }
}
