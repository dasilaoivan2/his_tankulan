<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function citizens(){
        return $this->belongsToMany('App\Models\Citizen', 'citizenprograms', 'program_id', 'citizen_id');
    }

    public function citizenprogram($citizen_id)
    {
        return Citizenprogram::where('citizen_id',$citizen_id)->where('program_id',$this->id)->first();
    }
}
