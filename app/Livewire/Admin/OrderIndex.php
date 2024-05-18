<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class OrderIndex extends Component
{
    use WithPagination;

    public $search;
    public $search_id;
    public $orderState = 'pending';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function searchById()
    {
        $this->resetPage();
    }

    public function filterByOrderState($state)
    {
        $this->orderState = $state;
        $this->resetPage();
    }

    public function render()
    {
        $usersQuery = User::has('orders');

        if ($this->search_id) {
            $usersQuery->where('id', $this->search_id);
        } else {
            $usersQuery->where('name', 'LIKE', '%' . $this->search . '%');
        }

        if ($this->orderState === 'pending') {
            $usersQuery->whereHas('orders', function ($query) {
                $query->where('state', 'pending');
            });
        } elseif ($this->orderState === 'complete') {
            $usersQuery->whereHas('orders', function ($query) {
                $query->where('state', 'complete');
            });
        }

        $users = $usersQuery->orderBy('id', 'DESC')->paginate(10);

        return view('livewire.admin.order-index', [
            'users' => $users
        ]);
    }
}
