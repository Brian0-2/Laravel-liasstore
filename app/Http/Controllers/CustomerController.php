<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Photo;
use App\Models\Clothe;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\OrderClothes;
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


    public function clothe(Clothe $clothe)
    {

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

    public function search(){
        return view('layouts.customer.clothe.search');
    }

}
