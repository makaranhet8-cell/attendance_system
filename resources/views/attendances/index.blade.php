@extends('layouts.app')

@section('title', 'Attendances')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

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
    .badge-status {
        padding: 6px 12px;
        border-radius: 8px;
        font-weight: 500;
        font-size: 0.8rem;
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
    }
    .subject-name {
        font-weight: 500;
    }
</style>

<div class="container-fluid py-2">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="page-title mb-1">Attendances</h4>
            <p class="text-muted small mb-0">Manage and track student daily attendance records.</p>
        </div>
        <a href="{{ route('attendances.create') }}" class="btn btn-primary px-3 py-2 d-flex align-items-center gap-2 shadow-sm" style="border-radius: 10px; font-weight: 500;">
            <i class="bi bi-plus-lg"></i> Add Attendance
        </a>
    </div>

    <div class="card custom-card">
        <div class="table-responsive">
            <table class="table table-hover custom-table align-middle mb-0">
                <thead>
                    <tr>
                        <th style="width: 100px;">Student ID</th>
                        <th>Student Name</th>
                        <th>Subject & Schedule</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Remark</th>
                        <th class="text-end" style="width: 120px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($attendances as $attendance)
                        <tr>
                            <td>
                                <span class="badge bg-light text-secondary px-2 py-1 border font-monospace">
                                    #{{ $attendance->student_id }}
                                </span>
                            </td>
                            <td>
                                <div class="student-name">{{ $attendance->student->user->name ?? '-' }}</div>
                            </td>
                            <td>
                                <div class="subject-name text-dark">{{ $attendance->schedule->subject->subject_name ?? '-' }}</div>
                                <div class="text-muted small d-flex align-items-center gap-1 mt-1">
                                    <i class="bi bi-calendar3 small"></i> {{ $attendance->schedule->day ?? '-' }}
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-1">
                                    <i class="bi bi-clock text-secondary small"></i>
                                    <span>{{ $attendance->attendance_date }}</span>
                                </div>
                            </td>
                            <td>
                                @php
                                    // ប្រើប្រាស់ពណ៌បែប Pastel ស្រទន់ មើលទៅបែប Premium
                                    $statusColors = [
                                        'Present' => 'bg-success-subtle text-success border border-success-subtle',
                                        'Absent'  => 'bg-danger-subtle text-danger border border-danger-subtle',
                                        'Late'    => 'bg-warning-subtle text-warning-emphasis border border-warning-subtle',
                                        'Excused' => 'bg-info-subtle text-info-emphasis border border-info-subtle',
                                    ];
                                @endphp
                                <span class="badge-status {{ $statusColors[$attendance->status] ?? 'bg-secondary-subtle text-secondary' }}">
                                    <i class="bi bi-circle-fill small me-1" style="font-size: 0.6rem;"></i>
                                    {{ $attendance->status }}
                                </span>
                            </td>
                            <td>
                                <span class="text-secondary small">{{ $attendance->remark ?? '-' }}</span>
                            </td>
                            <td class="text-end">
                                <div class="d-inline-flex gap-1">
                                    <a href="{{ route('attendances.edit', $attendance->id) }}" class="btn btn-action btn-outline-primary" title="Edit">
                                        <i class="bi bi-pencil-semibold"></i>
                                    </a>
                                    <form action="{{ route('attendances.destroy', $attendance->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this attendance record?')">
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
                            <td colspan="7" class="text-center text-secondary py-5">
                                <div class="mb-2"><i class="bi bi-folder-x fs-1 opacity-50"></i></div>
                                <div>No attendance records found.</div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if(method_exists($attendances, 'links'))
            <div class="p-3 border-top bg-light-subtle d-flex justify-content-end">
                {{ $attendances->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
