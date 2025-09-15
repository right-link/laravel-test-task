<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActorSubmissionController;


Route::get('/', [ActorSubmissionController::class, 'create'])->name('actors.create');
Route::post('/actors', [ActorSubmissionController::class, 'store'])->name('actors.store');
Route::get('/actors', [ActorSubmissionController::class, 'index'])->name('actors.index');
