<?php

namespace App\Http\Livewire;

use App\Models\Agebracket;
use App\Models\Citizen;
use App\Models\Zone;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class Citizenagerangereports extends Component
{

    use WithPagination;

    public $agebrackets, $agebracket_id;
    public $zones, $zone_id;

    public $searchToken;
    public $viewZone = false;

    public function mount()
    {
        $this->agebrackets = Agebracket::all();
        $this->zones = Zone::all();
    }

    public function render()
    {
        

        if($this->agebracket_id != NULL)
        {
            if($this->viewZone){
                if($this->zone_id != NULL)
                {
                    $age = Agebracket::find($this->agebracket_id);
                    $minAge = $age->from;
                    $maxAge = $age->to;
    
                    $minDate = Carbon::today()->subYears($maxAge + 1);
                    $maxDate = Carbon::today()->subYears($minAge)->endOfDay();
    
                    return view('livewire.citizenagerangereports', ['citizens' => Citizen::select('citizens.*')
                    ->join('households','households.id', 'citizens.household_id')
                    ->join('zones','zones.id', 'households.zone_id')
                    ->whereRaw("((citizens.lastname LIKE '%".$this->searchToken."%') OR (citizens.firstname LIKE '%".$this->searchToken."%') OR (citizens.middlename LIKE '%".$this->searchToken."%'))")
                    ->where('zones.id', $this->zone_id)
                    ->whereBetween('citizens.birthdate', [$minDate,$maxDate])
                    ->paginate(50)]);
                }
                else{
                    $age = Agebracket::find($this->agebracket_id);
                    $minAge = $age->from;
                    $maxAge = $age->to;
        
                    $minDate = Carbon::today()->subYears($maxAge + 1);
                    $maxDate = Carbon::today()->subYears($minAge)->endOfDay();
        
                    return view('livewire.citizenagerangereports', ['citizens' => Citizen::select('citizens.*')
                    ->whereRaw("((citizens.lastname LIKE '%".$this->searchToken."%') OR (citizens.firstname LIKE '%".$this->searchToken."%') OR (citizens.middlename LIKE '%".$this->searchToken."%'))")
                    ->whereBetween('citizens.birthdate', [$minDate,$maxDate])
                    ->paginate(50)]);
                }
            }
            else{
                $age = Agebracket::find($this->agebracket_id);
                $minAge = $age->from;
                $maxAge = $age->to;
    
                $minDate = Carbon::today()->subYears($maxAge + 1);
                $maxDate = Carbon::today()->subYears($minAge)->endOfDay();
    
                return view('livewire.citizenagerangereports', ['citizens' => Citizen::select('citizens.*')
                ->whereRaw("((citizens.lastname LIKE '%".$this->searchToken."%') OR (citizens.firstname LIKE '%".$this->searchToken."%') OR (citizens.middlename LIKE '%".$this->searchToken."%'))")
                ->whereBetween('citizens.birthdate', [$minDate,$maxDate])
                ->paginate(50)]);
            }
            
           
        }
        else
        {
            return view('livewire.citizenagerangereports', ['citizens' => Citizen::select('citizens.*')->whereRaw("((citizens.lastname LIKE '%".$this->searchToken."%') OR (citizens.firstname LIKE '%".$this->searchToken."%') OR (citizens.middlename LIKE '%".$this->searchToken."%'))")
            ->paginate(50)]);
        }

        
    }

    public function clearRadioButton()
        {
            $this->searchToken = '';
            $this->agebracket_id = '';
            $this->zone_id = '';
            $this->viewZone = false;
        }
}
