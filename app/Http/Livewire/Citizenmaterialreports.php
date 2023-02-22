<?php

namespace App\Http\Livewire;

use App\Models\Citizen;
use App\Models\Material;
use App\Models\Zone;
use Livewire\Component;
use Livewire\WithPagination;

class Citizenmaterialreports extends Component
{
    use WithPagination;

    public $materials, $material_id;
    public $zones, $zone_id;

    public $searchToken;
    public $viewZone = false;

    public function mount()
    {
        $this->materials = Material::all();
        $this->zones = Zone::all();
    }

    public function render()
    {

        if($this->material_id != NULL)
        {
            if($this->viewZone){
                if($this->zone_id != NULL)
                {
                    $material = Material::find($this->material_id);
                    

                    return view('livewire.citizenmaterialreports', ['citizens' => Citizen::select('citizens.*')
                    ->join('households','households.id', 'citizens.household_id')
                    ->join('zones','zones.id', 'households.zone_id')
                    ->whereRaw("((citizens.lastname LIKE '%".$this->searchToken."%') OR (citizens.firstname LIKE '%".$this->searchToken."%') OR (citizens.middlename LIKE '%".$this->searchToken."%'))")
                    ->where('zones.id', $this->zone_id)
                    ->where('households.material_id', $material->id)
                    ->paginate(50)]);
                }
                else{
                    $material = Material::find($this->material_id);
                    
        
                    return view('livewire.citizenmaterialreports', ['citizens' => Citizen::select('citizens.*')
                    ->join('households','households.id', 'citizens.household_id')
                    ->join('zones','zones.id', 'households.zone_id')
                    ->whereRaw("((citizens.lastname LIKE '%".$this->searchToken."%') OR (citizens.firstname LIKE '%".$this->searchToken."%') OR (citizens.middlename LIKE '%".$this->searchToken."%'))")
                    ->where('households.material_id', $material->id)
                    ->paginate(50)]);
                }

            }
            else{
                $material = Material::find($this->material_id);
                


                return view('livewire.citizenmaterialreports', ['citizens' => Citizen::select('citizens.*')
                ->join('households','households.id', 'citizens.household_id')
                ->join('zones','zones.id', 'households.zone_id')
                ->whereRaw("((citizens.lastname LIKE '%".$this->searchToken."%') OR (citizens.firstname LIKE '%".$this->searchToken."%') OR (citizens.middlename LIKE '%".$this->searchToken."%'))")
                ->where('households.material_id', $material->id)
                ->paginate(50)]);
            }

        }
        else{
            return view('livewire.citizenmaterialreports', ['citizens' => Citizen::select('citizens.*')->whereRaw("((citizens.lastname LIKE '%".$this->searchToken."%') OR (citizens.firstname LIKE '%".$this->searchToken."%') OR (citizens.middlename LIKE '%".$this->searchToken."%'))")
            ->paginate(50)]);
        }
    }

    public function clearRadioButton()
    {
        $this->searchToken = '';
        $this->material_id = '';
        $this->zone_id = '';
        $this->viewZone = false;
    }
}
