@extends('layouts.app')

@section('title', 'Students')

@section('content')
<style>
    .page-title {
        font-weight: 700;
        color: #1e293b;
    }
    .custom-card {
        border: none;
        border-radius: 16px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.03) !important;
        overflow: hidden;
        background: #ffffff;
    }
    .custom-table thead th {
        background-color: #f8fafc;
        color: #64748b;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-weight: 600;
        padding: 16px;
        border-bottom: 1px solid #e2e8f0;
    }
    .custom-table tbody td {
        padding: 16px;
        color: #334155;
        border-bottom: 1px solid #f1f5f9;
    }
    .custom-table tbody tr:last-child td {
        border-bottom: none;
    }
    .btn-action {
        width: 32px;
        height: 32px;
        padding: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        transition: all 0.2s ease;
    }
    .student-name {
        font-weight: 600;
        color: #0f172a;
        font-size: 0.95rem;
    }
    .avatar-placeholder {
        width: 32px;
        height: 32px;
        background-color: #e0e7ff;
        color: #4f46e5;
        font-weight: 600;
        font-size: 0.85rem;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>

<div class="container-fluid py-2">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="page-title mb-1">Students</h4>
            <p class="text-muted small mb-0">Manage student profiles, directory records, and classroom assignments.</p>
        </div>
        <a href="{{ route('students.create') }}" class="btn btn-primary px-3 py-2 d-flex align-items-center gap-2 shadow-sm" style="border-radius: 10px; font-weight: 500;">
            <i class="bi bi-plus-lg"></i> Add Student
        </a>
    </div>

    <div class="card custom-card">
        <div class="table-responsive">
            <table class="table table-hover custom-table align-middle mb-0">
                <thead>
                    <tr>
                        <th style="width: 80px;">ID</th>
                        <th>Name</th>
                        <th>Class</th>
                        <th>Student Code</th>
                        <th>Phone</th>
                        <th class="text-end" style="width: 120px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($students as $student)
                        <tr>
                            <td>
                                <span class="badge bg-light text-secondary px-2 py-1 border font-monospace">
                                    {{ $loop->iteration }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="avatar-placeholder">
                                        {{ strtoupper(substr($student->user->name ?? 'S', 0, 1)) }}
                                    </div>
                                    <div class="student-name">{{ $student->user->name ?? '-' }}</div>
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-info-subtle text-info-emphasis border border-info-subtle px-2 py-1" style="font-weight: 500;">
                                    <i class="bi bi-door-open me-1"></i>{{ $student->classRoom->class_name ?? '-' }}
                                </span>
                            </td>
                            <td>
                                <span class="font-monospace fw-semibold text-dark">{{ $student->student_code }}</span>
                            </td>
                            <td>
                                <span class="text-secondary small">
                                    @if($student->phone)
                                        <i class="bi bi-telephone me-1 text-muted"></i>{{ $student->phone }}
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </span>
                            </td>
                            <td class="text-end">
                                <div class="d-inline-flex gap-1">
                                    <a href="{{ route('students.edit', $student->id) }}" class="btn btn-action btn-outline-primary" title="Edit">
                                        <i class="bi bi-pencil-semibold"></i>
                                    </a>
                                    <form action="{{ route('students.destroy', $student->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this student?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-action btn-outline-danger" title="Delete">
                                            <i class="bi bi-trash3"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-secondary py-5">
                                <div class="mb-2"><i class="bi bi-people fs-1 opacity-50 text-muted"></i></div>
                                <div>No students found.</div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if(method_exists($students, 'links'))
            <div class="p-3 border-top bg-light-subtle d-flex justify-content-end">
                {{ $students->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
