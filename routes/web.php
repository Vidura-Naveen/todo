<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TodoCrudController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/todolist', [TodoCrudController::class, 'index'])->name('todolistindex');
    Route::get('/todolistadd', [TodoCrudController::class, 'create'])->name('todolistadd');
    Route::post('/todolist/save/', [TodoCrudController::class, 'save'])->name('todolistsave');
    Route::post('/todolist/store/', [TodoCrudController::class, 'store'])->name('todoliststore');
    Route::get('/todolist/delete/{id}', [TodoCrudController::class, 'destroy'])->name('todolistdelete');
    Route::get('/todolist/edit/{id}', [TodoCrudController::class, 'update'])->name('todolistedit');
});

require __DIR__.'/auth.php';
