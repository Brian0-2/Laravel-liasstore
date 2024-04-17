<?php

namespace App\Livewire\Components;

use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
class ImagesClothes extends Component
{
    use WithFileUploads;
    public $images = [];

    #[On('deleteImage($index)')]
    public function deleteImage($index)
    {
        if (isset($this->images[$index])) {
            unset($this->images[$index]);
            $this -> dispatch('imangeDelete');
        }
    }

    public function render()
    {
        return view('livewire.components.images-clothes');
    }
}
