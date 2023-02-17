<?php

namespace App\Http\Livewire;

use App\Models\Ownership;
use Livewire\Component;
use Livewire\WithPagination;

class Ownerships extends Component
{
    use WithPagination;

    public $name;

    public $ownership_id;

    public $searchToken;

    public $isCreate = 0;

    public $isEdit = 0;

    public $confirmSave = false;
    public $confirmUpdate = false;
    public $confirmDelete = false;


    public function render()
    {
        return view('livewire.ownerships', ['ownerships' => Ownership::select('ownerships.*')->where('ownerships.name','LIKE','%'.$this->searchToken.'%')
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
        $this->ownership_id = '';
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
        Ownership::create([
            'name' => $this->name,
        ]);

        session()->flash('message','Ownership created successfully');
        $this->closeCreate();
        $this->resetInputFields();

        $this->confirmSave = false;

    }

    public function edit($id)
    {
        $ownership = Ownership::find($id);
        $this->ownership_id = $id;
        $this->name = $ownership->name;

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
        $ownership = Ownership::find($this->ownership_id);

        $ownership->update([
            'name' => $this->name
        ]);

        session()->flash('message','Ownership updated successfully');
        $this->closeEdit();
        $this->resetInputFields();

        $this->confirmUpdate = false;
    }

    public function confirmDelete($id)
    {
        $this->ownership_id = $id;
        $this->confirmDelete = true;
    }

    public function delete()
    {
        Ownership::find($this->ownership_id)->delete();
        session()->flash('message', 'Ownership deleted successfully.');

        $this->confirmDelete = false;
        $this->ownership_id = '';

        return redirect(request()->header('Referer'));
    }
}
