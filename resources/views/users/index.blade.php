@extends('layouts.app')

@section('title', 'Users')

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
    .user-name {
        font-weight: 600;
        color: #0f172a;
        font-size: 0.95rem;
    }
    .avatar-placeholder {
        width: 32px;
        height: 32px;
        background-color: #f1f5f9;
        color: #475569;
        font-weight: 600;
        font-size: 0.85rem;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .badge-status {
        padding: 6px 12px;
        border-radius: 8px;
        font-weight: 500;
        font-size: 0.8rem;
    }
</style>

<div class="container-fluid py-2">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="page-title mb-1">Users</h4>
            <p class="text-muted small mb-0">Manage system authentication accounts, user roles, and profile statuses.</p>
        </div>
        <a href="{{ route('users.create') }}" class="btn btn-primary px-3 py-2 d-flex align-items-center gap-2 shadow-sm" style="border-radius: 10px; font-weight: 500;">
            <i class="bi bi-plus-lg"></i> Add User
        </a>
    </div>

    <div class="card custom-card">
        <div class="table-responsive">
            <table class="table table-hover custom-table align-middle mb-0">
                <thead>
                    <tr>
                        <th style="width: 80px;">ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th class="text-end" style="width: 160px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <td>
                                <span class="badge bg-light text-secondary px-2 py-1 border font-monospace">
                                    #{{ $user->id }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="avatar-placeholder">
                                        {{ strtoupper(substr($user->name ?? 'U', 0, 1)) }}
                                    </div>
                                    <div class="user-name">{{ $user->name }}</div>
                                </div>
                            </td>
                            <td>
                                <span class="text-secondary small"><i class="bi bi-envelope me-1 text-muted"></i>{{ $user->email }}</span>
                            </td>
                            <td>
                                @php
                                    // កំណត់ពណ៌ទៅតាមប្រភេទ Role នីមួយៗឱ្យមើលទៅប្លែកភ្នែក
                                    $roleColors = [
                                        'admin'   => 'bg-danger-subtle text-danger border border-danger-subtle',
                                        'teacher' => 'bg-primary-subtle text-primary border border-primary-subtle',
                                        'student' => 'bg-info-subtle text-info-emphasis border border-info-subtle',
                                    ];
                                    $userRole = strtolower($user->role);
                                @endphp
                                <span class="badge-status {{ $roleColors[$userRole] ?? 'bg-light text-secondary border' }}">
                                    {{ $user->role }}
                                </span>
                            </td>
                            <td>
                                <span class="badge-status {{ $user->status === 'active' ? 'bg-success-subtle text-success border border-success-subtle' : 'bg-secondary-subtle text-secondary border border-secondary-subtle' }}">
                                    <i class="bi bi-circle-fill small me-1" style="font-size: 0.6rem;"></i>
                                    {{ ucfirst($user->status) }}
                                </span>
                            </td>
                            <td class="text-end">
                                <div class="d-inline-flex gap-1">
                                    <a href="{{ route('users.show', $user->id) }}" class="btn btn-action btn-outline-info" title="View Details">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-action btn-outline-primary" title="Edit">
                                        <i class="bi bi-pencil-semibold"></i>
                                    </a>
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this user?')">
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
                            <td colspan="6" class="text-center text-secondary py-5">
                                <div class="mb-2"><i class="bi bi-people-fill fs-1 opacity-50 text-muted"></i></div>
                                <div>No users found.</div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if(method_exists($users, 'links'))
            <div class="p-3 border-top bg-light-subtle d-flex justify-content-end">
                {{ $users->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
