<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Log;
use App\Models\Trip as Search;

class SearchTrip extends Component
{
    #[Validate('required')]
    public $searchText = '';
    public $results = [];
    public $selectedId = null; // This will hold the ID of the selected result


    protected $listeners = ['resultSelected' => 'updateSearchBar'];


    public function mount($id = null)
    {
        $trip = Search::find($id);

        if ($trip) {
            $this->selectedId = $trip->id;
            $this->searchText = $trip->FlightNumber;
        }
    }


    public function selectResult($id)
    {

        // Check if the ID is null or empty
        if (is_null($id) || empty($id)) {
            Log::error('ID is null or invalid');
            throw new \Exception('ID is null or invalid');
        } else {
            // Find the result by ID and set the search text
            $this->selectedId = $id;
            $this->searchText = Search::find($id)->FlightNumber;
            $this->reset('results');
        }
    }

    public function updatedSearchText($value)
    {
        $this->reset('results');

        $this->validate();

        $searchTerm = "{$value}%";

        $this->results = Search::where('FlightNumber', 'LIKE', $searchTerm)->get();
    }

    public function clearResults()
    {
        $this->reset('results', 'searchText');
    }

    public function updateSearchBar($result)
    {


        $this->searchText = $result['FlightNumber'];


        // Voeg hier code toe om andere gegevens bij te werken
    }

    public function render()
    {
        return view('livewire.search-trip', [
            'results' => $this->results // Pass the results to the view,
            ,
            'searchText' => $this->searchText // Pass the search text to the view
        ],);
    }
}
