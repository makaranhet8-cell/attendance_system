@extends('layouts.app')

@section('title', 'Teachers')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="mb-0">Teachers</h5>
    <a href="{{ route('teachers.create') }}" class="btn btn-primary btn-sm">
        <i class="bi bi-plus-lg"></i> Add teacher
    </a>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Teacher code</th>
                    <th>Phone</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($teachers as $teacher)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $teacher->user->name ?? '-' }}</td>
                        <td>{{ $teacher->teacher_code }}</td>
                        <td>{{ $teacher->phone }}</td>
                        <td class="text-end">
                            <a href="{{ route('teachers.edit', $teacher->id) }}" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('teachers.destroy', $teacher->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this teacher?')">
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
                        <td colspan="5" class="text-center text-secondary py-4">No teachers found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if(method_exists($teachers, 'links'))
        <div class="p-3">{{ $teachers->links() }}</div>
    @endif
</div>
@endsection
