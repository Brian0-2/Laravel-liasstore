<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;
use Livewire\Features\SupportFileUploads\WithFileUploads;


class CategoriesForm extends Component
{

    use WithFileUploads;

    public $input;
    public $subcategory = [];
    public $name;
    public $image;

    public function rules(){
        return  [
            'name' => 'required|min:3',
            'subcategory' => 'required|min:1',
            'image' => 'require',
        ];
    }

    public function validationAttributes() {
        return [
        'name' => 'nombre',
        'subcategory' => 'sub categoria',
        ];
    }


    public function addInputColor () {
        $this -> input ++;
    }

    public function deleteInputColor() {
        $this -> input --;
    }

    public function save(){
         $this -> rules();
         $category =  Category::create([
             'name' => $this -> name,
             'file_url' => '',
         ]);

        if($this -> subcategory && $this -> image){

            foreach($this -> subcategory as $data){

                //Create image
                $imagen_webp = Image::make($this -> image->getRealPath())->fit(800, 800)->encode('webp', 80);

                //Create path and uniqu image name.
                $dir_name = 'storage/images';
                $image_name = Str::uuid();

                //Save images
                $imagen_webp -> save($dir_name.'/'.$image_name.'.webp');

                //Create sub categori into database
                SubCategory::create([
                    'name' => $data,
                    'file_url' => $image_name,
                    'category_id' => $category -> id,
                ]);

                //Clear image temporary
                Storage::deleteDirectory('livewire-tmp');

            }
        }

    }

    public function placeholder(){
        return view('livewire.spiners.loading');
    }

    public function render()
    {
        return view('livewire.admin.categories-form');
    }
}
