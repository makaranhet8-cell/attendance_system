<?php

namespace App\Http\Controllers;

use App\Models\ClassRoom;
use Illuminate\Http\Request;

class ClassRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classRooms = ClassRoom::all();

        return view('class_rooms.index', compact('classRooms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('class_rooms.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'class_name' => 'required|string|max:100',
            'description' => 'nullable|string',
        ]);

        ClassRoom::create($validated);

        return redirect()->route('class_rooms.index')
            ->with('success', 'Class room created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ClassRoom $classRoom)
    {
        return view('class_rooms.show', compact('classRoom'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ClassRoom $classRoom)
    {
        return view('class_rooms.edit', compact('classRoom'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ClassRoom $classRoom)
    {
        $validated = $request->validate([
            'class_name' => 'required|string|max:100',
            'description' => 'nullable|string',
        ]);

        $classRoom->update($validated);

        return redirect()->route('class_rooms.index')
            ->with('success', 'Class room updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ClassRoom $classRoom)
    {
        $classRoom->delete();

        return redirect()->route('class_rooms.index')
            ->with('success', 'Class room deleted successfully.');
    }
}
