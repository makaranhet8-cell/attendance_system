@extends('layouts.app')

@section('title', 'Add attendance')

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
<div class="card p-4" style="max-width: 600px;">
    <h5 class="mb-3">Add attendance</h5>
    <form action="{{ route('attendances.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Student</label>
            <select name="student_id" class="form-select @error('student_id') is-invalid @enderror" required>
                <option value="">-- Select student --</option>
                @foreach ($students as $student)
                    <option value="{{ $student->id }}" {{ old('student_id') == $student->id ? 'selected' : '' }}>
                        {{ $student->user->name ?? $student->student_code }}
                    </option>
                @endforeach
            </select>
            @error('student_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Schedule</label>
            <select name="schedule_id" class="form-select @error('schedule_id') is-invalid @enderror" required>
                <option value="">-- Select schedule --</option>
                @foreach ($schedules as $schedule)
                    <option value="{{ $schedule->id }}" {{ old('schedule_id') == $schedule->id ? 'selected' : '' }}>
                        {{ $schedule->subject->subject_name ?? '-' }} - {{ $schedule->day }} ({{ $schedule->start_time }} - {{ $schedule->end_time }})
                    </option>
                @endforeach
            </select>
            @error('schedule_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Attendance date</label>
            <input type="date" name="attendance_date" value="{{ old('attendance_date') }}" class="form-control @error('attendance_date') is-invalid @enderror" required>
            @error('attendance_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-select @error('status') is-invalid @enderror">
                @foreach (['Present','Absent','Late','Excused'] as $status)
                    <option value="{{ $status }}" {{ old('status', 'Present') == $status ? 'selected' : '' }}>{{ $status }}</option>
                @endforeach
            </select>
            @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Remark</label>
            <textarea name="remark" class="form-control @error('remark') is-invalid @enderror" rows="2">{{ old('remark') }}</textarea>
            @error('remark') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
        <a href="{{ route('attendances.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>

@endsection
