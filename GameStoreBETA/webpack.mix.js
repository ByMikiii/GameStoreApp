const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js').vue()
  .postCss('resources/css/app.css', 'public/css', [
    require('tailwindcss')]);


mix.browserSync({
  proxy: 'http://127.0.0.1:8000',
  notify: false
});