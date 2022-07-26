let mix = require('laravel-mix');

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

mix.js('resources/assets/js/app.js', 'public/js')
    .sass('resources/assets/sass/global.scss', 'public/css')
    .sass('resources/assets/sass/christkindli.scss', 'public/css')
    .sass('resources/assets/sass/winhuus.scss', 'public/css')
    .copyDirectory('resources/assets/img', 'public/img')
    .copyDirectory('resources/assets/font', 'public/font');
