<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/collection-schedule', [App\Http\Controllers\HomeController::class, 'viewCollectionSchedule'])->name('view_loan_collection_schedule');
Route::post('/collection-schedule', [App\Http\Controllers\HomeController::class, 'collectionSchedule'])->name('loan_collection_schedule');
