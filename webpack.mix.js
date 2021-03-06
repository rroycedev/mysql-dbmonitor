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

mix
     /* CSS */
     .sass('resources/assets/sass/main.scss', 'public/css/dashmix.css')
     .sass('resources/assets/sass/dashmix/themes/xeco.scss', 'public/css/themes/')
     .sass('resources/assets/sass/dashmix/themes/xinspire.scss', 'public/css/themes/')
     .sass('resources/assets/sass/dashmix/themes/xmodern.scss', 'public/css/themes/')
     .sass('resources/assets/sass/dashmix/themes/xsmooth.scss', 'public/css/themes/')
     .sass('resources/assets/sass/dashmix/themes/xwork.scss', 'public/css/themes/')

     /* JS */
     .js('resources/assets/js/laravel/app.js', 'public/js/laravel.app.js')
     .js('resources/assets/js/dashmix/app.js', 'public/js/dashmix.app.js')
     .js('resources/assets/js/semaphore.js', 'public/js/semaphore.js')


     .copy('resources/assets/images', 'public/images')
     .copy('node_modules/bootstrap-vue/dist/bootstrap-vue.css', 'public/css')
     .copy('node_modules/chart.js/dist/Chart.bundle.min.js', 'public/js')

     /* Tools */
     .browserSync('localhost:8000')
     .disableNotifications()

     /* Options */
     .options({
          processCssUrls: false
     });