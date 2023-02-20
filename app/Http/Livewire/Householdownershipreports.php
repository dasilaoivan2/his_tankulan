<?php

namespace App\Http\Livewire;

use App\Models\Household;
use App\Models\Ownership;
use App\Models\Zone;
use Livewire\Component;
use Livewire\WithPagination;

class Householdownershipreports extends Component
{
    use WithPagination;

    
    public $ownership_id, $ownerships;

    public $zones, $zone_id;

    public $searchToken;
    public $viewZone = false;

    public function mount()
    {
        $this->zones = Zone::all();
        $this->ownerships = Ownership::all();
    }


    public function render()
    {
        if($this->ownership_id == NULL)
        {
             return view('livewire.householdownershipreports', ['households' => Household::select('households.*')
             ->whereRaw("((households.address_detail LIKE '%".$this->searchToken."%') OR (households.residence_name LIKE '%".$this->searchToken."%'))")
             ->paginate(50)
        ]);
        }
        else{
            if($this->viewZone){
                if($this->zone_id != NULL)
                {
                    return view('livewire.householdownershipreports', ['households' => Household::select('households.*')
                    ->whereRaw("((households.address_detail LIKE '%".$this->searchToken."%') OR (households.residence_name LIKE '%".$this->searchToken."%'))")
                    ->where('households.ownership_id', $this->ownership_id)
                    ->where('households.zone_id', $this->zone_id)
                    ->paginate(50)
                    ]);
                }
                else{
                    return view('livewire.householdownershipreports', ['households' => Household::select('households.*')
                    ->whereRaw("((households.address_detail LIKE '%".$this->searchToken."%') OR (households.residence_name LIKE '%".$this->searchToken."%'))")
                    ->where('households.ownership_id', $this->ownership_id)
                    ->paginate(50)
                    ]);
                }
            }
            else{
                return view('livewire.householdownershipreports', ['households' => Household::select('households.*')
                ->whereRaw("((households.address_detail LIKE '%".$this->searchToken."%') OR (households.residence_name LIKE '%".$this->searchToken."%'))")
                ->where('households.ownership_id', $this->ownership_id)
                ->paginate(50)
            ]);
            }
        }
        
    }

    public function clearRadioButton()
    {
        $this->ownership_id = '';
        $this->zone_id = '';
        $this->searchToken = '';
        $this->viewZone = false;
    }
}
