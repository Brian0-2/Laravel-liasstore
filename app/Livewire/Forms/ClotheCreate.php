<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use App\Models\Color;
use App\Models\Photo;
use App\Models\Clothe;
use App\Models\ClothesSizes;
use Illuminate\Support\Str;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class ClotheCreate extends Form
{
    #[Validate([
        'name' => 'required',
        'description' => 'required',
        'unit_price' => 'required',
        'sub_category' => 'required',
        'provider' => 'required',
        'file' => 'required',
        'sizes' => 'required',
    ],  message: [
        'name' => 'El campo Nombre es requerido',
        'description' => 'El campo Descripcion es requerido',
        'unit_price' => 'El campo Precio es requerido',
        'sub_Category' => 'El campo Sub Categorias es requerido',
        'provider' => 'El campo Proveedor es requerido',
        'file' => 'El campo Imagen es requerido',
        'sizes' => 'El campo Tallas es requerido'
    ])]

    public $name;
    public $description;
    public $unit_price;
    public $provider;
    public $colors = [];
    public $file = [];
    public $sizes = [];
    public $category;
    public $sub_category;

    public function save()
    {
         $this->validate();

        // Create new clothing item
          $clothe = Clothe::create([
              'name' => $this->name,
              'description' => Str::of($this->description) -> trim(),
              'unit_price' => $this->unit_price,
              'sub_category_id' => $this->sub_category,
              'provider_id' => $this->provider,
          ]);

        if ($this->file) {
            foreach ($this->file as $image) {
                //Create image
                $imagen_webp = Image::make($image->getRealPath())->fit(800, 800)->encode('webp', 80);

                //Create path and uniqu image name.
                $dir_name = 'storage/images';
                $image_name = md5(uniqid(rand(), true));

                //Save images
                $imagen_webp -> save($dir_name.'/'.$image_name.'.webp');

                // Insert image paths into database
                 Photo::create([
                    'clothe_id' => $clothe->id,
                    'file_url' => $imagen_webp -> basename,
                ]);
            }
        }

        foreach($this ->sizes as $size){
            ClothesSizes::create([
                'clothe_id' => $clothe -> id,
                'size_id' => $size
            ]);
        }

        foreach($this -> colors as $color){
            Color::create([
                'name' => $color,
                'clothe_id' => $clothe -> id
            ]);
        }

            // Get temporary images and delete it
            Storage::deleteDirectory('livewire-tmp');

        return redirect() -> route('clothes.index')
        ->with('message-created', 'Prenda Creada correctamente!');
    }
}
