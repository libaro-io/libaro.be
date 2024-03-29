const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
  .js('resources/js/service-worker.js', 'public/service-worker.js')
  .js('resources/js/playground/logo-3d.js', 'public/js/playground')
  .postCss('resources/css/app.css', 'public/css', [
    require('tailwindcss')
  ])
  .copyDirectory('resources/assets/fonts/', 'public/fonts');

if (mix.inProduction()) {
    mix.version();
}
