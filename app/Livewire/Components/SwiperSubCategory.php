<?php

namespace App\Livewire\Components;

use Livewire\Component;

class SwiperSubCategory extends Component
{

    public $subCategories;
    public $category;

    public function render()
    {
        return view('livewire.components.swiper-sub-category');
    }
}
