<?php

namespace App\Http\Livewire;

use App\Models\Type;
use Livewire\Component;
use Livewire\WithPagination;

class Types extends Component
{
    use WithPagination;

    public $name;

    public $type_id;

    public $searchToken;

    public $isCreate = 0;

    public $isEdit = 0;

    public $confirmSave = false;
    public $confirmUpdate = false;
    public $confirmDelete = false;

    public function render()
    {
        return view('livewire.types',['types' => Type::select('types.*')->where('types.name','LIKE','%'.$this->searchToken.'%')
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
        $this->type_id = '';
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
        Type::create([
            'name' => $this->name,
        ]);

        session()->flash('message','Type created successfully');
        $this->closeCreate();
        $this->resetInputFields();

        $this->confirmSave = false;

    }

    public function edit($id)
    {
        $type = Type::find($id);
        $this->type_id = $id;
        $this->name = $type->name;

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
        $type = Type::find($this->type_id);

        $type->update([
            'name' => $this->name,
        ]);

        session()->flash('message','Type updated successfully');
        $this->closeEdit();
        $this->resetInputFields();

        $this->confirmUpdate = false;
    }

    public function confirmDelete($id)
    {
        $this->type_id = $id;
        $this->confirmDelete = true;
    }

    public function delete()
    {
        Type::find($this->type_id)->delete();
        session()->flash('message', 'Type deleted successfully.');

        $this->confirmDelete = false;
        $this->type_id = '';

        return redirect(request()->header('Referer'));
    }
}
