<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendingcase extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function citizens(){
        return $this->belongsToMany('App\Models\Citizen', 'citizenpendingcases', 'pendingcase_id', 'citizen_id');
    }

    public function citizenpendingcase($citizen_id)
    {
        return Citizenpendingcase::where('citizen_id',$citizen_id)->where('pendingcase_id',$this->id)->first();
    }

    public function citizenpendingcases(){
        return $this->hasMany('App\Models\Citizenpendingcases');
    }
}
