<?php

namespace App\Http\Controllers;

use App\Models\ClassRoom;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::with(['user', 'classRoom'])->get();

        return view('students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::where('role', 'student')->get();
        $classRooms = ClassRoom::all();

        return view('students.create', compact('users', 'classRooms'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id|unique:students,user_id',
            'class_id' => 'required|exists:class_rooms,id',
            'student_code' => 'nullable|string|max:50|unique:students,student_code',
            'phone' => 'nullable|string|max:20',
        ]);

        Student::create($validated);

        return redirect()->route('students.index')
            ->with('success', 'Student created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        $student->load(['user', 'classRoom']);

        return view('students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        $users = User::where('role', 'student')->get();
        $classRooms = ClassRoom::all();

        return view('students.edit', compact('student', 'users', 'classRooms'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id|unique:students,user_id,' . $student->id,
            'class_id' => 'required|exists:class_rooms,id',
            'student_code' => 'nullable|string|max:50|unique:students,student_code,' . $student->id,
            'phone' => 'nullable|string|max:20',
        ]);

        $student->update($validated);

        return redirect()->route('students.index')
            ->with('success', 'Student updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->route('students.index')
            ->with('success', 'Student deleted successfully.');
    }
}
