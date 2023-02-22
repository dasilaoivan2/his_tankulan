<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Household extends Model
{
    use HasFactory;

    protected $fillable = ['type_id', 'classification_id', 'barangay_id', 'zone_id', 'residence_name', 'address_detail', 'income', 'cr', 'ownership_id', 'material_id'];

    public function citizens(){
        return $this->hasMany('App\Models\Citizen');
    }

    public function citizensHead(){
        return $this->hasMany('App\Models\Citizen')->where('familyrole_id', 1);
    }

    public function citizensOrderByRole(){
        return $this->hasMany('App\Models\Citizen')->orderBy('familyrole_id', 'ASC');
    }

    public function type(){
        return $this->belongsTo('App\Models\Type');
    }

    public function classification(){
        return $this->belongsTo('App\Models\Classification');
    }

    public function barangay(){
        return $this->belongsTo('App\Models\Barangay');
    }

    public function zone(){
        return $this->belongsTo('App\Models\Zone');
    }

    public function ownership(){
        return $this->belongsTo('App\Models\Ownership');
    }

    public function material(){
        return $this->belongsTo('App\Models\Material');
    }

    
}
