<?php

use App\Http\Controllers\NotesController;
use App\Http\Controllers\ProfileController;
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
    
    Route::get('/notes', [NotesController::class, 'index'])->name('notes.index');
    Route::get('/notes/create', [NotesController::class, 'create'])->name('notes.create');
    Route::post('/notes', [NotesController::class, 'store'])->name('notes.store');
    Route::get('/notes/{note}/edit', [NotesController::class, 'edit'])->name('notes.edit');
    Route::post('/notes/{note}', [NotesController::class, 'update'])->name('notes.update');
    Route::post('/notes/{note}/delete', [NotesController::class, 'destroy'])->name('notes.destroy');
    Route::post('/notes/{note}/toggle-pin', [NotesController::class, 'togglePin'])->name('notes.toggle-pin');
});

require __DIR__.'/auth.php';
