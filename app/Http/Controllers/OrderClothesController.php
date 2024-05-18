<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderClothesController extends Controller
{

    public function index(){

        return view('layouts.admin.orders.index',[

        ]);
    }

}
