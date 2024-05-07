<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DragonCode\Support\Facades\Filesystem\File;
use Intervention\Image\ImageManagerStatic as Image;



class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $categories = Category::all();

        return view('layouts.admin.categories.index',[
            'categories' => $categories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('layouts.admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        if($request -> has('file_url')){

            $dir_name = 'storage/images';
            $image_name = Str::uuid();

            $imagen_webp = Image::make($request -> file_url->getRealPath())->fit(800, 800)->encode('webp', 80);

            $imagen_webp -> save($dir_name.'/'.$image_name.'.webp');
        }

        Category::create([
            'name' => $request -> name,
            'file_url' => $image_name,
        ]);

        return redirect() -> route('categories.index') -> with('message-created','Categoria creada correctamente!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('layouts.admin.categories.edit',[
            'category' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {

        if($request -> file('new_file')){
            $image = $request -> file('new_file');

            $dir_name = 'storage/images/';
            $current_image = $category->file_url;

            $current_image_path = $dir_name . $current_image . '.webp';

        // Verificar la existencia y eliminar la imagen actual si existe
        if (File::exists($current_image_path)) {
            File::delete($current_image_path);
        }

            $image_name = Str::uuid();
            $imagen_webp = Image::make($image->getRealPath())->fit(800, 800)->encode('webp', 80);

            $imagen_webp -> save($dir_name.'/'.$image_name.'.webp');

            $category->update([
                'name' => $request->name,
                'file_url' => $image_name,
            ]);
        }else{
            $category -> update([
                'name' => $request -> name,
                'file_url' => $request -> currentFile,
            ]);
        }

        return redirect() -> route('categories.index') -> with('message-updated', 'La categoria: '. $category -> name .' fue actualizada correctamente!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //

        $dir_name = 'storage/images/';
        $current_image = $category->file_url;

        $current_image_path = $dir_name . $current_image . '.webp';

        // Verificar la existencia y eliminar la imagen actual si existe
        if (File::exists($current_image_path)) {
            File::delete($current_image_path);
        }

        $category -> delete();

        return redirect() -> route('categories.index') -> with('message-deleted','categoria eliminada correctamente!');
    }
}
