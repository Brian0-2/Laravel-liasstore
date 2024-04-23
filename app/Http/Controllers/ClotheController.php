<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClotheRequest;
use App\Models\Clothe;
use App\Models\ClothesSizes;
use App\Models\Color;
use App\Models\Photo;
use App\Models\Provider;
use App\Models\Size;
use DragonCode\Support\Facades\Filesystem\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Str;

// php artisan make:controller ClothesController --model=Clothes -r

class ClotheController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('layouts.admin.clothes.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $providers = Provider::all();
        $sizes = Size::all();

        return view('layouts.admin.clothes.create', [
            'providers' => $providers,
            'sizes' => $sizes,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //TODO
    }

    /**
     * Display the specified resource.
     */
    public function show(Clothe $clothes)
    {
        //TODO
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Clothe $clothes)
    {

        $photos = $clothes->photos;
        $colors = $clothes->colors;
        $currentSubCategory = $clothes -> subCategory;
        $currentCategory = $currentSubCategory -> category;

        $providers = Provider::all();
        $sizes = Size::all();

        return view('layouts.admin.clothes.edit', [
            'clothes' => $clothes,
            'currentCategory' => $currentCategory,
            'currentSubCategory' => $currentSubCategory,
            'providers' => $providers,
            'colors' => $colors,
            'photos' => $photos,
            'sizes' => $sizes,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ClotheRequest $request, Clothe $clothes)
    {
        // Create path
        $dir_name = 'storage/images/';

        if($request -> has('colors')){
            //Colors request
            $newColors = $request -> colors;

            //Bring to me colors
            $currentColors = $clothes->colors;

            foreach($currentColors as $color){
                //Delete current colors
                $color -> delete();
            }

            //Create new Colors
            foreach($newColors as $color ){
                Color::create([
                    'name' => $color,
                    'clothe_id' => $clothes -> id
                ]);
            }
        }

        if ($request->hasFile('files')) {

            // Upload Files
            $images = $request->file('files');

            $newImages = [];
            //Bring to me
            $currentImages = $clothes->photos;

            //Delete Images
            if ($currentImages) {
                foreach ($currentImages as $image) {
                    File::delete($dir_name . $image->file_url);
                    //Delete from database
                    $image->delete();
                }
            }

            //Create new Images
            foreach ($images as $image) {

                $image_name = Str::uuid();

                // Create image
                $imagen_webp = Image::make($image->getRealPath())->fit(800, 800)->encode('webp', 80);
                $newImages =  $image_name;

                //Save images
                $imagen_webp->save($dir_name . '/' . $image_name);
                Photo::create([
                    'clothe_id' => $clothes -> id,
                    'file_url' => $newImages
                ]);
            }
        }

        foreach($request -> sizes as $size){
            ClothesSizes::create([
                'clothe_id' => $clothes -> id,
                'size_id' => $size
            ]);
        }

            // Get temporary images and delete it
            Storage::deleteDirectory('livewire-tmp');

            $clothes -> update([
                'name' => $request -> name,
                'description' => $request -> description,
                'unit_price' => $request -> unit_price,
                'provider_id' => $request -> provider_id,
                'sub_category_id' => $request -> sub_category_id,
            ]);

           return redirect() -> route('clothes.index')
           ->with('message-updated', 'Prenda Editada correctamente!');

    }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Clothe $clothes)
    {
        dd($clothes);
    }
}
