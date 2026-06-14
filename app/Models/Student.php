<?php

namespace App\Models;

use App\Models\ClassRoom; // ប្រើ Model នេះ
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'class_id',
        'student_code',
        'phone',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * កែសម្រួលត្រង់នេះ៖ ប្រើ ClassRoom::class មិនមែន ClassRoomController::class ទេ
     */
    public function classRoom()
    {
        return $this->belongsTo(ClassRoom::class, 'class_id');
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function leaveRequests()
    {
        return $this->hasMany(LeaveRequest::class);
    }
}
