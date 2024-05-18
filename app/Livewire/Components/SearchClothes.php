<?php

namespace App\Livewire\Components;

use App\Models\Clothe;
use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;


class SearchClothes extends Component
{
    use WithPagination;

    public $search;
    public $selectedCategories = [];
    public $categories;

    public function mount()
    {
        $this->categories = Category::all();
    }
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function submitForm()
    {
        $this->resetPage();
    }

    public function placeholder(){
        return view('livewire.spiners.loading');
    }
    public function render()
    {
        $query = Clothe::query()
            ->with('sizes')
            ->select(
                'clothes.id as id',
                'clothes.name as clothe',
                'clothes.unit_price as price',
                DB::raw('COALESCE(MIN(photos.file_url), "ruta_por_defecto") as photo')
            )
            ->leftJoin('photos', 'photos.clothe_id', '=', 'clothes.id')
            ->join('sub_categories', 'clothes.sub_category_id', '=', 'sub_categories.id')
            ->join('categories', 'sub_categories.category_id', '=', 'categories.id')
            ->when($this->search, function ($query) {
                $query->where('clothes.name', 'LIKE', '%' . $this->search . '%');
            })
            ->when($this->selectedCategories, function ($query) {
                $query->whereIn('categories.id', $this->selectedCategories);
            })
            ->groupBy('clothes.id')
            ->orderBy('id', 'DESC');

        $clothes = $query->paginate(5);
        return view('livewire.components.search-clothes', [
            'clothes' => $clothes
        ]);
    }
}
