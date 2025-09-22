
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
  <header class="hero">
    <div class="hero-overlay"></div>

    <nav class="site-nav">
      <div class="brand">
        <!--<img src="<?php echo e(asset('images/logo-light.png')); ?>" alt="Elektra" class="brand-logo" />-->
        <span class="brand-name">ELEKTRA</span>
      </div>
      <ul class="nav-links">
        <li><a href="#">Home</a></li>
        <li><a href="#">Services</a></li>
        <li><a href="#">Membership</a></li>
        <li><a href="#">About</a></li>
      </ul>
      <a class="btn-join" href="#">Join Now</a>
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
        <!-- optional SVG/mockup or image -->
        <img src="<?php echo e(asset('images/mockup-card.png')); ?>" alt="" />
      </div>
    </div>
  </header>
</body>
</html><?php /**PATH C:\Apache24\htdocs\elektra\resources\views/hero.blade.php ENDPATH**/ ?>