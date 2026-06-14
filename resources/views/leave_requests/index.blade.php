@extends('layouts.app')

@section('title', 'Leave requests')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="mb-0">Leave requests</h5>
    <a href="{{ route('leave_requests.create') }}" class="btn btn-primary btn-sm">
        <i class="bi bi-plus-lg"></i> Add leave request
    </a>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Student</th>
                    <th>Schedule</th>
                    <th>Reason</th>
                    <th>Status</th>
                    <th>Approved by</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($leaveRequests as $leaveRequest)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $leaveRequest->student->user->name ?? '-' }}</td>
                        <td>
                            {{ $leaveRequest->schedule->subject->subject_name ?? '-' }}
                            <span class="text-secondary small">({{ $leaveRequest->schedule->day ?? '-' }})</span>
                        </td>
                        <td>{{ \Illuminate\Support\Str::limit($leaveRequest->reason, 40) }}</td>
                        <td>
                            @php
                                $statusColors = [
                                    'Pending' => 'bg-warning text-dark',
                                    'Approved' => 'bg-success',
                                    'Rejected' => 'bg-danger',
                                ];
                            @endphp
                            <span class="badge {{ $statusColors[$leaveRequest->status] ?? 'bg-secondary' }}">
                                {{ $leaveRequest->status }}
                            </span>
                        </td>
                        <td>{{ $leaveRequest->approver->user->name ?? '-' }}</td>
                        <td class="text-end">
                            <a href="{{ route('leave_requests.edit', $leaveRequest->id) }}" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('leave_requests.destroy', $leaveRequest->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this leave request?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-secondary py-4">No leave requests found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if(method_exists($leaveRequests, 'links'))
        <div class="p-3">{{ $leaveRequests->links() }}</div>
    @endif
</div>
@endsection
