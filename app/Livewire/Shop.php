<?php

namespace App\Livewire;

use App\Models\Record;
use Livewire\Component;
use Livewire\WithPagination;

class Shop extends Component
{
    use WithPagination;

    public $perPage = 6;

    public function render()
    {
        $records = Record::orderBy('artist')
            ->orderBy('title')
            ->paginate($this->perPage);

        return view('livewire.shop', compact('records'));
    }
}
