<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeFormRequest;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::orderBy('full_name')->paginate(10);

        $data = [
            'employees' => $employees
        ];

        return view('employees.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$departments = Employee::select('department')->distinct()->get();

        $data = [
            'departments' => $departments
        ];

        return view('employees.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request\EmployeeFormRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeFormRequest $request)
    {
        $full_name = $request->input('full_name');
        $birthdate = $request->input('birthdate');
        $age = Carbon::parse($birthdate)->diff(Carbon::now())->y;
        $department = $request->input('department');

        Employee::create([
            'full_name' => $full_name,
            'age' => $age,
            'birthdate' => $birthdate,
            'department' => $department
        ]);

        return redirect('/employees')->with('success', 'Successfully Added New Employee!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
		$departments = Employee::select('department')->distinct()->get();

        $data = [
            'employee' => $employee,
            'departments' => $departments
        ];

        return view('employees.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request\EmployeeFormRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeeFormRequest $request, $id)
    {
        $employee = Employee::find($id);

        $full_name = $request->input('full_name');
        $birthdate = $request->input('birthdate');
        $age = Carbon::parse($birthdate)->diff(Carbon::now())->y;
        $department = $request->input('department');

        $employee->update([
            'full_name' => $full_name,
            'birthdate' => $birthdate,
            'age' => $age,
            'department' => $department
        ]);

        return redirect('/')->with('success', 'Succeessfully Update the Employee Details!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::find($id);
        $employee->delete();

        return redirect('/employees')->with('success', 'Successfully Deleted the Employee!');
    }
}
