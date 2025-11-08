<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Instructor Portal - ElektraFit')</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&family=Orbitron:wght@600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/shared.css', 'resources/css/auth.css'])
    @yield('extra-styles')
</head>
<body>
    @yield('content')
</body>
</html>
