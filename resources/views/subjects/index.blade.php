@extends('layouts.app')

@section('title', 'Subjects')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="mb-0">Subjects</h5>
    <a href="{{ route('subjects.create') }}" class="btn btn-primary btn-sm">
        <i class="bi bi-plus-lg"></i> Add subject
    </a>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Subject name</th>
                    <th>Description</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($subjects as $subject)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $subject->subject_name }}</td>
                        <td>{{ $subject->description }}</td>
                        <td class="text-end">
                            <a href="{{ route('subjects.edit', $subject->id) }}" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('subjects.destroy', $subject->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this subject?')">
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
                        <td colspan="4" class="text-center text-secondary py-4">No subjects found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if(method_exists($subjects, 'links'))
        <div class="p-3">{{ $subjects->links() }}</div>
    @endif
</div>
@endsection
