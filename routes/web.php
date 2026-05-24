<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NotesController;

Route::middleware('auth')->group(function () {
    Route::get('/notes', [NotesController::class, 'index'])->name('notes.index');
    Route::get('/notes/create', [NotesController::class, 'create'])->name('notes.create');
    Route::post('/notes', [NotesController::class, 'store'])->name('notes.store');
    Route::get('/notes/{id}/edit', [NotesController::class, 'edit'])->name('notes.edit');
    Route::post('/notes/{id}', [NotesController::class, 'update'])->name('notes.update');
    Route::post('/notes/{id}/delete', [NotesController::class, 'destroy'])->name('notes.destroy');
    Route::post('/notes/{id}/toggle-pin', [NotesController::class, 'togglePin'])->name('notes.toggle-pin');
});
