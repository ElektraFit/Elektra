@props(['active' => 'dashboard'])

<ul>
    <li>
        <a href="{{ route('dashboard') }}" class="{{ $active === 'dashboard' ? 'active' : '' }}">
            <svg class="nav-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                <polyline points="9 22 9 12 15 12 15 22"></polyline>
            </svg>
            <span class="nav-text">Dashboard</span>
        </a>
    </li>
    <li>
        <a href="{{ route('training-sessions.index') }}" class="{{ $active === 'training' ? 'active' : '' }}">
            <svg class="nav-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M6 2v4"></path>
                <path d="M10 2v4"></path>
                <path d="M14 2v4"></path>
                <path d="M18 2v4"></path>
                <rect x="2" y="6" width="20" height="12" rx="2"></rect>
            </svg>
            <span class="nav-text">Training</span>
        </a>
    </li>
    <li>
        <a href="{{ route('nutrition.index') }}" class="{{ $active === 'nutrition' ? 'active' : '' }}">
            <svg class="nav-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M22 12h-4l-3 9L9 3l-3 9H2"></path>
            </svg>
            <span class="nav-text">Nutrition</span>
        </a>
    </li>
    <li>
        <a href="{{ route('dashboard') }}#instructors" class="{{ $active === 'instructors' ? 'active' : '' }}">
            <svg class="nav-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                <circle cx="9" cy="7" r="4"></circle>
                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
            </svg>
            <span class="nav-text">Instructors</span>
        </a>
    </li>
</ul>
