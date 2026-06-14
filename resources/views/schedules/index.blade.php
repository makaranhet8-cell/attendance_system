@extends('layouts.app')

@section('title', 'Schedules')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="mb-0">Schedules</h5>
    <a href="{{ route('schedules.create') }}" class="btn btn-primary btn-sm">
        <i class="bi bi-plus-lg"></i> Add schedule
    </a>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Class</th>
                    <th>Subject</th>
                    <th>Teacher</th>
                    <th>Day</th>
                    <th>Time</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($schedules as $schedule)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $schedule->classRoom->class_name ?? '-' }}</td>
                        <td>{{ $schedule->subject->subject_name ?? '-' }}</td>
                        <td>{{ $schedule->teacher->user->name ?? '-' }}</td>
                        <td>{{ $schedule->day }}</td>
                        <td>{{ $schedule->start_time }} - {{ $schedule->end_time }}</td>
                        <td class="text-end">
                            <a href="{{ route('schedules.edit', $schedule->id) }}" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('schedules.destroy', $schedule->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this schedule?')">
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
                        <td colspan="7" class="text-center text-secondary py-4">No schedules found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if(method_exists($schedules, 'links'))
        <div class="p-3">{{ $schedules->links() }}</div>
    @endif
</div>
@endsection
