<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class FileInput extends Component
{
    use WithFileUploads;
    
    public $file_url = [];

    public function render()
    {
        return view('livewire.admin.file-input');
    }
}
