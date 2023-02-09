<?php

use App\Http\Livewire\Categories;
use App\Http\Livewire\Citizenreports;
use App\Http\Livewire\Citizenzonereports;
use App\Http\Livewire\Citizenagerangereports;
use App\Http\Livewire\Citizenworkreports;
use App\Http\Livewire\Citizentypereports;
use App\Http\Livewire\Householdreports;
use App\Http\Livewire\Householdtypereports;
use App\Http\Livewire\Householdclassreports;
use App\Http\Livewire\Householdzonereports;
use App\Http\Livewire\Householdcrreports;
use App\Http\Livewire\Citizens;
use App\Http\Livewire\Classifications;
use App\Http\Livewire\Agebrackets;
use App\Http\Livewire\Works;
use App\Http\Livewire\Citizentypes;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Dashboards;
use App\Http\Livewire\Familyroles;
use App\Http\Livewire\Households;
use App\Http\Livewire\Pendingcases;
use App\Http\Livewire\Programs;
use App\Http\Livewire\Types;
use App\Http\Livewire\Zones;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return redirect(route('login'));
});

Route::get('/register', function () {
    return redirect(route('login'));
});



Route::get('dashboard',Dashboards::class)->middleware(['auth:sanctum', 'verified'])->name('dashboard');

Route::group(['middleware' => 'role:Encoder', 'prefix' => 'encoder'], function(){
    Route::get('households',Households::class)->middleware(['auth:sanctum', 'verified'])->name('encoder.households');
    Route::get('citizens',Citizens::class)->middleware(['auth:sanctum', 'verified'])->name('encoder.citizens');
});

