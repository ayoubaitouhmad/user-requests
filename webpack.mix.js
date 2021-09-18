let mix = require('laravel-mix');
let minifier = require('minifier');
mix.setPublicPath('public');



mix.js('resources/assets/js/app.js', 'public/js/app.js')
mix.autoload({
    jquery: ['$', 'window.jQuery'],
    axios: ['axios', 'window.axios']
});



mix.sass('resources/assets/sass/app.scss', 'public/css/app.css')
    .options({
        postCss: [
            require('autoprefixer')
        ]
    })
    .then(() => {
        minifier.minify('public/css/app.css');
    });





