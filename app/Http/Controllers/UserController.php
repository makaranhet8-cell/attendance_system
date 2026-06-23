<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\LeaveRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:100',
            'username' => 'required|string|max:50|unique:users,username',
            'email'    => 'nullable|email|max:100',
            'password' => 'required|string|min:6',
            'role'     => 'required|in:admin,teacher,student',
            'status'   => 'nullable|in:active,inactive',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['status']   = $validated['status'] ?? 'active';

        User::create($validated);

        return redirect()->route('users.index')
            ->with('success', 'User created successfully.');
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:100',
            'username' => 'required|string|max:50|unique:users,username,' . $user->id,
            'email'    => 'nullable|email|max:100',
            'password' => 'nullable|string|min:6',
            'role'     => 'required|in:admin,teacher,student',
            'status'   => 'nullable|in:active,inactive',
        ]);

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $validated['status'] = $validated['status'] ?? 'active';

        $user->update($validated);

        return redirect()->route('users.index')
            ->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        // ── Teacher ──────────────────────────────────────
        if ($user->role === 'teacher') {
            $teacher = $user->teacher;

            if ($teacher) {
                // null-out approved_by on any leave_requests this teacher approved
                LeaveRequest::where('approved_by', $teacher->id)
                    ->update(['approved_by' => null]);

                // delete schedules + their child attendances/leave_requests
                foreach ($teacher->schedules as $schedule) {
                    $schedule->attendances()->delete();
                    $schedule->leaveRequests()->delete();
                    $schedule->delete();
                }

                $teacher->delete();
            }
        }

        // ── Student ──────────────────────────────────────
        if ($user->role === 'student') {
            $student = $user->student;

            if ($student) {
                $student->attendances()->delete();
                $student->leaveRequests()->delete();
                $student->delete();
            }
        }

        // ── Delete user ──────────────────────────────────
        $user->delete();
        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully.');
    }
}
