<?php

namespace App\Http\Livewire;

use App\Models\Household;
use App\Models\Zone;
use Livewire\Component;
use Livewire\WithPagination;

class Householdzonereports extends Component
{
    use WithPagination;

    public $zones;
    public $zone_id;

    public $searchToken;


    public function mount(){
        $this->zones = Zone::all();
    }

    public function render()
    {
        if($this->zone_id == ''){
            return view('livewire.householdzonereports', ['households' => Household::select('households.*')->where('households.residence_name','LIKE','%'.$this->searchToken.'%')
            ->orWhere('households.address_detail','LIKE','%'.$this->searchToken.'%')
            ->paginate(50)
        ]);
        }
        else{
            return view('livewire.householdzonereports', ['households' => Household::select('households.*')->where('households.residence_name','LIKE','%'.$this->searchToken.'%')
            ->where('households.zone_id', $this->zone_id)
            ->paginate(50)
        ]);
        }
    }

    public function clearRadioButton()
    {
        $this->zone_id = '';
        $this->searchToken = '';
    }
}
