<?php

namespace App\Http\Livewire;

use App\Models\Material;
use Livewire\Component;
use Livewire\WithPagination;

class Materials extends Component
{
    use WithPagination;

    public $name;

    public $material_id;

    public $searchToken;

    public $isCreate = 0;

    public $isEdit = 0;

    public $confirmSave = false;
    public $confirmUpdate = false;
    public $confirmDelete = false;

    public function render()
    {
       
        return view('livewire.materials', ['materials' => Material::select('materials.*')->where('materials.name','LIKE','%'.$this->searchToken.'%')
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
        $this->material_id = '';
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
        Material::create([
            'name' => $this->name,
        ]);

        session()->flash('message','Material Type created successfully');
        $this->closeCreate();
        $this->resetInputFields();

        $this->confirmSave = false;

    }

    public function edit($id)
    {
        $material = Material::find($id);
        $this->material_id = $id;
        $this->name = $material->name;

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
        $material = Material::find($this->material_id);

        $material->update([
            'name' => $this->name
        ]);

        session()->flash('message','Material Type updated successfully');
        $this->closeEdit();
        $this->resetInputFields();

        $this->confirmUpdate = false;
    }

    public function confirmDelete($id)
    {
        $this->material_id = $id;
        $this->confirmDelete = true;
    }

    public function delete()
    {
        Material::find($this->material_id)->delete();
        session()->flash('message', 'Material Type deleted successfully.');

        $this->confirmDelete = false;
        $this->material_id = '';

        return redirect(request()->header('Referer'));
    }
}
