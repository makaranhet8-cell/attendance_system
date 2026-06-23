@extends('layouts.app')

@section('title', 'Class rooms')

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
    .class-name {
        font-weight: 600;
        color: #0f172a;
        font-size: 0.95rem;
    }
</style>

<div class="container-fluid py-2">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="page-title mb-1">Class Rooms</h4>
            <p class="text-muted small mb-0">Manage and organization school study sections and class rooms.</p>
        </div>
        <a href="{{ route('class_rooms.create') }}" class="btn btn-primary px-3 py-2 d-flex align-items-center gap-2 shadow-sm" style="border-radius: 10px; font-weight: 500;">
            <i class="bi bi-plus-lg"></i> Add Class Room
        </a>
    </div>

    <div class="card custom-card">
        <div class="table-responsive">
            <table class="table table-hover custom-table align-middle mb-0">
                <thead>
                    <tr>
                        <th style="width: 80px;">ID</th>
                        <th>Class Name</th>
                        <th>Description</th>
                        <th class="text-end" style="width: 120px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($classRooms as $classRoom)
                        <tr>
                            <td>
                                <span class="badge bg-light text-secondary px-2 py-1 border font-monospace">
                                    {{ $loop->iteration }}
                                </span>
                            </td>
                            <td>
                                <div class="class-name">
                                    <i class="bi bi-door-open text-primary me-1"></i> {{ $classRoom->class_name }}
                                </div>
                            </td>
                            <td>
                                <span class="text-secondary small">{{ $classRoom->description ?? '-' }}</span>
                            </td>
                            <td class="text-end">
                                <div class="d-inline-flex gap-1">
                                    <a href="{{ route('class_rooms.edit', $classRoom->id) }}" class="btn btn-action btn-outline-primary text-danger" title="Edit">
                                        <i class="bi bi-pencil-semibold"></i>
                                    </a>
                                    <form action="{{ route('class_rooms.destroy', $classRoom->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this class room?')">
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
                            <td colspan="4" class="text-center text-secondary py-5">
                                <div class="mb-2"><i class="bi bi-door-closed fs-1 opacity-50 text-muted"></i></div>
                                <div>No class rooms found.</div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if(method_exists($classRooms, 'links'))
            <div class="p-3 border-top bg-light-subtle d-flex justify-content-end">
                {{ $classRooms->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
