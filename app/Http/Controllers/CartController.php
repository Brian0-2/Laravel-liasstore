<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Order;
use App\Models\OrderClothes;
use Illuminate\Http\Request;
use App\Http\Responses\ApiResponse;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CartAPIRequest;
use Illuminate\Validation\ValidationException;

class CartController extends Controller
{
    //
    public function index(){

        return view('layouts.customer.shopping.index',[

        ]);
    }

    public function show(){

        $orders = Order::where('user_id' , Auth::user() -> id) -> get();

        return view('layouts.customer.shopping.ordered',[
            'orders' => $orders
        ]);
    }

    public function store(Request $request)
    {
        try {

            $request->validate([
                'cart.*.id' => 'required|integer',
                'cart.*.name' => 'required|string',
                'cart.*.sizeId' => 'required|string',
                'cart.*.price' => 'required|numeric',
                'cart.*.amount' => 'required|integer',
                'total' => 'required|numeric',
            ]);


            $order = Order::create([
                'state' => 'pending',
                'total' => $request -> total,
                'user_id' => Auth::user() -> id,
            ]);


            foreach($request -> cart as $cart){

                OrderClothes::create([
                    'amount' => intval($cart['amount']),
                    'order_id' => $order -> id,
                    'clothe_id' => $cart['id'],
                    'size_id' => $cart['sizeId'],
                    'total' => $request -> total
                ]);
            }

            return ApiResponse::success('Orden ingresada correctamente!',201);

        } catch (ValidationException $e) {
            $errors = $e -> validator -> errors() -> toArray();
            return ApiResponse::error('Errors', 422, $errors);
        }catch(Exception $e){
            return ApiResponse::error('Error'.$e -> getMessage(), 500);
        }
    }
}
