@extends('layouts.app')

@section('title', 'Leave requests')

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
</style>

<div class="container-fluid py-2">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="page-title mb-1">Leave Requests</h4>
            <p class="text-muted small mb-0">Review and manage student absence permissions and documentation.</p>
        </div>
        <a href="{{ route('leave_requests.create') }}" class="btn btn-primary px-3 py-2 d-flex align-items-center gap-2 shadow-sm" style="border-radius: 10px; font-weight: 500;">
            <i class="bi bi-plus-lg"></i> Add Leave Request
        </a>
    </div>

    <div class="card custom-card">
        <div class="table-responsive">
            <table class="table table-hover custom-table align-middle mb-0">
                <thead>
                    <tr>
                        <th style="width: 80px;">ID</th>
                        <th>Student</th>
                        <th>Subject & Schedule</th>
                        <th>Reason</th>
                        <th>Status</th>
                        <th>Approved By</th>
                        <th class="text-end" style="width: 120px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($leaveRequests as $leaveRequest)
                        <tr>
                            <td>
                                <span class="badge bg-light text-secondary px-2 py-1 border font-monospace">
                                    {{ $loop->iteration }}
                                </span>
                            </td>
                            <td>
                                <div class="student-name">{{ $leaveRequest->student->user->name ?? '-' }}</div>
                            </td>
                            <td>
                                <div class="text-dark fw-medium">{{ $leaveRequest->schedule->subject->subject_name ?? '-' }}</div>
                                <div class="text-muted small d-flex align-items-center gap-1 mt-1">
                                    <i class="bi bi-calendar3 small"></i> {{ $leaveRequest->schedule->day ?? '-' }}
                                </div>
                            </td>
                            <td>
                                <span class="text-secondary small" title="{{ $leaveRequest->reason }}">
                                    {{ \Illuminate\Support\Str::limit($leaveRequest->reason, 40) }}
                                </span>
                            </td>
                            <td>
                                @php
                                    $statusColors = [
                                        'Pending'  => 'bg-warning-subtle text-warning-emphasis border border-warning-subtle',
                                        'Approved' => 'bg-success-subtle text-success border border-success-subtle',
                                        'Rejected' => 'bg-danger-subtle text-danger border border-danger-subtle',
                                    ];
                                @endphp
                                <span class="badge-status {{ $statusColors[$leaveRequest->status] ?? 'bg-secondary-subtle text-secondary' }}">
                                    <i class="bi bi-circle-fill small me-1" style="font-size: 0.6rem;"></i>
                                    {{ $leaveRequest->status }}
                                </span>
                            </td>
                            <td>
                                @if($leaveRequest->approver)
                                    <div class="small fw-medium text-dark d-flex align-items-center gap-1">
                                        <i class="bi bi-person-check text-success"></i>
                                        <span>{{ $leaveRequest->approver->user->name }}</span>
                                    </div>
                                @else
                                    <span class="text-muted small">-</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <div class="d-inline-flex gap-1">
                                    <a href="{{ route('leave_requests.edit', $leaveRequest->id) }}" class="btn btn-action btn-outline-info" title="Edit">
                                        <i class="bi bi-pencil-semibold"></i>
                                    </a>
                                    <form action="{{ route('leave_requests.destroy', $leaveRequest->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this leave request?')">
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
                                <div class="mb-2"><i class="bi bi-envelope-x fs-1 opacity-50 text-muted"></i></div>
                                <div>No leave requests found.</div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if(method_exists($leaveRequests, 'links'))
            <div class="p-3 border-top bg-light-subtle d-flex justify-content-end">
                {{ $leaveRequests->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
