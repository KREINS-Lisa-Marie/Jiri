<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\JiriController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('jiris', [JiriController::class, 'index'])->name('jiris.index');
Route::get('jiris/{jiri}', [JiriController::class, 'show'])->name('jiris.show');
Route::post('jiris', [JiriController::class, 'store']);

Route::get('contacts', [ContactController::class, 'index'])->name('contacts.index');
Route::get('contacts/{contact}', [ContactController::class, 'show'])->name('contacts.show');
Route::post('contacts', [ContactController::class, 'store']);


Route::get('projects', [ProjectController::class, 'index'])->name('projects.index');
Route::post('projects', [ProjectController::class, 'store']);
