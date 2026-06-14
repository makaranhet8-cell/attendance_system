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
        // ទាញយកចំនួនពី Database
        $classRoomCount = ClassRoom::count();
        $studentCount = Student::count();
        $teacherCount = Teacher::count();
        $pendingLeaveCount = LeaveRequest::where('status', 'Pending')->count();

        // បញ្ជូនទិន្នន័យទៅកាន់ view('dashboard')
        return view('dashboard', compact(
            'classRoomCount',
            'studentCount',
            'teacherCount',
            'pendingLeaveCount'
        ));
    }
}
