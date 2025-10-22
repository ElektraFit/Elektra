<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - ElektraFit</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&family=Orbitron:wght@600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #0f172a 0%, #1e3a8a 50%, #0f172a 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }
        
        .background-image {
            position: absolute;
            inset: 0;
            background-image: url('<?php echo e(asset('images/gym-equipment.png')); ?>');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            opacity: 0.3;
        }
        
        .overlay {
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.7);
        }
        
        .login-container {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            padding: 2rem;
            width: 100%;
            max-width: 400px;
            position: relative;
            z-index: 10;
        }
        
        .logo {
            text-align: center;
            margin-bottom: 2rem;
        }
        
        .logo img {
            height: 3rem;
            width: 3rem;
            filter: brightness(0) saturate(100%) invert(64%) sepia(100%) saturate(1000%) hue-rotate(170deg);
            margin-bottom: 0.5rem;
        }
        
        .logo h1 {
            font-family: 'Orbitron', sans-serif;
            font-size: 1.8rem;
            font-weight: 900;
            background: linear-gradient(to right, #3cf0ff, #1cb6d7, #0080ff);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            letter-spacing: 0.1em;
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        label {
            display: block;
            color: white;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }
        
        input[type="email"], input[type="password"] {
            width: 100%;
            padding: 0.75rem;
            border: 2px solid rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.1);
            color: white;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }
        
        input[type="email"]:focus, input[type="password"]:focus {
            outline: none;
            border-color: #00bfff;
            box-shadow: 0 0 10px rgba(0, 191, 255, 0.3);
        }
        
        input::placeholder {
            color: rgba(255, 255, 255, 0.6);
        }
        
        .checkbox-group {
            display: flex;
            align-items: center;
            margin-bottom: 1.5rem;
        }
        
        input[type="checkbox"] {
            margin-right: 0.5rem;
        }
        
        .checkbox-group label {
            margin: 0;
            font-size: 0.9rem;
            color: rgba(255, 255, 255, 0.8);
        }
        
        .btn-login {
            width: 100%;
            padding: 0.75rem;
            background: linear-gradient(45deg, #00bfff, #0080ff);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0, 191, 255, 0.3);
        }
        
        .links {
            text-align: center;
            margin-top: 1rem;
        }
        
        .links a {
            color: #00bfff;
            text-decoration: none;
            font-size: 0.9rem;
        }
        
        .links a:hover {
            text-decoration: underline;
        }
        
        .error {
            color: #ff6b6b;
            font-size: 0.9rem;
            margin-top: 0.5rem;
        }
    </style>
</head>
<body>
    <div class="background-image"></div>
    <div class="overlay"></div>
    
    <div class="login-container">
        <div class="logo">
            <img src="<?php echo e(asset('images/logo.png')); ?>" alt="ElektraFit Logo">
            <h1>ElektraFit</h1>
        </div>
        
        <form method="POST" action="<?php echo e(route('login.submit')); ?>">
            <?php echo csrf_field(); ?>
            
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" value="<?php echo e(old('email')); ?>" required>
                <?php if($errors->has('email')): ?>
                    <div class="error"><?php echo e($errors->first('email')); ?></div>
                <?php endif; ?>
            </div>
            
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
                <?php if($errors->has('password')): ?>
                    <div class="error"><?php echo e($errors->first('password')); ?></div>
                <?php endif; ?>
            </div>
            
            <div class="checkbox-group">
                <input type="checkbox" id="remember" name="remember">
                <label for="remember">Remember me</label>
            </div>
            
            <button type="submit" class="btn-login">Log In</button>
        </form>
        
        <div class="links">
            <a href="<?php echo e(route('register')); ?>">Don't have an account? Sign up</a>
        </div>
    </div>
</body>
</html>
<?php /**PATH C:\Apache24\htdocs\Elektra\resources\views/auth/login.blade.php ENDPATH**/ ?>