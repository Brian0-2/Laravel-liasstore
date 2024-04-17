<?php

namespace App\Livewire\Admin;

use App\Models\Provider;
use Livewire\Component;
use Livewire\WithPagination;

class ProviderIndex extends Component
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
        $providersQuery = Provider::query();

        if ($this->search_id) {
            $providersQuery->where('id', $this->search_id);
        } else {
            $providersQuery->where('name', 'LIKE', '%' . $this->search . '%');
        }

        $providers = $providersQuery->orderBy('id', 'DESC')->paginate(5);
        return view('livewire.admin.provider-index',[
            'providers' => $providers,
        ]);
    }
}
