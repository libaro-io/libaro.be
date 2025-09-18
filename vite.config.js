import { tailwindReferencePlugin } from '@libaro-io/libaro-utilities';
import { defineConfig } from 'vite';
import * as path from "node:path";
import laravel from "laravel-vite-plugin";
import vue from "@vitejs/plugin-vue";
import tailwindcss from "@tailwindcss/vite";
export default defineConfig({
    resolve: {
        alias: {
            '@css': path.resolve(__dirname, 'resources/css'),
            '@layouts': path.resolve(__dirname, 'resources/js/layouts'),
            '@components': path.resolve(__dirname, 'resources/js/components'),
            '@pages': path.resolve(__dirname, 'resources/js/pages'),
            '@assets': path.resolve(__dirname, 'resources/assets'),
        },
    },
    plugins: [
        tailwindReferencePlugin(),
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        vue(),
        tailwindcss(),
    ],
});
