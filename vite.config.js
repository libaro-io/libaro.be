import { tailwindReferencePlugin } from '@libaro-io/libaro-utilities';
import { defineConfig, loadEnv } from 'vite';
import * as path from "node:path";
import laravel from "laravel-vite-plugin";
import vue from "@vitejs/plugin-vue";
import { run } from "vite-plugin-run";
import tailwindcss from "@tailwindcss/vite";
import i18n from "laravel-vue-i18n/vite";

const env = loadEnv("", "");

const getPHPPrefix = () => {
    if (env.VITE_DOCKERIZED) {
        return ["docker", "compose", "exec", "php"];
    }

    if (env.VITE_HERD) {
        return ["herd"];
    }

    return [];
};

const phpPrefix = getPHPPrefix();

export default defineConfig({
    resolve: {
        alias: {
            '@css': path.resolve(__dirname, 'resources/css'),
            '@layouts': path.resolve(__dirname, 'resources/js/layouts'),
            '@components': path.resolve(__dirname, 'resources/js/components'),
            '@composables': path.resolve(__dirname, 'resources/js/composables'),
            '@pages': path.resolve(__dirname, 'resources/js/pages'),
            '@assets': path.resolve(__dirname, 'resources/assets'),
            '@actions': path.resolve(__dirname, 'resources/js/actions'),
            '@enums': path.resolve(__dirname, 'resources/js/enums'),
            '@interfaces': path.resolve(__dirname, 'resources/js/interfaces'),
        },
    },
    build: {
        rollupOptions: {
            output: {
                manualChunks: (id) => {
                    // Only chunk for client-side builds, not SSR
                    if (id.includes('node_modules')) {
                        if (id.includes('vue-i18n') || id.includes('laravel-vue-i18n')) {
                            return 'i18n';
                        }
                        if (id.includes('vue-recaptcha-v3')) {
                            return 'recaptcha';
                        }
                        if (id.includes('vue3-toastify')) {
                            return 'toastify';
                        }
                        return 'vendor';
                    }
                }
            }
        }
    },
    plugins: [
        run([
            {
                name: "wayfinder",
                run: [...phpPrefix, "php", "artisan", "wayfinder:generate"],
                pattern: ["routes/**/*.php", "app/**/Http/**/*.php"],
                build: false,
            },
            {
                name: "translations-js",
                run: [...phpPrefix, "php", "artisan", "vte:export"],
                pattern: ["lang/**/*.php"],
                build: false,
            },
        ]),
        tailwindReferencePlugin(),
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            ssr: 'resources/js/ssr.ts',
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
        tailwindcss(),
        i18n(),
    ],
});
