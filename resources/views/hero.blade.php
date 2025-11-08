<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>ElektraFit - Electrify Your Performance</title>

  <!-- Load Google Fonts for better typography -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&family=Orbitron:wght@600;700&display=swap" rel="stylesheet">

  {{-- 
    Vite directive: Compiles and includes CSS/JS files
    Laravel will automatically find resources/css/hero.css and process it
  --}}
  @vite(['resources/css/hero.css'])
</head>
<body>
  {{-- 
    HERO SECTION: Main landing area that users see first
    This creates the visual impact and first impression
  --}}
  <header class="hero">
    <!-- Background image layer -->
    <div 
      class="absolute inset-0 bg-cover bg-center bg-no-repeat"
      style="background-image: url('{{ asset('images/gym-equipment.png') }}')"
    ></div>
    
    <!-- Dark overlay for text readability -->
    <div class="absolute inset-0 bg-black/80"></div>
    
    <!-- Electric visual effects for brand theme -->
    <div class="absolute inset-0">
      <div class="absolute top-1/4 left-1/4 w-32 h-32 bg-primary/30 rounded-full blur-3xl animate-pulse"></div>
      <div class="absolute bottom-1/3 right-1/4 w-24 h-24 bg-accent/30 rounded-full blur-2xl animate-pulse" style="animation-delay: 1s;"></div>
      <div class="absolute top-1/2 right-1/3 w-16 h-16 bg-primary-glow/40 rounded-full blur-xl animate-pulse" style="animation-delay: 0.5s;"></div>
    </div>
    
    <div class="hero-overlay"></div>

    {{-- 
      NAVIGATION: Main menu at top of page
      asset() helper generates correct URLs for images/files
    --}}
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
        <a class="btn-join" href="{{ route('register') }}">Join Now</a>
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

        {{-- Social proof: Statistics that build trust --}}
        <ul class="hero-stats" role="list" aria-label="site stats">
          <li><span class="stat-num">500+</span><span class="stat-label">Happy Members</span></li>
          <li><span class="stat-num">50+</span><span class="stat-label">Expert Trainers</span></li>
          <li><span class="stat-num">24/7</span><span class="stat-label">Gym Access</span></li>
        </ul>
      </div>

      {{-- Visual element: Image or illustration --}}
      <div class="hero-visual" aria-hidden="true">
        <img src="{{ asset('images/mockup-card.png') }}" alt="" />
      </div>
    </div>
  </header>

  {{-- 
    SERVICES SECTION: What the gym offers
    This provides more details about your services
  --}}
  <section id="services" class="services-section">
    <div class="services-container">
      <h2 class="section-title">Our Services</h2>
      <p class="section-subtitle">Discover what makes ElektraFIT unique</p>
      
      <div class="services-grid">
        <div class="service-card">
          <h3>Personal Training</h3>
          <p>One-on-one sessions with certified trainers tailored to your goals.</p>
        </div>
        
        <div class="service-card">
          <h3>Group Classes</h3>
          <p>High-energy group workouts that motivate and inspire.</p>
        </div>
        
        <div class="service-card">
          <h3>Nutrition Coaching</h3>
          <p>Expert guidance on meal planning and healthy eating habits.</p>
        </div>
        
        <div class="service-card">
          <h3>Recovery & Wellness</h3>
          <p>Massage therapy, sauna, and recovery tools for optimal performance.</p>
        </div>
      </div>
    </div>
  </section>

  {{-- 
    JAVASCRIPT: Interactive functionality
    This adds smooth scrolling when clicking navigation links
  --}}
  <script>
    // When someone clicks a link that starts with #, scroll smoothly to that section
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
      anchor.addEventListener('click', function (e) {
        e.preventDefault(); // Stop the normal link behavior
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
          target.scrollIntoView({
            behavior: 'smooth',
            block: 'start'
          });
        }
      });
    });
  </script>
</body>
</html>
