<?php

namespace App\Http\Controllers;

use App\Models\Clothe;
use App\Models\Provider;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::count();
        $providers = Provider::count();
        $clothes = Clothe::count();


        return view('layouts.admin.index',[
            'users' => $users,
            'providers' => $providers,
            'clothes' => $clothes,
        ]);
    }


}
