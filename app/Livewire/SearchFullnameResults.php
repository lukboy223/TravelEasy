<?php

namespace App\Livewire;

use Livewire\Attributes\Reactive;
use Livewire\Component;
use App\Models\person as Result;


use function Laravel\Prompts\search;

class SearchFullnameResults extends Component
{   
    #[Reactive]
    public $results = []; // This is the array that will hold the search results


    public function selectResult($id)
    {
        $result = Result::find($id);
        $this->emit('resultSelected', $result);
    }

    public function render()
    {
        return view('livewire.search-fullname-results');
    }
}
