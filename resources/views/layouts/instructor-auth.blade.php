<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Instructor Portal - ElektraFit')</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&family=Orbitron:wght@600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/hero.css'])
    @yield('extra-styles')
</head>
<body class="auth-page">
    <!-- Background Effects with Purple Theme -->
    <div class="hero-bg" style="background-image: url('{{ asset('images/gym-equipment.png') }}')"></div>
    <div class="hero-bg-overlay"></div>
    <div class="hero-effects">
        <div class="effect-orb orb-1" style="background-color: rgba(138, 43, 226, 0.3);"></div>
        <div class="effect-orb orb-2" style="background-color: rgba(168, 85, 247, 0.3); animation-delay: 1s;"></div>
        <div class="effect-orb orb-3" style="background-color: rgba(138, 43, 226, 0.4); animation-delay: 0.5s;"></div>
    </div>
    <div class="hero-overlay"></div>
    
    @yield('content')
</body>
</html>
