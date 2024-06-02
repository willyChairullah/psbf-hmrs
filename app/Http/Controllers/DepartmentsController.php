<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDepartmentRequest;
use App\Models\Department;
use App\Models\Log;
use Illuminate\Http\Request;

class DepartmentsController extends Controller
{
    private $departments;

    public function __construct()
    {
        $this->middleware('auth');  
        
        $this->departments = resolve(Department::class);
    }

    public function index()
    {
        $departments = $this->departments->paginate();
        return view('pages.departments-data', compact('departments'));
    }

    public function create()
    {
        return view('pages.departments-data_create');
    }

    public function store(StoreDepartmentRequest $request)
    {
        Department::create($request->validated());

        Log::create([
            'description' => auth()->user()->employee->name . " created an department named '" . $request->input('name') . "'"
        ]);

        return redirect()->route('departments-data')->with('status', 'Successfully created a department.');
    }

    public function show(Department $department)
    {
        return view('pages.departments-data_show', compact('department'));
    }

    public function edit(Department $department)
    {
        return view('pages.departments-data_edit', compact('department'));
    }

    public function update(StoreDepartmentRequest $request, Department $department)
    {
        Department::where('id', $department->id)->update($request->validated());

        Log::create([
            'description' => auth()->user()->employee->name . " updated an department named '" . $department->name . "'"
        ]);

        return redirect()->route('departments-data')->with('status', 'Successfully updated department.');
    }

    public function destroy(Department $department)
    {
        Department::where('id', $department->id)->delete();
        
        Log::create([
            'description' => auth()->user()->employee->name . " deleted an department named '" . $department->name . "'"
        ]);

        return redirect()->route('departments-data')->with('status', 'Successfully deleted department.');
    }

    public function print() {
        $departments = Department::all();
        return view('pages.departments-data_print', compact('departments'));
    }
}
