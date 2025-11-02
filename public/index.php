<?php

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;

// STEP 1: Start timing the application (for performance monitoring)
define('LARAVEL_START', microtime(true));

/*
|--------------------------------------------------------------------------
| STEP 2: Check If The Application Is Under Maintenance
|--------------------------------------------------------------------------
| 
| Before we do anything else, check if the app is in maintenance mode.
| If it is, show a maintenance page instead of loading the full app.
| This prevents users from accessing the site during updates/fixes.
| Command: php artisan down (puts site in maintenance)
| Command: php artisan up (brings site back online)
|
*/

if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

/*
|--------------------------------------------------------------------------
| STEP 3: Load All Required Classes (Autoloader)
|--------------------------------------------------------------------------
|
| Composer's autoloader lets us use classes without manually including files.
| When we reference a class like "UserController", it automatically finds
| and loads the file. This makes our code cleaner and more organized.
| All classes in vendor/ and app/ folders get auto-loaded.
|
*/

require __DIR__.'/../vendor/autoload.php';

/*
|--------------------------------------------------------------------------
| STEP 4: Bootstrap The Laravel Application
|--------------------------------------------------------------------------
|
| Now we create the main Laravel application instance. This sets up all
| the core services, binds them to the container, and prepares everything
| we need to handle web requests. 
| 
| NEXT: This goes to bootstrap/app.php to set up the application
|
*/

$app = require_once __DIR__.'/../bootstrap/app.php';

/*
|--------------------------------------------------------------------------
| STEP 5: Handle The Incoming Request
|--------------------------------------------------------------------------
|
| Here's where the request processing happens:
| 1. Get the HTTP kernel (handles web requests vs console commands)
| 2. Capture the current request (URL, method, POST data, headers, etc.)
| 3. Process through middleware (auth, CSRF protection, etc.)
| 4. Match the route and call the appropriate controller
| 5. Generate a response (HTML page, JSON data, file download, etc.)
| 6. Send response back to user's browser
| 7. Clean up and run termination tasks
|
*/

$kernel = $app->make(Kernel::class);

// Capture what the user requested (GET /home, POST /login, etc.)
$response = $kernel->handle(
    $request = Request::capture()
)->send();

// Clean up resources and run any final tasks (like logging, cleanup)
$kernel->terminate($request, $response);