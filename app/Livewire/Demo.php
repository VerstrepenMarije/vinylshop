<?php

namespace App\Livewire;

use App\Models\Genre;
use App\Models\Record;      // Import the Record model
use Livewire\Component;
use Livewire\WithPagination;   // Import the WithPagination trait


class Demo extends Component
{

    use WithPagination;

    public $maxPrice = 100; // Set default max price
    public $perPage = 8;    // Records per page

    public function render()
{
    // Query for Records
    $records = Record::orderBy('artist')    // Order by artist first
    ->orderBy('title')
    //->maxPrice($this->maxPrice) // Use the scope name without 'scope' prefix
    ->paginate($this->perPage); // Use paginate() instead of get()


    // Query for Genres
    $genres = Genre::orderBy('name')
        ->with('records')
        ->has('records')// Eager load the 'records' relationship
        ->get();

    return view('livewire.demo', compact('records','genres'));
}
}
