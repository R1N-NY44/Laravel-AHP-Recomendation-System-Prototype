<?php

use App\Http\Controllers\CourseController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('main');
});

Route::prefix('master')->name('master.')->group(function() {
    Route::prefix('course')->name('course.')->controller(CourseController::class)->group(function() {
        Route::get('/', 'index');
        Route::get('/create', 'create')->name('create');
        Route::get('/show', 'show')->name('show');
        Route::post('/store', 'store')->name('store');
        Route::post('/update/{id}', 'update')->name('update');
        Route::get('/edit/{id}', 'edit')->name('edit');  
        Route::post('/status/{id}', 'status')->name('status');      
    });
});
