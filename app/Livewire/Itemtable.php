<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ItemCategory;

class Itemtable extends Component
{

    public $ItemCateg;
    public $name;
    public $description;

    public function create()
    {
        $this->validate([
            'name' => 'required',
            'description' => 'nullable',
        ]);

        $data = new ItemCategory;
        $data->name = $this->name;
        $data->description = $this->description;
        $data->save();

        $this->dispatch('closeModal');
        $this->dispatch('message');


        $this->name = '';
        $this->description = '';
        $this->getData();

        return redirect()->back();
    }
    public function getData()
    {
        $this->ItemCateg = ItemCategory::latest()->get();
    }
    public function mount()
    {
        $this->getData();
    }
    public function render()
    {
        return view('livewire.itemtable');
    }
}
