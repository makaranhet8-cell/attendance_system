@extends('layouts.app')

@section('title', 'Attendances')

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
        <div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="mb-0">Attendances</h5>
    <a href="{{ route('attendances.create') }}" class="btn btn-primary btn-sm">
        <i class="bi bi-plus-lg"></i> Add attendance
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
                    <th>Date</th>
                    <th>Status</th>
                    <th>Remark</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($attendances as $attendance)
                    <tr>
                        <td>{{ $attendance->student_id }}</td>
                        <td>{{ $attendance->student->user->name ?? '-' }}</td>
                        <td>
                            {{ $attendance->schedule->subject->subject_name ?? '-' }}
                            <span class="text-secondary small">({{ $attendance->schedule->day ?? '-' }})</span>
                        </td>
                        <td>{{ $attendance->attendance_date }}</td>
                        <td>
                            @php
                                $statusColors = [
                                    'Present' => 'bg-success',
                                    'Absent' => 'bg-danger',
                                    'Late' => 'bg-warning text-dark',
                                    'Excused' => 'bg-info text-dark',
                                ];
                            @endphp
                            <span class="badge {{ $statusColors[$attendance->status] ?? 'bg-secondary' }}">
                                {{ $attendance->status }}
                            </span>
                        </td>
                        <td>{{ $attendance->remark }}</td>
                        <td class="text-end">
                            <a href="{{ route('attendances.edit', $attendance->id) }}" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('attendances.destroy', $attendance->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this attendance record?')">
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
                        <td colspan="7" class="text-center text-secondary py-4">No attendance records found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if(method_exists($attendances, 'links'))
        <div class="p-3">{{ $attendances->links() }}</div>
    @endif
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>

@endsection
