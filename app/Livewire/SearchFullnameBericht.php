<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use App\Models\person as Search;




class SearchFullnameBericht extends Component
{
    #[Validate('required')]
    public $searchText = '';
    public $results = [];



    public function updatedSearchText($value) 
    {
        $this->reset('results');

        $this->validate();

        $searchTerm = "{$value}%";

        $this->results = Search::where('FullName', 'LIKE', $searchTerm)->get();

    }

    #[on('SearchFullnameBericht:clear-results')]
    public function clear() 
    {
        $this->reset('results', 'searchText');
    }
    public function updateSearchBar($result)
    {
        $this->searchText = $result['FullName'];
        // Voeg hier code toe om andere gegevens bij te werken
    }

    public function render()
    {
        return view('livewire.search-fullname-bericht');
    }
}
