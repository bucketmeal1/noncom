<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\Auth\LoginController;
use Livewire\Livewire;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/',[LoginController::class,'showLoginForm'])->name('home.login');
Route::get('/login',[LoginController::class,'showLoginForm'])->name('login');
Route::post('/login',[LoginController::class,'login']);
Route::post('/logout',[LoginController::class,'logout'])->name('logout');


Livewire::setScriptRoute(function ($handle) {
    return Route::get(env('FILAMENT_VENDOR').'/livewire/livewire/dist/livewire.js', $handle);
});

Livewire::setUpdateRoute(function ($handle) {
    return Route::post(env('FILAMENT_VENDOR').'/livewire/livewire/dist/update', $handle);
});



    
Route::get('reports/accomplishment/report', [PDFController::class, 'accomplishment_report'])->name('pdf.accomplishment.report');
Route::get('reports/accomplishmentprovince/report', [PDFController::class,'accomplishmentprovince_report'])->name('pdf.accomplishmentprovince.report');
Route::get('reports/tclcervicalcancer/report', [PDFController::class, 'tcl_report'])->name('pdf.tcl.reports');
// Route::get('/year', PDFController::class, 'year');
// Route::post('/your-route/filter', PDFController::class, 'filter');
// Route::get('pdf/wfp/{fund_source_id}/{year}/stream',[PDFController::class,'wfp_pdf'])->name('wfp.stream');
// Route::get('pdf/ppmp/{fund_source_id}/{year}/stream',[PDFController::class,'ppmp_pdf'])->name('ppmp.stream'); 
// Route::get('pdf/wfpis/{fund_source_id}/{year}/stream',[PDFController::class,'wfpis_pdf'])->name('wfpis.stream');

