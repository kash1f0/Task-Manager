<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Task;
use App\Enums\TaskStatus;

class TaskController extends Controller {
    public function taskCreation(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'due_date' => 'required|date|after:today',
        ]);

        Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'status' => TaskStatus::OPEN, // Assuming a default status for new tasks
            'employer_id' => auth()->guard('employer')->id(), // Assuming the employer is authenticated
        ]);
        return Inertia::render('Employer/Task');

    }

    public function taskDelete($id){
        Task::findOrFail($id)->delete();
        return redirect()->route('employer.taskList');
    }

    public function editSubmit(Request $request, $id)
    {
        $request->validate([
            'title' => 'string|max:255|nullable',
            'description' => 'string|max:1000|nullable',
            'due_date' => 'date|after:today|nullable',
        ]);

        $task = Task::findOrFail($id);
        $task->update([
            'title' => $request->title ?? $task->title,
            'description' => $request->description ?? $task->description,
            'due_date' => $request->due_date ?? $task->due_date,
        ]);

        return redirect()->route('employer.taskList');
    }
}