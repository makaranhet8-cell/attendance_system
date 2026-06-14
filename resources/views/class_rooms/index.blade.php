@extends('layouts.app')

@section('title', 'Class rooms')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="mb-0">Class rooms</h5>
    <a href="{{ route('class_rooms.create') }}" class="btn btn-primary btn-sm">
        <i class="bi bi-plus-lg"></i> Add class room
    </a>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Class name</th>
                    <th>Description</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($classRooms as $classRoom)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $classRoom->class_name }}</td>
                        <td>{{ $classRoom->description }}</td>
                        <td class="text-end">
                            <a href="{{ route('class_rooms.edit', $classRoom->id) }}" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('class_rooms.destroy', $classRoom->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this class room?')">
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
                        <td colspan="4" class="text-center text-secondary py-4">No class rooms found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if(method_exists($classRooms, 'links'))
        <div class="p-3">{{ $classRooms->links() }}</div>
    @endif
</div>
@endsection
