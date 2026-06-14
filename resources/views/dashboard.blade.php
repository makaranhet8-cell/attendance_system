@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<!doctype html>
    <html lang="en">
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>Bootstrap demo</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
        </head>
        <body>
            <div class="row g-3">
            <div class="col-md-3">
                <div class="card p-3">
                    <a href="{{ route('class_rooms.index') }}" class="text-decoration-none text-secondary">
                    <div class="text-secondary small">Class rooms</div>
                    <div class="fs-3 fw-bold">{{ $classRoomCount ?? 0 }}</div>
                    </a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card p-3">
                    <a href="{{ route('students.index') }}" class="text-decoration-none text-success">
                    <div class="text-secondary small">Students</div>
                    <div class="fs-3 fw-bold">{{ $studentCount ?? 0 }}</div>
                    </a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card p-3">
                    <a href="{{ route('teachers.index') }}" class="text-decoration-none text-warning">
                    <div class="text-secondary small">Teachers</div>
                    <div class="fs-3 fw-bold">{{ $teacherCount ?? 0 }}</div>
                    </a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card p-3">
                    <a href="{{ route('leave_requests.index') }}" class="text-decoration-none text-danger">
                    <div class="text-secondary small">Pending leave requests</div>
                    <div class="fs-3 fw-bold">{{ $pendingLeaveCount ?? 0 }}</div>
                    </a>
                </div>
            </div>
        </div>

        <div class="card mt-4 p-4">
            <h5>Welcome to the Student Attendance System</h5>
            <p class="text-secondary mb-0">Use the sidebar to manage class rooms, subjects, teachers, students, schedules, attendance records, and leave requests.</p>
        </div>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
        </body>
    </html>

@endsection
