<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Citizen extends Model
{
    use HasFactory;

    protected $fillable = ['household_id', 'firstname', 'middlename', 'lastname', 'suffixname', 'birthdate', 'gender_id', 'contact_no', 'permanent_address', 'email', 'familyrole_id', 'citizentype_id', 'work_id', 'photo', 'deceased', 'yearlive'];

    public function categories(){
        return $this->belongsToMany('App\Models\Category', 'citizencategories', 'citizen_id', 'category_id');
    }

    public function programs(){
        return $this->belongsToMany('App\Models\Program', 'citizenprograms', 'citizen_id', 'program_id');
    }

    public function pendingcases(){
        return $this->belongsToMany('App\Models\Pendingcase', 'citizenpendingcases', 'citizen_id', 'pendingcase_id');
    }

    public function citizencategories()
    {
        return $this->hasMany('App\Models\Citizencategory');
    }

    public function citizenprograms()
    {
        return $this->hasMany('App\Models\Citizenprogram');
    }

    public function citizenpendingcases()
    {
        return $this->hasMany('App\Models\Citizenpendingcase');
    }

    public function household(){
        return $this->belongsTo('App\Models\Household');
    }

    public function work(){
        return $this->belongsTo('App\Models\Work');
    }

    public function citizentype(){
        return $this->belongsTo('App\Models\Citizentype');
    }

    public function gender(){
        return $this->belongsTo('App\Models\Gender');
    }

    public function familyrole(){
        return $this->belongsTo('App\Models\Familyrole');
    }
    

    public function fullname()
    {
        return $this->firstname." ".$this->middlename[0].". ".$this->lastname." ".$this->suffixname;
    }

    public function fullnameLastname()
    {
        return $this->lastname.", ".$this->firstname." ".$this->middlename[0].". ".$this->suffixname;
    }

    public function age()
    {
        return Carbon::parse($this->attributes['birthdate'])->age;
    }
}

