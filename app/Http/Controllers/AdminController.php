<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Clothe;
use App\Models\Provider;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __invoke(Request $request)
    {
        $users = User::count();
        $providers = Provider::count();
        $clothes = Clothe::count();
        $orders = Order::where('state', 'pending')->count();

        return view('layouts.admin.index',[
            'users' => $users,
            'providers' => $providers,
            'clothes' => $clothes,
            'orders' => $orders
        ]);
    }


}
