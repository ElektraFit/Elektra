<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard - ElektraFit')</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&family=Orbitron:wght@600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/hero.css', 'resources/css/dashboard.css'])
</head>
<body style="font-family: 'Inter', sans-serif; color: white; margin: 0; padding: 0;">
    <!-- Background Effects -->
    <div class="hero-bg" style="background-image: url('{{ asset('images/gym-equipment.png') }}')"></div>
    <div class="hero-bg-overlay"></div>
    <div class="hero-effects">
        <div class="effect-orb orb-1"></div>
        <div class="effect-orb orb-2"></div>
        <div class="effect-orb orb-3"></div>
    </div>
    <div class="cyber-grid"></div>

    <!-- Sidebar -->
    <aside class="sidebar @yield('sidebar-class')" id="sidebar">
        <div class="sidebar-toggle" onclick="toggleSidebar()">◀</div>
        
        <div class="sidebar-brand">
            <img src="{{ asset('images/logo.png') }}" alt="ElektraFit Logo" style="filter: brightness(0) saturate(100%) invert(64%) sepia(100%) saturate(1000%) hue-rotate(170deg);">
            <h2>@yield('brand-name', 'ElektraFit')</h2>
        </div>

        <nav class="sidebar-nav">
            @yield('sidebar-nav')
        </nav>

        <div class="logout-section">
            @yield('logout-button')
        </div>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        @yield('content')
    </main>

    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('collapsed');
        }

        // Typing animation for dashboard welcome
        document.addEventListener('DOMContentLoaded', function() {
            const typedTextElement = document.getElementById('typed-text');
            if (typedTextElement) {
                const displayName = typedTextElement.getAttribute('data-name') || 'Member';
                let charIndex = 0;
                
                function typeWriter() {
                    if (charIndex < displayName.length) {
                        typedTextElement.textContent += displayName.charAt(charIndex);
                        charIndex++;
                        setTimeout(typeWriter, 100);
                    } else {
                        // Hide cursor after typing is complete
                        const cursor = document.querySelector('.cursor');
                        if (cursor) {
                            cursor.style.display = 'none';
                        }
                    }
                }
                typeWriter();
            }
        });

        @yield('scripts')
    </script>
</body>
</html>
