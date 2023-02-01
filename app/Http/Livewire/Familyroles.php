<?php

namespace App\Http\Livewire;

use App\Models\Familyrole;
use Livewire\Component;
use Livewire\WithPagination;

class Familyroles extends Component
{
    use WithPagination;

    public $name;

    public $familyrole_id;

    public $searchToken;

    public $isCreate = 0;

    public $isEdit = 0;

    public $confirmSave = false;
    public $confirmUpdate = false;
    public $confirmDelete = false;

    public function render()
    {
        return view('livewire.familyroles',['familyroles' => Familyrole::select('familyroles.*')->where('familyroles.name','LIKE','%'.$this->searchToken.'%')
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
        $this->familyrole_id = '';
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
        Familyrole::create([
            'name' => $this->name,
        ]);

        session()->flash('message','Role created successfully');
        $this->closeCreate();
        $this->resetInputFields();

        $this->confirmSave = false;

    }

    public function edit($id)
    {
        $familyrole = Familyrole::find($id);
        $this->familyrole_id = $id;
        $this->name = $familyrole->name;

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
        $familyrole = Familyrole::find($this->familyrole_id);

        $familyrole->update([
            'name' => $this->name
        ]);

        session()->flash('message','Role updated successfully');
        $this->closeEdit();
        $this->resetInputFields();

        $this->confirmUpdate = false;
    }

    public function confirmDelete($id)
    {
        $this->familyrole_id = $id;
        $this->confirmDelete = true;
    }

    public function delete()
    {
        Familyrole::find($this->familyrole_id)->delete();
        session()->flash('message', 'Role deleted successfully.');

        $this->confirmDelete = false;
        $this->familyrole_id = '';

        return redirect(request()->header('Referer'));
    }
}
