<?php

/*
|--------------------------------------------------------------------------
| BOOTSTRAP: Laravel 11 Application Configuration
|--------------------------------------------------------------------------
|
| This file is called from public/index.php (STEP 4).
| 
| Laravel 11 uses a simplified bootstrap approach. Instead of manually
| binding services, we use the Application::configure() method to set up
| everything in a cleaner, more organized way.
|
*/

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

/*
|--------------------------------------------------------------------------
| STEP 1: Configure the Application
|--------------------------------------------------------------------------
|
| Here we create and configure the Laravel application instance.
| This sets up the foundation for everything else to work.
|
| basePath: Tells Laravel where the root of our project is located
|
*/

return Application::configure(basePath: dirname(__DIR__))
    /*
    |--------------------------------------------------------------------------
    | STEP 2: Configure Routing
    |--------------------------------------------------------------------------
    |
    | Tell Laravel where to find our route definitions:
    | - web: Routes for web browsers (GET /home, POST /login, etc.)
    | - commands: Custom artisan commands (php artisan my:command)
    | - health: Health check endpoint for monitoring (/up shows if app is working)
    |
    | NEXT: When a request comes in, Laravel will check routes/web.php
    |       to find which controller method should handle the request
    |
    */
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    /*
    |--------------------------------------------------------------------------
    | STEP 3: Configure Middleware
    |--------------------------------------------------------------------------
    |
    | Middleware runs before/after your controllers. Think of it like security
    | guards that check requests before they reach your application logic.
    | Examples: authentication, CSRF protection, rate limiting, etc.
    |
    | We can add custom middleware here when needed.
    |
    */
    ->withMiddleware(function (Middleware $middleware) {
        // Custom middleware can be added here
        // $middleware->append(MyCustomMiddleware::class);
    })
    /*
    |--------------------------------------------------------------------------
    | STEP 4: Configure Exception Handling
    |--------------------------------------------------------------------------
    |
    | When something goes wrong (errors, exceptions), this determines how
    | to handle them. Should we show a detailed error page? Log it?
    | Send an email to developers? This is where we configure all that.
    |
    */
    ->withExceptions(function (Exceptions $exceptions) {
        // Custom exception handling can be configured here
        // $exceptions->report(function (Exception $e) { ... });
    })
    /*
    |--------------------------------------------------------------------------
    | STEP 5: Create and Return the Application
    |--------------------------------------------------------------------------
    |
    | Finally, create the configured application instance and return it
    | back to public/index.php where it will start processing the request.
    |
    | NEXT: Back to public/index.php STEP 5 where the request gets processed
    |
    */
    ->create();