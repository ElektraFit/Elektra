<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>{{ config('app.name') }} - Welcome</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&family=Orbitron:wght@600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/hero.css'])
    
    <style>
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: #0a0e27;
            z-index: -3;
        }
        
        body::after {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(138, 43, 226, 0.15) 0%, rgba(0, 191, 255, 0.15) 50%, rgba(255, 0, 255, 0.15) 100%);
            background-size: 400% 400%;
            animation: gradientShift 15s ease infinite;
            z-index: -2;
        }
        
        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        /* Cyberpunk grid effect */
        .cyber-grid {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: 
                linear-gradient(rgba(0, 191, 255, 0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(0, 191, 255, 0.03) 1px, transparent 1px);
            background-size: 50px 50px;
            z-index: -1;
            pointer-events: none;
        }
        
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 280px;
            height: 100vh;
            background: rgba(10, 14, 39, 0.85);
            backdrop-filter: blur(20px) saturate(180%);
            border-right: 1px solid rgba(0, 191, 255, 0.3);
            box-shadow: 0 0 30px rgba(0, 191, 255, 0.1);
            padding: 2rem 0;
            z-index: 1000;
            display: flex;
            flex-direction: column;
            transition: width 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .sidebar.collapsed {
            width: 80px;
        }
        
        .sidebar.collapsed .sidebar-brand span,
        .sidebar.collapsed .sidebar-nav-item span:last-child,
        .sidebar.collapsed .sidebar-logout span:last-child {
            opacity: 0;
            width: 0;
            overflow: hidden;
        }
        
        .sidebar.collapsed .sidebar-brand {
            justify-content: center;
            padding: 0;
        }
        
        .sidebar.collapsed .sidebar-nav-item,
        .sidebar.collapsed .sidebar-logout {
            justify-content: center;
            padding: 1rem;
        }
        
        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0 1.5rem;
            margin-bottom: 3rem;
        }
        
        .sidebar-brand img {
            width: 40px;
            height: 40px;
        }
        
        .sidebar-brand span {
            font-family: 'Orbitron', sans-serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: #00bfff;
            text-shadow: 0 0 10px rgba(0, 191, 255, 0.5);
            transition: opacity 0.3s ease, width 0.3s ease;
        }
        
        .sidebar-toggle {
            position: absolute;
            top: 2rem;
            right: -15px;
            width: 30px;
            height: 30px;
            background: rgba(10, 14, 39, 0.95);
            border: 1px solid rgba(0, 191, 255, 0.5);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            z-index: 1001;
            color: #00bfff;
            font-size: 0.875rem;
        }
        
        .sidebar-toggle:hover {
            background: rgba(0, 191, 255, 0.2);
            box-shadow: 0 0 15px rgba(0, 191, 255, 0.4);
        }
        
        .sidebar-nav {
            flex: 1;
            padding: 0 1rem;
        }
        
        .sidebar-nav-item {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1rem;
            padding: 1rem 1.25rem;
            margin-bottom: 0.5rem;
            color: #00bfff;
            text-decoration: none;
            border-radius: 12px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            font-weight: 600;
            font-family: 'Orbitron', sans-serif;
            text-shadow: 0 0 10px rgba(0, 191, 255, 0.5);
            background: rgba(0, 191, 255, 0.05);
            border: 1px solid rgba(0, 191, 255, 0.2);
        }
        
        .sidebar-nav-item:hover {
            background: rgba(0, 191, 255, 0.1);
            color: #00bfff;
            transform: translateX(5px);
            box-shadow: 0 0 15px rgba(0, 191, 255, 0.3);
        }
        
        .sidebar-nav-item.active {
            background: rgba(0, 191, 255, 0.15);
            color: #00bfff;
            border-left: 3px solid #00bfff;
            box-shadow: 0 0 20px rgba(0, 191, 255, 0.4);
        }
        
        .sidebar-footer {
            padding: 0 1.5rem;
            margin-top: auto;
        }
        
        .sidebar-logout {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem 1.25rem;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            border-radius: 12px;
            background: rgba(10, 14, 39, 0.6);
            border: 1px solid rgba(255, 59, 48, 0.3);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            font-weight: 500;
            text-align: center;
            justify-content: center;
        }
        
        .sidebar-logout:hover {
            background: rgba(255, 59, 48, 0.2);
            color: #ff3b30;
            transform: translateY(-2px);
        }
        
        .sidebar-nav-item span:last-child,
        .sidebar-logout span:last-child {
            transition: opacity 0.3s ease, width 0.3s ease;
        }
        
        .main-content {
            margin-left: 280px;
            transition: margin-left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .sidebar.collapsed ~ .main-content {
            margin-left: 80px;
        }
        
        .welcome-header {
            position: fixed;
            top: 2rem;
            left: 320px;
            z-index: 999;
            transition: left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .sidebar.collapsed ~ .main-content .welcome-header {
            left: 120px;
        }
        
        .welcome-text {
            font-family: 'Orbitron', sans-serif;
            font-size: 1.5rem;
            font-weight: 600;
            color: #ffffff;
            text-shadow: 0 0 10px rgba(0, 191, 255, 0.5);
            display: inline-block;
        }
        
        .welcome-text .typing {
            display: inline-block;
            border-right: 2px solid #00bfff;
            animation: blink 0.7s step-end infinite;
            padding-right: 2px;
        }
        
        @keyframes blink {
            from, to { border-color: transparent; }
            50% { border-color: #00bfff; }
        }
        
        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>

</head>
<body>
    <!-- Cyberpunk Grid Overlay -->
    <div class="cyber-grid"></div>
    
    <!-- Left Sidebar Navigation -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-toggle" onclick="toggleSidebar()">
            ◀
        </div>
        
        <div class="sidebar-brand">
            <img src="{{ asset('images/logo.png') }}" alt="ElektraFit Logo" style="filter: brightness(0) saturate(100%) invert(64%) sepia(100%) saturate(1000%) hue-rotate(170deg);" />
            <span>ElektraFit</span>
        </div>
        
        <nav class="sidebar-nav">
            <a href="#" class="sidebar-nav-item">
                <span>Instructor</span>
            </a>
        </nav>
        
        <div class="sidebar-footer">
            <a href="{{ url('/') }}" class="sidebar-logout">
                <span>Logout</span>
            </a>
        </div>
    </aside>
    
    <!-- Main Content Area -->
    <div class="main-content">
        <!-- Welcome Header with Typing Animation -->
        <div class="welcome-header">
            <div class="welcome-text">
                Welcome, <span class="typing" id="typedText"></span>
            </div>
        </div>
        
    <header class="hero">
        <!-- Electric background effects -->
        <div class="absolute inset-0">
            <div class="absolute top-1/4 left-1/4 w-32 h-32 bg-primary/30 rounded-full blur-3xl animate-pulse"></div>
            <div class="absolute bottom-1/3 right-1/4 w-24 h-24 bg-accent/30 rounded-full blur-2xl animate-pulse" style="animation-delay: 1s;"></div>
            <div class="absolute top-1/2 right-1/3 w-16 h-16 bg-primary-glow/40 rounded-full blur-xl animate-pulse" style="animation-delay: 0.5s;"></div>
        </div>

        <div class="hero-inner">
            <div class="hero-content" style="max-width: 100%; text-align: center;">
                <h1 class="hero-title">
                    <span class="accent">Your membership is ACTIVATED</span>
                </h1>
                                <p class="hero-sub" style="max-width: 600px; margin-left: auto; margin-right: auto;">
                    Get ready to unleash your potential in our electrifying fitness environment.
                </p>
            </div>
        </div>
    </header>
    </div>
    
    <script>
        // Typing animation
        const userName = "{{ $userName }}";
        const typedTextElement = document.getElementById('typedText');
        let charIndex = 0;
        
        function typeWriter() {
            if (charIndex < userName.length) {
                typedTextElement.textContent += userName.charAt(charIndex);
                charIndex++;
                setTimeout(typeWriter, 100);
            } else {
                // Remove cursor after typing is complete
                setTimeout(() => {
                    typedTextElement.classList.remove('typing');
                }, 500);
            }
        }
        
        // Start typing animation when page loads
        window.addEventListener('load', () => {
            setTimeout(typeWriter, 500);
        });
        
        // Sidebar toggle function
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const toggle = document.querySelector('.sidebar-toggle');
            sidebar.classList.toggle('collapsed');
            
            if (sidebar.classList.contains('collapsed')) {
                toggle.textContent = '▶';
            } else {
                toggle.textContent = '◀';
            }
        }
    </script>
</body>
</html>
            </div>
        </div>
    </header>
    </div>
</body>
</html>