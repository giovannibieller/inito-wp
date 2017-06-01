var gulp = require('gulp'),
    sass = require('gulp-sass'),
    autoprefixer = require('gulp-autoprefixer'),
    del = require('del'),
    notify = require('gulp-notify'),
    uglify = require('gulp-uglify'),
    concat = require('gulp-concat'),
    rename = require('gulp-rename'),
    runSequence = require('run-sequence');

/**
 * Sass init
 */
gulp.task('sass', function() {
    return gulp
        .src(['./assets/sass/main.scss'])
        .pipe(
            sass({ outputStyle: 'compressed' }).on(
                'error',
                notify.onError(function(error) {
                    return 'Error: ' + error.message;
                })
            )
        )
        .pipe(gulp.dest('./dist/css'));
});

/**
 * JS init
 */
gulp.task('js', function() {
    return gulp
        .src(['./assets/js/main.js'])
        .pipe(concat('main.js'))
        .pipe(uglify())
        .pipe(
            rename({
                suffix: '.min'
            })
        )
        .pipe(gulp.dest('./dist/js'));
});

gulp.task('copy-js', function() {
    return gulp.src([]).pipe(gulp.dest('./dist/js/vendor'));
});

/**
 * Copy files in dist
 */
var imagemin = require('gulp-imagemin'), pngquant = require('imagemin-pngquant');

gulp.task('copy-images', function() {
    return gulp
        .src(['./assets/img/**/*.*'])
        .pipe(
            imagemin({
                progressive: true,
                svgoPlugins: [{ removeViewBox: false }],
                use: [pngquant()]
            })
        )
        .pipe(gulp.dest('./dist/img'));
});

gulp.task('copy-ico', function() {
    return gulp.src(['./assets/ico/**/*.*']).pipe(gulp.dest('./dist/ico'));
});

gulp.task('copy-fonts', function() {
    return gulp.src(['./assets/fonts/**/*.*']).pipe(gulp.dest('./dist/fonts'));
});

/**
 * Del folder
 */
gulp.task('clean-dist', del.bind(null, ['./dist/css']));

/**
 * Tasks
 */
gulp.task('default', ['dist']);

/**
 * Watch
 */
gulp.task('watch', ['copy-images', 'copy-ico'], function() {
    gulp.watch(['./assets/sass/**/*.scss'], ['sass']);
    gulp.watch(['./assets/js/*.js'], ['js']);
});

/**
 * Dist
 */
gulp.task('dist', ['clean-dist'], function(cb) {
    runSequence('copy-images', 'copy-js', 'copy-ico', 'sass', 'js', cb);
});
