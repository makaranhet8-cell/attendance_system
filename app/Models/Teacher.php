<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    // កំណត់ឈ្មោះ Table ប្រសិនបើវាមិនមែនជាឈ្មោះ teachers
    // protected $table = 'teachers';

    // កំណត់ Column ដែលអាចបញ្ចូលទិន្នន័យបាន
    protected $fillable = [
        'user_id',
        'teacher_code',
        'phone',
    ];

    /**
     * Relationship: គ្រូមួយរូប ជា User មួយរូប
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relationship: គ្រូអាចបង្រៀនបានច្រើនមុខវិជ្ជា ឬក្នុងថ្នាក់ច្រើន (អាស្រ័យលើ Database របស់អ្នក)
     * នេះជាឧទាហរណ៍ទំនាក់ទំនងជាមួយ Schedule
     */
    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}
