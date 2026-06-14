<?php

namespace App\Http\Controllers;

use App\Models\ClassRoom;
use App\Models\Schedule;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $schedules = Schedule::with(['classRoom', 'subject', 'teacher.user'])->get();

        return view('schedules.index', compact('schedules'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $classRooms = ClassRoom::all();
        $subjects = Subject::all();
        $teachers = Teacher::with('user')->get();

        return view('schedules.create', compact('classRooms', 'subjects', 'teachers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'class_id' => 'required|exists:class_rooms,id',
            'subject_id' => 'required|exists:subjects,id',
            'teacher_id' => 'required|exists:teachers,id',
            'day' => 'nullable|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday',
            'start_time' => 'nullable',
            'end_time' => 'nullable',
        ]);

        Schedule::create($validated);

        return redirect()->route('schedules.index')
            ->with('success', 'Schedule created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Schedule $schedule)
    {
        $schedule->load(['classRoom', 'subject', 'teacher.user']);

        return view('schedules.show', compact('schedule'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Schedule $schedule)
    {
        $classRooms = ClassRoom::all();
        $subjects = Subject::all();
        $teachers = Teacher::with('user')->get();

        return view('schedules.edit', compact('schedule', 'classRooms', 'subjects', 'teachers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Schedule $schedule)
    {
        $validated = $request->validate([
            'class_id' => 'required|exists:class_rooms,id',
            'subject_id' => 'required|exists:subjects,id',
            'teacher_id' => 'required|exists:teachers,id',
            'day' => 'nullable|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday',
            'start_time' => 'nullable',
            'end_time' => 'nullable',
        ]);

        $schedule->update($validated);

        return redirect()->route('schedules.index')
            ->with('success', 'Schedule updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Schedule $schedule)
    {
        $schedule->delete();

        return redirect()->route('schedules.index')
            ->with('success', 'Schedule deleted successfully.');
    }
}
