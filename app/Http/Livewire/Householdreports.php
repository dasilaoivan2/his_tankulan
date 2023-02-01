<?php

namespace App\Http\Livewire;

use App\Models\Household;
use Livewire\Component;
use Livewire\WithPagination;

class Householdreports extends Component
{

    use WithPagination;

    public $searchToken;


    public function render()
    {
        return view('livewire.householdreports', ['households' => Household::select('households.*')->where('households.residence_name','LIKE','%'.$this->searchToken.'%')
        ->orWhere('households.address_detail','LIKE','%'.$this->searchToken.'%')
        ->paginate(10)]);
    }
}
