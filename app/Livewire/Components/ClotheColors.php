<?php

namespace App\Livewire\Components;

use Livewire\Component;

class ClotheColors extends Component
{

    public $numInputsColor = 0;

    public function addInputColor () {
        $this -> numInputsColor ++;
    }

    public function deleteInputColor() {
        $this -> numInputsColor --;
    }
    
    public function render()
    {
        return view('livewire.components.clothe-colors');
    }
}
