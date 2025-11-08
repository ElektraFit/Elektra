<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify OTP - ElektraFit</title>
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
            overflow: hidden;
        }
        
        body::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(0, 191, 255, 0.15) 0%, transparent 70%);
            animation: rotate 20s linear infinite;
        }
        
        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        
        .background-image {
            position: absolute;
            inset: 0;
            background-image: url('{{ asset('images/gym-equipment.png') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            opacity: 0.2;
            filter: blur(2px);
        }
        
        .overlay {
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.6);
        }
        
        .otp-container {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px) saturate(180%);
            -webkit-backdrop-filter: blur(20px) saturate(180%);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 32px;
            padding: 2.5rem;
            width: 100%;
            max-width: 440px;
            position: relative;
            z-index: 10;
            text-align: center;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.37), 
                        inset 0 1px 0 rgba(255, 255, 255, 0.1);
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
        
        .otp-title {
            color: white;
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }
        
        .otp-subtitle {
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.9rem;
            margin-bottom: 2rem;
        }
        
        .form-group {
            margin-bottom: 1.5rem;
            text-align: left;
        }
        
        label {
            display: block;
            color: white;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }
        
        input[type="email"], input[type="text"] {
            width: 100%;
            padding: 0.9rem 1rem;
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 16px;
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            color: white;
            font-size: 1rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            text-align: center;
        }
        
        input[type="email"]:focus, input[type="text"]:focus {
            outline: none;
            border-color: rgba(0, 191, 255, 0.4);
            background: rgba(255, 255, 255, 0.12);
            box-shadow: 0 4px 16px rgba(0, 191, 255, 0.2);
            transform: translateY(-1px);
        }
        
        input::placeholder {
            color: rgba(255, 255, 255, 0.6);
        }
        
        .otp-input {
            font-size: 1.8rem;
            letter-spacing: 0.8rem;
            font-weight: 700;
            font-family: 'Orbitron', monospace;
            text-shadow: 0 0 10px rgba(0, 191, 255, 0.3);
        }
        
        .btn-verify {
            width: 100%;
            padding: 0.9rem;
            background: linear-gradient(135deg, rgba(0, 191, 255, 0.25), rgba(0, 128, 255, 0.25));
            backdrop-filter: blur(20px) saturate(180%);
            -webkit-backdrop-filter: blur(20px) saturate(180%);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 16px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 8px 32px rgba(0, 191, 255, 0.25);
        }
        
        .btn-verify:hover {
            transform: translateY(-2px) scale(1.01);
            box-shadow: 0 12px 40px rgba(0, 191, 255, 0.4);
            background: linear-gradient(135deg, rgba(0, 191, 255, 0.35), rgba(0, 128, 255, 0.35));
            border-color: rgba(255, 255, 255, 0.25);
        }
        
        .status-message {
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
            font-size: 0.9rem;
        }
        
        .status-success {
            background: rgba(81, 207, 102, 0.2);
            border: 1px solid rgba(81, 207, 102, 0.3);
            color: #51cf66;
        }
        
        .status-error {
            background: rgba(255, 107, 107, 0.2);
            border: 1px solid rgba(255, 107, 107, 0.3);
            color: #ff6b6b;
        }
        
        .error {
            color: #ff6b6b;
            font-size: 0.9rem;
            margin-top: 0.5rem;
        }
        
        .back-link {
            margin-top: 1rem;
        }
        
        .back-link a {
            color: #00bfff;
            text-decoration: none;
            font-size: 0.9rem;
        }
        
        .back-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="background-image"></div>
    <div class="overlay"></div>
    
    <div class="otp-container">
        <div class="logo">
            <img src="{{ asset('images/logo.png') }}" alt="ElektraFit Logo">
            <h1>ElektraFit</h1>
        </div>
        
        <h2 class="otp-title">Verify Your Identity</h2>
        <p class="otp-subtitle">Enter the 4-digit code sent to your email</p>
        
        @if(session('status'))
            <div class="status-message status-success">{{ session('status') }}</div>
        @endif
        
        @if(session('error'))
            <div class="status-message status-error">{{ session('error') }}</div>
        @endif
        
        <form action="{{ route('otp.submit') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" value="{{ old('email', session('otp_email')) }}" required readonly>
            </div>
            
            <div class="form-group">
                <label for="otp">OTP Code</label>
                <input type="text" id="otp" name="otp" placeholder="0000" maxlength="4" class="otp-input" required autocomplete="off">
                @if($errors->has('otp'))
                    <div class="error">{{ $errors->first('otp') }}</div>
                @endif
            </div>
            
            <button type="submit" class="btn-verify">Verify OTP</button>
        </form>
        
        <div class="back-link">
            <a href="{{ route('login') }}">← Back to Login</a>
        </div>
    </div>
    
    <script>
        // Auto-focus on OTP input
        document.getElementById('otp').focus();
        
        // Auto-submit when 4 digits are entered
        document.getElementById('otp').addEventListener('input', function(e) {
            if (e.target.value.length === 4) {
                // Optional: auto-submit after a short delay
                setTimeout(() => {
                    e.target.form.submit();
                }, 500);
            }
        });
    </script>
</body>
</html>
