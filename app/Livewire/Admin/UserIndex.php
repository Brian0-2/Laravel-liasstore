<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class UserIndex extends Component
{
    use WithPagination;

    public $search;
    public $search_id;

    // Este método sirve para resolver el problema que no solo busca el dato en la paginación que este, sino en todos los registros.
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function searchById()
    {
        $this->resetPage(); // Reinicia la paginación
    }

    public function render()
    {
        $usersQuery = User::query();

        if ($this->search_id) {
            $usersQuery->where('id', $this->search_id)
                ->where('id', '!=', Auth::user()->id);
        } else {
            $usersQuery->where(function ($query) {
                $query->where('name', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('email', 'LIKE', '%' . $this->search . '%');
            })
                ->where('id', '!=', Auth::user()->id);
        }

        $users = $usersQuery->where('id', '!=', Auth::user()->id)
            ->whereDoesntHave('roles', function ($query) {
                $query->where('name', 'admin');
            })
            ->orderBy('id', 'DESC')
            ->paginate(10);
            
        foreach ($users as $user) {
            $user->load('roles');
        }

        $roles = Role::all();

        return view('livewire.admin.user-index', [
            'roles' => $roles,
            'users' => $users
        ]);
    }
}
