const {mix} = require('laravel-mix');
const BundleAnalyzerPlugin = require('webpack-bundle-analyzer').BundleAnalyzerPlugin;
const FontelloPlugin = require("fontello-webpack-plugin");

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

mix.webpackConfig({
    plugins: [
        // new BundleAnalyzerPlugin(),
        new FontelloPlugin({
            config: require("./fontello.config.json"),
            output: {
                css: '/css/icons.css',
                font: '/fonts/vendor/fontello/[name].[ext]'
            }
        })
    ],
});

mix.js('resources/assets/js/app.js', 'public/js')
    .sass('resources/assets/sass/app.scss', 'public/css').browserSync({
    proxy: 'larabid.test',
    notify: false
});

if (mix.inProduction()) {
    mix.version();
}