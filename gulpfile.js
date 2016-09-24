var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

// elixir(function(mix) {
//     mix.sass('app.scss');
// });

elixir.config.sourcemaps = false;

elixir(function(mix) {
    mix.styles([
        'bootstrap.css',
        'bootstrap-theme.css',
        'custom.css',
        'jquery-ui.css',
        '../js/dhtmlxCombo/codebase/dhtmlxcombo.css',
    ], 'assets/dist/css');
});

elixir(function(mix) {
    mix.scripts([
        'jquery.min.js',
        'jquery-ui.js',
        'bootstrap.min.js',
        'jquery.maskMoney.min.js',
        'dhtmlxCombo/codebase/dhtmlxcombo.js',
        'common.js'
    ], 'assets/dist/js');
});