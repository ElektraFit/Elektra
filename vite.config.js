import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/hero.css',
                'resources/css/shared.css',
                'resources/css/auth.css',
                'resources/css/dashboard.css',
                'resources/css/dashboard-views.css',
                'resources/css/training-sessions.css',
                'resources/js/app.js',
                'resources/js/dashboard-navigation.js'
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
