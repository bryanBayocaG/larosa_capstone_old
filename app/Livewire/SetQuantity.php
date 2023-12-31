<?php

namespace App\Livewire;

use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class SetQuantity extends Component
{
    protected $listeners = ['includesupdated' => 'render', 'itemDeleted' => 'render'];
    public function render()
    {
        $cartContent = Cart::instance('itemselected')->content();
        $minQuantity = PHP_INT_MAX;


        if ($cartContent->isEmpty()) {
            $minQuantity = 0;
        } else {
            foreach ($cartContent as $item) {
                $quantity = $item->qty;
                if ($quantity < $minQuantity) {
                    $minQuantity = $quantity;
                }
            }
        }
        return view('livewire.set-quantity', compact('minQuantity'));
    }
}
