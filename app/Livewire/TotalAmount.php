<?php

namespace App\Livewire;

use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class TotalAmount extends Component
{
    protected $listeners = ['cartUpdated' => 'render'];
    public function render()
    {
        $cartTotal = Cart::priceTotal();
        return view('livewire.total-amount', compact('cartTotal'));
    }
}
