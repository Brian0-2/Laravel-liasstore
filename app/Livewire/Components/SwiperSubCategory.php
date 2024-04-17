<?php

namespace App\Livewire\Components;

use Livewire\Component;

class SwiperSubCategory extends Component
{

    public $subCategories;

    //     public function placeholder(){
    //     return view('livewire.spiners.navLoading');
    // }


    public function render()
    {
        return view('livewire.components.swiper-sub-category');
    }
}
