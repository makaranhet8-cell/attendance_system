<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    ClassRoomController,
    SubjectController,
    UserController,
    TeacherController,
    StudentController,
    ScheduleController,
    AttendanceController,
    LeaveRequestController,
    Auth\LoginController
};

// 1. Routes សម្រាប់ភ្ញៀវ (Guest) - អ្នកមិនទាន់ Login
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

// 2. Routes ដែលតម្រូវឱ្យ Login ទើបចូលបាន
Route::middleware('auth')->group(function () {

    // បញ្ជូនអ្នកប្រើប្រាស់ទៅ Dashboard នៅពេលចូលទំព័រដើម
    Route::get('/', function () {
        return redirect()->route('dashboard');
    });

    Route::get('/dashboard', fn () => view('dashboard'))->name('dashboard');

    // Resource Routes
    Route::resource('class_rooms', ClassRoomController::class);
    Route::resource('subjects', SubjectController::class);
    Route::resource('users', UserController::class);
    Route::resource('teachers', TeacherController::class);
    Route::resource('students', StudentController::class);
    Route::resource('schedules', ScheduleController::class);
    Route::resource('attendances', AttendanceController::class);
    Route::resource('leave_requests', LeaveRequestController::class);
    // ក្នុង routes/web.php
Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    // Logout
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});
