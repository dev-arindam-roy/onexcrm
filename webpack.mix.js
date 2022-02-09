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

/** Main ROOT JS */
mix.js([
    'resources/js/app.js',
], 'public/js')
    .vue()
    .sourceMaps()
    .version();
/**=============================================================================================== */


/** STYLE SHEETS | CSS | SCSS */
/** MAIN ROOT CSS */
mix.styles([
    'resources/css/app.css',
], 'public/css/app.css')
    .sourceMaps()
    .copyDirectory('resources/css/fonts/', 'public/fonts/')
    .copyDirectory('resources/audio/', 'public/audio/')
    .version();

/** MODULE CSS*/
mix.styles([
    'resources/css/server.css'
], 'public/css/server-module.min.css')
    .sourceMaps()
    .version();

//mix.sass();
