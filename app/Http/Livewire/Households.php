<?php

namespace App\Http\Livewire;

use App\Models\Barangay;
use App\Models\Category;
use App\Models\Citizen;
use App\Models\Citizencategory;
use App\Models\Citizenpendingcase;
use App\Models\Citizenprogram;
use App\Models\Citizentype;
use App\Models\Classification;
use App\Models\Familyrole;
use App\Models\Gender;
use App\Models\Household;
use App\Models\Ownership;
use App\Models\Pendingcase;
use App\Models\Program;
use App\Models\Type;
use App\Models\Work;
use App\Models\Zone;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Households extends Component
{
    use WithPagination;

    use WithFileUploads;

    // household
    public $residence_name, $type_id, $classification_id, $barangay_id = 21, $zone_id, $address_detail, $income;
    public $arraybarangay, $arrayzone, $savebrgy;
    public $zoneBarangaylists = [];

    public $cr;

            //edit househould
    public $household_id;

            //edit household citizen
    public $citizens;
    public $updateCitizenInEditFormBtn = false;


    // citizen
    public $firstname, $middlename, $lastname, $suffixname, $birthdate, $gender_id, $contact_no, $permanent_address, $email, $familyrole_id, $photo, $filename, $citizen_id, $deceased = 0, $yearlive, $citizen_income;
    public $citizenlists = [], $index, $updateCitizen = false;
    public $cat = [];
    public $category_id = [];
    public $prog = [];
    public $program_id = [];
    public $pend = [];
    public $pendingcase_id = [];

    public $viewCaseForm = false;

    public $trapMessage = false;
    public $citizen_trapmessage;



    public $types, $classifications, $zones, $barangays, $categories, $programs, $genders, $familyroles, $pendingcases;
    public $work_id, $citizentype_id;
    public $works, $citizentypes;

    public $searchToken;

    public $isCreate = 0;

    public $isEdit = 0;

    public $confirmSave = false;
    public $confirmUpdate = false;
    public $confirmDelete = false;
    public $confirmCancel = false;
    public $confirmCancelEdit = false;

    public $createZoneBrgy = false;
    public $editZoneBrgy = false;

    public $ownerships, $ownership_id;

    
    

    public function render()
    {
        $this->types = Type::all();
        $this->classifications = Classification::all();
        $this->zones = Zone::where('barangay_id', $this->barangay_id)->get();
        $this->barangays = Barangay::all();
        $this->categories = Category::all();
        $this->programs = Program::all();
        $this->genders = Gender::all();
        $this->familyroles = Familyrole::all();
        $this->pendingcases = Pendingcase::all();
        $this->works = Work::all();
        $this->citizentypes = Citizentype::all();
        $this->ownerships = Ownership::all();

                
        
        return view('livewire.households',['households' => Household::select('households.*')->where('households.residence_name','LIKE','%'.$this->searchToken.'%')
            ->orderBy('id', 'ASC')
            ->paginate(10)]);
    }






    // ZoneBarangay
    public function createZoneBrgy()
    {
        $this->createZoneBrgy = true;
    }

    public function closeZoneBrgy()
    {
        $this->createZoneBrgy = false;
        $this->editZoneBrgy = false;
    }

    public function saveZoneBrgy()
    {
        $this->validate([
            'barangay_id' => 'required',
            'zone_id' => 'required'
        ],
        [
            'barangay_id.required' => 'Required Field',
            'zone_id.required' => 'Required Field',
        ]);
        
        
        $this->zoneBarangaylists[] = [
            'barangay_id' => $this->barangay_id,
            'zone_id' => $this->zone_id
        ];

        $this->savebrgy = $this->barangay_id;

        $this->createZoneBrgy = false;
        $this->arraybarangay = Barangay::find($this->barangay_id);
        $this->arrayzone = Zone::find($this->zone_id);

    }

    public function editZoneBrgy()
    {
        foreach($this->zoneBarangaylists as $zoneBarangaylist){
            $this->zone_id = $zoneBarangaylist['zone_id'];
            $this->barangay_id = $zoneBarangaylist['barangay_id'];
        }
        
        
        
        $this->editZoneBrgy = true;
        
    }

    public function checkBarangay()
    {
        if($this->savebrgy != $this->barangay_id){
            $this->zone_id = '';
        }
    }

    public function updateZoneBrgy()
    {
    
        $this->validate([
            'barangay_id' => 'required',
            'zone_id' => 'required'
        ],
        [
            'barangay_id.required' => 'Required Field',
            'zone_id.required' => 'Required Field',
        ]);

        
       
        $this->zoneBarangaylists = [];
        
        $this->zoneBarangaylists[] = [
            'barangay_id' => $this->barangay_id,
            'zone_id' => $this->zone_id
        ];

        $this->savebrgy = $this->barangay_id;

        $this->editZoneBrgy = false;
        $this->arraybarangay = Barangay::find($this->barangay_id);
        $this->arrayzone = Zone::find($this->zone_id);
    }






    // CITIZEN
    public function clearCitizenField()
    {
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
        $this->citizen_income = '';
        
        
        $this->resetArrayCheckbox();
        $this->updateCitizen = false;
        $this->updateCitizenInEditFormBtn = false;
        $this->viewCaseForm = false;
        $this->trapMessage = false;
        
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

    public function addCitizen()
    {
        $this->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'birthdate' => 'required',
            'gender_id' => 'required',
            'familyrole_id' => 'required',
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



        $familyrole = Familyrole::find($this->familyrole_id);
        $familyrole_name = $familyrole->name;
        
        
        $this->citizenlists[] = [
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
            'work_id' => $this->work_id,
            'citizentype_id' => $this->citizentype_id,
            'familyrole_name' => $familyrole_name,
            'photo' => $this->photo,
            'categories' => $this->category_id,
            'programs' => $this->program_id,
            'pendingcases' => $this->pendingcase_id,
            'deceased' => $this->deceased,
            'yearlive' => $this->yearlive,
            'income' => $this->citizen_income
            
        ];

        $this->viewCaseForm = false;
        $this->clearCitizenField();
        }
    }

    public function editCitizen($index)
    {
        $this->resetArrayCheckbox();

        $this->index = $index;
        $citizenlist = $this->citizenlists[$index];
        
        $this->firstname = $citizenlist['firstname'];
        $this->middlename = $citizenlist['middlename'];
        $this->lastname = $citizenlist['lastname'];
        $this->suffixname = $citizenlist['suffixname'];
        $this->birthdate = $citizenlist['birthdate'];
        $this->gender_id = $citizenlist['gender_id'];
        $this->contact_no = $citizenlist['contact_no'];
        $this->permanent_address = $citizenlist['permanent_address'];
        $this->email = $citizenlist['email'];
        $this->familyrole_id = $citizenlist['familyrole_id'];
        $this->work_id = $citizenlist['work_id'];
        $this->citizentype_id = $citizenlist['citizentype_id'];
        $this->deceased = $citizenlist['deceased'];
        $this->yearlive = $citizenlist['yearlive'];
        $this->citizen_income = $citizenlist['income'];
        $this->photo = $citizenlist['photo'];

        $this->category_id = $citizenlist['categories'];
        $this->program_id = $citizenlist['programs'];
        $this->pendingcase_id = $citizenlist['pendingcases'];


         foreach($citizenlist['categories'] as $citlist)
         {
            $this->cat[$citlist] = 1;
         }

         foreach($citizenlist['programs'] as $proglist)
         {
            $this->prog[$proglist] = 1;
         }

         foreach($citizenlist['pendingcases'] as $pendlist)
         {
            $this->pend[$pendlist] = 1;
         }




         //View Case Form
         if($citizenlist['pendingcases'] != null)
         {
            $this->viewCaseForm = true;
         }
         else{
            $this->viewCaseForm = false;
         }


        $this->updateCitizen = true;
       
    }

    public function updateCitizen()
    {
        $this->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'birthdate' => 'required',
            'gender_id' => 'required',
            'familyrole_id' => 'required',
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
            'work_id.required' => 'Please select Nature of Work',
            'citizentype_id.required' => 'Please select Type of Resident',
            'yearlive.required' => 'Please input exact year',
        ]);



        
        $familyrole = Familyrole::find($this->familyrole_id);
        $familyrole_name = $familyrole->name;
        
        
        $this->citizenlists[$this->index] = [
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
            'work_id' => $this->work_id,
            'citizentype_id' => $this->citizentype_id,
            'deceased' => $this->deceased,
            'yearlive' => $this->yearlive,
            'income' => $this->citizen_income,
            'familyrole_name' => $familyrole_name,
            'photo' => $this->photo,
            'categories' => $this->category_id,
            'programs' => $this->program_id,
            'pendingcases' => $this->pendingcase_id
        ];

       
        $this->viewCaseForm = false;
        $this->clearCitizenField();
        $this->updateCitizen = false;
        
    }

    public function removeCitizen($index)
    {
        unset($this->citizenlists[$index]);
        $this->citizenlists = array_values($this->citizenlists);


        $this->clearCitizenField();
        $this->updateCitizen = false;
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


        $this->clearCitizenField();
        $this->citizenlists = [];
        $this->resetInputFields();
    }

    public function closeEdit()
    {
        $this->isEdit = false;
        $this->confirmCancelEdit = false;
        $this->resetInputFields();
        $this->clearCitizenField();
    }

    public function resetInputFields()
    {
        $this->residence_name = '';
        $this->type_id = '';
        $this->classification_id = ''; 
        $this->barangay_id = 21;
        $this->zone_id = '';
        $this->address_detail = '';
        $this->income = '';
        $this->household_id = '';
        $this->savebrgy = '';
        $this->cr = '';
        $this->ownership_id = '';


        $this->zoneBarangaylists = [];
        $this->citizenlists = [];
    }

    public function create()
    {
        // $this->resetInputFields();
        $this->openCreate();
    }
    
    public function confirmCancel()
    {
        $this->confirmCancel = true;
    }

    public function confirmCancelEdit()
    {
        $this->confirmCancelEdit = true;
    }

    public function confirmSave()
    {
        
        $this->validate(
            [
                'residence_name' => 'required',
                'type_id' => 'required',
                'classification_id' => 'required',
                'barangay_id' => 'required',
                'zone_id' => 'required',
                'address_detail' => 'required',
                'income' => 'required',
                'cr' => 'required',
                'ownership_id' => 'required',
            ],[
                'residence_name.required' => 'Field is required.',
                'type_id.required' => 'Field is required.',
                'classification_id.required' => 'Field is required.',
                'barangay_id.required' => 'Field is required.',
                'zone_id.required' => 'Field is required.',
                'address_detail.required' => 'Field is required.',
                'income.required' => 'Field is required.',
                'cr.required' => 'Please check button.',
                'ownership_id.required' => 'Please select ownership.',
            ]);

            
            $this->confirmSave = true;
    }

    public function store()
    {
        
        $household = Household::create([
            'residence_name' => $this->residence_name,
            'type_id' => $this->type_id,
            'classification_id' => $this->classification_id,
            'barangay_id' => $this->barangay_id,
            'zone_id' => $this->zone_id,
            'address_detail' => $this->address_detail,
            'income' => $this->income,
            'cr' => $this->cr,
            'ownership_id' => $this->ownership_id
        ]);

        
        foreach($this->citizenlists as $citizenlist)
        {
            if($citizenlist['photo'] != NULL)
            {
                $nameofPhoto = md5($citizenlist['photo'] . microtime()).'.'.$citizenlist['photo']->extension();
                $citizenlist['photo']->storeAs('public/photo', $nameofPhoto);
            }
            else{
                $nameofPhoto = NULL;
            }


            if($citizenlist['income'] == NULL)
            {
                $citizen_income = 0;
            }
            else{
                $citizen_income = $citizenlist['income'];
            }
            

            $citizen = Citizen::create([
                'household_id' => $household->id,
                'firstname' => $citizenlist['firstname'],
                'middlename' => $citizenlist['middlename'],
                'lastname' => $citizenlist['lastname'],
                'suffixname' => $citizenlist['suffixname'],
                'birthdate' => $citizenlist['birthdate'],
                'gender_id' => $citizenlist['gender_id'],
                'contact_no' => $citizenlist['contact_no'],
                'permanent_address' => $citizenlist['permanent_address'],
                'email' => $citizenlist['email'],
                'familyrole_id' => $citizenlist['familyrole_id'],
                'deceased' => $citizenlist['deceased'],
                'yearlive' => $citizenlist['yearlive'],
                'income' => $citizen_income,
                'work_id' => $citizenlist['work_id'],
                'citizentype_id' => $citizenlist['citizentype_id'],
                'photo' => $nameofPhoto
            ]);

            foreach($citizenlist['categories'] as $category)
            {
                Citizencategory::create([
                    'category_id' => $category,
                    'citizen_id' => $citizen->id
                ]);

            }

            foreach($citizenlist['programs'] as $program)
            {
                Citizenprogram::create([
                    'program_id' => $program,
                    'citizen_id' => $citizen->id
                ]);

            }

            foreach($citizenlist['pendingcases'] as $pendingcase)
            {
                Citizenpendingcase::create([
                    'pendingcase_id' => $pendingcase,
                    'citizen_id' => $citizen->id
                ]);

            }
        }





        session()->flash('message','Household created successfully');
        $this->closeCreate();

        $this->confirmSave = false;

    }

    public function edit($id)
    {
        $household = Household::find($id);
        $this->household_id = $id;
        $this->type_id = $household->type_id;
        $this->classification_id = $household->classification_id;
        $this->barangay_id = $household->barangay_id;
        $this->zone_id = $household->zone_id;
        $this->residence_name = $household->residence_name;
        $this->address_detail = $household->address_detail;
        $this->income = $household->income;
        $this->cr = $household->cr;
        $this->ownership_id = $household->ownership_id;
        
        $this->citizens = Citizen::where('household_id', $household->id)->get();

        $this->openEdit();
    }

    public function editCitizenInEditForm($id)
    {
        $this->resetArrayCheckbox();

        $citizen = Citizen::find($id);
        $this->citizen_id = $id;
        
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
        $this->citizen_income = $citizen->income;
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


        $this->updateCitizenInEditFormBtn = true;
        
    }

    public function updateCitizenInEditForm()
    {
        if($this->citizen_id){
            $this->validate([
                'firstname' => 'required',
                'lastname' => 'required',
                'birthdate' => 'required',
                'gender_id' => 'required',
                'familyrole_id' => 'required',
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
                'work_id.required' => 'Please select Nature of Work',
                'citizentype_id.required' => 'Please select Type of Resident',
                'yearlive.required' => 'Please input exact year',
            ]);
            
    
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

            if($this->citizen_income == NULL)
            {
                $citizen_income = 0;
            }
            else{
                $citizen_income = $this->citizen_income;
            }
            
            $citizen->update([
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
             
            $this->citizens = Citizen::where('household_id', $this->household_id)->get();
            $this->clearCitizenField();
        }
        
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

    // public function updateCitizenCategory($category_id, $checker){

    //     Citizencategory::where('citizen_id', $this->citizen_id)->where('category_id',$category_id)->delete();

    //     if($checker){
    //     $CitizenCategory = new Citizencategory();

    //     $CitizenCategory->citizen_id = $this->citizen_id;
    //     $CitizenCategory->category_id= $category_id;
    //     $CitizenCategory->save();
    //     }
    // }

    // public function updateCitizenProgram($program_id, $checker){

    //     Citizenprogram::where('citizen_id', $this->citizen_id)->where('program_id',$program_id)->delete();

    //     if($checker){
    //     $CitizenProgram = new Citizenprogram();

    //     $CitizenProgram->citizen_id = $this->citizen_id;
    //     $CitizenProgram->program_id= $program_id;
    //     $CitizenProgram->save();
    //     }
    // }

    // public function updateCitizenPendingcase($pendingcase_id, $checker){

    //     Citizenpendingcase::where('citizen_id', $this->citizen_id)->where('pendingcase_id',$pendingcase_id)->delete();

    //     if($checker){
    //     $CitizenPendingcase = new Citizenpendingcase();

    //     $CitizenPendingcase->citizen_id = $this->citizen_id;
    //     $CitizenPendingcase->pendingcase_id= $pendingcase_id;
    //     $CitizenPendingcase->save();
    //     }
    // }

    public function addCitizenInEditForm()
    {
        $this->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'birthdate' => 'required',
            'gender_id' => 'required',
            'familyrole_id' => 'required',
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
            
            if($this->photo != NULL)
            {
                $nameofPhoto = md5($this->photo . microtime()).'.'.$this->photo->extension();
                $this->photo->storeAs('public/photo', $nameofPhoto);
            }
            else{
                $nameofPhoto = NULL;
            }

        if($this->citizen_income == NULL)
        {
            $citizen_income = 0;
        }
        else{
            $citizen_income = $this->citizen_income;
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
            'photo' => $nameofPhoto,
            
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

            $this->citizens = Citizen::where('household_id', $this->household_id)->get();
            $this->clearCitizenField();

        }
        

        


    }

    public function removeCitizenInEditForm($id)
    {
        $citizen = Citizen::find($id);

        Citizencategory::where('citizen_id', $citizen->id)->delete();
        Citizenprogram::where('citizen_id', $citizen->id)->delete();
        Citizenpendingcase::where('citizen_id', $citizen->id)->delete();

        $oldfilename = $citizen->photo;
        Storage::delete('public/photo/'.$oldfilename);
        $citizen->delete();

        $this->citizens = Citizen::where('household_id', $this->household_id)->get();
        $this->clearCitizenField();
    }
    
    

    public function confirmUpdate()
    {
        $this->validate(
            [
                'residence_name' => 'required',
                'type_id' => 'required',
                'classification_id' => 'required',
                'barangay_id' => 'required',
                'zone_id' => 'required',
                'address_detail' => 'required',
                'income' => 'required',
                'cr' => 'required',
                'ownership_id' => 'required',
            ],[
                'residence_name.required' => 'Field is required.',
                'type_id.required' => 'Field is required.',
                'classification_id.required' => 'Field is required.',
                'barangay_id.required' => 'Field is required.',
                'zone_id.required' => 'Field is required.',
                'address_detail.required' => 'Field is required.',
                'income.required' => 'Field is required.',
                'cr.required' => 'Please check button.',
                'ownership.required' => 'Please select ownership.',
            ]);

            
        $this->confirmUpdate = true;
    }

    public function update()
    {
        $household = Household::find($this->household_id);

        $household->update([
            'residence_name' => $this->residence_name,
            'type_id' => $this->type_id,
            'classification_id' => $this->classification_id,
            'barangay_id' => $this->barangay_id,
            'zone_id' => $this->zone_id,
            'address_detail' => $this->address_detail,
            'income' => $this->income,
            'cr' => $this->cr,
            'ownership_id' => $this->ownership_id,
        ]);




        session()->flash('message','Household updated successfully');
        $this->closeEdit();

        $this->confirmUpdate = false;
    }

    public function confirmDelete($id)
    {
        $this->household_id = $id;
        $this->confirmDelete = true;
    }

    public function delete()
    {
        $household = Household::find($this->household_id);

        $citizens = Citizen::where('household_id', $household->id)->get();

        foreach($citizens as $citizen)
        {
            Citizencategory::where('citizen_id', $citizen->id)->delete();
            Citizenprogram::where('citizen_id', $citizen->id)->delete();
            Citizenpendingcase::where('citizen_id', $citizen->id)->delete();

            $oldfilename = $citizen->photo;
            Storage::delete('public/photo/'.$oldfilename);

            $citizen->delete();
        }



        Household::find($this->household_id)->delete();
        session()->flash('message', 'Category deleted successfully.');

        $this->confirmDelete = false;
        $this->household_id = '';

        return redirect(request()->header('Referer'));
    }
}
