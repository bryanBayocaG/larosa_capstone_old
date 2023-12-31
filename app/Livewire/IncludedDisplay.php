<?php

namespace App\Livewire;

use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class IncludedDisplay extends Component
{
    protected $listeners = ['includesupdated' => 'render', 'itemDeleted' => 'render'];
    public function render()
    {
        $includedItem = Cart::instance('itemselected')->content();
        return view('livewire.included-display', compact('includedItem'));
    }

    public function deleteItem($itemRowID)
    {
        Cart::instance('itemselected')->remove($itemRowID);
        $this->dispatch(event: 'itemDeleted');
    }
}
