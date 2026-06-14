<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'schedule_id',
        'reason',
        'attachment',
        'status',
        'teacher_comment',
        'approved_by',
    ];

    /**
     * The student who submitted this leave request.
     */
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    /**
     * The schedule this leave request is for.
     */
    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }

    /**
     * The teacher who approved/rejected this leave request.
     */
    public function approver()
    {
        return $this->belongsTo(Teacher::class, 'approved_by');
    }
}
