<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Citizenpendingcase extends Model
{
    use HasFactory;

    protected $fillable = ['pendingcase_id', 'citizen_id'];

    public function citizen(){
        return $this->belongsTo('App\Models\Citizen');
    }

    public function pendingcase(){
        return $this->belongsTo('App\Models\Pendingcase');
    }
}
