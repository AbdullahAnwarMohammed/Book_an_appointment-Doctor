<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Employees = Employee::all();
        return view("doctor.employees.index", compact('Employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'phone' => 'unique:employees,phone'
        ]);
        $Employee = Employee::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'show_password' => $request->password,
        ]);

       
        return redirect()->back()->with('Success', 'تم الاضافة بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $Employee = Employee::where('id', $id)->first();

        return view("doctor.employees.edit", compact('Employee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'phone' => 'unique:employees,phone,' . $id,
        ]);

        

        $employeeData = [
            'name' => $request->name,
            'phone' => $request->phone,
        ];

        // Check if password is provided and add it to the update array
        if ($request->filled('password')) {
            $employeeData['password'] = Hash::make($request->password);
        }

        // Update the employee record
        Employee::where('id', $id)->update($employeeData);

        return redirect()->route('doctor.employees.index')->with('Success','تم تعديل البيانات بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Employee::where('id', $id)->delete();
        return redirect()->back()->with('Success', 'تم الحذف بنجاح');
    }
}
