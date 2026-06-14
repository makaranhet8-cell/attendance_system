<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'class_id',
        'subject_id',
        'teacher_id',
        'day',
        'start_time',
        'end_time',
    ];

    /**
     * The class this schedule belongs to.
     */
    public function classRoom()
    {
        return $this->belongsTo(ClassRoom::class, 'class_id');
    }

    /**
     * The subject taught in this schedule.
     */
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    /**
     * The teacher assigned to this schedule.
     */
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    /**
     * Attendance records for this schedule.
     */
    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    /**
     * Leave requests for this schedule.
     */
    public function leaveRequests()
    {
        return $this->hasMany(LeaveRequest::class);
    }
}
