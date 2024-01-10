<?php

namespace App\Livewire;

use App\Models\Item_details;
use Livewire\Component;

class MakeSingleCondition extends Component
{
    public $id;
    public $condition;
    public $itemID;
    public  $item;

    public function render()
    {

        return view('livewire.make-single-condition');
    }
    public function conditionSing()
    {


        $item = Item_details::find($this->id);

        if (!$this->condition) {
            return;
        };
        $item->state = $this->condition;



        $item->save();
        $this->dispatch('warning', text: 'You setted ' . $item->item->name . '-' . $item->item_code . ' to ' . $this->condition . '!.');
    }
}
