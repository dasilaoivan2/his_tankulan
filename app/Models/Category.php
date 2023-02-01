<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function citizens(){
        return $this->belongsToMany('App\Models\Citizen', 'citizencategories', 'category_id', 'citizen_id');
    }

    public function citizencategory($citizen_id)
    {
        return Citizencategory::where('citizen_id',$citizen_id)->where('category_id',$this->id)->first();
    }
}
