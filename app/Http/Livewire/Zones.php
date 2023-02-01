<?php

namespace App\Http\Livewire;

use App\Models\Barangay;
use App\Models\Zone;
use Livewire\Component;
use Livewire\WithPagination;

class Zones extends Component
{
    use WithPagination;

    public $name, $barangay_id = 21;

    public $barangays;

    public $zone_id;

    public $searchToken;

    public $isCreate = 0;

    public $isEdit = 0;

    public $confirmSave = false;
    public $confirmUpdate = false;
    public $confirmDelete = false;

    public function render()
    {

        $this->barangays = Barangay::all();

        return view('livewire.zones',['zones' => Zone::select('zones.*')->where('zones.name','LIKE','%'.$this->searchToken.'%')
            ->orderBy('id', 'ASC')
            ->paginate(10)]);
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
    }

    public function closeEdit()
    {
        $this->isEdit = false;
    }

    public function resetInputFields()
    {
        $this->name = '';
        $this->zone_id = '';
        $this->barangay_id = 21;
    }

    public function create()
    {
        $this->resetInputFields();
        $this->openCreate();
    }

    public function confirmSave()
    {
        $this->validate(
            [
                'name' => 'required',
                'barangay_id' => 'required',
            ],[
                'name.required' => 'Name field is required.',
                'barangay_id.required' => 'Barangay field is required.',
            ]);

            
            $this->confirmSave = true;
    }

    public function store()
    {
        Zone::create([
            'name' => $this->name,
            'barangay_id' => $this->barangay_id
        ]);

        session()->flash('message','Zone created successfully');
        $this->closeCreate();
        $this->resetInputFields();

        $this->confirmSave = false;

    }

    public function edit($id)
    {
        $zone = Zone::find($id);
        $this->zone_id = $id;
        $this->name = $zone->name;
        $this->barangay_id = $zone->barangay_id;

        $this->openEdit();
    }

    public function confirmUpdate()
    {
        $this->validate(
            [
                'name' => 'required',
                'barangay_id' => 'required'
            ],[
                'name.required' => 'Name field is required.',
                'barangay_id.required' => 'Barangay field is required.'
            ]);

            
            $this->confirmUpdate = true;
    }

    public function update()
    {
        $zone = Zone::find($this->zone_id);

        $zone->update([
            'name' => $this->name,
            'barangay_id' => $this->barangay_id
        ]);

        session()->flash('message','Zone updated successfully');
        $this->closeEdit();
        $this->resetInputFields();

        $this->confirmUpdate = false;
    }

    public function confirmDelete($id)
    {
        $this->zone_id = $id;
        $this->confirmDelete = true;
    }

    public function delete()
    {
        Zone::find($this->zone_id)->delete();
        session()->flash('message', 'Zone deleted successfully.');

        $this->confirmDelete = false;
        $this->zone_id = '';

        return redirect(request()->header('Referer'));
    }
}
