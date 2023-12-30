<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Color;

class ColorTable extends Component
{
    public $Colors;
    public $name;
    public function create()
    {
        $this->validate([
            'name' => 'required',

        ]);

        $data = new Color;
        $data->name = $this->name;
        $data->save();

        $this->dispatch('closeModal1');
        $this->dispatch('message1');


        $this->name = '';
        $this->getData();

        return redirect()->back();
    }
    public function getData()
    {
        $this->Colors = Color::latest()->get();
    }
    public function mount()
    {
        $this->getData();
    }
    public function render()
    {
        return view('livewire.colortable');
    }
}