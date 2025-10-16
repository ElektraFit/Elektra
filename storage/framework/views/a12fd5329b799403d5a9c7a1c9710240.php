
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Elektra</title>

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&family=Orbitron:wght@600;700&display=swap" rel="stylesheet">

   <link rel="stylesheet" href="<?php echo e(url('css/hero.css')); ?>">
</head>
<body>
  <!-- Top Navigation Bar -->
  <div class="top-nav">
    <nav class="site-nav">
      <div class="brand-name">ElektraFIT</div>
      <ul class="nav-links">
        <li><a href="#home">Home</a></li>
        <li><a href="#services">Services</a></li>
        <li><a href="#membership">Membership</a></li>
        <li><a href="#about">About</a></li>
      </ul>
      <div class="nav-actions">
        <a class="btn-join" href="#">Join Now</a>
        <a class="btn-login" href="#">Log In</a>
      </div>
    </nav>
  </div>

  <header class="hero" id="home">
    <div class="hero-overlay"></div>

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
        <!-- optional SVG/mockup or image -->
        <img src="<?php echo e(asset('images/mockup-card.png')); ?>" alt="" />
      </div>
    </div>
  </header>

  <!-- Services Section -->
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

  <script>
    // Smooth scroll functionality
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
      anchor.addEventListener('click', function (e) {
        e.preventDefault();
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
</html><?php /**PATH C:\Apache24\htdocs\elektra\resources\views/hero.blade.php ENDPATH**/ ?>