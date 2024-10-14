<?php

use App\Enums\PermissionEnum;
use App\Enums\RoleEnum;
use App\Http\Controllers\ClientController;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::resource('users', UserController::class)->middleware('can:'. PermissionEnum::MANAGE_USERS->value);
    Route::resource('clients', ClientController::class);
    Route::resource('projects', ProjectController ::class);
    Route::resource('tasks', TaskController ::class);


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
