<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Task;

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

        return Inertia::render('Employee/Dashboard');
    }


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
            'employer_id' => auth()->user()->id, // Assuming the employer is authenticated
        ]);
        return Inertia::render('Employer/Dashboard');

    }


}
