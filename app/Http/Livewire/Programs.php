<?php

namespace App\Http\Livewire;

use App\Models\Program;
use Livewire\Component;
use Livewire\WithPagination;

class Programs extends Component
{
    use WithPagination;

    public $name;

    public $program_id;

    public $searchToken;

    public $isCreate = 0;

    public $isEdit = 0;

    public $confirmSave = false;
    public $confirmUpdate = false;
    public $confirmDelete = false;

    public function render()
    {
        return view('livewire.programs',['programs' => Program::select('programs.*')->where('programs.name','LIKE','%'.$this->searchToken.'%')
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
        $this->program_id = '';
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
        Program::create([
            'name' => $this->name,
        ]);

        session()->flash('message','Program created successfully');
        $this->closeCreate();
        $this->resetInputFields();

        $this->confirmSave = false;

    }

    public function edit($id)
    {
        $program = Program::find($id);
        $this->program_id = $id;
        $this->name = $program->name;

        $this->openEdit();
    }

    public function confirmUpdate()
    {
        $this->validate(
            [
                'name' => 'required',
            ],[
                'name.required' => 'Name field is required.',
            ]);

            
            $this->confirmUpdate = true;
    }

    public function update()
    {
        $program = Program::find($this->program_id);

        $program->update([
            'name' => $this->name,
        ]);

        session()->flash('message','Program updated successfully');
        $this->closeEdit();
        $this->resetInputFields();

        $this->confirmUpdate = false;
    }

    public function confirmDelete($id)
    {
        $this->program_id = $id;
        $this->confirmDelete = true;
    }

    public function delete()
    {
        Program::find($this->program_id)->delete();
        session()->flash('message', 'Program deleted successfully.');

        $this->confirmDelete = false;
        $this->program_id = '';

        return redirect(request()->header('Referer'));
    }
}