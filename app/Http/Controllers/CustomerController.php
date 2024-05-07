<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Clothe;
use App\Models\Photo;
use App\Models\SubCategory;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public function index()
    {
        $categories = Category::take(3) -> get();
        return view('layouts.customer.index',[
            'categories' => $categories
        ]);

    }

    public function category(Category $category){

        $subCategories = SubCategory::where('category_id', $category -> id) -> get();

        return view('layouts.customer.categories.index',[
            'category' => $category,
            'subCategories' => $subCategories,
        ]);
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

    public function clothe(Clothe $clothe){

       $photos =  $clothe -> photos;
       $colors = $clothe -> colors;
       $sizes = $clothe -> sizes;
       $subcategory = SubCategory::find($clothe -> sub_category_id);
       $category = Category::find($subcategory -> category_id);

        return view('layouts.customer.clothe.index',[
            'clothe' => $clothe,
            'photos' =>  $photos,
            'colors' => $colors,
            'sizes' =>  $sizes,
            'subcategory' => $subcategory,
            'category' => $category
        ]);
    }
}
