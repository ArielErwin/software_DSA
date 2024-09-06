import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/routes/routes.scss', 'resources/routes/routes.js'],
            refresh: true,
        }),
    ],
});
