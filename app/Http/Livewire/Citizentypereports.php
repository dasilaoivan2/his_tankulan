<?php

namespace App\Http\Livewire;

use App\Models\Citizen;
use App\Models\Citizentype;
use App\Models\Zone;
use Livewire\Component;
use Livewire\WithPagination;

class Citizentypereports extends Component
{
    use WithPagination;

    public $citizentypes, $citizentype_id;
    public $zones, $zone_id;

    public $searchToken;
    public $viewZone = false;

    public function mount()
    {
        $this->citizentypes = Citizentype::all();
        $this->zones = Zone::all();
    }

    public function render()
    {
        if($this->citizentype_id != NULL)
        {
            if($this->viewZone){
                if($this->zone_id != NULL)
                {
                    $citizentype = Citizentype::find($this->citizentype_id);
                    

                    return view('livewire.citizentypereports', ['citizens' => Citizen::select('citizens.*')
                    ->join('households','households.id', 'citizens.household_id')
                    ->join('zones','zones.id', 'households.zone_id')
                    ->whereRaw("((citizens.lastname LIKE '%".$this->searchToken."%') OR (citizens.firstname LIKE '%".$this->searchToken."%') OR (citizens.middlename LIKE '%".$this->searchToken."%'))")
                    ->where('zones.id', $this->zone_id)
                    ->where('citizens.citizentype_id', $citizentype->id)
                    ->paginate(50)]);
                }
                else{
                    $citizentype = Citizentype::find($this->citizentype_id);
                    
        
                    return view('livewire.citizentypereports', ['citizens' => Citizen::select('citizens.*')
                    ->whereRaw("((citizens.lastname LIKE '%".$this->searchToken."%') OR (citizens.firstname LIKE '%".$this->searchToken."%') OR (citizens.middlename LIKE '%".$this->searchToken."%'))")
                    ->where('citizens.citizentype_id', $citizentype->id)
                    ->paginate(50)]);
                }
            }
            else{
                $citizentype = Citizentype::find($this->citizentype_id);
                


                return view('livewire.citizentypereports', ['citizens' => Citizen::select('citizens.*')
                ->whereRaw("((citizens.lastname LIKE '%".$this->searchToken."%') OR (citizens.firstname LIKE '%".$this->searchToken."%') OR (citizens.middlename LIKE '%".$this->searchToken."%'))")
                ->where('citizens.citizentype_id', $citizentype->id)
                ->paginate(50)]);
            }
        
        }
        
        else{
            return view('livewire.citizentypereports', ['citizens' => Citizen::select('citizens.*')->whereRaw("((citizens.lastname LIKE '%".$this->searchToken."%') OR (citizens.firstname LIKE '%".$this->searchToken."%') OR (citizens.middlename LIKE '%".$this->searchToken."%'))")
            ->paginate(50)]);
        }
    }

    public function clearRadioButton()
    {
        $this->searchToken = '';
        $this->citizentype_id = '';
        $this->zone_id = '';
        $this->viewZone = false;
    }
}
