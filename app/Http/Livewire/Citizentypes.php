<?php

namespace App\Http\Livewire;

use App\Models\Citizentype;
use Livewire\Component;
use Livewire\WithPagination;

class Citizentypes extends Component
{
    use WithPagination;

    public $name;

    public $citizentype_id;

    public $searchToken;

    public $isCreate = 0;

    public $isEdit = 0;

    public $confirmSave = false;
    public $confirmUpdate = false;
    public $confirmDelete = false;


    public function render()
    {
        return view('livewire.citizentypes', ['citizentypes' => Citizentype::select('citizentypes.*')->where('citizentypes.name','LIKE','%'.$this->searchToken.'%')
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
        $this->citizentype_id = '';
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
            ],[
                'name.required' => 'Name field is required.',
            ]);

            
            $this->confirmSave = true;
    }

    public function store()
    {
        Citizentype::create([
            'name' => $this->name,
        ]);

        session()->flash('message','Citizen type created successfully');
        $this->closeCreate();
        $this->resetInputFields();

        $this->confirmSave = false;

    }

    public function edit($id)
    {
        $citizentype = Citizentype::find($id);
        $this->citizentype_id = $id;
        $this->name = $citizentype->name;

        $this->openEdit();
    }

    public function confirmUpdate()
    {
        $this->validate(
            [
                'name' => 'required'
            ],[
                'name.required' => 'Name field is required.'
            ]);

            
            $this->confirmUpdate = true;
    }

    public function update()
    {
        $citizentype = Citizentype::find($this->citizentype_id);

        $citizentype->update([
            'name' => $this->name
        ]);

        session()->flash('message','Citizen type updated successfully');
        $this->closeEdit();
        $this->resetInputFields();

        $this->confirmUpdate = false;
    }

    public function confirmDelete($id)
    {
        $this->citizentype_id = $id;
        $this->confirmDelete = true;
    }

    public function delete()
    {
        Citizentype::find($this->citizentype_id)->delete();
        session()->flash('message', 'Citizen type deleted successfully.');

        $this->confirmDelete = false;
        $this->citizentype_id = '';

        return redirect(request()->header('Referer'));
    }
}
