<?php

namespace App\Http\Livewire;

use App\Models\Agebracket;
use App\Models\Citizen;
use App\Models\Classification;
use App\Models\Household;
use App\Models\Type;
use App\Models\Work;
use Livewire\Component;

class Dashboards extends Component
{
    public $households, $citizens, $classifications, $types, $works, $agebrackets;
    public function render()
    {

        $this->households = Household::all();
        $this->citizens = Citizen::all();
        $this->classifications = Classification::all();
        $this->types = Type::all();
        $this->works = Work::all();
        $this->agebrackets = Agebracket::all();



        return view('livewire.dashboards');
    }
}
