<?php

namespace App\Http\Livewire;

use App\Models\Household;
use App\Models\Material;
use App\Models\Zone;
use Livewire\Component;
use Livewire\WithPagination;

class Householdmaterialreports extends Component
{
    use WithPagination;

    
    public $material_id, $materials;

    public $zones, $zone_id;

    public $searchToken;
    public $viewZone = false;

    public function mount()
    {
        $this->zones = Zone::all();
        $this->materials = Material::all();
    }

    public function render()
    {
        if($this->material_id == NULL)
        {
             return view('livewire.householdmaterialreports', ['households' => Household::select('households.*')
             ->whereRaw("((households.address_detail LIKE '%".$this->searchToken."%') OR (households.residence_name LIKE '%".$this->searchToken."%'))")
             ->paginate(50)
        ]);
        }
        else{
            if($this->viewZone){
                if($this->zone_id != NULL)
                {
                    return view('livewire.householdmaterialreports', ['households' => Household::select('households.*')
                    ->whereRaw("((households.address_detail LIKE '%".$this->searchToken."%') OR (households.residence_name LIKE '%".$this->searchToken."%'))")
                    ->where('households.material_id', $this->material_id)
                    ->where('households.zone_id', $this->zone_id)
                    ->paginate(50)
                    ]);
                }
                else{
                    return view('livewire.householdmaterialreports', ['households' => Household::select('households.*')
                    ->whereRaw("((households.address_detail LIKE '%".$this->searchToken."%') OR (households.residence_name LIKE '%".$this->searchToken."%'))")
                    ->where('households.material_id', $this->material_id)
                    ->paginate(50)
                    ]);
                }
            }
            else{
                return view('livewire.householdmaterialreports', ['households' => Household::select('households.*')
                ->whereRaw("((households.address_detail LIKE '%".$this->searchToken."%') OR (households.residence_name LIKE '%".$this->searchToken."%'))")
                ->where('households.material_id', $this->material_id)
                ->paginate(50)
            ]);
            }
        }
    }
    public function clearRadioButton()
    {
        $this->material_id = '';
        $this->zone_id = '';
        $this->searchToken = '';
        $this->viewZone = false;
    }
}
