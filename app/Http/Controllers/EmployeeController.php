<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
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

    


}
