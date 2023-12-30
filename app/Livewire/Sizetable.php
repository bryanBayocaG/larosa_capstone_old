<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Size;

class SizeTable extends Component
{
    public $Sizes;
    public $name;
    public $description;


    public function create()
    {
        $this->validate([
            'name' => 'required',
            'description' => 'nullable',
        ]);

        $data = new Size;
        $data->name = $this->name;
        $data->description = $this->description;
        $data->save();

        $this->dispatch('closeModal2');
        $this->dispatch('message2');


        $this->name = '';
        $this->description = '';
        $this->getData();

        return redirect()->back();
    }
    public function getData()
    {
        $this->Sizes = Size::latest()->get();
    }
    public function mount()
    {
        $this->getData();
    }
    public function render()
    {
        return view('livewire.sizetable');
    }
}