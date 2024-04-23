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
        return view('layouts.customer.index');
    }

    public function category(Category $category){

        $subCategories = SubCategory::where('category_id', $category -> id) -> get();


        return view('layouts.customer.categories.index',[
            'category' => $category,
            'subCategories' => $subCategories,
        ]);
    }

    public function subcategory(subcategory $subcategory){
        
        $clothesWithPhotos = DB::table('clothes')
        ->select(
            'clothes.name',
            'clothes.unit_price',
            DB::raw('MIN(photos.file_url) as file_url'))
        ->leftJoin('photos', 'clothes.id', '=', 'photos.clothe_id')
        ->where('clothes.sub_category_id', $subcategory->id)
        ->groupBy('clothes.id', 'clothes.name', 'clothes.unit_price')
        ->paginate(50);

        return view('layouts.customer.categories.subcategories', [
            'clothesWithPhotos' => $clothesWithPhotos,
            'subcategory' => $subcategory
        ]);
    }
}
