<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Student;
use App\Models\Schedule;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    /**
     * បង្ហាញបញ្ជីវត្តមានសិស្ស
     */
    public function index()
    {
        // ទាញយកទិន្នន័យវត្តមានរួមជាមួយព័ត៌មានសិស្ស និងកាលវិភាគ
        $attendances = Attendance::with(['student', 'schedule'])->latest()->paginate(10);
        return view('attendances.index', compact('attendances'));
    }

    /**
     * បង្ហាញទម្រង់សម្រាប់កត់ត្រាវត្តមានថ្មី
     */
    public function create()
    {
        $students = Student::all();
        $schedules = Schedule::all();
        return view('attendances.create', compact('students', 'schedules'));
    }

    /**
     * រក្សាទុកវត្តមានក្នុង Database
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id'      => 'required|exists:students,id',
            'schedule_id'     => 'required|exists:schedules,id',
            'attendance_date' => 'required|date',
            'status'          => 'required|in:Present,Absent,Late,Excused',
            'remark'          => 'nullable|string',
        ]);

        Attendance::create($validated);

        return redirect()->route('attendances.index')
            ->with('success', 'កត់ត្រាវត្តមានបានជោគជ័យ។');
    }

    /**
     * កែសម្រួលវត្តមាន
     */
    public function edit(Attendance $attendance)
    {
        $students = Student::all();
        $schedules = Schedule::all();
        return view('attendances.edit', compact('attendance', 'students', 'schedules'));
    }

    /**
     * អាប់ដេតទិន្នន័យ
     */
    public function update(Request $request, Attendance $attendance)
    {
        $validated = $request->validate([
            'status' => 'required|in:Present,Absent,Late,Excused',
            'remark' => 'nullable|string',
        ]);

        $attendance->update($validated);

        return redirect()->route('attendances.index')
            ->with('success', 'ធ្វើបច្ចុប្បន្នភាពវត្តមានបានជោគជ័យ។');
    }

    /**
     * លុបវត្តមាន
     */
    public function destroy(Attendance $attendance)
    {
        $attendance->delete();
        return redirect()->route('attendances.index')
            ->with('success', 'បានលុបកំណត់ត្រាវត្តមាន។');
    }
}
