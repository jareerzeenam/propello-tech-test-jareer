<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TaskController;
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

Route::middleware(['auth', 'verified'])
    ->name('tasks.')
    ->controller(TaskController::class)
    ->group(function() {
        Route::get('', 'index')->name('home');
        Route::get('create', 'create')->name('create');
        Route::post('create', 'store')->name('store');
        Route::get('edit/{task}', 'edit')->name('edit');
        Route::patch('edit/{task}', 'update')->name('update');
        Route::get('delete/{task}', 'destroy')->name('destroy');
        Route::get('complete/{task}', 'complete')->name('complete');
    });

Route::resource('tags', TagController::class)
    ->middleware('auth')
    ->except('show');

Route::middleware('auth')
    ->prefix('profile')
    ->name('profile.')
    ->controller(ProfileController::class)
    ->group(function () {
        Route::get('', 'edit')->name('edit');
        Route::patch('', 'update')->name('update');
        Route::delete('', 'destroy')->name('destroy');
    });

Route::fallback(function () {
    abort(404);
});

require __DIR__.'/auth.php';
