<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PriorityController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\DashboardController;

Route::get('/', function(){ 
    return redirect()->route('tasks.index'); 
})->middleware('auth.check');

Route::get('/', function(){ return redirect()->route('tasks.index'); });

// Auth
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

// Protected routes
Route::middleware(['auth.check'])->group(function () {
    Route::resource('tasks', TaskController::class);
    Route::resource('categories', CategoryController::class)->except(['show']);
    Route::resource('priorities', PriorityController::class)->except(['show']);
    Route::resource('statuses', StatusController::class)->except(['show']);
    
});
