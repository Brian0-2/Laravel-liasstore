<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Auth;


class OrderDetails extends Component
{

    public $orderId;
    public $orders;
    public $open = false;
    public $clothes;

    public function mount(){
        $this -> orders = Order::where('user_id' , Auth::user() -> id) -> get();
    }

    public function placeholder(){
        return view('livewire.spiners.loading');
    }
    
    #[On('showOrderDetails($orderId)')]
    public function showOrderDetails($orderId)
    {
       $this -> open = true;

       $order = Order::find($orderId);

        // Asignar los datos a la propiedad del componente
        $this->clothes = $order->load('clothes.photos');

    }

    public function render()
    {
        return view('livewire.order-details');
    }
}
