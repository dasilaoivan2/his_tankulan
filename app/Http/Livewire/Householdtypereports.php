<?php

namespace App\Http\Livewire;

use App\Models\Household;
use App\Models\Type;
use Livewire\Component;
use Livewire\WithPagination;

class Householdtypereports extends Component
{
    use WithPagination;

    public $types;
    public $type_id;

    public $searchToken;

    public function mount(){
        $this->types = Type::all();
    }


    public function render()
    {
        if($this->type_id == ''){
            return view('livewire.householdtypereports', ['households' => Household::select('households.*')->where('households.residence_name','LIKE','%'.$this->searchToken.'%')
            ->orWhere('households.address_detail','LIKE','%'.$this->searchToken.'%')
            ->paginate(50)
        ]);
        }
        else{
            return view('livewire.householdtypereports', ['households' => Household::select('households.*')->where('households.residence_name','LIKE','%'.$this->searchToken.'%')
            ->where('households.type_id', $this->type_id)
            ->paginate(50)
        ]);
        }
    }

    public function clearRadioButton()
    {
        $this->type_id = '';
        $this->searchToken = '';
    }
}
