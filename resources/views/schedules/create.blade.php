@extends('layouts.app')

@section('title', 'Add schedule')

@section('content')
<div class="card p-4" style="max-width: 600px;">
    <h5 class="mb-3">Add schedule</h5>
    <form action="{{ route('schedules.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Class room</label>
            <select name="class_id" class="form-select @error('class_id') is-invalid @enderror" required>
                <option value="">-- Select class --</option>
                @foreach ($classRooms as $classRoom)
                    <option value="{{ $classRoom->id }}" {{ old('class_id') == $classRoom->id ? 'selected' : '' }}>
                        {{ $classRoom->class_name }}
                    </option>
                @endforeach
            </select>
            @error('class_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Subject</label>
            <select name="subject_id" class="form-select @error('subject_id') is-invalid @enderror" required>
                <option value="">-- Select subject --</option>
                @foreach ($subjects as $subject)
                    <option value="{{ $subject->id }}" {{ old('subject_id') == $subject->id ? 'selected' : '' }}>
                        {{ $subject->subject_name }}
                    </option>
                @endforeach
            </select>
            @error('subject_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Teacher</label>
            <select name="teacher_id" class="form-select @error('teacher_id') is-invalid @enderror" required>
                <option value="">-- Select teacher --</option>
                @foreach ($teachers as $teacher)
                    <option value="{{ $teacher->id }}" {{ old('teacher_id') == $teacher->id ? 'selected' : '' }}>
                        {{ $teacher->user->name ?? $teacher->teacher_code }}
                    </option>
                @endforeach
            </select>
            @error('teacher_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Day</label>
            <select name="day" class="form-select @error('day') is-invalid @enderror">
                <option value="">-- Select day --</option>
                @foreach (['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'] as $day)
                    <option value="{{ $day }}" {{ old('day') == $day ? 'selected' : '' }}>{{ $day }}</option>
                @endforeach
            </select>
            @error('day') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Start time</label>
                <input type="time" name="start_time" value="{{ old('start_time') }}" class="form-control @error('start_time') is-invalid @enderror">
                @error('start_time') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">End time</label>
                <input type="time" name="end_time" value="{{ old('end_time') }}" class="form-control @error('end_time') is-invalid @enderror">
                @error('end_time') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
        <a href="{{ route('schedules.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
