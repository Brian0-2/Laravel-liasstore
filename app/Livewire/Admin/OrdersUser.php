<?php

namespace App\Livewire\Admin;

use App\Models\User;
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
    public $totalAmount = 0;
    public $total;
    public $order;

    public function placeholder(){
        return view('livewire.spiners.loading');
    }

    #[On('showOrderDetails($orderId)')]
    public function showOrderDetails($orderId)
    {
       $this -> open = true;
       $this -> totalAmount = 0;

       $order = Order::find($orderId);

        $this->clothes = $order->clothes()->with(['photos', 'orderClothes','sizes']) -> get();

        foreach ($this->clothes as $index => $clothe) {
            $this->totalAmount += $clothe->orderClothes -> sum('amount');
        }

        $this->total = $this -> totalAmount;
    }

    #[On('toggleOrderState($orderId)')]
    public function toggleOrderState(Order $orderId){

        if ($orderId->state === 'pending') {
            $orderId -> state = 'complete';
        } else {
            $orderId -> state = 'pending';
        }

        $orderId->save();

        $order = Order::find($orderId -> id);
    }

    #[On('deleteOrder($orderId)')]
    public function deleteOrder($orderId)
    {
        $order = Order::findOrFail($orderId);
        $userId = $order->user_id;
        $order->delete();

        $userHasOrders = Order::where('user_id', $userId)->count();

        if ($userHasOrders) {
            return redirect()->route('orders.show', $userId)->with('message-deleted', 'Pedido Eliminado correctamente');
        }

        return redirect()->route('orders.index')->with('message-deleted', 'Pedido Eliminado correctamente');
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
