<?php

namespace App\Http\Controllers;

use App\Models\Clothe;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\SubCategoryRequest;
use DragonCode\Support\Facades\Filesystem\File;
use Intervention\Image\ImageManagerStatic as Image;



class SubCategoryController extends Controller
{

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

    public function subcategory(subcategory $subcategory){
        $category = Category::find($subcategory->category_id);

        $clothes = Clothe::with(['photos', 'sizes'])
        ->where('sub_category_id', $subcategory->id)
        ->paginate(10);

        $clothes->each(function ($clothe) {
            $clothe->file_url = $clothe->photos->min('file_url');
            $clothe->sizes = $clothe->sizes->pluck('name', 'id')->toArray();
        });

        return view('layouts.customer.categories.subcategories', [
            'clothes' => $clothes,
            'subcategory' => $subcategory,
            'category' => $category
        ]);
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
    public function update(Request $request, SubCategory $subcategory)
    {
        $this->validate($request, [
            'name' => 'required|max:250|min:3'
        ],[],[
            'name' => 'Nombre'
        ]);
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
