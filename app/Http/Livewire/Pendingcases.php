<?php

namespace App\Http\Livewire;

use App\Models\Pendingcase;
use Livewire\Component;
use Livewire\WithPagination;

class Pendingcases extends Component
{
    use WithPagination;

    public $name;

    public $pendingcase_id;

    public $searchToken;

    public $isCreate = 0;

    public $isEdit = 0;

    public $confirmSave = false;
    public $confirmUpdate = false;
    public $confirmDelete = false;

    public function render()
    {
        return view('livewire.pendingcases',['pendingcases' => Pendingcase::select('pendingcases.*')->where('pendingcases.name','LIKE','%'.$this->searchToken.'%')
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
        $this->pendingcase_id = '';
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
        Pendingcase::create([
            'name' => $this->name,
        ]);

        session()->flash('message','Case created successfully');
        $this->closeCreate();
        $this->resetInputFields();

        $this->confirmSave = false;

    }

    public function edit($id)
    {
        $pendingcase = Pendingcase::find($id);
        $this->pendingcase_id = $id;
        $this->name = $pendingcase->name;

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
        $pendingcase = Pendingcase::find($this->pendingcase_id);

        $pendingcase->update([
            'name' => $this->name,
        ]);

        session()->flash('message','Case updated successfully');
        $this->closeEdit();
        $this->resetInputFields();

        $this->confirmUpdate = false;
    }

    public function confirmDelete($id)
    {
        $this->pendingcase_id = $id;
        $this->confirmDelete = true;
    }

    public function delete()
    {
        Pendingcase::find($this->pendingcase_id)->delete();
        session()->flash('message', 'Case deleted successfully.');

        $this->confirmDelete = false;
        $this->pendingcase_id = '';

        return redirect(request()->header('Referer'));
    }
}
