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
        // dd($employees);
        foreach ($employees as $employee) {
            $employee->task_id = $task->id; // Assuming you want to set the task_id for each employee
        }
        // $employee->task_id = $id;

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


    public function taskEdit($id)
    {
        $task = Task::findOrFail($id);
        return Inertia::render('Employer/TaskEdit', [
            'task' => $task,
        ]);
    }


    public function completedTasks()
    {
        $employer = Employer::findOrFail(auth()->guard('employer')->id())->load('tasks');
        // dd($employer);
        $tasks = $employer->tasks()
            ->where('status', TaskStatus::COMPLETED)
            ->get();
        
        // return Inertia::render(
        //     'Employer/Dashboard'
        // );
        return Inertia::render('Employer/CompletedTasks', [
            'tasks' => $tasks,
        ]);
    }

    public function currentTasks(){
        $employer = Employer::findOrFail(auth()->guard('employer')->id())->load('tasks');
        $tasks = $employer->tasks()
            ->where('status', TaskStatus::PENDING)
            ->get();
        
        foreach ($tasks as $task) {
            $task->email = Employee::findOrFail($task->employee_id)->value('email'); // Assuming you want to load the employee for each task
        }
        // dd($tasks);
        return Inertia::render('Employer/CurrentTasks', [
            'tasks' => $tasks,
        ]);
    }


    public function profile()
    {
        $employer = Employer::findOrFail(auth()->guard('employer')->id())->get();
        // dd($employer);
        return Inertia::render('Employer/Profile', [
            'employer' => $employer,
        ]);
    }


    public function edit($id)
    {
        $employer = Employer::findOrFail($id);
        return Inertia::render('Employer/Edit', [
            'employer' => $employer,
        ]);
    }

    public function submitEdit(Request $request)
    {
        $id = auth()->guard('employer')->id();
        $request->validate([
            'name' => 'string|max:255|nullable',
            'email' => 'email|max:255|unique:employees|nullable',
        ]);

        $employer = Employer::findOrFail($id)->first();
        $employer->update([
            'name' => $request->name ?? $employer->name,
            'email' => $request->email ?? $employer->email,
        ]);

        return redirect()->route('employer.profile');
    }


    public function employerDelete($id)
    {
        $employer = Employer::findOrFail($id);
        $employer->delete();

        return redirect()->route('employer.dashboard');
    }

    public function logout(Request $request)
    {
        auth()->guard('employer')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('employer.login');
    }





}
