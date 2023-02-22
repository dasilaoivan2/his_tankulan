<?php

namespace App\Http\Controllers;

use App\Models\Agebracket;
use App\Models\Category;
use App\Models\Citizen;
use App\Models\Citizentype;
use App\Models\Material;
use App\Models\Ownership;
use App\Models\Pendingcase;
use App\Models\Program;
use App\Models\Work;
use App\Models\Zone;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CitizensReportController extends Controller
{
   

    public function index(){

        // $citizens = Citizen::paginate(50);

        // return view('reports.citizens', compact('citizens'));
    }

    public function allcitizen()
    {
        $citizens = Citizen::orderBy('lastname', 'ASC')->get();

        $gender_records = Citizen::selectRaw('
            COUNT(CASE WHEN citizens.gender_id = 1 THEN 1 ELSE NULL END) as "male",
            COUNT(CASE WHEN citizens.gender_id <> 1 THEN 1 ELSE NULL END) as "female",
            COUNT(*) as "all"
            ')
            ->first();

        

        return view('reports.citizens.allcitizen', compact('citizens', 'gender_records'));
    }

    public function individual($id)
    {
        $citizen = Citizen::find($id);

        

        return view('reports.citizens.individual', compact('citizen'));

    }

    public function group($radio_select)
    {
        if($radio_select == 1){
            $group_name = 'CATEGORY';

            $citizens = DB::table('citizencategories')
            ->select('citizens.*', 'households.residence_name as residence_name', 'zones.name as zone_name')
            ->join('categories','categories.id', 'citizencategories.category_id')
            ->join('citizens','citizens.id', 'citizencategories.citizen_id')
            ->join('households','households.id', 'citizens.household_id')
            ->join('zones','zones.id', 'households.zone_id')
            ->distinct()
            ->orderBy('citizens.lastname', 'ASC')
            ->get();

            $male = $citizens->where('gender_id', 1)->count();
            $female = $citizens->where('gender_id', 2)->count();

            

              
             
        }
        elseif($radio_select == 2){
            $group_name = 'PROGRAM';
           $citizens = DB::table('citizenprograms')
            ->select('citizens.*',  'households.residence_name as residence_name', 'zones.name as zone_name')
            ->join('programs','programs.id', 'citizenprograms.program_id')
            ->join('citizens','citizens.id', 'citizenprograms.citizen_id')
            ->join('households','households.id', 'citizens.household_id')
            ->join('zones','zones.id', 'households.zone_id')
            ->distinct()
            ->orderBy('citizens.lastname', 'ASC')
            ->get();

            $male = $citizens->where('gender_id', 1)->count();
            $female = $citizens->where('gender_id', 2)->count();

            

        }
        elseif($radio_select == 3){
            $group_name = 'PENDING COMPLAINTS';
            $citizens = DB::table('citizenpendingcases')
                ->select('citizens.*', 'households.residence_name as residence_name', 'zones.name as zone_name')
                ->join('pendingcases','pendingcases.id', 'citizenpendingcases.pendingcase_id')
                ->join('citizens','citizens.id', 'citizenpendingcases.citizen_id')
                ->join('households','households.id', 'citizens.household_id')
                ->join('zones','zones.id', 'households.zone_id')
                ->distinct()
                ->orderBy('citizens.lastname', 'ASC')
                ->get();

            $male = $citizens->where('gender_id', 1)->count();
            $female = $citizens->where('gender_id', 2)->count();

        }

        // $citizens = $citizens->get();

        return view('reports.citizens.group', compact('citizens', 'group_name', 'male', 'female'));

    }

    public function subgroup($radio_select, $subgroup_id)
    {
        if($radio_select == 1){
            $group_name = 'CATEGORY';
            $subgroup = Category::find($subgroup_id);
            $subgroup_name = $subgroup->name;


            $citizens = DB::table('citizencategories')
            ->select('citizens.*', 'households.residence_name as residence_name', 'zones.name as zone_name')
            ->where('categories.id', $subgroup->id)
            ->join('categories','categories.id', 'citizencategories.category_id')
            ->join('citizens','citizens.id', 'citizencategories.citizen_id')
            ->join('households','households.id', 'citizens.household_id')
            ->join('zones','zones.id', 'households.zone_id')
            ->distinct()
            ->orderBy('citizens.lastname', 'ASC')
            ->get();

            $male = $citizens->where('gender_id', 1)->count();
            $female = $citizens->where('gender_id', 2)->count();

        
             
        }
        elseif($radio_select == 2){
            $group_name = 'PROGRAM';
            $subgroup = Program::find($subgroup_id);
            $subgroup_name = $subgroup->name;


           $citizens = DB::table('citizenprograms')
            ->select('citizens.*', 'households.residence_name as residence_name', 'zones.name as zone_name')
            ->where('programs.id', $subgroup->id)
            ->join('programs','programs.id', 'citizenprograms.program_id')
            ->join('citizens','citizens.id', 'citizenprograms.citizen_id')
            ->join('households','households.id', 'citizens.household_id')
            ->join('zones','zones.id', 'households.zone_id')
            ->distinct()
            ->orderBy('citizens.lastname', 'ASC')
            ->get();

            $male = $citizens->where('gender_id', 1)->count();
            $female = $citizens->where('gender_id', 2)->count();

            

        }
        elseif($radio_select == 3){
            $group_name = 'PENDING COMPLAINTS';
            $subgroup = Pendingcase::find($subgroup_id);

            $subgroup_name = $subgroup->name;

            $citizens = DB::table('citizenpendingcases')
                ->select('citizens.*', 'households.residence_name as residence_name', 'zones.name as zone_name')
                ->where('pendingcases.id', $subgroup->id)
                ->join('pendingcases','pendingcases.id', 'citizenpendingcases.pendingcase_id')
                ->join('citizens','citizens.id', 'citizenpendingcases.citizen_id')
                ->join('households','households.id', 'citizens.household_id')
                ->join('zones','zones.id', 'households.zone_id')
                ->distinct()
                ->orderBy('citizens.lastname', 'ASC')
                ->get();

                $male = $citizens->where('gender_id', 1)->count();
                $female = $citizens->where('gender_id', 2)->count();

        }

        return view('reports.citizens.subgroup', compact('citizens', 'group_name', 'subgroup_name', 'male', 'female'));
    }

    
    public function zone($zone_id)
    {
        $zone = Zone::find($zone_id);

        $citizens = Citizen::select('citizens.*', 'households.residence_name as residence_name', 'zones.name as zone_name')
        ->where('zones.id', $zone->id)
        ->join('households','households.id', 'citizens.household_id')
        ->join('zones','zones.id', 'households.zone_id')
        ->orderBy('citizens.lastname', 'ASC')
        ->get();

        $male = $citizens->where('gender_id', 1)->count();
        $female = $citizens->where('gender_id', 2)->count();

        return view('reports.citizens.zone', compact('citizens', 'zone', 'male', 'female'));
    }

    public function zonegroup($zone_id,$radio_select)
    {
        $zone = Zone::find($zone_id);


        if($radio_select == 1){
            $group_name = 'CATEGORY';

            $citizens = DB::table('citizencategories')
            ->select('citizens.*', 'households.residence_name as residence_name', 'zones.name as zone_name')
            ->where('zones.id', $zone->id)
            ->join('categories','categories.id', 'citizencategories.category_id')
            ->join('citizens','citizens.id', 'citizencategories.citizen_id')
            ->join('households','households.id', 'citizens.household_id')
            ->join('zones','zones.id', 'households.zone_id')
            ->distinct()
            ->orderBy('citizens.lastname', 'ASC')
            ->get();

            $male = $citizens->where('gender_id', 1)->count();
        $female = $citizens->where('gender_id', 2)->count();

        
             
        }
        elseif($radio_select == 2){
            $group_name = 'PROGRAM';
           $citizens = DB::table('citizenprograms')
            ->select('citizens.*', 'households.residence_name as residence_name', 'zones.name as zone_name')
            ->where('zones.id', $zone->id)
            ->join('programs','programs.id', 'citizenprograms.program_id')
            ->join('citizens','citizens.id', 'citizenprograms.citizen_id')
            ->join('households','households.id', 'citizens.household_id')
            ->join('zones','zones.id', 'households.zone_id')
            ->distinct()
            ->orderBy('citizens.lastname', 'ASC')
            ->get();

            $male = $citizens->where('gender_id', 1)->count();
        $female = $citizens->where('gender_id', 2)->count();

            

        }
        elseif($radio_select == 3){
            $group_name = 'PENDING CASE';
            $citizens = DB::table('citizenpendingcases')
                ->select('citizens.*', 'households.residence_name as residence_name', 'zones.name as zone_name')
                ->where('zones.id', $zone->id)
                ->join('pendingcases','pendingcases.id', 'citizenpendingcases.pendingcase_id')
                ->join('citizens','citizens.id', 'citizenpendingcases.citizen_id')
                ->join('households','households.id', 'citizens.household_id')
                ->join('zones','zones.id', 'households.zone_id')
                ->distinct()
                ->orderBy('citizens.lastname', 'ASC')
                ->get();

                $male = $citizens->where('gender_id', 1)->count();
        $female = $citizens->where('gender_id', 2)->count();

        }

       

        return view('reports.citizens.zonegroup', compact('citizens', 'group_name', 'zone', 'male', 'female'));

    }

    public function zonesubgroup($zone_id, $radio_select, $subgroup_id)
    {

        $zone = Zone::find($zone_id);


        if($radio_select == 1){
            $group_name = 'CATEGORY';
            $subgroup = Category::find($subgroup_id);
            $subgroup_name = $subgroup->name;


            $citizens = DB::table('citizencategories')
            ->select('citizens.*', 'households.residence_name as residence_name', 'zones.name as zone_name')
            ->where('zones.id', $zone->id)
            ->where('categories.id', $subgroup->id)
            ->join('categories','categories.id', 'citizencategories.category_id')
            ->join('citizens','citizens.id', 'citizencategories.citizen_id')
            ->join('households','households.id', 'citizens.household_id')
            ->join('zones','zones.id', 'households.zone_id')
            ->distinct()
            ->orderBy('citizens.lastname', 'ASC')
            ->get();

            $male = $citizens->where('gender_id', 1)->count();
        $female = $citizens->where('gender_id', 2)->count();

        
             
        }
        elseif($radio_select == 2){
            $group_name = 'PROGRAM';
            $subgroup = Program::find($subgroup_id);
            $subgroup_name = $subgroup->name;


           $citizens = DB::table('citizenprograms')
            ->select('citizens.*', 'households.residence_name as residence_name', 'zones.name as zone_name')
            ->where('zones.id', $zone->id)
            ->where('programs.id', $subgroup->id)
            ->join('programs','programs.id', 'citizenprograms.program_id')
            ->join('citizens','citizens.id', 'citizenprograms.citizen_id')
            ->join('households','households.id', 'citizens.household_id')
            ->join('zones','zones.id', 'households.zone_id')
            ->distinct()
            ->orderBy('citizens.lastname', 'ASC')
            ->get();

            $male = $citizens->where('gender_id', 1)->count();
        $female = $citizens->where('gender_id', 2)->count();

            

        }
        elseif($radio_select == 3){
            $group_name = 'PENDING CASE';
            $subgroup = Pendingcase::find($subgroup_id);

            $subgroup_name = $subgroup->name;

            $citizens = DB::table('citizenpendingcases')
                ->select('citizens.*', 'households.residence_name as residence_name', 'zones.name as zone_name')
                ->where('zones.id', $zone->id)
                ->where('pendingcases.id', $subgroup->id)
                ->join('pendingcases','pendingcases.id', 'citizenpendingcases.pendingcase_id')
                ->join('citizens','citizens.id', 'citizenpendingcases.citizen_id')
                ->join('households','households.id', 'citizens.household_id')
                ->join('zones','zones.id', 'households.zone_id')
                ->distinct()
                ->orderBy('citizens.lastname', 'ASC')
                ->get();

                $male = $citizens->where('gender_id', 1)->count();
        $female = $citizens->where('gender_id', 2)->count();

        }

        return view('reports.citizens.zonesubgroup', compact('citizens', 'group_name', 'zone','subgroup_name', 'male', 'female'));
    }

    public function agerange($agebracket_id)
    {
        $age = Agebracket::find($agebracket_id);
            $minAge = $age->from;
            $maxAge = $age->to;

            $minDate = Carbon::today()->subYears($maxAge + 1);
            $maxDate = Carbon::today()->subYears($minAge)->endOfDay();

            $citizens = Citizen::whereBetween('citizens.birthdate', [$minDate,$maxDate])
            ->orderBy('lastname', 'ASC')
            ->get();
            
            $gender_records = Citizen::selectRaw('
            COUNT(CASE WHEN citizens.gender_id = 1 THEN 1 ELSE NULL END) as "male",
            COUNT(CASE WHEN citizens.gender_id <> 1 THEN 1 ELSE NULL END) as "female",
            COUNT(*) as "all"
            ')->whereBetween('citizens.birthdate', [$minDate,$maxDate])
            ->first();



        return view('reports.citizens.age', compact('citizens', 'age', 'gender_records'));
    }

    public function zoneagerange($zone_id, $agebracket_id)
    {
        $age = Agebracket::find($agebracket_id);
        $minAge = $age->from;
        $maxAge = $age->to;

        $zone = Zone::find($zone_id);

        $minDate = Carbon::today()->subYears($maxAge + 1);
        $maxDate = Carbon::today()->subYears($minAge)->endOfDay();

        $citizens = Citizen::select('citizens.*')
        ->join('households','households.id', 'citizens.household_id')
        ->join('zones','zones.id', 'households.zone_id')
        ->where('zones.id', $zone_id)
        ->whereBetween('citizens.birthdate', [$minDate,$maxDate])
        ->orderBy('lastname', 'ASC')
        ->get();

        $gender_records = Citizen::selectRaw('
            COUNT(CASE WHEN citizens.gender_id = 1 THEN 1 ELSE NULL END) as "male",
            COUNT(CASE WHEN citizens.gender_id <> 1 THEN 1 ELSE NULL END) as "female",
            COUNT(*) as "all"
            ')
            ->join('households','households.id', 'citizens.household_id')
            ->join('zones','zones.id', 'households.zone_id')
            ->where('zones.id', $zone_id)
            ->whereBetween('citizens.birthdate', [$minDate,$maxDate])
            ->first();

        return view('reports.citizens.zoneage', compact('citizens', 'age', 'zone', 'gender_records'));
    }

    public function work($work_id)
    {
        $work = Work::find($work_id);

       

        $citizens = Citizen::select('citizens.*')
        ->join('households','households.id', 'citizens.household_id')
        ->join('zones','zones.id', 'households.zone_id')
        ->where('citizens.work_id', $work->id)
        ->orderBy('lastname', 'ASC')
        ->get();

        $gender_records = Citizen::selectRaw('
            COUNT(CASE WHEN citizens.gender_id = 1 THEN 1 ELSE NULL END) as "male",
            COUNT(CASE WHEN citizens.gender_id <> 1 THEN 1 ELSE NULL END) as "female",
            COUNT(*) as "all"
            ')
            ->join('households','households.id', 'citizens.household_id')
            ->join('zones','zones.id', 'households.zone_id')
            ->where('citizens.work_id', $work->id)
            ->first();

        return view('reports.citizens.work', compact('citizens', 'work', 'gender_records'));
    }

    public function zonework($zone_id, $work_id)
    {
        $work = Work::find($work_id);
        $zone = Zone::find($zone_id);


        $citizens = Citizen::select('citizens.*')
        ->join('households','households.id', 'citizens.household_id')
        ->join('zones','zones.id', 'households.zone_id')
        ->where('zones.id', $zone_id)
        ->where('citizens.work_id', $work->id)
        ->orderBy('lastname', 'ASC')
        ->get();

        $gender_records = Citizen::selectRaw('
            COUNT(CASE WHEN citizens.gender_id = 1 THEN 1 ELSE NULL END) as "male",
            COUNT(CASE WHEN citizens.gender_id <> 1 THEN 1 ELSE NULL END) as "female",
            COUNT(*) as "all"
            ')
            ->join('households','households.id', 'citizens.household_id')
            ->join('zones','zones.id', 'households.zone_id')
            ->where('zones.id', $zone_id)
            ->where('citizens.work_id', $work->id)
            ->first();

        return view('reports.citizens.zonework', compact('citizens', 'work', 'zone', 'gender_records'));
    }

    public function citizentype($citizentype_id)
    {
        $citizentype = Citizentype::find($citizentype_id);

       

        $citizens = Citizen::select('citizens.*')
        ->join('households','households.id', 'citizens.household_id')
        ->join('zones','zones.id', 'households.zone_id')
        ->where('citizens.citizentype_id', $citizentype->id)
        ->orderBy('lastname', 'ASC')
        ->get();

        $gender_records = Citizen::selectRaw('
            COUNT(CASE WHEN citizens.gender_id = 1 THEN 1 ELSE NULL END) as "male",
            COUNT(CASE WHEN citizens.gender_id <> 1 THEN 1 ELSE NULL END) as "female",
            COUNT(*) as "all"
            ')
            ->join('households','households.id', 'citizens.household_id')
            ->join('zones','zones.id', 'households.zone_id')
            ->where('citizens.citizentype_id', $citizentype->id)
            ->first();

        return view('reports.citizens.type', compact('citizens', 'citizentype','gender_records'));
    }

    public function zonecitizentype($zone_id, $citizentype_id)
    {
        $citizentype = Citizentype::find($citizentype_id);
        $zone = Zone::find($zone_id);


        $citizens = Citizen::select('citizens.*')
        ->join('households','households.id', 'citizens.household_id')
        ->join('zones','zones.id', 'households.zone_id')
        ->where('zones.id', $zone_id)
        ->where('citizens.citizentype_id', $citizentype->id)
        ->orderBy('lastname', 'ASC')
        ->get();

        $gender_records = Citizen::selectRaw('
        COUNT(CASE WHEN citizens.gender_id = 1 THEN 1 ELSE NULL END) as "male",
        COUNT(CASE WHEN citizens.gender_id <> 1 THEN 1 ELSE NULL END) as "female",
        COUNT(*) as "all"
        ')
        ->join('households','households.id', 'citizens.household_id')
        ->join('zones','zones.id', 'households.zone_id')
        ->where('zones.id', $zone_id)
        ->where('citizens.citizentype_id', $citizentype->id)
        ->first();

        return view('reports.citizens.zonetype', compact('citizens', 'citizentype', 'zone', 'gender_records'));
    }

    public function ownership($ownership_id)
    {
        $ownership = Ownership::find($ownership_id);

       

        $citizens = Citizen::select('citizens.*')
        ->join('households','households.id', 'citizens.household_id')
        ->join('zones','zones.id', 'households.zone_id')
        ->where('households.ownership_id', $ownership->id)
        ->orderBy('lastname', 'ASC')
        ->get();

        $gender_records = Citizen::selectRaw('
        COUNT(CASE WHEN citizens.gender_id = 1 THEN 1 ELSE NULL END) as "male",
        COUNT(CASE WHEN citizens.gender_id <> 1 THEN 1 ELSE NULL END) as "female",
        COUNT(*) as "all"
        ')
        ->join('households','households.id', 'citizens.household_id')
        ->join('zones','zones.id', 'households.zone_id')
        ->where('households.ownership_id', $ownership->id)
        ->first();

        return view('reports.citizens.ownership', compact('citizens', 'ownership', 'gender_records'));
    }

    public function zoneownership($zone_id, $ownership_id)
    {
        $ownership = Ownership::find($ownership_id);
        $zone = Zone::find($zone_id);


        $citizens = Citizen::select('citizens.*')
        ->join('households','households.id', 'citizens.household_id')
        ->join('zones','zones.id', 'households.zone_id')
        ->where('zones.id', $zone_id)
        ->where('households.ownership_id', $ownership->id)
        ->orderBy('lastname', 'ASC')
        ->get();

        $gender_records = Citizen::selectRaw('
        COUNT(CASE WHEN citizens.gender_id = 1 THEN 1 ELSE NULL END) as "male",
        COUNT(CASE WHEN citizens.gender_id <> 1 THEN 1 ELSE NULL END) as "female",
        COUNT(*) as "all"
        ')
        ->join('households','households.id', 'citizens.household_id')
        ->join('zones','zones.id', 'households.zone_id')
        ->where('zones.id', $zone_id)
        ->where('households.ownership_id', $ownership->id)
        ->first();

        return view('reports.citizens.zoneownership', compact('citizens', 'ownership', 'zone', 'gender_records'));
    }

    public function material($material_id)
    {
        $material = Material::find($material_id);

       

        $citizens = Citizen::select('citizens.*')
        ->join('households','households.id', 'citizens.household_id')
        ->join('zones','zones.id', 'households.zone_id')
        ->where('households.material_id', $material->id)
        ->orderBy('lastname', 'ASC')
        ->get();

        $gender_records = Citizen::selectRaw('
        COUNT(CASE WHEN citizens.gender_id = 1 THEN 1 ELSE NULL END) as "male",
        COUNT(CASE WHEN citizens.gender_id <> 1 THEN 1 ELSE NULL END) as "female",
        COUNT(*) as "all"
        ')
        ->join('households','households.id', 'citizens.household_id')
        ->join('zones','zones.id', 'households.zone_id')
        ->where('households.material_id', $material->id)
        ->first();

        return view('reports.citizens.material', compact('citizens', 'material', 'gender_records'));
    }

    public function zonematerial($zone_id, $material_id)
    {
        $material = Material::find($material_id);
        $zone = Zone::find($zone_id);


        $citizens = Citizen::select('citizens.*')
        ->join('households','households.id', 'citizens.household_id')
        ->join('zones','zones.id', 'households.zone_id')
        ->where('zones.id', $zone_id)
        ->where('households.material_id', $material->id)
        ->orderBy('lastname', 'ASC')
        ->get();

        $gender_records = Citizen::selectRaw('
        COUNT(CASE WHEN citizens.gender_id = 1 THEN 1 ELSE NULL END) as "male",
        COUNT(CASE WHEN citizens.gender_id <> 1 THEN 1 ELSE NULL END) as "female",
        COUNT(*) as "all"
        ')
        ->join('households','households.id', 'citizens.household_id')
        ->join('zones','zones.id', 'households.zone_id')
        ->where('zones.id', $zone_id)
        ->where('households.material_id', $material->id)
        ->first();

        return view('reports.citizens.zonematerial', compact('citizens', 'material', 'zone', 'gender_records'));
    }

}
