const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');

//No reload page on development
mix.browserSync({
    open: 'external',
    host: 'ia-calendar.com',
    proxy: 'ia-calendar.com',
    files: [
        'resources/views/**/*.php',
        'app/**/*.php',
        'routes/**/*.php',
        'public/js/*.js',
        'public/css/*.css'
    ],
    browser: '/usr/lib/firefox-developer-edition/firefox',
    port: 3000
});
