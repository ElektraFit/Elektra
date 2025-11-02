# ElektraFit - Laravel Application Flow

## 🔄 Request Lifecycle (How a Page Load Works)

When someone visits your website, here's the exact order of what happens:

### 1. **Entry Point** → `public/index.php`
- **What happens**: User types URL in browser or clicks a link
- **Purpose**: This is the first file that runs for EVERY request
- **Next step**: Loads the Laravel framework and passes control to it

### 2. **Bootstrap** → `bootstrap/app.php` 
- **What happens**: Sets up the Laravel application container
- **Purpose**: Configures services, middleware, exception handling, and routes
- **Next step**: Returns the configured app back to `index.php`

### 3. **Route Matching** → `routes/web.php`
- **What happens**: Laravel looks at the URL and finds the matching route
- **Purpose**: Determines which controller method should handle this request
- **Example**: `/` → shows homepage, `/login` → shows login form
- **Next step**: Calls the appropriate controller method OR closure function

### 4. **Controller Logic** → `app/Http/Controllers/`
- **What happens**: Business logic executes (database queries, calculations, etc.)
- **Purpose**: Processes the request and prepares data for the view
- **Example**: `HomeController@index` gets user data and passes it to view
- **Next step**: Returns a view with data

### 5. **View Rendering** → `resources/views/`
- **What happens**: Blade template processes and generates HTML
- **Purpose**: Combines your template with data to create final webpage
- **Example**: `hero.blade.php` displays user's name, stats, etc.
- **Next step**: HTML is sent back to user's browser

### 6. **Response** → Back to Browser
- **What happens**: User sees the final webpage
- **Purpose**: Complete the request cycle
- **What user sees**: Styled HTML page with their data

---

## 📁 File Structure Overview

```
elektra/
├── public/
│   └── index.php          # 🚪 Entry point - EVERY request starts here
├── bootstrap/
│   └── app.php            # ⚙️ Configure Laravel application  
├── routes/
│   └── web.php            # 🗺️ URL mapping - which URL goes where
├── app/Http/Controllers/  # 🧠 Business logic for each page
├── resources/views/       # 🎨 HTML templates (what users see)
└── vendor/               # 📚 Laravel framework code
```

---

## 🔧 Making Your Website Work in Apache

To make clicking the folder open your website:

1. **Make sure Apache is running**
2. **Visit**: `http://localhost/elektra/public/`
3. **Or set up a virtual host** to use just `http://elektra.local`

The `public/` folder must be accessible to Apache for security (it prevents direct access to your code files).

---

## 🎯 Common Development Flow

When building features, you typically work in this order:

1. **Route** (`routes/web.php`) - Define the URL
2. **Controller** (`app/Http/Controllers/`) - Handle the logic  
3. **Model** (`app/Models/`) - Database operations (if needed)
4. **View** (`resources/views/`) - What the user sees

**Example**: Building a user profile page:
1. Add route: `Route::get('/profile', [UserController::class, 'show']);`
2. Create method: `UserController@show()` gets user data from database
3. Create model: `User::find($id)` to fetch user information  
4. Create view: `profile.blade.php` to display user information

---

## 🛠️ Helpful Commands

```bash
# Start the development server
php artisan serve

# View all routes
php artisan route:list

# Create a new controller
php artisan make:controller PageController

# Create a new model
php artisan make:model Post

# Clear cache when things get stuck
php artisan cache:clear
```

---

## 📚 Key Laravel Concepts

- **Routes**: Map URLs to actions
- **Controllers**: Contain page logic
- **Views**: HTML templates  
- **Models**: Database interactions
- **Middleware**: Security layers (auth, CSRF, etc.)
- **Blade**: Template engine with `{{ }}` syntax
- **Artisan**: Command-line tool for Laravel tasks

Remember: Follow the flow → Route → Controller → Model → View → Response!