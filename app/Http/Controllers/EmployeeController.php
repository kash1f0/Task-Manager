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
        auth()->guard('employee')->attempt([
            'email' => $request->email,
            'password' => $request->password,
        ]);
        $request->session()->regenerate();
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
            return redirect()->route('employee.findTasks');
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


    public function appliedList()
    {
        $employee_id = auth()->guard('employee')->id();
        $employee = Employee::findOrFail($employee_id);
        $tasks = $employee->tasks()->wherePivot('status', EmployeeStatus::PENDING)->get();
        // dd($tasks);

        return Inertia::render('Employee/AppliedTasks', [
            'tasks' => $tasks,
        ]);
    }

    public function taskCancel($id){
        $task = Task::findOrFail($id);
        $employee_id = auth()->guard('employee')->id();
        
        $task->employees()->detach($employee_id);

        return redirect()->route('employee.appliedList');
    }


    public function currentList()
    {
        $employee_id = auth()->guard('employee')->id();
        $tasks = Task::where('status', TaskStatus::PENDING)->where('employee_id', $employee_id)->get();

        return Inertia::render('Employee/CurrentTasks', [
            'tasks' => $tasks,
        ]);
    }


    public function taskComplete($id)
    {
        $task = Task::findOrFail($id);
        $employee_id = auth()->guard('employee')->id();
        $task->status = TaskStatus::COMPLETED;
        $task->save();

        return redirect()->route('employee.currentList');
    }

    public function completedTasks(){
        $employee_id = auth()->guard('employee')->id();
        $tasks = Task::where('status', TaskStatus::COMPLETED)->where('employee_id', $employee_id)->get();

        return Inertia::render('Employee/CompletedTasks', [
            'tasks' => $tasks,
        ]);
    }


    public function profile(){
        $employee = Employee::findOrFail(auth()->guard('employee')->id())->get();

        return Inertia::render('Employee/Edit', [
            'employee' => $employee,
        ]);
    }


    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        return Inertia::render('Employee/Edit', [
            'employee' => $employee,
        ]);
    }

    public function submitEdit(Request $request)
    {
        $id = auth()->guard('employee')->id();
        $request->validate([
            'name' => 'string|max:255|nullable',
            'email' => 'email|max:255|unique:employees|nullable',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,pdf,svg|max:2048|nullable',
            'aboutEmployee' => 'string|max:500|nullable',
        ]);

        $employee = Employee::findOrFail($id)->first();
        $employee->update([
            'name' => $request->name ?? $employee->name,
            'email' => $request->email ?? $employee->email,
            'aboutEmployee' => $request->aboutEmployee ?? $employee->aboutEmployee,
            'photo' => $employee->photo,
        ]);

        return redirect()->route('employee.profile');
    }


    public function employeeDelete($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();
        return redirect()->route('employee.login');
    }


    public function logout(Request $request)
    {
        auth()->guard('employee')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('employee.login');
    }
    


    

    


}
