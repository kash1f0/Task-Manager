<?php

namespace App\Http\Controllers;

use App\Enums\TaskStatus;
use App\Enums\EmployeeStatus;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Task;
use Inertia\Inertia;


class EmployeeController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:employees,email',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,pdf,svg|max:2048',
            'aboutEmployee' => 'nullable|string|max:500',
            'password' => 'required|string|min:8|confirmed',
        ]);
        $path = $request->file('photo') ? $request->file('photo')->store('photos', 'public') : null;

        Employee::create([
            'name' => $request->name,
            'email' => $request->email,
            'aboutEmployee' => $request->aboutEmployee,
            'photo' => $path,
            'password' => bcrypt($request->password),
        ]);

        return Inertia::render('Employee/Dashboard');
    }

        public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);

        if (auth()->guard('employee')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('employee.dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }


    public function findTasks(Request $request)
    {
        $tasks = Task::where('status', TaskStatus::OPEN)->with('employees')->get();

        $tasks_new = array();

        foreach($tasks as $task) {
            if(!$task->employees()->where('employee_id', auth()->guard('employee')->id())->exists()) {
                array_push($tasks_new, $task);
            }
        }

        $tasks = Task::where('status', TaskStatus::OPEN)->get();

        foreach($tasks_new as $task) {
            $task->href = route('employee.taskApply');
        }
        return Inertia::render('Employee/FindTasks', ['tasks' => $tasks_new]);
    }


    public function taskApply(Request $request)
    {
        // Validate the request data
        $request->validate([
            'task_id' => 'required|exists:tasks,id',
        ]);
        
        $taskId = $request->all();
        $task_id = $taskId['task_id'];
        $task = Task::findOrFail($task_id);
        $employee = auth()->guard('employee')->user();

        if ($task->status !== TaskStatus::OPEN) {
            return back()->withErrors(['error' => 'This task is not available for application.']);
        }



        $task->employees()->attach($employee->id);
        $task->employees()->updateExistingPivot($employee->id, ['status' => EmployeeStatus::PENDING]);
        $task->save();

        return redirect()->route('employee.findTasks');
    }


    

    


}
