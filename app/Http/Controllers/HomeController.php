<?php

namespace App\Http\Controllers;

/*
|--------------------------------------------------------------------------
| CONTROLLER: HomeController
|--------------------------------------------------------------------------
|
| This file is reached when a route in routes/web.php points to it.
| 
| Controllers contain the logic for what happens when someone visits
| a specific URL. Think of them as the "brains" that decide what to
| show the user.
|
| FLOW: Route -> Controller Method -> Model (if needed) -> View
| Example: /home -> HomeController@index -> User model -> home.blade.php
|
*/

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | METHOD: index() - Display the Homepage
    |--------------------------------------------------------------------------
    |
    | This method is called when someone visits the homepage route.
    | It's the most common pattern: each URL typically has an "index" method
    | that shows the main page for that section.
    |
    | NEXT: Usually returns a view (HTML template) that gets displayed
    |       to the user's browser
    |
    */
    public function index()
    {
        // STEP 1: Get any data we need (from database, APIs, etc.)
        // For example: $users = User::all(); // Get all users from database
        
        // STEP 2: Pass data to a view template and display it
        // The view() function looks for resources/views/hero.blade.php
        return view('hero', [
            'title' => 'Welcome to Elektra Fitness',
            'message' => 'Your fitness journey starts here!'
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | METHOD: about() - Display About Page
    |--------------------------------------------------------------------------
    |
    | Another example method. Each method in a controller typically
    | corresponds to a different page or action on your website.
    |
    */
    public function about()
    {
        // You can return different types of responses:
        
        // 1. A view (most common for web pages)
        return view('about');
        
        // 2. JSON data (for APIs)
        // return response()->json(['status' => 'success']);
        
        // 3. Redirect to another page
        // return redirect('/home');
        
        // 4. Download a file
        // return response()->download($pathToFile);
    }

    /*
    |--------------------------------------------------------------------------
    | METHOD: store() - Handle Form Submissions
    |--------------------------------------------------------------------------
    |
    | This method would handle POST requests (form submissions).
    | It receives the form data, processes it, and usually saves it
    | to the database.
    |
    */
    public function store(Request $request)
    {
        // STEP 1: Validate the incoming data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
        ]);

        // STEP 2: Save to database (example)
        // User::create($validatedData);

        // STEP 3: Redirect with success message
        return redirect('/')->with('success', 'Thank you for joining!');
    }
}