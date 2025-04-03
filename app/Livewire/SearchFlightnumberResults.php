<?php

namespace App\Livewire;

use Livewire\Attributes\Reactive;
use Livewire\Component;
use App\Models\Trip as Result;
use Illuminate\Support\Facades\Log;

class SearchFlightnumberResults extends Component
{       


    #[Reactive]
    public $results = []; // This is the array that will hold the search results
    public $selectedId = null; // This will hold the ID of the selected result
    public $flightnumberSearch = ''; // This will hold the search text


    public function selectResult($id)
    {
    

        if (is_null($id) || empty($id)) {
            Log::error('ID is null or invalid');
            throw new \Exception('ID is null or invalid');
        }else{
            $this->selectedId = $id;
            $this->flightnumberSearch = Result::find($id)->FlightNumber;
             // Emit an event to notify other components about the selected result
            // $this->emit('resultSelected', ['id' => $id, 'FullName' => $this->searchText]);
            

        }
  

    }

    public function render()
    {
        return view('livewire.search-flightnumber-results');
        return view('livewire.search-flightnumber-bericht', [
            'flightnumberSearch' => $this->flightnumberSearch // Pass the search text to the view
        ]);
    }

}
