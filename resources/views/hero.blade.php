<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>ElektraFit - Electrify Your Performance</title>

  <!-- Load Google Fonts for better typography -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&family=Orbitron:wght@600;700&display=swap" rel="stylesheet">

  @vite(['resources/css/hero.css'])
</head>
<body>
  <!-- HOME SECTION: Main landing area -->
  <header id="home" class="hero full-section">
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

    <!-- NAVIGATION: Main menu at top of page -->
    <nav class="site-nav">
      <div class="brand">
        <img src="{{ asset('images/logo.png') }}" alt="ElektraFit Logo" class="brand-logo" style="filter: brightness(0) saturate(100%) invert(64%) sepia(100%) saturate(1000%) hue-rotate(170deg);" />
        <span class="brand-name">ElektraFit</span>
      </div>
      <ul class="nav-links">
        <li><a href="#home">Home</a></li>
        <li><a href="#services">Services</a></li>
        <li><a href="#membership">Membership</a></li>
        <li><a href="#about">About</a></li>
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
      <p class="section-subtitle">
        Discover a wide range of fitness services designed to help you reach your goals
      </p>
      
      <div class="services-grid">
        <!-- Strength Training -->
        <div class="service-card">
          <div class="service-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M6.5 6.5L17.5 17.5"/>
              <path d="M6.5 17.5L17.5 6.5"/>
              <circle cx="12" cy="12" r="1"/>
              <circle cx="6" cy="6" r="2"/>
              <circle cx="18" cy="18" r="2"/>
              <circle cx="18" cy="6" r="2"/>
              <circle cx="6" cy="18" r="2"/>
            </svg>
          </div>
          <h3>Strength Training</h3>
          <p>Build muscle and increase power with our comprehensive strength training programs and state-of-the-art equipment.</p>
        </div>
        
        <!-- Cardio Workouts -->
        <div class="service-card">
          <div class="service-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.29 1.51 4.04 3 5.5l7 7Z"/>
            </svg>
          </div>
          <h3>Cardio Workouts</h3>
          <p>Improve your cardiovascular health with our variety of cardio equipment and high-energy group classes.</p>
        </div>
        
        <!-- Group Classes -->
        <div class="service-card">
          <div class="service-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
              <circle cx="9" cy="7" r="4"/>
              <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
              <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
            </svg>
          </div>
          <h3>Group Classes</h3>
          <p>Join our motivating group fitness classes including yoga, HIIT, spinning, and dance workouts.</p>
        </div>
        
        <!-- Personal Training -->
        <div class="service-card">
          <div class="service-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="m13 2-2 2.5-2-2.5"/>
              <path d="M13 22l-2-2.5-2 2.5"/>
              <path d="M6 16.5 2 13l4-3.5"/>
              <path d="M18 16.5 22 13l-4-3.5"/>
              <rect x="8" y="8" width="8" height="8" rx="1"/>
            </svg>
          </div>
          <h3>Personal Training</h3>
          <p>Get personalized attention and customized workout plans from our certified personal trainers.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- MEMBERSHIP SECTION -->
  <section id="membership" class="full-section">
    <div class="section-content">
      <h2 class="section-title">Choose Your Plan</h2>
      <p class="section-subtitle">
        Select the membership that best fits your fitness goals and lifestyle
      </p>
      
      <div class="membership-grid">
        <!-- Basic Plan -->
        <div class="membership-card">
          <h3>Basic</h3>
          <div class="membership-price">KSh 2,500<span>/month</span></div>
          <p class="membership-description">Perfect for getting started with your fitness journey</p>
          <ul class="membership-features">
            <li>Gym access during standard hours</li>
            <li>Basic cardio and strength equipment</li>
            <li>Locker room access</li>
            <li>Free fitness assessment</li>
          </ul>
          <a href="{{ route('register') }}" class="membership-button">Choose Basic</a>
        </div>
        
        <!-- Premium Plan -->
        <div class="membership-card popular">
          <h3>Premium</h3>
          <div class="membership-price">KSh 5,000<span>/month</span></div>
          <p class="membership-description">Our most popular plan with additional benefits</p>
          <ul class="membership-features">
            <li>24/7 gym access</li>
            <li>All equipment and facilities</li>
            <li>Group fitness classes</li>
            <li>Personal trainer consultation</li>
            <li>Nutrition guidance</li>
            <li>Guest passes (2/month)</li>
          </ul>
          <a href="{{ route('register') }}" class="membership-button">Choose Premium</a>
        </div>
        
        <!-- Elite Plan -->
        <div class="membership-card">
          <h3>Elite</h3>
          <div class="membership-price">KSh 9,000<span>/month</span></div>
          <p class="membership-description">Ultimate fitness experience with premium services</p>
          <ul class="membership-features">
            <li>Everything in Premium</li>
            <li>Unlimited personal training</li>
            <li>Massage therapy sessions</li>
            <li>Nutritionist consultations</li>
            <li>VIP locker with amenities</li>
            <li>Priority class booking</li>
          </ul>
          <a href="{{ route('register') }}" class="membership-button">Choose Elite</a>
        </div>
      </div>
    </div>
  </section>

  <!-- ABOUT SECTION -->
  <section id="about" class="full-section">
    <div class="section-content">
      <div class="about-grid">
        <!-- Left Column: Story and Stats -->
        <div class="about-left">
          <h2 class="about-title">About ElektraFit</h2>
          <p class="about-text">
            For over a decade, ElektraFit has been the premier destination for fitness enthusiasts who demand excellence. Our state-of-the-art facility combines cutting-edge equipment with expert guidance to create an environment where transformation happens.
          </p>
          <p class="about-text">
            We believe fitness is more than just physical exercise, it's about building mental strength, creating lasting habits, and becoming the best version of yourself. Our community of trainers and members supports each other every step of the way.
          </p>
          
          <!-- Stats Grid -->
          <div class="about-stats-grid">
            <div class="about-stat-card">
              <div class="stat-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                  <circle cx="9" cy="7" r="4"/>
                  <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
                  <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                </svg>
              </div>
              <div class="stat-number">500+</div>
              <div class="stat-label">Happy Members</div>
            </div>
            
            <div class="about-stat-card">
              <div class="stat-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M12 2v20M2 12h20"/>
                  <circle cx="12" cy="12" r="4"/>
                </svg>
              </div>
              <div class="stat-number">3+</div>
              <div class="stat-label">Years Experience</div>
            </div>
            
            <div class="about-stat-card">
              <div class="stat-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <circle cx="12" cy="12" r="10"/>
                  <polyline points="12 6 12 12 16 14"/>
                </svg>
              </div>
              <div class="stat-number">24/7</div>
              <div class="stat-label">Access Available</div>
            </div>
            
            <div class="about-stat-card">
              <div class="stat-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <circle cx="12" cy="12" r="10"/>
                  <circle cx="12" cy="12" r="6"/>
                  <circle cx="12" cy="12" r="2"/>
                </svg>
              </div>
              <div class="stat-number">95%</div>
              <div class="stat-label">Success Rate</div>
            </div>
          </div>
        </div>
        
        <!-- Right Column: Mission, Vision, Values -->
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
      
      <!-- Instructor Portal Link -->
      <div class="instructor-login-section">
        <p class="instructor-login-text">Are you a fitness instructor?</p>
        <a href="{{ route('instructor.login') }}" class="instructor-login-btn">Instructor Portal - Login Here</a>
      </div>
    </div>
  </section>

  <script>
    // Smooth scrolling for navigation links
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
</html>
