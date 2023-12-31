<?php

namespace App\Livewire;

use App\Models\Color;
use App\Models\item;
use App\Models\Item_quantity;
use App\Models\ItemCategory;
use App\Models\Size;
use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;

class ToBeIncludItems extends Component
{
    public $id;
    public $color;
    public $quantity;
    public $dami;
    public $kulay;
    public $item;
    public $sizes;
    public $category;
    public $search = '';

    public function mount()
    {
        $this->sizes = Size::all();
    }
    protected $listeners = ['includesupdated' => 'render', 'itemDeleted' => 'render'];
    public function render()
    {
        $colors = Color::orderBy('name', 'asc')->get();
        $categories = ItemCategory::whereRaw('LOWER(name) NOT LIKE ?', ['%gown%'])
            ->orderBy('name', 'asc')
            ->get();
        $cart = Cart::instance('itemselected')->content();

        $items = Item::where(function ($query) {
            $query->when($this->color, function ($query) {
                $query->where('color_id', $this->color);
            })
                ->when($this->category, function ($query) {
                    $query->where('item_category_id', $this->category);
                });
        })
            ->whereDoesntHave('itemCategory', function ($query) {
                // Exclude items with item_category_id = 4
                $query->where('name', 'LIKE', ['%gown%']);
            })
            ->whereHas('quantity', function ($query) {
                $query->where('remaining', '>', 0);
            })
            ->where('name', 'like', '%' . $this->search . '%')
            ->get();
        return view('livewire.to-be-includ-items', compact('items', 'colors', 'categories', 'cart'));
    }

    public function include($item_id)
    {
        $item = item::findOrFail($item_id);
        $image = $item->productImage;
        $code = $item->item_code;
        $ramaining = $item->quantity->remaining;
        $total = $item->quantity->total;
        $submittedQuantity = $item->quantity->remaining;


        //Cart::add('id', 'name', quantity, price, weight);

        Cart::instance('itemselected')->add(
            $item->id,
            $item->name,
            $submittedQuantity,
            1,
            1,
            ['image' => $image, 'code' => $code, 'color' => $this->kulay, 'remain' => $ramaining, 'total' => $total]
        );
        $this->dispatch(event: 'includesupdated');
    }
}
