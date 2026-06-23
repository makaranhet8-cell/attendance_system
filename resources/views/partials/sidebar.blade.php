<style>
    .sidebar-container {
        padding-top: 12px;
        padding-bottom: 12px;
    }
    .sidebar-heading {
        font-size: 0.68rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: #94a3b8; /* Slate 400 */
        padding: 20px 20px 6px 20px;
    }
    .sidebar-link {
        display: flex;
        align-items: center;
        padding: 10px 16px;
        margin: 2px 12px;
        color: #475569; /* Slate 600 */
        text-decoration: none;
        font-size: 0.9rem;
        font-weight: 500;
        border-radius: 10px;
        transition: all 0.2s ease;
    }
    .sidebar-link i {
        font-size: 1.1rem;
        color: #64748b; /* Slate 500 */
        transition: all 0.2s ease;
    }
    /* ចលនាពេលហ្សូមពីលើ (Hover State) */
    .sidebar-link:hover {
        background-color: #f1f5f9; /* Slate 100 */
        color: #0f172a; /* Slate 900 */
    }
    .sidebar-link:hover i {
        color: #0f172a;
    }
    /* ស្ថានភាពម៉ឺនុយកំពុងសកម្ម (Active State) */
    .sidebar-link.active {
        background-color: #e0e7ff; /* Indigo Light Subtle */
        color: #4f46e5; /* Indigo 600 */
        font-weight: 600;
    }
    .sidebar-link.active i {
        color: #4f46e5;
    }
</style>

<div class="sidebar-container">
    <a href="{{ route('dashboard') }}" class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
        <i class="bi bi-speedometer2 me-2"></i> Dashboard
    </a>

    <div class="sidebar-heading">Master data</div>

    <a href="{{ route('class_rooms.index') }}" class="sidebar-link {{ request()->routeIs('class_rooms.*') ? 'active' : '' }}">
        <i class="bi bi-door-open me-2"></i> Class
    </a>

    <a href="{{ route('subjects.index') }}" class="sidebar-link {{ request()->routeIs('subjects.*') ? 'active' : '' }}">
        <i class="bi bi-book me-2"></i> Subjects
    </a>

    <a href="{{ route('users.index') }}" class="sidebar-link {{ request()->routeIs('users.*') ? 'active' : '' }}">
        <i class="bi bi-person-gear me-2"></i> Users
    </a>

    <div class="sidebar-heading">People</div>

    <a href="{{ route('teachers.index') }}" class="sidebar-link {{ request()->routeIs('teachers.*') ? 'active' : '' }}">
        <i class="bi bi-person-badge me-2"></i> Teachers
    </a>

    <a href="{{ route('students.index') }}" class="sidebar-link {{ request()->routeIs('students.*') ? 'active' : '' }}">
        <i class="bi bi-people me-2"></i> Students
    </a>

    <div class="sidebar-heading">Academics</div>

    <a href="{{ route('schedules.index') }}" class="sidebar-link {{ request()->routeIs('schedules.*') ? 'active' : '' }}">
        <i class="bi bi-calendar3 me-2"></i> Schedules
    </a>

    <a href="{{ route('attendances.index') }}" class="sidebar-link {{ request()->routeIs('attendances.*') ? 'active' : '' }}">
        <i class="bi bi-clipboard-check me-2"></i> Attendances
    </a>

    <a href="{{ route('leave_requests.index') }}" class="sidebar-link {{ request()->routeIs('leave_requests.*') ? 'active' : '' }}">
        <i class="bi bi-envelope-paper me-2"></i> Leave requests
    </a>
</div>
