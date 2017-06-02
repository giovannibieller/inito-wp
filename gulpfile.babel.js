'use strict';

import gulp from 'gulp';
import sass from 'gulp-sass';
import autoprefixer from 'gulp-autoprefixer';
import del from 'del';
import notify from 'gulp-notify';
import uglify from 'gulp-uglify';
import concat from 'gulp-concat';
import rename from 'gulp-rename';
import runSequence from 'run-sequence';
import imagemin from 'gulp-imagemin';
import pngquant from 'imagemin-pngquant';
import babel from 'gulp-babel';
import print from 'gulp-print';

const paths = {
    sass: './assets/sass',
    js: './assets/js',
    img: './assets/img',
    ico: './assets/ico',
    dist: './dist'
};

/**
 * Sass init
 */
gulp.task('sass', () => {
    return gulp
        .src([paths.sass + '/main.scss'])
        .pipe(
            sass({ outputStyle: 'compressed' }).on(
                'error',
                notify.onError(error => {
                    return 'Error: ' + error.message;
                })
            )
        )
        .pipe(gulp.dest(paths.dist + '/css'));
});

/**
 * JS init
 */
gulp.task('js', () => {
    return gulp
        .src([paths.js + '/main.js'])
        .pipe(print())
        .pipe(babel({ presets: ['es2015'] }))
        .pipe(concat('main.js'))
        .pipe(uglify())
        .pipe(
            rename({
                suffix: '.min'
            })
        )
        .pipe(gulp.dest(paths.dist + '/js'));
});

gulp.task('copy-js', () => {
    return gulp
        .src(
            [
                /*array of vendor scripts*/
            ]
        )
        .pipe(gulp.dest(paths.dist + '/js/vendor'));
});

/**
 * Copy files in dist
 */
gulp.task('copy-images', () => {
    return gulp
        .src([paths.img + '/**/*.*'])
        .pipe(
            imagemin({
                progressive: true,
                svgoPlugins: [{ removeViewBox: false }],
                use: [pngquant()]
            })
        )
        .pipe(gulp.dest(paths.dist + '/img'));
});

gulp.task('copy-ico', () => {
    return gulp.src([paths.ico + '/**/*.*']).pipe(gulp.dest(paths.dist + '/ico'));
});

gulp.task('copy-fonts', () => {
    return gulp.src([paths.fonts + '/**/*.*']).pipe(gulp.dest(paths.dist + '/fonts'));
});

/**
 * Del folder
 */
gulp.task('clean-dist-css', del.bind(null, [paths.dist + '/css']));

/**
 * Tasks
 */
gulp.task('default', ['dist']);

/**
 * Watch
 */
gulp.task('watch', ['copy-images', 'copy-ico'], () => {
    gulp.watch([paths.sass + '/**/*.scss'], ['sass']);
    gulp.watch([paths.js + '/*.js'], ['js']);
});

/**
 * Dist
 */
gulp.task('dist', ['clean-dist-css'], cb => {
    runSequence('copy-images', 'copy-js', 'copy-ico', 'sass', 'js', cb);
});

/**
 * Create Theme
 */
gulp.task('create-theme', ['dist'], () => {});
