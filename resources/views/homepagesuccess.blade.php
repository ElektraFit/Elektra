<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} - ElektraFit|Homepage</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&display=swap" rel="stylesheet">
     @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-background text-foreground">
    <!-- Header -->
    <header class="fixed top-0 w-full z-50 bg-background/80 backdrop-blur-md border-b border-border">
        <div class="container mx-auto px-4 py-4 flex items-center justify-between">
            <div class="flex items-center gap-2">
                <svg class="h-8 w-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                </svg>
                <span class="font-orbitron text-2xl font-black text-gradient tracking-wider">ElektraFit</span>
            </div>
            
            <nav class="hidden md:flex items-center gap-8">
                <a href="{{ url('/#home') }}" class="text-foreground hover:text-primary transition-colors">Home</a>
                <a href="{{ url('/#services') }}" class="text-foreground hover:text-primary transition-colors">Services</a>
                <a href="{{ url('/#membership') }}" class="text-foreground hover:text-primary transition-colors">Membership</a>
                <a href="{{ url('/#about') }}" class="text-foreground hover:text-primary transition-colors">About</a>
                <a href="{{ url('/#contact') }}" class="text-foreground hover:text-primary transition-colors">Contact</a>
            </nav>

            <div class="flex items-center gap-4">
                <svg class="h-6 w-6 md:hidden text-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="min-h-screen flex items-center justify-center relative overflow-hidden pt-20">
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

        <div id="main-content" class="relative z-10 text-center max-w-2xl mx-auto px-6 content-hide">
            <!-- Electric logo effect -->
            <div class="mb-8 relative">
                <h1 class="text-6xl md:text-8xl font-bold font-orbitron text-gradient animate-pulse-glow">
                    ElektraFit
                </h1>
                <div class="absolute inset-0 text-6xl md:text-8xl font-bold font-orbitron text-primary/20 blur-sm animate-pulse">
                    ElektraFit
                </div>
            </div>

            <!-- Welcome message -->
            <div class="space-y-6 mb-8">
                <div class="relative">
                    <h2 class="text-3xl md:text-4xl font-bold font-orbitron text-foreground mb-4">
                        Welcome to the ElektraFit Gym and Fitness Centre
                    </h2>
                    <div class="w-full h-px bg-gradient-to-r from-transparent via-primary to-transparent animate-electric-flow"></div>
                </div>
                
                <p class="text-lg md:text-xl text-muted-foreground max-w-lg mx-auto leading-relaxed">
                    Your membership is now <span class="text-primary font-semibold">ACTIVATED</span>. 
                    Get ready to unleash your potential in our electrifying fitness environment.
                </p>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-8">
                    <div class="p-4 rounded-lg bg-card/50 border border-primary/20 backdrop-blur-sm">
                        <div class="text-primary text-2xl mb-2">⚡</div>
                        <h3 class="font-semibold text-sm">Energy Boost</h3>
                        <p class="text-xs text-muted-foreground">Cutting-edge equipment</p>
                    </div>
                    <div class="p-4 rounded-lg bg-card/50 border border-accent/20 backdrop-blur-sm">
                        <div class="text-accent text-2xl mb-2">🎯</div>
                        <h3 class="font-semibold text-sm">Expert Training</h3>
                        <p class="text-xs text-muted-foreground">Professional guidance</p>
                    </div>
                    <div class="p-4 rounded-lg bg-card/50 border border-primary-glow/20 backdrop-blur-sm">
                        <div class="text-primary-glow text-2xl mb-2">🔥</div>
                        <h3 class="font-semibold text-sm">Peak Performance</h3>
                        <p class="text-xs text-muted-foreground">Achieve your goals</p>
                    </div>
                </div>
            </div>

            <!-- Action button -->
      <div class="flex justify-center">
    <a href="{{ url('/') }}"
       class="inline-block bg-[#3cf0ff] hover:bg-[#1cb6d7] text-black font-bold py-3 px-8 rounded-xl shadow-lg transition-colors duration-200">
        Explore more
    </a>
</div>

            <p class="text-sm text-muted-foreground mt-8">
                Check your email for your member portal access and exclusive workout plans.
            </p>
        </div>
    </div>
</body>
</html>