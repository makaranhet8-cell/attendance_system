<style>
    .custom-navbar {
        background: #ffffff;
        border-bottom: 1px solid #f1f5f9;
        padding-top: 12px;
        padding-bottom: 12px;
    }
    .navbar-page-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: #0f172a;
        letter-spacing: -0.3px;
    }
    .user-profile-block {
        background-color: #f8fafc;
        padding: 6px 14px;
        border-radius: 12px;
        border: 1px solid #e2e8f0;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .user-name-text {
        font-size: 0.9rem;
        font-weight: 600;
        color: #334155;
    }
    .role-badge {
        font-size: 0.75rem;
        font-weight: 500;
        padding: 4px 8px;
        border-radius: 6px;
        text-transform: capitalize;
    }
    .btn-logout {
        height: 38px;
        padding: 0 14px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        border-radius: 10px;
        font-weight: 500;
        font-size: 0.85rem;
        transition: all 0.2s ease;
    }
</style>

<nav class="navbar navbar-expand custom-navbar px-4">
    <div class="container-fluid">
        <div class="navbar-page-title">
            @yield('title', 'Dashboard')
        </div>

        <div class="ms-auto d-flex align-items-center gap-3">
            @auth
                <div class="dropdown">
                    <button class="btn user-profile-dropdown d-flex align-items-center gap-2 p-2" type="button" id="userProfileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="d-flex align-items-center text-secondary">
                            <i class="bi bi-person-circle fs-5 text-primary"></i>
                        </div>
                        <div class="d-none d-sm-block text-start me-1">
                            <div class="user-name-text lh-sm mb-1">{{ auth()->user()->name }}</div>

                            @php
                                $roleColors = [
                                    'admin'   => 'bg-danger-subtle text-danger border border-danger-subtle',
                                    'teacher' => 'bg-primary-subtle text-primary border border-primary-subtle',
                                    'student' => 'bg-info-subtle text-info-emphasis border border-info-subtle',
                                ];
                                $userRole = strtolower(auth()->user()->role);
                            @endphp
                            <span class="badge role-badge {{ $roleColors[$userRole] ?? 'bg-secondary-subtle text-secondary' }}">
                                {{ auth()->user()->role }}
                            </span>
                        </div>
                        <i class="bi bi-chevron-down text-muted small d-none d-sm-inline" style="font-size: 0.75rem;"></i>
                    </button>

                    <ul class="dropdown-menu dropdown-menu-end custom-dropdown-menu mt-2" aria-labelledby="userProfileDropdown">
                        <li class="dropdown-header d-sm-none pb-2 border-bottom mb-2">
                            <div class="fw-bold text-dark">{{ auth()->user()->name }}</div>
                            <span class="badge role-badge mt-1 {{ $roleColors[$userRole] ?? 'bg-secondary-subtle text-secondary' }}">
                                {{ auth()->user()->role }}
                            </span>
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center gap-2 py-2" href="#">
                                <i class="bi bi-person text-secondary fs-6"></i> My Profile
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center gap-2 py-2" href="#">
                                <i class="bi bi-gear text-secondary fs-6"></i> Settings
                            </a>
                        </li>
                        <li><hr class="dropdown-divider my-2" style="border-color: #f1f5f9;"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}" class="mb-0">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger d-flex align-items-center gap-2 py-2 w-100 border-0 bg-transparent">
                                    <i class="bi bi-box-arrow-right fs-6"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            @endauth
        </div>
    </div>
</nav>
