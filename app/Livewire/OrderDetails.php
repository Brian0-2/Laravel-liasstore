<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;


class OrderDetails extends Component
{
    use WithPagination;

    public $orderId;
    public $open = false;
    public $clothes;

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
        $orders = Order::where('user_id', Auth::id())
            // ->where('state', 'pending')
            ->orderBy('created_at', 'desc')
            ->paginate(2);

        return view('livewire.order-details',[
            'orders' => $orders
        ]);
    }
}
