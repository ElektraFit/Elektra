<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'ElektraFit')</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&family=Orbitron:wght@600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/hero.css', 'resources/css/auth.css'])
    @yield('extra-styles')
</head>
<body class="auth-page">
    <!-- Background Effects -->
    <div class="hero-bg" style="background-image: url('{{ asset('images/gym-equipment.png') }}')"></div>
    <div class="hero-bg-overlay"></div>
    <div class="hero-effects">
        <div class="effect-orb orb-1"></div>
        <div class="effect-orb orb-2"></div>
        <div class="effect-orb orb-3"></div>
    </div>
    <div class="hero-overlay"></div>
    
    @yield('content')
</body>
</html>
