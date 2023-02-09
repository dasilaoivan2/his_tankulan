<?php

namespace App\Http\Livewire;

use App\Models\Agebracket;
use Livewire\Component;
use Livewire\WithPagination;

class Agebrackets extends Component
{
    use WithPagination;

    public $name, $from, $to;

    public $agebracket_id;

    public $searchToken;

    public $isCreate = 0;

    public $isEdit = 0;

    public $confirmSave = false;
    public $confirmUpdate = false;
    public $confirmDelete = false;


    public function render()
    {
        
        return view('livewire.agebrackets',['agebrackets' => Agebracket::select('agebrackets.*')->where('agebrackets.name','LIKE','%'.$this->searchToken.'%')
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
        $this->from = '';
        $this->to = '';
        $this->agebracket_id = '';
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
                'from' => 'required',
                'to' => 'required'
            ],[
                'name.required' => 'Name field is required.',
                'from.required' => 'Field is required.',
                'to.required' => 'Field is required.'
            ]);

            
            $this->confirmSave = true;
    }

    public function store()
    {
        Agebracket::create([
            'name' => $this->name,
            'from' => $this->from,
            'to' => $this->to
        ]);

        session()->flash('message','Age bracket created successfully');
        $this->closeCreate();
        $this->resetInputFields();

        $this->confirmSave = false;

    }

    public function edit($id)
    {
        $agebracket = Agebracket::find($id);
        $this->agebracket_id = $id;
        $this->name = $agebracket->name;
        $this->from = $agebracket->from;
        $this->to = $agebracket->to;

        $this->openEdit();
    }

    public function confirmUpdate()
    {
        $this->validate(
            [
                'name' => 'required',
                'from' => 'required',
                'to' => 'required'
            ],[
                'name.required' => 'Name field is required.',
                'from.required' => 'Field is required.',
                'to.required' => 'Field is required.'
            ]);

            
            $this->confirmUpdate = true;
    }

    public function update()
    {
        $agebracket = Agebracket::find($this->agebracket_id);

        $agebracket->update([
            'name' => $this->name,
            'from' => $this->from,
            'to' => $this->to
        ]);

        session()->flash('message','Age bracket updated successfully');
        $this->closeEdit();
        $this->resetInputFields();

        $this->confirmUpdate = false;
    }

    public function confirmDelete($id)
    {
        $this->agebracket_id = $id;
        $this->confirmDelete = true;
    }

    public function delete()
    {
        Agebracket::find($this->agebracket_id)->delete();
        session()->flash('message', 'Age bracket deleted successfully.');

        $this->confirmDelete = false;
        $this->agebracket_id = '';

        return redirect(request()->header('Referer'));
    }
}
