<?php

namespace App\Http\Controllers;

use App\Models\Classification;
use App\Models\Household;
use App\Models\Ownership;
use App\Models\Type;
use App\Models\Zone;
use Illuminate\Http\Request;

class HouseholdsReportController extends Controller
{
    public function allhousehold()
    {
        $households = Household::orderBy('residence_name', 'ASC')->get();

        return view('reports.households.allhousehold', compact('households'));
    }


    public function household($id)
    {
        $household = Household::findOrFail($id);

        return view('reports.households.household', compact('household'));
    }

    public function householdtype($type_id)
    {
        $households = Household::where('type_id', $type_id)->get();

        $type = Type::find($type_id);

        return view('reports.households.householdtype', compact('households', 'type'));
    }

    public function householdclass($classification_id)
    {
        $households = Household::where('classification_id', $classification_id)->get();

        $classification = Classification::find($classification_id);

        return view('reports.households.householdclass', compact('households', 'classification'));
    }

    public function householdzone($zone_id)
    {
        $households = Household::where('zone_id', $zone_id)->get();

        $zone = Zone::find($zone_id);

        return view('reports.households.householdzone', compact('households', 'zone'));
    }

    public function householdcr($cr)
    {
        $households = Household::where('cr', $cr)->get();

       

        return view('reports.households.householdcr', compact('households', 'cr'));
    }
    
    public function householdzonecr($zone_id, $cr)
    {
        $zone = Zone::find($zone_id);

        $households = Household::where('cr', $cr)
        ->where('zone_id', $zone->id)
        ->get();


        return view('reports.households.householdzonecr', compact('households', 'cr', 'zone'));
    }


    public function householdownership($ownership_id)
    {
        $ownership = Ownership::find($ownership_id);
        $households = Household::where('ownership_id', $ownership_id)->get();

       

        return view('reports.households.householdownership', compact('households', 'ownership'));
    }

    public function householdzoneownership($zone_id, $ownership_id)
    {
        $zone = Zone::find($zone_id);
        $ownership = Ownership::find($ownership_id);

        $households = Household::where('ownership_id', $ownership_id)
        ->where('zone_id', $zone->id)
        ->get();


        return view('reports.households.householdzoneownership', compact('households', 'ownership', 'zone'));
    }
}
