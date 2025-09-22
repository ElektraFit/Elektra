# Elektra
Elektra, a web application that offers a personalized fitness experience for all.

## Overview
ElektraFit is a fitness website that offers gym memberships and classes. It offers a personalized experience that allows users to create their accounts, securely log in, pay for memberships and classes as well as receive relevant information in that regard.  

## Setting Up Your Development Environment

Hey there! Before you dive into the code, let's get your development environment ready. Don't worry - we'll walk through this together.

### What You'll Need First

To run this project locally, you'll need a few things installed on your computer:
- Apache (version 2.4 or newer) - this is our web server
- PHP 8.0 or newer - we're using some cool modern PHP features
- Composer - this helps us manage our PHP packages
- SQLite - we use this for our local database (it's simpler for development)

### Setting Up Apache

First, let's get Apache working with PHP. The hardest part of setting up a Laravel project is usually getting your web server configured correctly. Here's how to do it:

1. Open your Apache configuration file (httpd.conf). You'll find it in your Apache installation directory under the 'conf' folder. 

2. Look for the section with module loading. We need to enable two important modules:
   ```apache
   LoadModule rewrite_module modules/mod_rewrite.so
   LoadModule php_module "C:/php/php8apache2_4.dll"  # This path might be different on your computer
   ```
   If these lines are commented out (have a # at the start), remove the #.

3. Now we need to tell Apache how to work with PHP files. Add these lines to your httpd.conf:
   ```apache
   AddHandler application/x-httpd-php .php
   AddType application/x-httpd-php .php .html
   PHPIniDir "C:\php"  # Point this to where you installed PHP
   DirectoryIndex index.php
   ```
   This tells Apache "when you see a PHP file, use PHP to process it."

4. Here's the most important part - we need to allow Laravel to manage URLs its own way. Find the section in httpd.conf that looks like this:
   ```apache
   <Directory "your_apache_root/htdocs">
       Options Indexes FollowSymLinks
       AllowOverride All  # This is the key setting we need
       Require all granted
   </Directory>
   ```
   The `AllowOverride All` line is super important - it lets Laravel handle URLs in a clean, user-friendly way.

### Getting the Project Ready

Now that Apache's configured, let's set up the actual project. You'll do this part whenever you're setting up a new copy of the project.

1. First, get the code onto your computer. Go to your Apache's htdocs folder and clone the project:
   ```bash
   cd your_apache_root/htdocs
   git clone [repository_url] elektra
   ```

2. The project needs some libraries to work. Move into the project folder and let Composer install them:
   ```bash
   cd elektra
   composer install
   ```
   This might take a minute - Composer is downloading all the packages we need.

3. Every Laravel project needs a configuration file. We have an example one that you'll need to copy:
   ```bash
   cp .env.example .env
   ```
   Open the new .env file and update these settings for local development:
   ```env
   DB_CONNECTION=sqlite
   DB_DATABASE=absolute_path_to_database.sqlite
   SESSION_DRIVER=file
   CACHE_DRIVER=file
   ```
   This sets up a simple SQLite database - perfect for development.

4. Let's create that database and set up its structure:
   ```bash
   touch database/database.sqlite  # Creates the database file
   php artisan migrate  # Sets up all the tables we need
   ```

5. Last step! Make sure these folders are writable by your web server:
   - storage/ (Laravel needs this for logs and cache)
   - bootstrap/cache/ (for performance optimizations)
   - database/database.sqlite (your database file)

### Making Sure Everything Works

Let's check if everything's set up correctly:

1. Open your web browser and try these addresses:
   - http://localhost/ - You should see a list of folders (directory listing)
   - http://localhost/elektra/public/ - This should show our application

2. Try a few Laravel commands to make sure PHP and Laravel are happy together:
   ```bash
   php artisan --version  # This should tell you what version of Laravel you're running
   ```

### Troubleshooting

Sometimes things don't work on the first try. Here's how to fix common problems:

If you see a 500 Server Error:
- Look in your PHP error log (usually in Apache's logs folder)
- Double-check that you copied the .env file
- Make sure those folders we mentioned are writable

If you get a 404 Not Found:
- Check that mod_rewrite is enabled in Apache
- Make sure the .htaccess file exists in the public/ folder
- Verify you set AllowOverride All in httpd.conf

If you see a blank page:
- Check your PHP memory limit in php.ini - Laravel needs at least 128M
- Look at storage/logs/laravel.log for any errors

### Daily Development

Once everything's set up, here's your daily workflow:

1. Your code lives in your Apache htdocs folder: `your_apache_root/htdocs/elektra`
2. Keep Apache running while you're working
3. If you make changes to configuration or routes, clear Laravel's cache:
   ```bash
   php artisan config:clear
   php artisan cache:clear
   php artisan view:clear
   ```

That's it! You're ready to start coding. Remember, if you get stuck, check those error logs - they're your best friend for figuring out what went wrong.


## User Authentication with 2FA
A simple user flow for this functionality looks like this: 

<img width="1197" height="232" alt="image" src="https://github.com/user-attachments/assets/9809e1c9-0cb2-4a5c-9b8d-67c712fd6dab" />

A user is able to register a new account using a "Sign Up" functionality. This then takes them to the sign up page where they enter their details(full names, password etc) that are essential in user registration. They then accept the EULA terms and conditions and register the account.
Next the user is able to login using their email and password of their account. They receive an email to their registered email where they get an OTP that they enter in the app to be verified. **This is 2 factor authentication**
Afterwards they are presented with a dashboard which they use to navigate various functinoalities offered by the app. They can get memberships, register for classes, view their ongoing memberships and classes.
Next the user is able to login using their email and password of their account. They receive an email to their registered email where they get an OTP that they enter in the app to be verified. This is 2 factor authentication.
Afterwards, users are presented with a dashboard which they use to navigate various functinoalities offered by the app. They can get memberships, register for classes, view their ongoing memberships and classes.

