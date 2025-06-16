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

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';


Route::get('/employee/create', function () {
    return Inertia::render('Employee/Create');
})->name('employee.create');

Route::post('/employee/create/submit', [EmployeeController::class, 'create'])
    ->name('employee.create.submit');

Route::get('/employee/login', function () {
    return Inertia::render('Employee/Login');
})->name('employee.login');


Route::post('/employee/login/submit', [EmployeeController::class, 'login'])
    ->name('employee.login.submit');


Route::middleware(['auth:employee'])->group(function () {



    Route::get('/employee/dashboard', function () {
        return Inertia::render('Employee/Dashboard');
    })->name('employee.dashboard');



    Route::get('/employee/findTasks', [EmployeeController::class, 'findTasks'])->name('employee.findTasks');



    Route::post('/employee/task-apply', [EmployeeController::class, 'taskApply'])->name('employee.taskApply');



    Route::get('/employee/appliedList', [EmployeeController::class, 'appliedList'])
        ->name('employee.appliedList');

    Route::get('/employee/taskCancel/{id}', [EmployeeController::class, 'taskCancel'])
        ->name('employee.taskCancel');


    Route::get('/employee/currentList', [EmployeeController::class, 'currentList'])->name('employee.currentList');

    Route::get('/employee/taskComplete/{id}', [EmployeeController::class, 'taskComplete'])->name('employee.taskComplete');

    Route::get('/employee/completedTasks', [EmployeeController::class, 'completedTasks'])
        ->name('employee.completedTasks');


    Route::delete('/employee/delete/{id}', [EmployeeController::class, 'employeeDelete'])
        ->name('employee.delete');

    Route::get('/employee/logout', [EmployeeController::class, 'logout'])
        ->name('employee.logout');

    
    Route::get('/employee/profile', [EmployeeController::class, 'profile'])->name('employee.profile');

});

///////////////////Employer Routes////////////////////


Route::get('/employer/create', function () {
    return Inertia::render('Employer/Create');
})->name('employer.create');

Route::get('/employer/login', function () {
    return Inertia::render('Employer/Login');
})->name('employer.login');


Route::post('/employer/create/submit', [EmployerController::class, 'create'])
    ->name('employer.create.submit');


Route::post('/employer/login/submit', [EmployerController::class, 'login'])
    ->name('employer.login.submit');


Route::middleware(['auth:employer'])->group(function () {


    Route::get('/employer/edit/{id}', [EmployerController::class, 'edit'])->name('employer.edit');

    Route::post('/employer/edit/submit', [EmployerController::class, 'submitEdit'])->name('employer.editSubmit');

    Route::get('/employee/edit/{id}', [EmployeeController::class, 'edit'])
        ->name('employee.edit');

    Route::post('/employee/edit/submit', [EmployeeController::class, 'submitEdit'])
        ->name('employee.submitEdit');

    Route::get('/employer/task/create', function () {
        return Inertia::render('Employer/Task');
    })->name('employer.task.create');


    Route::post('/employer/task/submit', [TaskController::class, 'taskCreation'])
        ->name('employer.taskSubmit');



    Route::get('/employer/task/list', [EmployerController::class, 'taskList'])
        ->name('employer.taskList');

    Route::get('/employer/profile', [EmployerController::class, 'profile'])->name('employer.profile');


    Route::get('/employer/task/appliedList', [EmployerController::class, 'appliedList'])
        ->name('employer.appliedList');



    Route::get('/employer/task/edit/{id}', [EmployerController::class, 'taskEdit'])->name('employer.taskEdit');



    Route::get('/employer/employeeList/{id}', [EmployerController::class, 'appliedList'])
        ->name('employer.employeeList');

    Route::get('/employer/employeeSelect/{employee_id}/{task_id}', [EmployerController::class, 'employeeSelect'])
        ->name('employer.taskSelect');

    Route::delete('/task/delete/{id}', [TaskController::class, 'taskDelete'])
        ->name('task.delete');

    Route::post('/task/edit/submit/{id}', [TaskController::class, 'editSubmit'])
        ->name('taskEdit.submit');


    Route::get('/employer/completedTasks', [EmployerController::class, 'completedTasks'])->name('employer.completedTasks');


    Route::get('/employer/currentTasks', [EmployerController::class, 'currentTasks'])
        ->name('employer.currentTasks');

    Route::get('/employee/profile', [EmployeeController::class, 'profile'])
        ->name('employee.profile');


    Route::delete('/employer/delete/{id}', [EmployerController::class, 'employerDelete'])
        ->name('employer.delete');

    Route::get('/employer/logout', [EmployerController::class, 'logout'])
        ->name('employer.logout');

});
