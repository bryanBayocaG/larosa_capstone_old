<?php

namespace App\Livewire;

use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class RegisterButton extends Component
{
    protected $listeners = ['includesupdated' => 'render'];
    public function render()
    {
        $includedItems = Cart::instance('itemselected')->content();
        return view('livewire.register-button', compact('includedItems'));
    }
}
