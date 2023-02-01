<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Citizen;
use App\Models\Pendingcase;
use App\Models\Program;
use App\Models\Zone;
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

        

        return view('reports.citizens.allcitizen', compact('citizens'));
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

        
             
        }
        elseif($radio_select == 2){
            $group_name = 'PROGRAM';
           $citizens = DB::table('citizenprograms')
            ->select('citizens.*', 'households.residence_name as residence_name', 'zones.name as zone_name')
            ->join('programs','programs.id', 'citizenprograms.program_id')
            ->join('citizens','citizens.id', 'citizenprograms.citizen_id')
            ->join('households','households.id', 'citizens.household_id')
            ->join('zones','zones.id', 'households.zone_id')
            ->distinct()
            ->orderBy('citizens.lastname', 'ASC')
            ->get();

            

        }
        elseif($radio_select == 3){
            $group_name = 'PENDING CASE';
            $citizens = DB::table('citizenpendingcases')
                ->select('citizens.*', 'households.residence_name as residence_name', 'zones.name as zone_name')
                ->join('pendingcases','pendingcases.id', 'citizenpendingcases.pendingcase_id')
                ->join('citizens','citizens.id', 'citizenpendingcases.citizen_id')
                ->join('households','households.id', 'citizens.household_id')
                ->join('zones','zones.id', 'households.zone_id')
                ->distinct()
                ->orderBy('citizens.lastname', 'ASC')
                ->get();

        }

        // $citizens = $citizens->get();

        return view('reports.citizens.group', compact('citizens', 'group_name'));

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

            

        }
        elseif($radio_select == 3){
            $group_name = 'PENDING CASE';
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

        }

        return view('reports.citizens.subgroup', compact('citizens', 'group_name', 'subgroup_name'));
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

        return view('reports.citizens.zone', compact('citizens', 'zone'));
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

        }

       

        return view('reports.citizens.zonegroup', compact('citizens', 'group_name', 'zone'));

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

        }

        return view('reports.citizens.zonesubgroup', compact('citizens', 'group_name', 'zone','subgroup_name'));
    }

}
