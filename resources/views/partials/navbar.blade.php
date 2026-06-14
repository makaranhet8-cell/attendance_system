<nav class="navbar navbar-top navbar-expand px-4 py-2">
    <div class="container-fluid">
        <span class="fw-semibold">@yield('title', 'Dashboard')</span>
        <div class="ms-auto d-flex align-items-center">
            @auth
                <span class="me-3 text-secondary">
                    <i class="bi bi-person-circle me-1"></i>{{ auth()->user()->name }}
                    <span class="badge bg-secondary ms-1">{{ auth()->user()->role }}</span>
                </span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-outline-danger">
                        <i class="bi bi-box-arrow-right"></i> Logout
                    </button>
                </form>
            @endauth
        </div>
    </div>
</nav>
