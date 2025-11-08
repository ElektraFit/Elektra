<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>ElektraFit - Electrify Your Performance</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&family=Orbitron:wght@600;700&display=swap" rel="stylesheet">
  @vite(['resources/css/hero.css'])
</head>
<body>
  @php
    $icons = [
      'strength' => '<svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6.5 6.5L17.5 17.5"/><path d="M6.5 17.5L17.5 6.5"/><circle cx="12" cy="12" r="1"/><circle cx="6" cy="6" r="2"/><circle cx="18" cy="18" r="2"/><circle cx="18" cy="6" r="2"/><circle cx="6" cy="18" r="2"/></svg>',
      'heart' => '<svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.29 1.51 4.04 3 5.5l7 7Z"/></svg>',
      'users' => '<svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>',
      'target' => '<svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m13 2-2 2.5-2-2.5"/><path d="M13 22l-2-2.5-2 2.5"/><path d="M6 16.5 2 13l4-3.5"/><path d="M18 16.5 22 13l-4-3.5"/><rect x="8" y="8" width="8" height="8" rx="1"/></svg>',
      'users-small' => '<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>',
      'crosshair' => '<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2v20M2 12h20"/><circle cx="12" cy="12" r="4"/></svg>',
      'clock' => '<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>',
      'bullseye' => '<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="6"/><circle cx="12" cy="12" r="2"/></svg>',
    ];
  @endphp

  <!-- HOME SECTION -->
  <header id="home" class="hero full-section">
    <div class="hero-bg" style="background-image: url('{{ asset('images/gym-equipment.png') }}')"></div>
    <div class="hero-bg-overlay"></div>
    <div class="hero-effects">
      <div class="effect-orb orb-1"></div>
      <div class="effect-orb orb-2"></div>
      <div class="effect-orb orb-3"></div>
    </div>
    <div class="hero-overlay"></div>

    <!-- NAVIGATION -->
    <nav class="site-nav">
      <div class="brand">
        <img src="{{ asset('images/logo.png') }}" alt="ElektraFit Logo" class="brand-logo logo-filter" />
        <span class="brand-name">ElektraFit</span>
      </div>
      <ul class="nav-links">
        <li><a href="#home">Home</a></li>
        <li><a href="#services">Services</a></li>
        <li><a href="#membership">Membership</a></li>
        <li><a href="#about">About</a></li>
      </ul>
      <div class="nav-buttons">
        <a class="btn-join" href="{{ route('register') }}">Join Now</a>
        <a class="btn-join" href="{{ route('login') }}">Login</a>
      </div>
    </nav>

    <div class="hero-inner">
      <div class="hero-content">
        <h1 class="hero-title">Electrify Your<br /><span class="accent">Performance</span></h1>
        <p class="hero-sub">Experience the future of fitness with cutting-edge technology, expert guidance, and an electric atmosphere that powers your transformation.</p>
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

  <!-- SERVICES SECTION -->
  <section id="services" class="full-section">
    <div class="section-content">
      <h2 class="section-title">Our Services</h2>
      <p class="section-subtitle">Discover a wide range of fitness services designed to help you reach your goals</p>
      
      <div class="services-grid">
        <x-service-card 
          title="Strength Training" 
          :icon="$icons['strength']"
          description="Build muscle and increase power with our comprehensive strength training programs and state-of-the-art equipment." />
        
        <x-service-card 
          title="Cardio Workouts" 
          :icon="$icons['heart']"
          description="Improve your cardiovascular health with our variety of cardio equipment and high-energy group classes." />
        
        <x-service-card 
          title="Group Classes" 
          :icon="$icons['users']"
          description="Join our motivating group fitness classes including yoga, HIIT, spinning, and dance workouts." />
        
        <x-service-card 
          title="Personal Training" 
          :icon="$icons['target']"
          description="Get personalized attention and customized workout plans from our certified personal trainers." />
      </div>
    </div>
  </section>

  <!-- MEMBERSHIP SECTION -->
  <section id="membership" class="full-section">
    <div class="section-content">
      <h2 class="section-title">Choose Your Plan</h2>
      <p class="section-subtitle">Select the membership that best fits your fitness goals and lifestyle</p>
      
      <div class="membership-grid">
        <x-membership-card 
          title="Basic" 
          price="KSh 2,500"
          description="Perfect for getting started with your fitness journey"
          :features="['Gym access during standard hours', 'Basic cardio and strength equipment', 'Locker room access', 'Free fitness assessment']" />
        
        <x-membership-card 
          title="Premium" 
          price="KSh 5,000"
          description="Our most popular plan with additional benefits"
          :features="['24/7 gym access', 'All equipment and facilities', 'Group fitness classes', 'Personal trainer consultation', 'Nutrition guidance', 'Guest passes (2/month)']"
          :popular="true" />
        
        <x-membership-card 
          title="Elite" 
          price="KSh 9,000"
          description="Ultimate fitness experience with premium services"
          :features="['Everything in Premium', 'Unlimited personal training', 'Massage therapy sessions', 'Nutritionist consultations', 'VIP locker with amenities', 'Priority class booking']" />
      </div>
    </div>
  </section>

  <!-- ABOUT SECTION -->
  <section id="about" class="full-section">
    <div class="section-content">
      <div class="about-grid">
        <div class="about-left">
          <h2 class="about-title">About ElektraFit</h2>
          <p class="about-text">For over a decade, ElektraFit has been the premier destination for fitness enthusiasts who demand excellence. Our state-of-the-art facility combines cutting-edge equipment with expert guidance to create an environment where transformation happens.</p>
          <p class="about-text">We believe fitness is more than just physical exercise—it's about building mental strength, creating lasting habits, and becoming the best version of yourself. Our community of trainers and members supports each other every step of the way.</p>
          
          <div class="about-stats-grid">
            <x-stat-card number="500+" label="Happy Members" :icon="$icons['users-small']" />
            <x-stat-card number="3+" label="Years Experience" :icon="$icons['crosshair']" />
            <x-stat-card number="24/7" label="Access Available" :icon="$icons['clock']" />
            <x-stat-card number="95%" label="Success Rate" :icon="$icons['bullseye']" />
          </div>
        </div>
        
        <div class="about-right">
          <div class="about-card">
            <h3>Our Mission</h3>
            <p>To empower individuals to achieve their fitness goals through innovative training methods, supportive community, and world-class facilities.</p>
          </div>
          <div class="about-card">
            <h3>Our Vision</h3>
            <p>To be the leading fitness destination that transforms lives by making health and wellness accessible, enjoyable, and sustainable for everyone.</p>
          </div>
          <div class="about-card">
            <h3>Our Values</h3>
            <p>Excellence, community, integrity, and innovation drive everything we do. We're committed to creating an inclusive environment where everyone can thrive.</p>
          </div>
        </div>
      </div>
      
      <div class="instructor-login-section">
        <p class="instructor-login-text">Are you a fitness instructor?</p>
        <a href="{{ route('instructor.login') }}" class="instructor-login-btn">Instructor Portal - Login Here</a>
      </div>
    </div>
  </section>

  <script>
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
      anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) target.scrollIntoView({ behavior: 'smooth', block: 'start' });
      });
    });
  </script>
</body>
</html>
