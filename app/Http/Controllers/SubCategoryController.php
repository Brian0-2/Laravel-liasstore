<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubCategoryRequest;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use DragonCode\Support\Facades\Filesystem\File;



class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Category $category)
    {
       $subcategories = SubCategory::where('category_id', $category -> id) -> get();

        return view('layouts.admin.subcategories.index',[
            'category' => $category,
            'subcategories' => $subcategories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SubCategoryRequest $request)
    {

        $request -> validate([
            'file_url' => 'required',
            'category_id' => 'required|exists:categories,id',
        ]);

         if($request -> hasFile('file_url')){

             $dir_name = 'storage/images';
             $image_name = Str::uuid();

             $imagen_webp = Image::make($request -> file('file_url')->getRealPath())->fit(800, 800)->encode('webp', 80);

             $imagen_webp->save($dir_name . '/' . $image_name.'.webp');

             SubCategory::create([
                 'name' => $request -> name,
                 'file_url' => $image_name,
                 'category_id' => $request -> category_id,
             ]);

         }

        return redirect() -> back()-> with('message-created','Creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(SubCategory $subcategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubCategory $subcategory)
    {
        return view('layouts.admin.subcategories.edit',[
            'subcategory' => $subcategory
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SubCategoryRequest $request, SubCategory $subcategory)
    {
        //Current category
        $currentSubcategory = $subcategory -> category;

        if($request -> hasFile('file_url')){
            $dir_name = 'storage/images/';
            $image_name = Str::uuid();

            $current_image = $subcategory->file_url;

            $current_image_path = $dir_name . $current_image . '.webp';

            if (File::exists($current_image_path)) {
                File::delete($current_image_path);
            }

            //Create new image
            $imagen_webp = Image::make($request -> file('file_url')->getRealPath())->fit(800, 800)->encode('webp', 80);
            $imagen_webp->save($dir_name . '/' . $image_name.'.webp');

            $subcategory -> update([
                'name' => $request -> name,
                'file_url' => $image_name
            ]);

        }else{
            $subcategory -> update([
                'name' => $request -> name,
            ]);
        }

        return redirect() -> route('subcategories.create',$currentSubcategory -> id) -> with('message-updated','La subcategoria fue editada correctamente!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubCategory $subcategory)
    {
        //
        dd($subcategory);
    }
}
