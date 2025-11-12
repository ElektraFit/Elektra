@extends('layouts.dashboard')

@section('title', 'Our Instructors - ElektraFit')

@section('sidebar-nav')
    <ul>
        <x-nav-item href="{{ route('dashboard') }}" label="Dashboard">
            <svg class="nav-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="3" y="3" width="7" height="7"></rect>
                <rect x="14" y="3" width="7" height="7"></rect>
                <rect x="14" y="14" width="7" height="7"></rect>
                <rect x="3" y="14" width="7" height="7"></rect>
            </svg>
        </x-nav-item>
        <x-nav-item href="{{ route('training-sessions.index') }}" label="Training Sessions">
            <svg class="nav-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="6" y="9" width="3" height="6"></rect>
                <rect x="15" y="9" width="3" height="6"></rect>
                <rect x="9" y="10.5" width="6" height="3"></rect>
                <line x1="1" y1="12" x2="6" y2="12"></line>
                <line x1="18" y1="12" x2="23" y2="12"></line>
            </svg>
        </x-nav-item>
        <x-nav-item href="{{ route('nutrition.index') }}" label="Nutrition">
            <svg class="nav-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M16 2c0 2-2 4-2 4" />
                <path d="M19 7c-1.5-1-4-1.5-6 0-2-1.5-4.5-1-6 0-3 2-3 8 1 11 2 1.5 4 1 5 0 1 1 3 1.5 5 0 4-3 4-9 1-11z"></path>
            </svg>
        </x-nav-item>
        <x-nav-item href="{{ route('instructors') }}" label="Instructors" :active="true">
            <svg class="nav-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M17 21v-2a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4v2"></path>
                <circle cx="9" cy="7" r="4"></circle>
                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
            </svg>
        </x-nav-item>
    </ul>
@endsection

@section('logout-button')
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="btn-logout">
            <svg class="nav-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                <polyline points="16 17 21 12 16 7"></polyline>
                <line x1="21" y1="12" x2="9" y2="12"></line>
            </svg>
            <span class="nav-text">Logout</span>
        </button>
    </form>
@endsection

@section('content')
<div class="instructors-page">
    <div class="page-header">
        <div class="header-content center-text">
            <h1 class="page-title">Our Expert Instructors</h1>
            <p class="page-subtitle">Meet our certified fitness professionals ready to guide your journey</p>
        </div>
    </div>

    @if($instructors->count() > 0)
        <div class="instructors-grid">
            @foreach($instructors as $instructor)
                <div class="instructor-card">
                    <div class="instructor-photo">
                        <img src="{{ $instructor->profile_photo_url }}" alt="{{ $instructor->name }}">
                    </div>
                    <div class="instructor-info">
                        <h3>{{ $instructor->name }}</h3>
                        <p class="specialization">{{ $instructor->specialization }}</p>
                        <p class="experience">{{ $instructor->years_of_experience }} years experience</p>
                        @if($instructor->bio)
                            <p class="bio">{{ Str::limit($instructor->bio, 120) }}</p>
                        @endif
                        <div class="instructor-stats">
                            <span>⭐ 4.9</span>
                            <span>👥 {{ rand(10, 50) }} clients</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="empty-state">
            <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                <path d="M17 21v-2a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4v2"></path>
                <circle cx="9" cy="7" r="4"></circle>
                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
            </svg>
            <h3>No Instructors Available</h3>
            <p>Check back soon to meet our fitness professionals!</p>
        </div>
    @endif
</div>

<style>
    .instructors-page {
        padding: 2rem;
    }

    .page-header {
        margin-bottom: 3rem;
    }

    .center-text {
        text-align: center;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0.5rem;
    }

    .page-title {
        font-size: 2.5rem;
        font-weight: 600;
        color: #ffffff;
        margin-bottom: 0.5rem;
        font-family: -apple-system, BlinkMacSystemFont, 'SF Pro Display', sans-serif;
        letter-spacing: -0.015em;
    }

    .page-subtitle {
        font-size: 1.125rem;
        color: rgba(255, 255, 255, 0.7);
        text-align: center;
    }

    .instructors-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 2rem;
        margin-bottom: 2rem;
    }

    .instructor-card {
        background: rgba(255, 255, 255, 0.05);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(0, 191, 255, 0.2);
        border-radius: 20px;
        padding: 2rem;
        transition: all 0.3s ease;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
    }

    .instructor-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(0, 191, 255, 0.2);
        border-color: rgba(0, 191, 255, 0.4);
    }

    .instructor-photo {
        width: 140px;
        height: 140px;
        border-radius: 50%;
        overflow: hidden;
        border: 3px solid rgba(0, 191, 255, 0.3);
        margin-bottom: 1.5rem;
    }

    .instructor-photo img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
    }

    .instructor-info {
        width: 100%;
    }

    .instructor-info h3 {
        font-size: 1.5rem;
        font-weight: 600;
        color: #00bfff;
        margin-bottom: 0.5rem;
    }

    .specialization {
        color: #00bfff;
        font-weight: 600;
        font-size: 0.9375rem;
        margin-bottom: 0.5rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .experience {
        color: rgba(255, 255, 255, 0.6);
        font-size: 0.875rem;
        margin-bottom: 1rem;
    }

    .bio {
        color: rgba(255, 255, 255, 0.7);
        font-size: 0.9375rem;
        line-height: 1.6;
        margin-bottom: 1.5rem;
    }

    .instructor-stats {
        display: flex;
        justify-content: center;
        gap: 1.5rem;
        padding-top: 1rem;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
    }

    .instructor-stats span {
        color: rgba(255, 255, 255, 0.8);
        font-size: 0.875rem;
        font-weight: 500;
    }

    .instructor-stats span:first-child {
        color: #ffd700;
    }

    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        color: rgba(255, 255, 255, 0.5);
    }

    .empty-state svg {
        color: rgba(0, 191, 255, 0.3);
        margin-bottom: 1.5rem;
    }

    .empty-state h3 {
        font-size: 1.5rem;
        color: rgba(255, 255, 255, 0.7);
        margin-bottom: 0.75rem;
    }

    .empty-state p {
        font-size: 1rem;
        color: rgba(255, 255, 255, 0.5);
    }

    @media (max-width: 768px) {
        .instructors-grid {
            grid-template-columns: 1fr;
        }

        .page-title {
            font-size: 2rem;
        }
    }
</style>
@endsection
