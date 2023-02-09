<?php

namespace App\Http\Livewire;

use App\Models\Citizen;
use App\Models\Work;
use App\Models\Zone;
use Livewire\Component;
use Livewire\WithPagination;

class Citizenworkreports extends Component
{
    use WithPagination;

    public $works, $work_id;
    public $zones, $zone_id;

    public $searchToken;
    public $viewZone = false;

    public function mount()
    {
        $this->works = Work::all();
        $this->zones = Zone::all();
    }


    public function render()
    {
        if($this->work_id != NULL)
        {
            if($this->viewZone){
                if($this->zone_id != NULL)
                {
                    $work = Work::find($this->work_id);
                    

                    return view('livewire.citizenworkreports', ['citizens' => Citizen::select('citizens.*')
                    ->join('households','households.id', 'citizens.household_id')
                    ->join('zones','zones.id', 'households.zone_id')
                    ->whereRaw("((citizens.lastname LIKE '%".$this->searchToken."%') OR (citizens.firstname LIKE '%".$this->searchToken."%'))")
                    ->where('zones.id', $this->zone_id)
                    ->where('citizens.work_id', $work->id)
                    ->paginate(50)]);
                }
                else{
                    $work = Work::find($this->work_id);
                    
        
                    return view('livewire.citizenworkreports', ['citizens' => Citizen::select('citizens.*')
                    ->whereRaw("((citizens.lastname LIKE '%".$this->searchToken."%') OR (citizens.firstname LIKE '%".$this->searchToken."%'))")
                    ->where('citizens.work_id', $work->id)
                    ->paginate(50)]);
                }
            }
            else{
                $work = Work::find($this->work_id);
                


                return view('livewire.citizenworkreports', ['citizens' => Citizen::select('citizens.*')
                ->whereRaw("((citizens.lastname LIKE '%".$this->searchToken."%') OR (citizens.firstname LIKE '%".$this->searchToken."%'))")
                ->where('citizens.work_id', $work->id)
                ->paginate(50)]);
            }
        
        }
        
        else{
            return view('livewire.citizenworkreports', ['citizens' => Citizen::select('citizens.*')->whereRaw("((citizens.lastname LIKE '%".$this->searchToken."%') OR (citizens.firstname LIKE '%".$this->searchToken."%'))")
            ->paginate(50)]);
        }

        
    }



    public function clearRadioButton()
    {
        $this->searchToken = '';
        $this->work_id = '';
        $this->zone_id = '';
        $this->viewZone = false;
    }
}
