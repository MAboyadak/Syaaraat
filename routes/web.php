<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\TaskController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Login
Route::get('/', [LoginController::class, 'getLoginForm']);
Route::get('/login', [LoginController::class, 'getLoginForm'])->name('login.show');
Route::post('/login', [LoginController::class, 'login'])->name('login');

//employees
Route::middleware(['auth','manager'])->as('employees.')->group(function () {
    Route::get('/employees', [EmployeeController::class, 'index'])->name('index');
    Route::post('/employee', [EmployeeController::class, 'store'])->name('store');
    Route::put('/employee/{employee}', [EmployeeController::class, 'update'])->name('update');
    Route::delete('/employee/{employee}', [EmployeeController::class, 'destroy'])->name('destroy');
    Route::post('/employee/search', [EmployeeController::class, 'search'])->name('search');

});

// departments
Route::middleware(['auth','manager'])->as('departments.')->group(function () {
    Route::get('/departments', [DepartmentController::class, 'index'])->name('index');
    Route::post('/department', [DepartmentController::class, 'store'])->name('store');
    Route::put('/department/{department}', [DepartmentController::class, 'update'])->name('update');
    Route::delete('/department/{department}', [DepartmentController::class, 'destroy'])->name('destroy');
    Route::post('/department/search', [DepartmentController::class, 'search'])->name('search');
});

// Tasks
Route::middleware(['auth'])->as('tasks.')->group(function () {
    Route::get('/tasks', [TaskController::class, 'index'])->name('index');
    Route::post('/task', [TaskController::class, 'store'])->name('store');
    Route::put('/task/{task}', [TaskController::class, 'update'])->name('update');
    Route::delete('/task/{task}', [TaskController::class, 'destroy'])->name('destroy');
    Route::post('/task/search', [TaskController::class, 'search'])->name('search');
});

