<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;



class CategTable extends Component
{
    public $Categ;
    public $name;
    public $description;


    public function create()
    {
        $this->validate([
            'name' => 'required',
            'description' => 'nullable',
        ]);

        $data = new Category;
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
        $this->Categ = Category::latest()->get();
    }
    public function mount()
    {
        $this->getData();
    }
    public function render()
    {
        return view('livewire.categtable');
    }
}