@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>
    .dashboard-card {
        border: none;
        border-radius: 16px;
        transition: all 0.3s ease;
        background: #ffffff;
    }
    .dashboard-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 20px rgba(0, 0, 0, 0.08) !important;
    }
    .icon-shape {
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
    }
    .welcome-banner {
        background: linear-gradient(135deg, #4f46e5, #3b82f6);
        color: white;
        border: none;
        border-radius: 16px;
        position: relative;
        overflow: hidden;
    }
    .welcome-banner::after {
        content: '';
        position: absolute;
        right: -30px;
        top: -30px;
        width: 150px;
        height: 150px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
    }
</style>

<div class="container-fluid py-2">
    <div class="card welcome-banner mb-4 p-4 shadow-sm">
        <div class="d-flex align-items-center">
            <div class="me-3 fs-3">
                <i class="fa-solid fa-graduation-cap"></i>
            </div>
            <div>
                <h4 class="fw-bold mb-1">Welcome to the Student Attendance System</h4>
                <p class="mb-0 opacity-75">Use the sidebar to manage class rooms, subjects, teachers, students, schedules, attendance records, and leave requests.</p>
            </div>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-12 col-sm-6 col-md-3">
            <div class="card dashboard-card p-3 shadow-sm">
                <a href="{{ route('class_rooms.index') }}" class="text-decoration-none d-flex align-items-center justify-content-between">
                    <div>
                        <div class="text-muted small fw-medium mb-1">Class</div>
                        <div class="fs-2 fw-bold text-dark">{{ $classRoomCount ?? 0 }}</div>
                    </div>
                    <div class="icon-shape bg-primary-subtle text-primary">
                        <i class="fa-solid fa-chalkboard fs-4"></i>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-3">
            <div class="card dashboard-card p-3 shadow-sm">
                <a href="{{ route('students.index') }}" class="text-decoration-none d-flex align-items-center justify-content-between">
                    <div>
                        <div class="text-muted small fw-medium mb-1">Students</div>
                        <div class="fs-2 fw-bold text-dark">{{ $studentCount ?? 0 }}</div>
                    </div>
                    <div class="icon-shape bg-success-subtle text-success">
                        <i class="fa-solid fa-user-graduate fs-4"></i>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-3">
            <div class="card dashboard-card p-3 shadow-sm">
                <a href="{{ route('teachers.index') }}" class="text-decoration-none d-flex align-items-center justify-content-between">
                    <div>
                        <div class="text-muted small fw-medium mb-1">Teachers</div>
                        <div class="fs-2 fw-bold text-dark">{{ $teacherCount ?? 0 }}</div>
                    </div>
                    <div class="icon-shape bg-warning-subtle text-warning">
                        <i class="fa-solid fa-user-tie fs-4"></i>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-3">
            <div class="card dashboard-card p-3 shadow-sm">
                <a href="{{ route('leave_requests.index') }}" class="text-decoration-none d-flex align-items-center justify-content-between">
                    <div>
                        <div class="text-muted small fw-medium mb-1">Pending Leaves</div>
                        <div class="fs-2 fw-bold text-dark">{{ $pendingLeaveCount ?? 0 }}</div>
                    </div>
                    <div class="icon-shape bg-danger-subtle text-danger">
                        <i class="fa-solid fa-envelope-open-text fs-4"></i>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
