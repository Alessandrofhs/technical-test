<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('content.master.department');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function getData(Request $request)
    {
        // Mengambil semua data limbah
        $departments = Department::all();
        return response()->json($departments); // Kembalikan data dalam format JSON
    }
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'repeater-group.*.name' => 'required|string|max:255',
        ]);

        // Simpan setiap item dari repeater
        foreach ($request->input('repeater-group') as $item) {
            Department::create([
                'DepartmentName' => $item['name'],
                'Abbreviation'=>$item['abbreviation']
            ]);
        }

        // Redirect atau response setelah penyimpanan sukses
        return redirect()->back()->with('success', 'Department data successfully saved.');
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
    public function edit($id)
    {
        $department = Department::findOrFail($id);
        return response()->json($department);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'DepartmentName' => 'required|string|max:255',
            'Abbreviation' => 'required|string|max:10',
        ]);

        $department = Department::findOrFail($id);
        $department->update([
            'DepartmentName' => $request->DepartmentName,
            'Abbreviation' => $request->Abbreviation,
        ]);

        return response()->json([
            'message' => 'Department updated successfully',
            'redirect' => route('master.department.index') // Redirect ke halaman yang diinginkan
        ]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $departments = Department::findOrFail($id);
            $departments->delete();

            return response()->json(['success' => 'Department deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete Department.'], 500);
        }
    }
}
