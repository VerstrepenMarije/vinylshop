<?php

namespace App\Livewire;

use App\Models\Record;
use Carbon\Carbon;
use Flux;
use Http;
use Livewire\Component;
use Livewire\WithPagination;

class Shop extends Component
{
    use WithPagination;

    public $perPage = 6;
    public $selectedRecord;

    public function showTracks(Record $record): void
    {
        $this->selectedRecord = $record;

        $url = "https://musicbrainz.org/ws/2/release/{$record->mb_id}?inc=recordings&fmt=json";
        try {
            $response = Http::timeout(10)->get($url)->json();
            $tracks = $response['media'][0]['tracks'] ?? [];    // Get the tracks from the response, provide default empty array if not found

            foreach ($tracks as $key => $track) {           //   Convert milliseconds to mm:ss format using Carbon
                $milliseconds = $track['length'] ?? 0;      // Use null coalescing for safety if the length is missing
                $tracks[$key]['length'] = Carbon::createFromTimestampMs($milliseconds)->format('i:s');
            }

            $this->selectedRecord->tracks = $tracks;            // Add the tracks to $selectedRecord
        } catch (\Exception $e) {
            report($e);                         // Handle exceptions (e.g., timeout, network error, invalid JSON)
            $this->selectedRecord->tracks = []; // Set tracks to empty on error
        }

        // Show the modal with the name attribute "tracksModal"
        Flux::modal('tracksModal')->show();
    }

    public function addToBasket( Record $record): void
    {
        $this->js("alert('{$record->title} -Basket not implemented yet')");
    }

    public function render()
    {
        $records = Record::orderBy('artist')
            ->orderBy('title')
            ->paginate($this->perPage);

        return view('livewire.shop', compact('records'));
    }
}
