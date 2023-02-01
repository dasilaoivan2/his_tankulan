<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'barangay_id'];

    public function barangay(){
        return $this->belongsTo('App\Models\Barangay');
    }

    public function households(){
        return $this->hasMany('App\Models\Household');
    }
}
