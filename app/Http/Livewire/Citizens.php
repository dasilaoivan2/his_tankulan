<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Citizen;
use App\Models\Citizencategory;
use App\Models\Citizenpendingcase;
use App\Models\Citizenprogram;
use App\Models\Citizentype;
use App\Models\Familyrole;
use App\Models\Gender;
use App\Models\Household;
use App\Models\Pendingcase;
use App\Models\Program;
use App\Models\Work;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Citizens extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $firstname, $middlename, $lastname, $suffixname, $birthdate, $gender_id, $contact_no, $permanent_address, $email, $familyrole_id, $photo, $filename, $citizen_id, $household_id, $income;

    public $programs, $genders, $familyroles, $pendingcases, $categories;
    public $house;

    public $deceased = 0, $yearlive;

    public $works, $citizentypes;
    public $work_id, $citizentype_id;

    public $cat = [];
    public $category_id = [];
    public $prog = [];
    public $program_id = [];
    public $pend = [];
    public $pendingcase_id = [];

    public $viewCaseForm = false;

    public $searchToken;
    public $searchHousehold;

    public $isCreate = 0;

    public $isEdit = 0;

    public $trapMessage = false;
    public $citizen_trapmessage;

    public $confirmSave = false;
    public $confirmUpdate = false;
    public $confirmDelete = false;
    public $confirmCancel = false;
    public $confirmCancelEdit = false;

    public function render()
    {
        $this->house = Household::where('id', $this->household_id)->get()->first();
        $this->categories = Category::all();
        $this->programs = Program::all();
        $this->genders = Gender::all();
        $this->familyroles = Familyrole::all();
        $this->pendingcases = Pendingcase::all();
        $this->works = Work::all();
        $this->citizentypes = Citizentype::all();
        
        
        return view('livewire.citizens',['citizens' => Citizen::select('citizens.*')->where('citizens.lastname','LIKE','%'.$this->searchToken.'%')
            ->orWhere('citizens.firstname','LIKE','%'.$this->searchToken.'%')
            ->orWhere('citizens.middlename','LIKE','%'.$this->searchToken.'%')
            ->orderBy('household_id', 'ASC')
            ->paginate(50, ['*'], 'citizenspagination'), 'households' => Household::where('residence_name', 'LIKE', '%' . $this->searchHousehold . '%')->paginate(25, ['*'], 'householdspagination')]);
    }

    public function openCreate()
    {
        $this->isCreate = true;
    }

    public function openEdit()
    {
        $this->isEdit = true;
    }

    public function closeCreate()
    {
        $this->isCreate = false;
        $this->confirmCancel = false;
       
        
        $this->resetInputFields();
    }

    public function closeEdit()
    {
        $this->isEdit = false;
        $this->confirmCancelEdit = false;

        $this->resetInputFields();
    }

    public function resetInputFields()
    {
        $this->household_id = '';
        $this->firstname = '';
        $this->middlename = '';
        $this->lastname = '';
        $this->suffixname = '';
        $this->birthdate = '';
        $this->gender_id= '';
        $this->contact_no = '';
        $this->permanent_address = '';
        $this->email = '';
        $this->familyrole_id = '';
        $this->photo = '';
        $this->filename = '';
        $this->citizen_id = '';
        $this->work_id = '';
        $this->citizentype_id = '';
        $this->deceased = 0;
        $this->yearlive = '';
        $this->income = '';


        $this->resetArrayCheckbox();
        $this->viewCaseForm = false;
        $this->trapMessage = false;
        
    }

    public function confirmCancel()
    {
        $this->confirmCancel = true;
    }

    public function confirmCancelEdit()
    {
        $this->confirmCancelEdit = true;
    }

    public function create()
    {
        // $this->resetInputFields();
        $this->openCreate();
    }

    public function resetArrayCheckbox()
    {
        $this->category_id = [];
        $this->program_id = [];
        $this->cat = [];
        $this->prog = [];
        $this->pend = [];
        $this->pendingcase_id = [];
    }

    public function updateCatArray($id)
    {
        if ($this->cat[$id] == 1) {
            $this->category_id[] = $id;
        } else {
            for ($i = 0; $i < count($this->category_id); $i++) {
                if ($this->category_id[$i] == $id) {
                    unset($this->category_id[$i]);
                    $this->category_id = array_values($this->category_id);
                }
            }

        }
    }

    public function updateProgArray($id)
    {
        if ($this->prog[$id] == 1) {
            $this->program_id[] = $id;
        } else {
            for ($i = 0; $i < count($this->program_id); $i++) {
                if ($this->program_id[$i] == $id) {
                    unset($this->program_id[$i]);
                    $this->program_id = array_values($this->program_id);
                }
            }

        }
    }

    public function updateCaseArray($id)
    {
        if ($this->pend[$id] == 1) {
            $this->pendingcase_id[] = $id;
        } else {
            for ($i = 0; $i < count($this->pendingcase_id); $i++) {
                if ($this->pendingcase_id[$i] == $id) {
                    unset($this->pendingcase_id[$i]);
                    $this->pendingcase_id = array_values($this->pendingcase_id);
                }
            }

        }
    }


    public function confirmSave()
    {
        $this->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'birthdate' => 'required',
            'gender_id' => 'required',
            'familyrole_id' => 'required',
            'household_id' => 'required',
            'work_id' => 'required',
            'citizentype_id' => 'required',
            'yearlive' => 'required|digits:4|integer|min:1900|max:'.(date('Y')),
        ],
        [
            'firstname.required' => 'Required Field',
            'lastname.required' => 'Required Field',
            'birthdate.required' => 'Required Field',
            'gender_id.required' => 'Required Field',
            'familyrole_id.required' => 'Required Field',
            'household_id.required' => 'Please select household',
            'work_id.required' => 'Please select Nature of Work',
            'citizentype_id.required' => 'Please select Type of Resident',
            'yearlive.required' => 'Please input exact year',
        ]);

        $citizenTrap = Citizen::select('citizens.*')
        ->where('citizens.lastname', $this->lastname)
        ->where('citizens.firstname', $this->firstname)
        ->where('citizens.birthdate', $this->birthdate)
        ->where('citizens.suffixname', $this->suffixname)
        ->first();

        if($citizenTrap != NULL){

            $this->citizen_trapmessage = Citizen::find($citizenTrap->id);

            $this->trapMessage = true;

        }
        else{

            $this->confirmSave = true;
        }

            
           
    }

    public function store()
    {
            if($this->photo != NULL)
            {
                $nameofPhoto = md5($this->photo . microtime()).'.'.$this->photo->extension();
                $this->photo->storeAs('public/photo', $nameofPhoto);
            }
            else{
                $nameofPhoto = NULL;
            }

            if($this->income == NULL)
            {
                $citizen_income = 0;
            }
            else{
                $citizen_income = $this->income;
            }
            

            $citizen = Citizen::create([
                'household_id' => $this->household_id,
                'firstname' => $this->firstname,
                'middlename' => $this->middlename,
                'lastname' => $this->lastname,
                'suffixname' => $this->suffixname,
                'birthdate' => $this->birthdate,
                'gender_id' => $this->gender_id,
                'contact_no' => $this->contact_no,
                'permanent_address' => $this->permanent_address,
                'email' => $this->email,
                'familyrole_id' => $this->familyrole_id,
                'deceased' => $this->deceased,
                'yearlive' => $this->yearlive,
                'income' => $citizen_income,
                'work_id' => $this->work_id,
                'citizentype_id' => $this->citizentype_id,
                'photo' => $nameofPhoto
            ]);

            foreach($this->category_id as $category)
            {
                Citizencategory::create([
                    'category_id' => $category,
                    'citizen_id' => $citizen->id
                ]);

            }

            foreach($this->program_id as $program)
            {
                Citizenprogram::create([
                    'program_id' => $program,
                    'citizen_id' => $citizen->id
                ]);

            }

            foreach($this->pendingcase_id as $pendingcase)
            {
                Citizenpendingcase::create([
                    'pendingcase_id' => $pendingcase,
                    'citizen_id' => $citizen->id
                ]);

            }

       
        
        session()->flash('message','Citizen created successfully');
        $this->closeCreate();
        $this->viewCaseForm = false;

        $this->confirmSave = false;
        

    }

    public function edit($id)
    {
        $this->resetArrayCheckbox();

        $citizen = Citizen::find($id);
        $this->citizen_id = $id;
        $this->household_id = $citizen->household_id;
        $this->firstname = $citizen->firstname;
        $this->middlename = $citizen->middlename;
        $this->lastname = $citizen->lastname;
        $this->suffixname = $citizen->suffixname;
        $this->birthdate = $citizen->birthdate;
        $this->gender_id = $citizen->gender_id;
        $this->contact_no = $citizen->contact_no;
        $this->permanent_address = $citizen->permanent_address;
        $this->email = $citizen->email;
        $this->familyrole_id = $citizen->familyrole_id;
        $this->deceased = $citizen->deceased;
        $this->yearlive = $citizen->yearlive;
        $this->income = $citizen->income;
        $this->work_id = $citizen->work_id;
        $this->citizentype_id = $citizen->citizentype_id;
        $this->photo = null;
        $this->filename = $citizen->photo;

        if($citizen->pendingcases->count() > 0){
            $this->viewCaseForm = true;
        }
        else{
            $this->viewCaseForm = false;
        }

        foreach($citizen->categories as $category)
         {
            $this->cat[$category->id] = 1;
            $this->category_id[] = $category->id; 
         }
         

         foreach($citizen->programs as $program)
         {
            $this->prog[$program->id] = 1;
            $this->program_id[] = $program->id; 
         }

         foreach($citizen->pendingcases as $pendingcase)
         {
            $this->pend[$pendingcase->id] = 1;
            $this->pendingcase_id[] = $pendingcase->id; 
         }

        $this->openEdit();
    }

    public function updateCatArrayEdit($id)
    {
        if($this->cat[$id] == 1) {
            $this->category_id[] = $id;
        } else {
            for ($i = 0; $i < count($this->category_id); $i++) {
                if ($this->category_id[$i] == $id) {
                    unset($this->category_id[$i]);
                    $this->category_id = array_values($this->category_id);
                }
            }

        }
    }

    public function updateProgArrayEdit($id)
    {
        if($this->prog[$id] == 1) {
            $this->program_id[] = $id;
        } else {
            for ($i = 0; $i < count($this->program_id); $i++) {
                if ($this->program_id[$i] == $id) {
                    unset($this->program_id[$i]);
                    $this->program_id = array_values($this->program_id);
                }
            }

        }
    }

    public function updateCaseArrayEdit($id)
    {
        if($this->pend[$id] == 1) {
            $this->pendingcase_id[] = $id;
        } else {
            for ($i = 0; $i < count($this->pendingcase_id); $i++) {
                if ($this->pendingcase_id[$i] == $id) {
                    unset($this->pendingcase_id[$i]);
                    $this->pendingcase_id = array_values($this->pendingcase_id);
                }
            }

        }
    }

    public function confirmUpdate()
    {
        $this->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'birthdate' => 'required',
            'gender_id' => 'required',
            'familyrole_id' => 'required',
            'household_id' => 'required',
            'work_id' => 'required',
            'citizentype_id' => 'required',
            'yearlive' => 'required|digits:4|integer|min:1900|max:'.(date('Y')),
        ],
        [
            'firstname.required' => 'Required Field',
            'lastname.required' => 'Required Field',
            'birthdate.required' => 'Required Field',
            'gender_id.required' => 'Required Field',
            'familyrole_id.required' => 'Required Field',
            'household_id.required' => 'Please select household',
            'work_id.required' => 'Please select Nature of Work',
            'citizentype_id.required' => 'Please select Type of Resident',
            'yearlive.required' => 'Please input exact year',
        ]);

            
            $this->confirmUpdate = true;
    }

    public function update()
    {
        if($this->citizen_id){
           

            if($this->photo != NULL)
            {
                $nameofPhoto = md5($this->photo . microtime()).'.'.$this->photo->extension();
                $this->photo->storeAs('public/photo', $nameofPhoto);
                $oldfilename = $this->filename;
                Storage::delete('public/photo/'.$oldfilename);
            }
            else{
                $nameofPhoto = $this->filename;
            }
            
            $citizen = Citizen::find($this->citizen_id);

            if($this->income == NULL)
            {
                $citizen_income = 0;
            }
            else{
                $citizen_income = $this->income;
            }
            
            $citizen->update([
                'household_id' => $this->household_id,
                'firstname' => $this->firstname,
                'middlename' => $this->middlename,
                'lastname' => $this->lastname,
                'suffixname' => $this->suffixname,
                'birthdate' => $this->birthdate,
                'gender_id' => $this->gender_id,
                'contact_no' => $this->contact_no,
                'permanent_address' => $this->permanent_address,
                'email' => $this->email,
                'familyrole_id' => $this->familyrole_id,
                'deceased' => $this->deceased,
                'yearlive' => $this->yearlive,
                'income' => $citizen_income,
                'work_id' => $this->work_id,
                'citizentype_id' => $this->citizentype_id,
                'photo' => $nameofPhoto
            ]);
    
            Citizencategory::where('citizen_id', $this->citizen_id)->delete();
            Citizenprogram::where('citizen_id', $this->citizen_id)->delete();
            Citizenpendingcase::where('citizen_id', $this->citizen_id)->delete();
    
            foreach($this->category_id as $category)
                {
                    Citizencategory::create([
                        'category_id' => $category,
                        'citizen_id' => $citizen->id
                    ]);
    
                }
    
                foreach($this->program_id as $program)
                {
                    Citizenprogram::create([
                        'program_id' => $program,
                        'citizen_id' => $citizen->id
                    ]);
    
                }
    
                foreach($this->pendingcase_id as $pendingcase)
                {
                    Citizenpendingcase::create([
                        'pendingcase_id' => $pendingcase,
                        'citizen_id' => $citizen->id
                    ]);
    
                }
             
            session()->flash('message','Citizen updated successfully');
            $this->closeEdit();

            $this->confirmUpdate = false;
        }
    }

    public function confirmDelete($id)
    {
        $this->citizen_id = $id;
        $this->confirmDelete = true;
    }

    public function delete()
    {
        $citizen = Citizen::find($this->citizen_id);

        Citizencategory::where('citizen_id', $citizen->id)->delete();
        Citizenprogram::where('citizen_id', $citizen->id)->delete();
        Citizenpendingcase::where('citizen_id', $citizen->id)->delete();

        $oldfilename = $citizen->photo;
        Storage::delete('public/photo/'.$oldfilename);
        $citizen->delete();


        session()->flash('message', 'Category deleted successfully.');

        $this->confirmDelete = false;
        $this->citizen_id = '';
        
        return redirect(request()->header('Referer'));
    }
}
