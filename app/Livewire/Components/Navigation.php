<?php

namespace App\Livewire\Components;

use App\Models\Category;
use Livewire\Component;


class Navigation extends Component
{
    public $categories;

    public function mount(){
        $this -> categories = Category::all();
    }

    public function render()
    {
        return view('livewire.components.navigation');
    }
}
