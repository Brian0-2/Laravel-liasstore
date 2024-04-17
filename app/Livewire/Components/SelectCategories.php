<?php

namespace App\Livewire\Components;

use App\Models\Category;
use App\Models\SubCategory;
use Livewire\Attributes\On;
use Livewire\Component;

class SelectCategories extends Component
{
    public $categories;
    public $subcategories = [];
    public $category;
    public $subcategoryId;

    public function mount()
    {
        $this->categories = Category::all();
        $this->subcategories = SubCategory::where('category_id',$this -> category)->get();
        $this -> subcategoryId;
    }

    #[On('createSelect($id)')]
    public function createSelect($id)
    {
        if (!empty($id)) {
            // Obtener las subcategorías asociadas a la categoría seleccionada
            $this->subcategories = SubCategory::where('category_id', $id)->get();
        } else {
            $this->subcategories = [];
        }
    }

    public function render()
    {
        return view('livewire.components.select-categories');
    }
}
