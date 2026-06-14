<div class="pt-2">
    <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
        <i class="bi bi-speedometer2 me-2"></i> Dashboard
    </a>

    <div class="text-uppercase small text-secondary px-3 mt-3 mb-1" style="font-size: .7rem;">Master data</div>
    <a href="{{ route('class_rooms.index') }}" class="{{ request()->routeIs('class_rooms.*') ? 'active' : '' }}">
        <i class="bi bi-door-open me-2"></i> Class rooms
    </a>
    <a href="{{ route('subjects.index') }}" class="{{ request()->routeIs('subjects.*') ? 'active' : '' }}">
        <i class="bi bi-book me-2"></i> Subjects
    </a>
    <a href="{{ route('users.index') }}" class="{{ request()->routeIs('users.*') ? 'active' : '' }}">
        <i class="bi bi-person-gear me-2"></i> Users
    </a>

    <div class="text-uppercase small text-secondary px-3 mt-3 mb-1" style="font-size: .7rem;">People</div>
    <a href="{{ route('teachers.index') }}" class="{{ request()->routeIs('teachers.*') ? 'active' : '' }}">
        <i class="bi bi-person-badge me-2"></i> Teachers
    </a>
    <a href="{{ route('students.index') }}" class="{{ request()->routeIs('students.*') ? 'active' : '' }}">
        <i class="bi bi-people me-2"></i> Students
    </a>

    <div class="text-uppercase small text-secondary px-3 mt-3 mb-1" style="font-size: .7rem;">Academics</div>
    <a href="{{ route('schedules.index') }}" class="{{ request()->routeIs('schedules.*') ? 'active' : '' }}">
        <i class="bi bi-calendar3 me-2"></i> Schedules
    </a>
    <a href="{{ route('attendances.index') }}" class="{{ request()->routeIs('attendances.*') ? 'active' : '' }}">
        <i class="bi bi-clipboard-check me-2"></i> Attendances
    </a>
    <a href="{{ route('leave_requests.index') }}" class="{{ request()->routeIs('leave_requests.*') ? 'active' : '' }}">
        <i class="bi bi-envelope-paper me-2"></i> Leave requests
    </a>
</div>
