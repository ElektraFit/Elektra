<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>ElektraFit</title>

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
        <li><a href="#">Home</a></li>
        <li><a href="#">Services</a></li>
        <li><a href="#">Membership</a></li>
        <li><a href="#">About</a></li>
      </ul>
      <div style="display: flex; gap: 1rem;">
        <a class="btn-join" href="{{ route('login') }}">Login</a>
      </div>
    </nav>

    <div class="hero-inner">
      <div class="hero-content">
        <h1 class="hero-title">
          Electrify Your<br />
          <span class="accent">Performance</span>
        </h1>
        <p class="hero-sub">
          Experience the future of fitness with cutting-edge technology, expert guidance, and an electric atmosphere that powers your transformation.
        </p>

        <div class="hero-ctas">
          <a class="btn-primary" href="#">Power Up Now</a>
          <a class="btn-outline" href="#">See The Energy</a>
        </div>

        <ul class="hero-stats" role="list" aria-label="site stats">
          <li><span class="stat-num">500+</span><span class="stat-label">Happy Members</span></li>
          <li><span class="stat-num">50+</span><span class="stat-label">Expert Trainers</span></li>
          <li><span class="stat-num">24/7</span><span class="stat-label">Gym Access</span></li>
        </ul>
      </div>

      <div class="hero-visual" aria-hidden="true">
        <img src="{{ asset('images/mockup-card.png') }}" alt="" />
      </div>
    </div>
  </header>
</body>
</html>