<?php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DispatcherController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
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
});

require __DIR__.'/auth.php';

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin/dashboard');
    Route::get('admin/logout',[AdminController::class, 'AdminLogOut'])->name('admin.logout');
});

Route::middleware(['auth', 'role:dispatcher'])->group(function () {
    Route::get('spedytor/dashboard', [DispatcherController::class, 'DispatcherDashboard'])->name('dispatcher/dashboard');
});

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('user/dashboard', [UserController::class, 'UserDashboard'])->name('user/dashboard');
});


Route::middleware(['auth', 'role:driver'])->group(function () {
    Route::get('driver/dashboard', [DriverController::class, 'DriverDashboard'])->name('driver/dashboard');
});
