<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;

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
}
