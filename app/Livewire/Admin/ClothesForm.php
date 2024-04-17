<?php

namespace App\Livewire\Admin;

use App\Models\Size;
use Livewire\Component;
use App\Models\Category;
use App\Models\Provider;
use App\Livewire\Forms\ClotheCreate;
use App\Models\SubCategory;
use Livewire\Attributes\On;
use Livewire\Features\SupportFileUploads\WithFileUploads;


class ClothesForm extends Component
{
    use WithFileUploads;

    public ClotheCreate $clotheCreate;
    public $providers;
    public $categories;
    public $subcategories = [];
    public $numInputsColor = 0;
    public $sizes;



    public function mount() {
        $this -> providers = Provider::all();
        $this -> sizes = Size::all();
        $this -> categories = Category::all();
    }


    #[On('createSelect($id)')]
    public function createSelect($id)
    {
        if (!empty($id)) {
            // Obtener las subcategorías asociadas a la categoría seleccionada
            $this->subcategories = SubCategory::where('category_id', $id)->get();
        } else {
            $this->subcategories = null;
        }
    }

    #[On('deleteImage($index)')]
    public function deleteImage($index)
    {
        if (isset($this->clotheCreate->file[$index])) {
            unset($this->clotheCreate->file[$index]);
        }
    }

    public function addInputColor () {
        $this -> numInputsColor ++;
    }

    public function deleteInputColor() {
        $this -> numInputsColor --;
    }


    public function store()
    {
        $this -> clotheCreate -> save();
    }



    public function render()
    {
        return view('livewire.admin.clothes-form');
    }
}
