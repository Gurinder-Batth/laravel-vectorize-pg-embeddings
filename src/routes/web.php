<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/dating-search');


Route::get('/dating-form', [UserController::class, 'create'])->name('dating.form');
Route::post('/dating-form', [UserController::class, 'store'])->name('dating.store');
Route::get('/dating-search', [UserController::class, 'search'])->name('dating.search');
