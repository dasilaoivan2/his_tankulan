<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Citizen extends Model
{
    use HasFactory;

    protected $fillable = ['household_id', 'firstname', 'middlename', 'lastname', 'suffixname', 'birthdate', 'gender_id', 'contact_no', 'permanent_address', 'email', 'familyrole_id', 'citizentype_id', 'work_id', 'photo', 'deceased', 'yearlive', 'income'];

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
        if($this->middlename == NULL){
            return $this->firstname." - ".$this->lastname." ".$this->suffixname;
        }
        else{
            return $this->firstname." ".$this->middlename[0].". ".$this->lastname." ".$this->suffixname;
        }
        
    }

    public function fullnameLastname()
    {
        if($this->middlename == NULL){
            return $this->lastname.", ".$this->firstname." - ".$this->suffixname;
        }
        else{
            return $this->lastname.", ".$this->firstname." ".$this->middlename[0].". ".$this->suffixname;
        }
        
    }

    public function age()
    {
        return Carbon::parse($this->attributes['birthdate'])->age;
    }

    public function ageMonth()
    {
        return Carbon::parse($this->attributes['birthdate'])->diff(\Carbon\Carbon::now())->format('%m');
    }

    public function ageindays(){

       
            $start = strtotime($this->birthdate);
            $end = strtotime(now());
    
            return ceil(abs($end - $start) / 86400);
    
    }

    public function ageinwords($sum){

        $finalyear="";
        $finalmonth="";
        $finalday="";
        $stringyears = "year";
        $stringmonths="month";
        $stringdays="day";
        $years = floor($sum / 365);
        $months = floor(($sum - ($years * 365))/30.5);
        $days = ($sum - ($years * 365) - ($months * 30.5));

        if($years > 1)
        $stringyears="years";
        if($months>1)
        $stringmonths="months";
        if($days>1)
        $stringdays="days";


        if($years>0){
            $finalyear=$years." ".$stringyears; 
        }

        if($months>0){
            $finalmonth=$months." ".$stringmonths; 
        }

        if($days>0){
            $finalday=$days." ".$stringdays; 
        }

        return $finalyear." ".$finalmonth." ".$finalday;



}
}

