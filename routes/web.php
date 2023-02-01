<?php

use App\Http\Livewire\Categories;
use App\Http\Livewire\Citizenreports;
use App\Http\Livewire\Citizenzonereports;
use App\Http\Livewire\Householdreports;
use App\Http\Livewire\Householdtypereports;
use App\Http\Livewire\Householdclassreports;
use App\Http\Livewire\Householdzonereports;
use App\Http\Livewire\Citizens;
use App\Http\Livewire\Classifications;
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
Route::get('households',Households::class)->middleware(['auth:sanctum', 'verified'])->name('households');
Route::get('citizens',Citizens::class)->middleware(['auth:sanctum', 'verified'])->name('citizens');
Route::get('classifications',Classifications::class)->middleware(['auth:sanctum', 'verified'])->name('classifications');
Route::get('familyroles',Familyroles::class)->middleware(['auth:sanctum', 'verified'])->name('familyroles');
Route::get('categories',Categories::class)->middleware(['auth:sanctum', 'verified'])->name('categories');
Route::get('zones',Zones::class)->middleware(['auth:sanctum', 'verified'])->name('zones');
Route::get('programs',Programs::class)->middleware(['auth:sanctum', 'verified'])->name('programs');
Route::get('types',Types::class)->middleware(['auth:sanctum', 'verified'])->name('types');
Route::get('cases',Pendingcases::class)->middleware(['auth:sanctum', 'verified'])->name('pendingcases');
Route::get('citizenreports',Citizenreports::class)->middleware(['auth:sanctum', 'verified'])->name('citizenreports');
Route::get('citizenzonereports',Citizenzonereports::class)->middleware(['auth:sanctum', 'verified'])->name('citizenzonereports');
Route::get('householdreports',Householdreports::class)->middleware(['auth:sanctum', 'verified'])->name('householdreports');
Route::get('householdtypereports',Householdtypereports::class)->middleware(['auth:sanctum', 'verified'])->name('householdtypereports');
Route::get('householdclassreports',Householdclassreports::class)->middleware(['auth:sanctum', 'verified'])->name('householdclassreports');
Route::get('householdzonereports',Householdzonereports::class)->middleware(['auth:sanctum', 'verified'])->name('householdzonereports');

Route::get('citizens/all/reports', 'App\Http\Controllers\CitizensReportController@allcitizen')->name('citizens.all.reports');
Route::get('citizens/individual/reports/{id}', 'App\Http\Controllers\CitizensReportController@individual')->name('citizens.individual.reports');
Route::get('citizens/group/reports/{radio_select}', 'App\Http\Controllers\CitizensReportController@group')->name('citizens.group.reports');
Route::get('citizens/subgroup/{radio_select}/reports/{subgroup_id}', 'App\Http\Controllers\CitizensReportController@subgroup')->name('citizens.subgroup.reports');
Route::get('citizens/zone/{zone_id}/reports', 'App\Http\Controllers\CitizensReportController@zone')->name('citizens.zone.reports');
Route::get('citizens/zone/{zone_id}/group/{radio_select}/reports', 'App\Http\Controllers\CitizensReportController@zonegroup')->name('citizens.zonegroup.reports');
Route::get('citizens/zone/{zone_id}/subgroup/{radio_select}/reports/{subgroup_id}', 'App\Http\Controllers\CitizensReportController@zonesubgroup')->name('citizens.zonesubgroup.reports');


Route::get('households/all/reports', 'App\Http\Controllers\HouseholdsReportController@allhousehold')->name('households.all.reports');
Route::get('households/reports/{id}', 'App\Http\Controllers\HouseholdsReportController@household')->name('households.reports');
Route::get('households/reports/type/{type_id}', 'App\Http\Controllers\HouseholdsReportController@householdtype')->name('households.reports.type');
Route::get('households/reports/classification/{classification_id}', 'App\Http\Controllers\HouseholdsReportController@householdclass')->name('households.reports.classification');
Route::get('households/reports/zone/{zone_id}', 'App\Http\Controllers\HouseholdsReportController@householdzone')->name('households.reports.zone');