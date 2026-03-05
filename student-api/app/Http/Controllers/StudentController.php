<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Requests\StoreStudentRequest;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Student::all());
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
    public function store(StoreStudentRequest $request)
    {
        // $validated = $request->validate([
        //     'name' => 'required|string',
        //     'email' => 'required|string|email|unique:students',
        //     'course' => 'required|string',
        // ]);

        $student = Student::create($request->validated());

        return response()->json($student, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        return response()->json($student);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
         $validated = $request->validate([
            'name' => 'sometimes|required|string',
            'email' => 'sometimes|required|string|email|unique:students,email,' . $student->id,
            'course' => 'sometimes|required|string',
        ]);

        $student->update($validated);

        return response()->json($student, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        $student->delete();

        return response()->json(null, 204);
    }
}
