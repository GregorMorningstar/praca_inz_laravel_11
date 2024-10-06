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
    //akcje z samochodami
    Route::get('car/add',[AdminController::class, 'AdminAddCar'])->name('car/add');
    Route::post('car/add', [AdminController::class, 'CarStore'])->name('car/addStore');  // Zapisuje dane z formularza
    Route::get('car/list',[AdminController::class, 'AdminListCar'])->name('car/list');
    Route::get('car/add-driver-to-car',[AdminController::class, 'AdminAddCarToDriver'])->name('car/add-driver');
    Route::get('/assign-car/{id}', [AdminController::class, 'carAssing'])->name('car.assign');
    Route::post('/assign-car/{id}', [AdminController::class, 'storeCar'])->name('car.store');
    Route::post('/remove-car/{id}', [AdminController::class, 'carRemove'])->name('car.remove');


    //akcje z spedytorami
    Route::get('dispatcher/list',[AdminController::class,'dispatcher_list'])->name('dispatcher/list');
    //akcje z kierowcami
    Route::get('driver/list',[AdminController::class,'driver_list'])->name('driver/list');
    //akcje z userami
    Route::get('user/list',[AdminController::class,'user_list'])->name('users/list');
    Route::delete('/user/{id}', [AdminController::class, 'destroyUser'])->name('user.destroy');
    Route::patch('/admin/user/{id}/role', [AdminController::class, 'updateRole'])->name('admin.update_role');

    //pozostale
    Route::get('role/edit',[AdminController::class,'role_edit'])->name('role/edit');
});

Route::middleware(['auth', 'role:dispatcher'])->group(function () {
    Route::get('spedytor/dashboard', [DispatcherController::class, 'DispatcherDashboard'])->name('dispatcher/dashboard');
});

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('user/dashboard', [UserController::class, 'UserDashboard'])->name('user/dashboard');
    Route::get('user/logout',[UserController::class, 'UserLogOut'])->name('user.logout');
    Route::get('user/create/order',[UserController::class, 'CreateNewOrder'])->name('user/create/order');
    Route::post('user/create/order', [UserController::class, 'AddNewOrder'])->name('orders.store');
    Route::get('user/all/order',[UserController::class,'AllOrder'])->name('user/all/order');
    Route::get('user/my-order',[UserController::class,'My_order'])->name('user/my-order');
    Route::get('/user/order/completed', [UserController::class, 'completedOrders'])->name('user.order.completed');
    Route::get('/user/order/in_progress', [UserController::class, 'in_progresOrders'])->name('user/order/in_progress');


});


Route::middleware(['auth', 'role:driver'])->group(function () {
    Route::get('driver/dashboard', [DriverController::class, 'DriverDashboard'])->name('driver/dashboard');
});

Route::get('admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login');

