<?php

namespace App\Http\Livewire;

use App\Models\Work;
use Livewire\Component;
use Livewire\WithPagination;

class Works extends Component
{
    use WithPagination;

    public $name;

    public $work_id;

    public $searchToken;

    public $isCreate = 0;

    public $isEdit = 0;

    public $confirmSave = false;
    public $confirmUpdate = false;
    public $confirmDelete = false;

    public function render()
    {
        return view('livewire.works', ['works' => Work::select('works.*')->where('works.name','LIKE','%'.$this->searchToken.'%')
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
        $this->work_id = '';
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
        Work::create([
            'name' => $this->name,
        ]);

        session()->flash('message','Work created successfully');
        $this->closeCreate();
        $this->resetInputFields();

        $this->confirmSave = false;

    }

    public function edit($id)
    {
        $work = Work::find($id);
        $this->work_id = $id;
        $this->name = $work->name;

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
        $work = Work::find($this->work_id);

        $work->update([
            'name' => $this->name
        ]);

        session()->flash('message','Work updated successfully');
        $this->closeEdit();
        $this->resetInputFields();

        $this->confirmUpdate = false;
    }

    public function confirmDelete($id)
    {
        $this->work_id = $id;
        $this->confirmDelete = true;
    }

    public function delete()
    {
        Work::find($this->work_id)->delete();
        session()->flash('message', 'Work deleted successfully.');

        $this->confirmDelete = false;
        $this->work_id = '';

        return redirect(request()->header('Referer'));
    }


}
