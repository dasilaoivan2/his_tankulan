<?php

namespace App\Http\Livewire;

use App\Models\Classification;
use App\Models\Household;
use Livewire\Component;
use Livewire\WithPagination;

class Householdclassreports extends Component
{
    use WithPagination;

    public $classifications;
    public $classification_id;

    public $searchToken;


    public function mount(){
        $this->classifications = Classification::all();
    }

    public function render()
    {
        if($this->classification_id == ''){
            return view('livewire.householdclassreports', ['households' => Household::select('households.*')->where('households.residence_name','LIKE','%'.$this->searchToken.'%')
            ->orWhere('households.address_detail','LIKE','%'.$this->searchToken.'%')
            ->paginate(50)
        ]);
        }
        else{
            return view('livewire.householdclassreports', ['households' => Household::select('households.*')->where('households.residence_name','LIKE','%'.$this->searchToken.'%')
            ->where('households.classification_id', $this->classification_id)
            ->paginate(50)
        ]);
        }
    }

    public function clearRadioButton()
    {
        $this->classification_id = '';
        $this->searchToken = '';
    }
}
