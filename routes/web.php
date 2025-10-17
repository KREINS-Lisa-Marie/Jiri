<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\JiriController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

//echo storage_path();

Route::get('/', function () {
    return view('welcome');
});

/*Route::get('jiris', [JiriController::class, 'index'])->name('jiris.index');
Route::get('jiris/{jiri}', [JiriController::class, 'show'])->name('jiris.show');
Route::post('jiris', [JiriController::class, 'store']);
Route::get('jiris/create', [JiriController::class, 'create'])->name('jiris.create');*/

// Route::get('jiris/{jiri}', [JiriController::class, 'show'])->name('jiris.show');

//Route::resource('jiris', JiriController::class)->middleware('auth');
Route::get('jiris/', [JiriController::class, 'index'])->name('jiris.index')->middleware([
    'auth',
]);
Route::get('jiris/create', [JiriController::class, 'create'])->name('jiris.create')->middleware([
    'auth',
]);


Route::get('jiris/{jiri}/edit', [JiriController::class, 'edit'])->name('jiris.edit')->middleware([
    'auth',
    'can:update,jiri'
]);

Route::patch('jiris/{jiri}', [JiriController::class, 'update'])->name('jiris.update')->middleware([
    'auth',
    'can:update,jiri'
]);

Route::get('jiris/{jiri}', [JiriController::class, 'show'])->name('jiris.show')->middleware([
    'auth',
    'can:update,jiri'
]);

Route::post('jiris', [JiriController::class, 'store'])->name('jiris.store')->middleware([
    'auth',
    //'can:store,jiri',
    //'can:update,jiri',
]);








Route::get('contacts/', [ContactController::class, 'index'])->name('contacts.index')->middleware([
    'auth',
]);

Route::get('contacts/create', [ContactController::class, 'create'])->name('contacts.create')->middleware([
    'auth',
]);


Route::get('contacts/{contact}/edit', [ContactController::class, 'edit'])->name('contacts.edit')->middleware([
    'auth',
    'can:update,contact'
]);

Route::get('contacts/{contact}', [ContactController::class, 'show'])
    ->name('contacts.show')
    ->middleware([
        'auth',
        'can:view,contact'
    ]);

Route::patch('contacts/{contact}', [ContactController::class, 'update'])->name('contacts.update')->middleware([
    'auth',
    'can:update,contact'
]);
Route::post('contacts/', [ContactController::class, 'store'])->name('contacts.store')->middleware([
    'auth',
    //'can:store,contact'
]);




Route::get('projects/', [ProjectController::class, 'index'])->name('projects.index')->middleware([
    'auth',
]);

Route::get('projects/create', [ProjectController::class, 'create'])->name('projects.create')->middleware([
    'auth',
]);
Route::resource('projects', ProjectController::class);

/*
Route::get('contacts', [ContactController::class, 'index'])->name('contacts.index');
Route::get('contacts/{contact}', [ContactController::class, 'show'])->name('contacts.show');
Route::post('contacts', [ContactController::class, 'store']);

Route::get('projects', [ProjectController::class, 'index'])->name('projects.index');
Route::get('projects/{project}', [ProjectController::class, 'show'])->name('projects.show');
Route::post('projects', [ProjectController::class, 'store']);*/
