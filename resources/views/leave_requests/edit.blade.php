@extends('layouts.app')

@section('title', 'Edit leave request')

@section('content')
<div class="card p-4" style="max-width: 600px;">
    <h5 class="mb-3">Edit leave request</h5>
    <form action="{{ route('leave_requests.update', $leaveRequest->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Student</label>
            <select name="student_id" class="form-select @error('student_id') is-invalid @enderror" required>
                @foreach ($students as $student)
                    <option value="{{ $student->id }}" {{ old('student_id', $leaveRequest->student_id) == $student->id ? 'selected' : '' }}>
                        {{ $student->user->name ?? $student->student_code }}
                    </option>
                @endforeach
            </select>
            @error('student_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Schedule</label>
            <select name="schedule_id" class="form-select @error('schedule_id') is-invalid @enderror" required>
                @foreach ($schedules as $schedule)
                    <option value="{{ $schedule->id }}" {{ old('schedule_id', $leaveRequest->schedule_id) == $schedule->id ? 'selected' : '' }}>
                        {{ $schedule->subject->subject_name ?? '-' }} - {{ $schedule->day }} ({{ $schedule->start_time }} - {{ $schedule->end_time }})
                    </option>
                @endforeach
            </select>
            @error('schedule_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Reason</label>
            <textarea name="reason" class="form-control @error('reason') is-invalid @enderror" rows="3" required>{{ old('reason', $leaveRequest->reason) }}</textarea>
            @error('reason') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Attachment</label>
            @if($leaveRequest->attachment)
                <div class="mb-2">
                    <a href="{{ asset('storage/' . $leaveRequest->attachment) }}" target="_blank">Current attachment</a>
                </div>
            @endif
            <input type="file" name="attachment" class="form-control @error('attachment') is-invalid @enderror">
            @error('attachment') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-select @error('status') is-invalid @enderror">
                @foreach (['Pending','Approved','Rejected'] as $status)
                    <option value="{{ $status }}" {{ old('status', $leaveRequest->status) == $status ? 'selected' : '' }}>{{ $status }}</option>
                @endforeach
            </select>
            @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Teacher comment</label>
            <textarea name="teacher_comment" class="form-control @error('teacher_comment') is-invalid @enderror" rows="2">{{ old('teacher_comment', $leaveRequest->teacher_comment) }}</textarea>
            @error('teacher_comment') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Approved by (teacher)</label>
            <select name="approved_by" class="form-select @error('approved_by') is-invalid @enderror">
                <option value="">-- None --</option>
                @foreach ($teachers as $teacher)
                    <option value="{{ $teacher->id }}" {{ old('approved_by', $leaveRequest->approved_by) == $teacher->id ? 'selected' : '' }}>
                        {{ $teacher->user->name ?? $teacher->teacher_code }}
                    </option>
                @endforeach
            </select>
            @error('approved_by') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('leave_requests.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
