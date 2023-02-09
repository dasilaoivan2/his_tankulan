<?php

namespace App\Http\Livewire;

use App\Models\Household;
use App\Models\Zone;
use Livewire\Component;
use Livewire\WithPagination;

class Householdcrreports extends Component
{
    
    use WithPagination;

    
    public $cr;

    public $zones, $zone_id;

    public $searchToken;
    public $viewZone = false;

    public function mount()
    {
        $this->zones = Zone::all();
    }


    public function render()
    {
        if($this->cr == NULL){
            return view('livewire.householdcrreports', ['households' => Household::select('households.*')
            ->whereRaw("((households.address_detail LIKE '%".$this->searchToken."%') OR (households.residence_name LIKE '%".$this->searchToken."%'))")
            ->paginate(50)
        ]);
        }
        else{

            if($this->viewZone){
                if($this->zone_id != NULL)
                {
                    return view('livewire.householdcrreports', ['households' => Household::select('households.*')
                    ->whereRaw("((households.address_detail LIKE '%".$this->searchToken."%') OR (households.residence_name LIKE '%".$this->searchToken."%'))")
                    ->where('households.cr', $this->cr)
                    ->where('households.zone_id', $this->zone_id)
                    ->paginate(50)
                    ]);
                }
                else{
                    return view('livewire.householdcrreports', ['households' => Household::select('households.*')
                    ->whereRaw("((households.address_detail LIKE '%".$this->searchToken."%') OR (households.residence_name LIKE '%".$this->searchToken."%'))")
                    ->where('households.cr', $this->cr)
                    ->paginate(50)
                    ]);
                }
            }
            else{

                return view('livewire.householdcrreports', ['households' => Household::select('households.*')
                ->whereRaw("((households.address_detail LIKE '%".$this->searchToken."%') OR (households.residence_name LIKE '%".$this->searchToken."%'))")
                ->where('households.cr', $this->cr)
                ->paginate(50)
            ]);

                
            }
        }

    }

    public function clearRadioButton()
    {
        $this->cr = NULL;
        $this->zone_id = '';
        $this->searchToken = '';
        $this->viewZone = false;
    }
}
