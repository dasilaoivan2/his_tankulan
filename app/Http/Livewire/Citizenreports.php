<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Citizen;
use App\Models\Citizencategory;
use App\Models\Pendingcase;
use App\Models\Program;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Citizenreports extends Component
{
    use WithPagination;

    public $program_id, $pendingcase_id, $category_id;
    public $radio_select;
    public $searchToken;

    public $category_count, $program_count, $pendingcase_count;



    public $categories, $programs, $pendingcases;

    public function mount(){

        $this->categories = Category::all();
        $this->programs = Program::all();
        $this->pendingcases = Pendingcase::all();
        $category_query = DB::table('citizencategories')
        ->select('citizens.*', 'households.residence_name as residence_name')
        ->join('categories','categories.id', 'citizencategories.category_id')
        ->join('citizens','citizens.id', 'citizencategories.citizen_id')
        ->join('households','households.id', 'citizens.household_id')
        ->distinct()->get();

        $program_query = DB::table('citizenprograms')
        ->select('citizens.*', 'households.residence_name as residence_name')
        ->join('programs','programs.id', 'citizenprograms.program_id')
        ->join('citizens','citizens.id', 'citizenprograms.citizen_id')
        ->join('households','households.id', 'citizens.household_id')
        ->distinct()->get();

        $pendingcase_query = DB::table('citizenpendingcases')
        ->select('citizens.*', 'households.residence_name as residence_name')
        ->join('pendingcases','pendingcases.id', 'citizenpendingcases.pendingcase_id')
        ->join('citizens','citizens.id', 'citizenpendingcases.citizen_id')
        ->join('households','households.id', 'citizens.household_id')
        ->distinct()->get();

        $this->category_count = $category_query->count();
        $this->program_count = $program_query->count();
        $this->pendingcase_count = $pendingcase_query->count();
    }

    public function render()
    {
        // $this->citizens = DB::table('citizens')
        // ->join('citizencategories','')


        // $offices = DB::table('officesubcategories') 
        // ->select('offices.*')
        // ->where('officecategories.id',$category_id)
        // ->join('subcategories','subcategories.id','officesubcategories.subcategory_id')
        // ->join('officecategories','officecategories.id','subcategories.officecategory_id')
        // ->join('offices','offices.id','officesubcategories.office_id')
        // ->distinct()
        // ->get();
        
        if($this->radio_select == 1){
            if($this->category_id == NULL){
                return view('livewire.citizenreports', ['citizens' => DB::table('citizencategories')
                ->select('citizens.*', 'households.residence_name as residence_name')
                ->join('categories','categories.id', 'citizencategories.category_id')
                ->join('citizens','citizens.id', 'citizencategories.citizen_id')
                ->join('households','households.id', 'citizens.household_id')
                ->distinct()
                ->paginate(50, ['*'], 'categoriespagination')
            ]);
            }
            else{
                return view('livewire.citizenreports', ['citizens' => DB::table('citizencategories')
                ->select('citizens.*', 'households.residence_name as residence_name')
                ->where('categories.id', $this->category_id)
                ->join('categories','categories.id', 'citizencategories.category_id')
                ->join('citizens','citizens.id', 'citizencategories.citizen_id')
                ->join('households','households.id', 'citizens.household_id')
                ->distinct()
                ->paginate(50, ['*'], 'citizencategoriespagination')
            ]);
            }
            
        }
        elseif($this->radio_select == 2)
        {
            if($this->program_id == NULL){
                return view('livewire.citizenreports', ['citizens' => DB::table('citizenprograms')
                ->select('citizens.*', 'households.residence_name as residence_name')
                ->join('programs','programs.id', 'citizenprograms.program_id')
                ->join('citizens','citizens.id', 'citizenprograms.citizen_id')
                ->join('households','households.id', 'citizens.household_id')
                ->distinct()
                ->paginate(50, ['*'], 'programpagination')
            ]);
            }
            else{
                return view('livewire.citizenreports', ['citizens' => DB::table('citizenprograms')
                ->select('citizens.*', 'households.residence_name as residence_name')
                ->where('programs.id', $this->program_id)
                ->join('programs','programs.id', 'citizenprograms.program_id')
                ->join('citizens','citizens.id', 'citizenprograms.citizen_id')
                ->join('households','households.id', 'citizens.household_id')
                ->distinct()
                ->paginate(50, ['*'], 'citizenprogramspagination')
            ]);
            }
            
        
        }
        elseif($this->radio_select == 3)
        {
            if($this->pendingcase_id == NULL){
                return view('livewire.citizenreports', ['citizens' => DB::table('citizenpendingcases')
                ->select('citizens.*', 'households.residence_name as residence_name')
                ->join('pendingcases','pendingcases.id', 'citizenpendingcases.pendingcase_id')
                ->join('citizens','citizens.id', 'citizenpendingcases.citizen_id')
                ->join('households','households.id', 'citizens.household_id')
                ->distinct()
                ->paginate(50, ['*'], 'casespagination')
            ]);
            }
            else{
                return view('livewire.citizenreports', ['citizens' => DB::table('citizenpendingcases')
                ->select('citizens.*', 'households.residence_name as residence_name')
                ->where('pendingcases.id', $this->pendingcase_id)
                ->join('pendingcases','pendingcases.id', 'citizenpendingcases.pendingcase_id')
                ->join('citizens','citizens.id', 'citizenpendingcases.citizen_id')
                ->join('households','households.id', 'citizens.household_id')
                ->distinct()
                ->paginate(50, ['*'], 'citizencasespagination')
            ]);
            }
            
        }
        elseif($this->radio_select == ''){
            return view('livewire.citizenreports', ['citizens' => Citizen::select('citizens.*')->where('citizens.lastname','LIKE','%'.$this->searchToken.'%')
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
    }
}
