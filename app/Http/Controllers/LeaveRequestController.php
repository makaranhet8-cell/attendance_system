<?php

namespace App\Http\Controllers;

use App\Models\LeaveRequest;
use App\Models\Student;
use App\Models\Schedule;
use App\Models\Teacher; // 1. កុំភ្លេច Import Model នេះ
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeaveRequestController extends Controller
{
    /**
     * បង្ហាញបញ្ជីសំណើសុំច្បាប់
     */
    public function index()
    {
        $leaveRequests = LeaveRequest::with(['student', 'schedule'])->latest()->paginate(10);
        return view('leave_requests.index', compact('leaveRequests'));
    }

    /**
     * បង្ហាញទម្រង់សុំច្បាប់
     */
    public function create()
    {
        $students = Student::all();
        $schedules = Schedule::all();
        // 2. ទាញយកទិន្នន័យគ្រូ (ជាមួយព័ត៌មាន User) ដើម្បីបញ្ជូនទៅ View
        $teachers = Teacher::with('user')->get();

        // 3. បញ្ជូន $teachers ទៅក្នុង compact() ដើម្បីកុំឱ្យមានកំហុសក្នុង View
        return view('leave_requests.create', compact('students', 'schedules', 'teachers'));
    }

    /**
     * រក្សាទុកសំណើសុំច្បាប់
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id'  => 'required|exists:students,id',
            'schedule_id' => 'required|exists:schedules,id',
            'reason'      => 'required|string',
            'attachment'  => 'nullable|file|mimes:jpg,png,pdf|max:2048',
        ]);

        if ($request->hasFile('attachment')) {
            $path = $request->file('attachment')->store('attachments', 'public');
            $validated['attachment'] = $path;
        }

        LeaveRequest::create($validated);

        return redirect()->route('leave_requests.index')
            ->with('success', 'សំណើសុំច្បាប់ត្រូវបានបញ្ជូនជោគជ័យ។');
    }

    /**
     * អនុម័ត ឬបដិសេធសំណើសុំច្បាប់ (សម្រាប់គ្រូ)
     */
    public function updateStatus(Request $request, LeaveRequest $leaveRequest)
    {
        $validated = $request->validate([
            'status'          => 'required|in:Approved,Rejected',
            'teacher_comment' => 'nullable|string',
        ]);

        $leaveRequest->update([
            'status'          => $validated['status'],
            'teacher_comment' => $validated['teacher_comment'],
            'approved_by'     => Auth::id(),
        ]);

        return redirect()->route('leave_requests.index')
            ->with('success', 'ស្ថានភាពសំណើសុំច្បាប់ត្រូវបានអាប់ដេត។');
    }

    /**
     * លុបសំណើ
     */
    public function destroy(LeaveRequest $leaveRequest)
    {
        $leaveRequest->delete();
        return redirect()->route('leave_requests.index')
            ->with('success', 'បានលុបសំណើសុំច្បាប់។');
    }
}
