<?php

namespace App\Livewire\Admin;

use App\Models\Order;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;

class OrdersUser extends Component
{
    use WithPagination;

    public $userId;
    public $open = false;
    public $clothes;
    public $orderId;

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
        $orders = Order::where('user_id',$this -> userId)
        ->orderBy('created_at', 'desc')
        ->paginate(5);

        return view('livewire.admin.orders-user',[
            'orders' => $orders
        ]);
    }
}
