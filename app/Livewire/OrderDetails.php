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
    public $totalAmount = 0;
    public $total;
    public $orderState = 'pending';


    public function placeholder(){
        return view('livewire.spiners.loading');
    }

    #[On('showOrderDetails($orderId)')]
    public function showOrderDetails($orderId)
    {
        $this->open = true;
        $this->totalAmount = 0;
        $order = Order::find($orderId);

        if ($order) {
            $this->clothes = $order->clothes()->with(['photos', 'orderClothes', 'sizes'])->get();

            foreach ($this->clothes as $index => $clothe) {
                $this->totalAmount += $clothe->orderClothes -> sum('amount');
            }

            $this->total = $this->totalAmount;
        }
    }

    public function filterByOrderState($state)
    {
        $this->orderState = $state;
        $this->resetPage();
    }

    public function render()
    {
        $orders = Order::where('user_id', Auth::id());

        if ($this->orderState === 'pending') {
            $orders->where('state', 'pending');
        } elseif ($this->orderState === 'complete') {
            $orders->where('state', 'complete');
        }

        $orders = $orders->orderBy('created_at', 'desc')->paginate(2);

        return view('livewire.order-details', [
            'orders' => $orders
        ]);
    }

}
