<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Citizenprogram extends Model
{
    use HasFactory;

    protected $fillable = ['program_id', 'citizen_id'];

    public function citizen(){
        return $this->belongsTo('App\Models\Citizen');
    }

    public function program(){
        return $this->belongsTo('App\Models\Program');
    }
}
