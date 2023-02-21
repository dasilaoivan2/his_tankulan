<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Citizen;
use App\Models\Pendingcase;
use App\Models\Program;
use App\Models\Zone;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Citizenzonereports extends Component
{
    use WithPagination;

    public $program_id, $pendingcase_id, $category_id;
    public $zones, $zone_id;
    public $radio_select;
    public $searchToken;

    public $category_count, $program_count, $pendingcase_count;



    public $categories, $programs, $pendingcases;

    public function mount(){

        $this->categories = Category::all();
        $this->programs = Program::all();
        $this->pendingcases = Pendingcase::all();
        $this->zones = Zone::all();
  
    }

    public function render()
    {
        if($this->zone_id != NULL){
            $category_query = DB::table('citizencategories')
            ->select('citizens.*', 'households.residence_name as residence_name')
            ->where('zones.id', $this->zone_id)
            ->join('categories','categories.id', 'citizencategories.category_id')
            ->join('citizens','citizens.id', 'citizencategories.citizen_id')
            ->join('households','households.id', 'citizens.household_id')
            ->join('zones','zones.id', 'households.zone_id')
            ->distinct()->get();

            $program_query = DB::table('citizenprograms')
            ->select('citizens.*', 'households.residence_name as residence_name')
            ->where('zones.id', $this->zone_id)
            ->join('programs','programs.id', 'citizenprograms.program_id')
            ->join('citizens','citizens.id', 'citizenprograms.citizen_id')
            ->join('households','households.id', 'citizens.household_id')
            ->join('zones','zones.id', 'households.zone_id')
            ->distinct()->get();

            $pendingcase_query = DB::table('citizenpendingcases')
            ->select('citizens.*', 'households.residence_name as residence_name')
            ->where('zones.id', $this->zone_id)
            ->join('pendingcases','pendingcases.id', 'citizenpendingcases.pendingcase_id')
            ->join('citizens','citizens.id', 'citizenpendingcases.citizen_id')
            ->join('households','households.id', 'citizens.household_id')
            ->join('zones','zones.id', 'households.zone_id')
            ->distinct()->get();



            $this->category_count = $category_query->count();
            $this->program_count = $program_query->count();
            $this->pendingcase_count = $pendingcase_query->count();

            if($this->radio_select == 1){
                if($this->category_id == NULL){
                    return view('livewire.citizenzonereports', ['citizens' => DB::table('citizencategories')
                    ->select('citizens.*', 'households.residence_name as residence_name', 'zones.name as zone_name')
                    ->where('zones.id', $this->zone_id)
                    ->join('categories','categories.id', 'citizencategories.category_id')
                    ->join('citizens','citizens.id', 'citizencategories.citizen_id')
                    ->join('households','households.id', 'citizens.household_id')
                    ->join('zones','zones.id', 'households.zone_id')
                    ->distinct()
                    ->paginate(50)
                ]);
                }
                else{
                    return view('livewire.citizenzonereports', ['citizens' => DB::table('citizencategories')
                    ->select('citizens.*', 'households.residence_name as residence_name', 'zones.name as zone_name')
                    ->where('zones.id', $this->zone_id)
                    ->where('categories.id', $this->category_id)
                    ->join('categories','categories.id', 'citizencategories.category_id')
                    ->join('citizens','citizens.id', 'citizencategories.citizen_id')
                    ->join('households','households.id', 'citizens.household_id')
                    ->join('zones','zones.id', 'households.zone_id')
                    ->distinct()
                    ->paginate(50)
                ]);
                }
                
            }
            elseif($this->radio_select == 2)
            {
                if($this->program_id == NULL){
                    return view('livewire.citizenzonereports', ['citizens' => DB::table('citizenprograms')
                    ->select('citizens.*', 'households.residence_name as residence_name', 'zones.name as zone_name')
                    ->where('zones.id', $this->zone_id)
                    ->join('programs','programs.id', 'citizenprograms.program_id')
                    ->join('citizens','citizens.id', 'citizenprograms.citizen_id')
                    ->join('households','households.id', 'citizens.household_id')
                    ->join('zones','zones.id', 'households.zone_id')
                    ->distinct()
                    ->paginate(50)
                ]);
                }
                else{
                    return view('livewire.citizenzonereports', ['citizens' => DB::table('citizenprograms')
                    ->select('citizens.*', 'households.residence_name as residence_name', 'zones.name as zone_name')
                    ->where('zones.id', $this->zone_id)
                    ->where('programs.id', $this->program_id)
                    ->join('programs','programs.id', 'citizenprograms.program_id')
                    ->join('citizens','citizens.id', 'citizenprograms.citizen_id')
                    ->join('households','households.id', 'citizens.household_id')
                    ->join('zones','zones.id', 'households.zone_id')
                    ->distinct()
                    ->paginate(50)
                ]);
                }
                
            
            }
            elseif($this->radio_select == 3)
            {
                if($this->pendingcase_id == NULL){
                    return view('livewire.citizenzonereports', ['citizens' => DB::table('citizenpendingcases')
                    ->select('citizens.*', 'households.residence_name as residence_name', 'zones.name as zone_name')
                    ->where('zones.id', $this->zone_id)
                    ->join('pendingcases','pendingcases.id', 'citizenpendingcases.pendingcase_id')
                    ->join('citizens','citizens.id', 'citizenpendingcases.citizen_id')
                    ->join('households','households.id', 'citizens.household_id')
                    ->join('zones','zones.id', 'households.zone_id')
                    ->distinct()
                    ->paginate(50)
                ]);
                }
                else{
                    return view('livewire.citizenzonereports', ['citizens' => DB::table('citizenpendingcases')
                    ->select('citizens.*', 'households.residence_name as residence_name', 'zones.name as zone_name')
                    ->where('zones.id', $this->zone_id)
                    ->where('pendingcases.id', $this->pendingcase_id)
                    ->join('pendingcases','pendingcases.id', 'citizenpendingcases.pendingcase_id')
                    ->join('citizens','citizens.id', 'citizenpendingcases.citizen_id')
                    ->join('households','households.id', 'citizens.household_id')
                    ->join('zones','zones.id', 'households.zone_id')
                    ->distinct()
                    ->paginate(50)
                ]);
                }
                
            }
            elseif($this->radio_select == ''){
                return view('livewire.citizenzonereports', ['citizens' => Citizen::select('citizens.*', 'households.residence_name as residence_name', 'zones.name as zone_name')
                    ->whereRaw("((citizens.lastname LIKE '%".$this->searchToken."%') OR (citizens.firstname LIKE '%".$this->searchToken."%') OR (citizens.middlename LIKE '%".$this->searchToken."%'))")
                    ->where('zones.id', $this->zone_id)
                    ->join('households','households.id', 'citizens.household_id')
                    ->join('zones','zones.id', 'households.zone_id')
                    ->paginate(50)
                ]);
            }

        }
        else{
            $this->clearRadioButton();
            
            return view('livewire.citizenzonereports', ['citizens' => Citizen::select('citizens.*')->where('citizens.lastname','LIKE','%'.$this->searchToken.'%')
            ->orWhere('citizens.firstname','LIKE','%'.$this->searchToken.'%')
            ->orWhere('citizens.middlename','LIKE','%'.$this->searchToken.'%')
            ->paginate(50)]);
        }
        
    }

    public function clearRadioButton()
    {
        $this->program_id = '';
        $this->category_id = '';
        $this->pendingcase_id = '';
        $this->radio_select = '';
        $this->zone_id = '';
    }

}
