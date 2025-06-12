<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\TaskController;

Route::get('/', function () {
    return Inertia::render('welcome');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('dashboard');
    })->name('dashboard');
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';


Route::get('/employee/create', function () {
    return Inertia::render('Employee/Create');
})->name('employee.create');

Route::post('/employee/create/submit', [EmployeeController::class, 'create'])
    ->name('employee.create.submit');

Route::get('/employee/dashboard', function () {
    return Inertia::render('Employee/Dashboard');
})->name('employee.dashboard');

Route::get('/employee/findTasks', [EmployeeController::class, 'findTasks'])->name('employee.findTasks');

Route::get('/employer/create', function () {
    return Inertia::render('Employer/Create');
})->name('employer.create');


Route::get('/employee/login', function () {
    return Inertia::render('Employee/Login');
})->name('employee.login');


Route::post('/employee/login/submit', [EmployeeController::class, 'login'])
    ->name('employee.login.submit');


Route::get('/employer/login', function () {
    return Inertia::render('Employer/Login');
})->name('employer.login');


Route::post('/employer/create/submit', [EmployerController::class, 'create'])
    ->name('employer.create.submit');


Route::post('/employer/login/submit', [EmployerController::class, 'login'])
    ->name('employer.login.submit');


Route::get('/employer/task/create', function () {
    return Inertia::render('Employer/Task');
})->name('employer.task.create');


Route::post('/employer/task/submit', [TaskController::class, 'taskCreation'])
    ->name('task.submit');