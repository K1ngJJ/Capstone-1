const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/dashboard.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .postCss('resources/css/app.css', 'public/css')
    .postCss('resources/css/home.css', 'public/css')
    .postCss('resources/css/backend.css', 'public/css')
    .postCss('resources/css/order.css', 'public/css')
    .postCss('resources/css/menu.css', 'public/css')
    .sourceMaps();
