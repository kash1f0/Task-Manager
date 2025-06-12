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





}
