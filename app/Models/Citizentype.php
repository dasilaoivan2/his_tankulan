<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Citizentype extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function citizens(){
        return $this->hasMany('App\Models\Citizen');
    }
}
