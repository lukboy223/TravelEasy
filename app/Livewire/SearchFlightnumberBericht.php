<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use App\Models\Trip as Search;

class SearchFlightnumberBericht extends Component
{

    #[Validate('required')]
    public $flightnumberSearch = '';
    public $results = [];

    protected $listeners = ['resultSelected' => 'updateSearchBar'];


    public function updatedSearchText($value) 
    {
        $this->reset('results');

        $this->validate();

        $searchTerm = "{$value}%";

        

        $this->results = Search::where('FlightNumber', 'LIKE', $searchTerm)->get();

    }

    #[On('SearchFlightNumberBericht:clear-results')]
    public function clear() 
    {
        $this->reset('results', 'flightnumberSearch');
    }

    public function updateSearchBar($result)
    {
        $this->flightnumberSearch = $result['FlightNumber'];
        
        // Voeg hier code toe om andere gegevens bij te werken
    }

    public function render()
    {
        return view('livewire.search-flightnumber-bericht',[
            'results' => $this->results // Pass the results to the view,
            ,'flightnumberSearch' => $this->flightnumberSearch // Pass the search text to the view
        ]);
    }
}
