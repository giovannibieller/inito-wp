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
import prompt from 'gulp-prompt';
import fs from 'node-fs';
import jsonmod from 'gulp-json-modify';
import replace from 'gulp-replace';

const paths = {
    root: './',
    assets: './assets',
    node_modules: './node_modules',
    sass: './assets/sass',
    js: './assets/js',
    img: './assets/img',
    ico: './assets/ico',
    create: './create',
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
gulp.task('create-theme', () => {
    gulp.src([paths.root]).pipe(
        prompt.prompt(
            [
                {
                    type: 'input',
                    name: 'name',
                    message: 'name'
                },
                {
                    type: 'input',
                    name: 'version',
                    message: 'version',
                    default: '1.0.0'
                },
                {
                    type: 'input',
                    name: 'description',
                    message: 'description',
                    default: ''
                },
                {
                    type: 'input',
                    name: 'author',
                    message: 'author',
                    default: 'giovanni.bieller@gmail.com'
                }
            ],
            res => {
                let formName = res.name.replace(/\s/g, '-').toLowerCase();
                let destPath = paths.create + '/' + formName;

                let changeName = () => {
                    gulp
                        .src([paths.root + 'package.json'])
                        .pipe(
                            jsonmod({
                                key: 'name',
                                value: formName
                            })
                        )
                        .pipe(
                            jsonmod({
                                key: 'themeName',
                                value: res.name
                            })
                        )
                        .pipe(
                            jsonmod({
                                key: 'description',
                                value: res.description
                            })
                        )
                        .pipe(
                            jsonmod({
                                key: 'version',
                                value: res.version
                            })
                        )
                        .pipe(
                            jsonmod({
                                key: 'author',
                                value: res.author
                            })
                        )
                        .pipe(gulp.dest(destPath));
                };

                let changeThemeName = () => {
                    gulp
                        .src([paths.root + 'style.css'])
                        .pipe(replace('WP Boilerplate Theme', res.name))
                        .pipe(replace('Version: 1.0', 'Version: ' + res.version))
                        .pipe(replace('Description: ', 'Description: ' + res.description))
                        .pipe(gulp.dest(destPath));
                };

                let copyFiles = () => {
                    gulp
                        .src([
                            paths.root + '**/**/*.*',
                            paths.root + '.babelrc',
                            paths.root + '.gitignore',
                            '!' + paths.node_modules + '/**',
                            '!' + paths.dist + '/**',
                            '!' + paths.root + 'package.json',
                            '!' + paths.root + 'style.css'
                        ])
                        .pipe(gulp.dest(destPath));
                };

                del([destPath]).then(copyFiles).then(changeName).then(changeThemeName);
            }
        )
    );
});
