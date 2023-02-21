<?php

namespace App\Http\Livewire;

use App\Models\Citizen;
use App\Models\Ownership;
use App\Models\Zone;
use Livewire\Component;
use Livewire\WithPagination;

class Citizenownershipreports extends Component
{
    use WithPagination;

    public $ownerships, $ownership_id;
    public $zones, $zone_id;

    public $searchToken;
    public $viewZone = false;

    public function mount()
    {
        $this->ownerships = Ownership::all();
        $this->zones = Zone::all();
    }

    public function render()
    {
        if($this->ownership_id != NULL)
        {
            if($this->viewZone){
                if($this->zone_id != NULL)
                {
                    $ownership = Ownership::find($this->ownership_id);
                    

                    return view('livewire.citizenownershipreports', ['citizens' => Citizen::select('citizens.*')
                    ->join('households','households.id', 'citizens.household_id')
                    ->join('zones','zones.id', 'households.zone_id')
                    ->whereRaw("((citizens.lastname LIKE '%".$this->searchToken."%') OR (citizens.firstname LIKE '%".$this->searchToken."%') OR (citizens.middlename LIKE '%".$this->searchToken."%'))")
                    ->where('zones.id', $this->zone_id)
                    ->where('households.ownership_id', $ownership->id)
                    ->paginate(50)]);
                }
                else{
                    $ownership = Ownership::find($this->ownership_id);
                    
        
                    return view('livewire.citizenownershipreports', ['citizens' => Citizen::select('citizens.*')
                    ->join('households','households.id', 'citizens.household_id')
                    ->join('zones','zones.id', 'households.zone_id')
                    ->whereRaw("((citizens.lastname LIKE '%".$this->searchToken."%') OR (citizens.firstname LIKE '%".$this->searchToken."%') OR (citizens.middlename LIKE '%".$this->searchToken."%'))")
                    ->where('households.ownership_id', $ownership->id)
                    ->paginate(50)]);
                }

            }
            else{
                $ownership = Ownership::find($this->ownership_id);
                


                return view('livewire.citizenownershipreports', ['citizens' => Citizen::select('citizens.*')
                ->join('households','households.id', 'citizens.household_id')
                ->join('zones','zones.id', 'households.zone_id')
                ->whereRaw("((citizens.lastname LIKE '%".$this->searchToken."%') OR (citizens.firstname LIKE '%".$this->searchToken."%') OR (citizens.middlename LIKE '%".$this->searchToken."%'))")
                ->where('households.ownership_id', $ownership->id)
                ->paginate(50)]);
            }

        }
        else{
            return view('livewire.citizenownershipreports', ['citizens' => Citizen::select('citizens.*')->whereRaw("((citizens.lastname LIKE '%".$this->searchToken."%') OR (citizens.firstname LIKE '%".$this->searchToken."%') OR (citizens.middlename LIKE '%".$this->searchToken."%'))")
            ->paginate(50)]);
        }
    }

    public function clearRadioButton()
    {
        $this->searchToken = '';
        $this->ownership_id = '';
        $this->zone_id = '';
        $this->viewZone = false;
    }
}
