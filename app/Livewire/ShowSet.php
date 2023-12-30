<?php

namespace App\Livewire;

use App\Models\product_set;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class ShowSet extends Component
{
    public $sets;
    public $carts;
    public $search = '';
    public function mount()
    {

        // $this->sets = product_set::where('name', 'like', '%' . $this->search . '%')->get();
        // $this->carts = Cart::instance('shopping')->content();
    }

    public function render()
    {
        $setss = product_set::where('name', 'like', '%' . $this->search . '%')->get();
        return view('livewire.show-set', compact('setss'));
    }
}
