<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

        Employee::create([
            'name' => $request->name,
            'email' => $request->email,
            'photo' => $request->file('photo')->store('photos', 'public'),
            'password' => bcrypt($request->password),
        ]);

        return Inertia::render('Employee/Dashboard');
    }
}