Route::group(['middleware' => 'role:Admin', 'prefix' => 'admin'], function(){

    Route::get('households',Households::class)->middleware(['auth:sanctum', 'verified'])->name('households');
    Route::get('citizens',Citizens::class)->middleware(['auth:sanctum', 'verified'])->name('citizens');
    Route::get('classifications',Classifications::class)->middleware(['auth:sanctum', 'verified'])->name('classifications');
    Route::get('familyroles',Familyroles::class)->middleware(['auth:sanctum', 'verified'])->name('familyroles');
    Route::get('categories',Categories::class)->middleware(['auth:sanctum', 'verified'])->name('categories');
    Route::get('zones',Zones::class)->middleware(['auth:sanctum', 'verified'])->name('zones');
    Route::get('programs',Programs::class)->middleware(['auth:sanctum', 'verified'])->name('programs');
    Route::get('types',Types::class)->middleware(['auth:sanctum', 'verified'])->name('types');
    Route::get('cases',Pendingcases::class)->middleware(['auth:sanctum', 'verified'])->name('pendingcases');
    Route::get('agebrackets',Agebrackets::class)->middleware(['auth:sanctum', 'verified'])->name('agebrackets');
    Route::get('works',Works::class)->middleware(['auth:sanctum', 'verified'])->name('works');
    Route::get('citizentypes',Citizentypes::class)->middleware(['auth:sanctum', 'verified'])->name('citizentypes');
    
    
    
    
    
    Route::get('citizenreports',Citizenreports::class)->middleware(['auth:sanctum', 'verified'])->name('citizenreports');
    Route::get('citizenzonereports',Citizenzonereports::class)->middleware(['auth:sanctum', 'verified'])->name('citizenzonereports');
    Route::get('citizenagerangereports',Citizenagerangereports::class)->middleware(['auth:sanctum', 'verified'])->name('citizenagerangereports');
    Route::get('citizenworkreports',Citizenworkreports::class)->middleware(['auth:sanctum', 'verified'])->name('citizenworkreports');
    Route::get('citizentypereports',Citizentypereports::class)->middleware(['auth:sanctum', 'verified'])->name('citizentypereports');
    
    Route::get('householdreports',Householdreports::class)->middleware(['auth:sanctum', 'verified'])->name('householdreports');
    Route::get('householdtypereports',Householdtypereports::class)->middleware(['auth:sanctum', 'verified'])->name('householdtypereports');
    Route::get('householdclassreports',Householdclassreports::class)->middleware(['auth:sanctum', 'verified'])->name('householdclassreports');
    Route::get('householdzonereports',Householdzonereports::class)->middleware(['auth:sanctum', 'verified'])->name('householdzonereports');
    Route::get('householdcrreports',Householdcrreports::class)->middleware(['auth:sanctum', 'verified'])->name('householdcrreports');
    
    
    
    
    
    
    
    
    // Reports
    
    Route::get('citizens/all/reports', 'App\Http\Controllers\CitizensReportController@allcitizen')->name('citizens.all.reports');
    Route::get('citizens/individual/reports/{id}', 'App\Http\Controllers\CitizensReportController@individual')->name('citizens.individual.reports');
    Route::get('citizens/group/reports/{radio_select}', 'App\Http\Controllers\CitizensReportController@group')->name('citizens.group.reports');
    Route::get('citizens/subgroup/{radio_select}/reports/{subgroup_id}', 'App\Http\Controllers\CitizensReportController@subgroup')->name('citizens.subgroup.reports');
    Route::get('citizens/zone/{zone_id}/reports', 'App\Http\Controllers\CitizensReportController@zone')->name('citizens.zone.reports');
    Route::get('citizens/zone/{zone_id}/group/{radio_select}/reports', 'App\Http\Controllers\CitizensReportController@zonegroup')->name('citizens.zonegroup.reports');
    Route::get('citizens/zone/{zone_id}/subgroup/{radio_select}/reports/{subgroup_id}', 'App\Http\Controllers\CitizensReportController@zonesubgroup')->name('citizens.zonesubgroup.reports');
    Route::get('citizens/agerange/{agebracket_id}', 'App\Http\Controllers\CitizensReportController@agerange')->name('citizens.agerange.reports');
    Route::get('citizens/zone/{zone_id}/agerange/{agebracket_id}', 'App\Http\Controllers\CitizensReportController@zoneagerange')->name('citizens.zoneagerange.reports');
    Route::get('citizens/work/{work_id}', 'App\Http\Controllers\CitizensReportController@work')->name('citizens.work.reports');
    Route::get('citizens/zone/{zone_id}/work/{work_id}', 'App\Http\Controllers\CitizensReportController@zonework')->name('citizens.zonework.reports');
    Route::get('citizens/citizentype/{citizentype_id}', 'App\Http\Controllers\CitizensReportController@citizentype')->name('citizens.citizentype.reports');
    Route::get('citizens/zone/{zone_id}/citizentype/{citizentype_id}', 'App\Http\Controllers\CitizensReportController@zonecitizentype')->name('citizens.zonecitizentype.reports');
    
    
    Route::get('households/all/reports', 'App\Http\Controllers\HouseholdsReportController@allhousehold')->name('households.all.reports');
    Route::get('households/reports/{id}', 'App\Http\Controllers\HouseholdsReportController@household')->name('households.reports');
    Route::get('households/reports/type/{type_id}', 'App\Http\Controllers\HouseholdsReportController@householdtype')->name('households.reports.type');
    Route::get('households/reports/classification/{classification_id}', 'App\Http\Controllers\HouseholdsReportController@householdclass')->name('households.reports.classification');
    Route::get('households/reports/zone/{zone_id}', 'App\Http\Controllers\HouseholdsReportController@householdzone')->name('households.reports.zone');
    Route::get('households/reports/cr/{cr}', 'App\Http\Controllers\HouseholdsReportController@householdcr')->name('households.reports.cr');
    Route::get('households/zone/{zone_id}/reports/cr/{cr}', 'App\Http\Controllers\HouseholdsReportController@householdzonecr')->name('households.reports.zonecr');
});

