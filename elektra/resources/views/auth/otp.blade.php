<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Verify OTP</title>
</head>
<body>
    <h1>Enter OTP</h1>

    @if(session('status'))
        <p style="color: green;">{{ session('status') }}</p>
    @endif

    @if($errors->any())
        <div style="color: red;">
            <ul>
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('otp.verify') }}" method="POST">
        @csrf
        <div>
            <label>Email</label>
            <input type="email" name="email" required value="{{ old('email') }}">
        </div>
        <div>
            <label>OTP</label>
            <input type="text" name="otp" maxlength="4" required>
        </div>
        <button type="submit">Verify</button>
    </form>
</body>
</html>
