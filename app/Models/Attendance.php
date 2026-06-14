<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'schedule_id',
        'attendance_date',
        'status',
        'remark',
    ];

    /**
     * The student this attendance record belongs to.
     */
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    /**
     * The schedule this attendance record belongs to.
     */
    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }
}
