<?php

namespace App\Http\Livewire;

use App\Models\Classification;
use Livewire\Component;
use Livewire\WithPagination;
use PhpParser\Builder\Class_;

class Classifications extends Component
{
    use WithPagination;

    public $name;

    public $classification_id;

    public $searchToken;

    public $isCreate = 0;

    public $isEdit = 0;

    public $confirmSave = false;
    public $confirmUpdate = false;
    public $confirmDelete = false;

    public function render()
    {
        return view('livewire.classifications', ['classifications' => Classification::select('classifications.*')->where('classifications.name','LIKE','%'.$this->searchToken.'%')
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
        $this->classification_id = '';
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
        Classification::create([
            'name' => $this->name,
        ]);

        session()->flash('message','Classification created successfully');
        $this->closeCreate();
        $this->resetInputFields();

        $this->confirmSave = false;

    }

    public function edit($id)
    {
        $classification = Classification::find($id);
        $this->classification_id = $id;
        $this->name = $classification->name;

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
        $classification = Classification::find($this->classification_id);

        $classification->update([
            'name' => $this->name
        ]);

        session()->flash('message','Classification updated successfully');
        $this->closeEdit();
        $this->resetInputFields();

        $this->confirmUpdate = false;
    }

    public function confirmDelete($id)
    {
        $this->classification_id = $id;
        $this->confirmDelete = true;
    }

    public function delete()
    {
        Classification::find($this->classification_id)->delete();
        session()->flash('message', 'Classification deleted successfully.');

        $this->confirmDelete = false;
        $this->classification_id = '';

        return redirect(request()->header('Referer'));
    }
}
