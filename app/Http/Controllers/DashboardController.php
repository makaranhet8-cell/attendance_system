<?php

namespace App\Http\Controllers;

use App\Models\ClassRoom;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\LeaveRequest;

class DashboardController extends Controller
{
    public function index()
    {
        $classRoomCount = ClassRoom::count();
        $studentCount = Student::count();
        $teacherCount = Teacher::count();
        $pendingLeaveCount = LeaveRequest::where('status', 'Pending')->count();

        return view('admin.dashboard', compact(
            'classRoomCount',
            'studentCount',
            'teacherCount',
            'pendingLeaveCount'
        ));
    }
}
