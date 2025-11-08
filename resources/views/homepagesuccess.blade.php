<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>{{ config('app.name') }} - Welcome</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&family=Orbitron:wght@600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/hero.css'])

</head>
<body>
    <header class="hero">
        <!-- Full page background image -->
        <div 
            class="absolute inset-0 bg-cover bg-center bg-no-repeat"
            style="background-image: url('{{ asset('images/gym-equipment.png') }}')"
        ></div>
        
        <!-- Dark overlay for readability -->
        <div class="absolute inset-0 bg-black/85"></div>
        
        <!-- Electric background effects -->
        <div class="absolute inset-0">
            <div class="absolute top-1/4 left-1/4 w-32 h-32 bg-primary/30 rounded-full blur-3xl animate-pulse"></div>
            <div class="absolute bottom-1/3 right-1/4 w-24 h-24 bg-accent/30 rounded-full blur-2xl animate-pulse" style="animation-delay: 1s;"></div>
            <div class="absolute top-1/2 right-1/3 w-16 h-16 bg-primary-glow/40 rounded-full blur-xl animate-pulse" style="animation-delay: 0.5s;"></div>
        </div>
        
        <div class="hero-overlay"></div>

        <nav class="site-nav">
            <div class="brand">
                <img src="{{ asset('images/logo.png') }}" alt="ElektraFit Logo" class="brand-logo" style="filter: brightness(0) saturate(100%) invert(64%) sepia(100%) saturate(1000%) hue-rotate(170deg);" />
                <span class="brand-name">ElektraFit</span>
            </div>
            <ul class="nav-links">
                <li><a href="{{ url('/#home') }}">Home</a></li>
                <li><a href="{{ url('/#services') }}">Services</a></li>
                <li><a href="{{ url('/#membership') }}">Membership</a></li>
                <li><a href="{{ url('/#about') }}">About</a></li>
            </ul>
            <a class="btn-join" href="{{ url('/') }}">Back to Home</a>
        </nav>

        <div class="hero-inner">
            <div class="hero-content" style="max-width: 100%; text-align: center;">
                <h1 class="hero-title">
                    Welcome to<br />
                    <span class="accent">ElektraFit</span>
                </h1>
                <p class="hero-sub" style="max-width: 600px; margin-left: auto; margin-right: auto;">
                    Your membership is now <strong style="color: var(--primary);">ACTIVATED</strong>. 
                    Get ready to unleash your potential in our electrifying fitness environment.
                </p>

                <div class="hero-ctas">
                    <a class="btn-primary" href="{{ url('/') }}">Explore More</a>
                    <a class="btn-outline" href="{{ url('/#services') }}">View Services</a>
                </div>

                <ul class="hero-stats" role="list" aria-label="membership benefits" style="justify-content: center;">
                    <li><span class="stat-num">⚡</span><span class="stat-label">Energy Boost</span></li>
                    <li><span class="stat-num">🎯</span><span class="stat-label">Expert Training</span></li>
                    <li><span class="stat-num">🔥</span><span class="stat-label">Peak Performance</span></li>
                </ul>

                <p style="margin-top: 2rem; font-size: 0.875rem; color: var(--muted); opacity: 0.8;">
                    Check your email for your member portal access and exclusive workout plans.
                </p>
            </div>
        </div>
    </header>
</body>
</html>