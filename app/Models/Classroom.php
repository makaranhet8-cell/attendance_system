<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class ClassRoom extends Model
{
    use HasFactory;

    protected $table = 'class_rooms';   // <-- ត្រូវមានបន្ទាត់នេះ

    protected $fillable = [
        'class_name',
        'description',
    ];

    public function students()
    {
        return $this->hasMany(Student::class, 'class_id');
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'class_id');
    }
}
