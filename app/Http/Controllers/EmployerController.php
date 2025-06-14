<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Task;
use App\Models\Employee;
use App\Enums\TaskStatus;

class EmployerController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:employees,email',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,pdf,svg|max:2048',
            'password' => 'required|string|min:8|confirmed',
        ]);

        Employer::create([
            'name' => $request->name,
            'email' => $request->email,
            'photo' => $request->file('photo')->store('photos', 'public'),
            'password' => bcrypt($request->password),
        ]);

        return Inertia::render('Employer/Task');
    }


    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);

        if (auth()->guard('employer')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('employer.task.create');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }


    public function taskList()
    {
        $tasks = Task::where('employer_id', '=', auth()->guard('employer')->id())->where('status', '=', TaskStatus::OPEN)
            ->get();
        return Inertia::render('Employer/TaskList', [
            'tasks' => $tasks,
        ]);
    }


    public function appliedList($id)
    {
        $task = Task::findOrFail($id);
        $employees = $task->employees;
        foreach ($employees as $employee) {
            $employee_id = $employee->employee_id;
            $employee_email = Employee::findOrFail($id)->pluck('email');
            $employee->employee_id = $employee_id;
            $employee->task_id = $id;
           $employee->employee_email = $employee_email;
        }

        return Inertia::render('Employer/AppliedList', [
            'employees' => $employees,
        ]);
    }


    public function employeeSelect($employee_id, $task_id)
    {
        $task = Task::findOrFail($task_id);
        $task->employees()->detach($employee_id);
        $task->status = TaskStatus::PENDING;
        $task->employee_id = $employee_id; 
        $task->save();

        return Inertia::render('Employer/Task');
    }





}
