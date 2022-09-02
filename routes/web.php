<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\DiseaseController;
use App\Http\Controllers\VisitController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\CashController;
use App\Http\Controllers\RoleController;

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

Route::get('/', function () {
    return view('auth.login');
});



// Auth::routes(['register'=>false]);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('patients',PatientController::class);

Route::resource('doctors',DoctorController::class);

Route::resource('diseases',DiseaseController::class);

Route::resource('visits',VisitController::class);

Route::resource('invoices',InvoiceController::class);

Route::get('Print_invoice/{id}',[InvoiceController::class,'Print_invoice']);

Route::resource('cash',CashController::class);


Route::group(['middleware' => ['auth']], function() {

    Route::resource('roles',RoleController::class);

    Route::resource('users',UserController::class);
});





Route::get('/{page}',[AdminController::class,'index']);
