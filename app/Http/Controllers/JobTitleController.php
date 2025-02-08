<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\JobTitle;
use Illuminate\Http\Request;

class JobTitleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $department = Department::all();
        return view('content.master.jobtitle',compact('department'));
    }
    
    public function getData(Request $request)
    {
        // Mengambil semua data limbah
        $jobttitles = JobTitle::with('department')->get();
        return response()->json($jobttitles); // Kembalikan data dalam format JSON
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
        // dd($request);
        $request->validate([
            'repeater-group.*.name' => 'required|string|max:255',
            'repeater-group.*.departmentid' => 'required|integer|exists:departments,id', // Tambahkan validasi
        ]);

        // Simpan setiap item dari repeater
        foreach ($request->input('repeater-group') as $item) {
            JobTitle::create([
                'JobTitleName' => $item['name'],
                'DepartmentID'=>$item['departmentid']
            ]);
        }

        // Redirect atau response setelah penyimpanan sukses
        return redirect()->back()->with('success', 'Job Title data successfully saved.');
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
        $jobtitle = JobTitle::with('department')->findOrFail($id);
        return response()->json($jobtitle);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'departmentid' => 'required|exists:departments,id'
        ]);

        $jobtitles = JobTitle::findOrFail($id);
        $jobtitles->JobTitleName = $request->name;
        $jobtitles->DepartmentID = $request->departmentid;
        $jobtitles->save();

        return redirect()->route('master.jobtitle.index')->with('success', 'Job Title updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $jobtitles = JobTitle::findOrFail($id);
            $jobtitles->delete();

            return response()->json(['success' => 'Job Title deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete Job Title.'], 500);
        }
    }
}
