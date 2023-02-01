<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Citizencategory extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'citizen_id'];

    public function citizen(){
        return $this->belongsTo('App\Models\Citizen');
    }

    public function category(){
        return $this->belongsTo('App\Models\Category');
    }
}
