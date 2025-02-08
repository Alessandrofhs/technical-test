<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use App\Models\JobTitle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $department = Department::all();
    $jobtitle = JobTitle::all();

    $employee = Employee::with(['jobtitle.department'])
    ->get();

    return view('content.employee', compact('department', 'jobtitle', 'employee'));
}

    
    public function getReportData($id)
    {
        $employees = Employee::with(['jobtitle.department'])
        ->get();

        return response()->json($employees);
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
            'repeater-group.*.nik' => 'required|string|max:6',
            'repeater-group.*.firstname' => 'required|string|max:255',
            'repeater-group.*.lastname' => 'nullable|string|max:255',
            'repeater-group.*.jobtitleid' => 'required|integer|exists:jobtitles,id',
            'repeater-group.*.gender' => 'required|in:M,L',
            'repeater-group.*.placeofbirth' => 'required|string|max:255',
            'repeater-group.*.dateofbirth' => 'required|date',
            'repeater-group.*.hiredate' => 'required|date',
            'repeater-group.*.phone' => 'required|string|max:20',
            'repeater-group.*.email' => 'required|email',
            'repeater-group.*.address' => 'required|string|max:500',
        ]);

        foreach ($request->input('repeater-group') as $item) {
            Employee::create([
                'NIK' => $item['nik'],
                'FirstName' => $item['firstname'],
                'LastName' => $item['lastname'],
                'JobTitleID' => $item['jobtitleid'],
                'Gender' => $item['gender'],
                'PlaceOfBirth' => $item['placeofbirth'],
                'DateOfBirth' => $item['dateofbirth'],
                'HireDate' => $item['hiredate'],
                'Phone' => $item['phone'],
                'Email' => $item['email'],
                'Address' => $item['address'],
            ]);
        }

        return redirect()->back()->with('success', 'Employee data successfully saved.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $employee = Employee::with(['jobtitle.department'])->find($id);
        return response()->json($employee);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $employee = Employee::with(['jobtitle.department'])->findOrFail($id);

        return response()->json($employee);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // dd($request);
        $request->validate([
            'nik' => 'required|string|max:6',
            'firstname' => 'required|string|max:255',
            'lastname' => 'nullable|string|max:255',
            'jobtitleid' => 'required|integer|exists:jobtitles,id',
            'gender' => 'required|in:M,F',
            'placeofbirth' => 'required|string|max:255',
            'dateofbirth' => 'required|date',
            'hiredate' => 'required|date',
            'phone' => 'required|string|max:20',
            'email' => 'required|email',
            'address' => 'required|string|max:500',
        ]);

        $employee = Employee::findOrFail($id);
        $employee->NIK = $request->nik;
        $employee->FirstName = $request->firstname;
        $employee->LastName = $request->lastname;
        $employee->JobTitleID = $request->jobtitleid;
        $employee->Gender = $request->gender;
        $employee->PlaceOfBirth = $request->placeofbirth;
        $employee->DateOfBirth = $request->dateofbirth;
        $employee->HireDate = $request->hiredate;
        $employee->Phone = $request->phone;
        $employee->Email = $request->email;
        $employee->Address = $request->address;
        $employee->save();

        return redirect()->route('employee.index')->with('success', 'Employee updated successfully!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        try {
            DB::beginTransaction();

            $employee->delete();

            DB::commit();
            return redirect()->back()->with('success', 'Employee deleted successfully');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to delete employee!');
        }
    }
}
