import gulp, { src, series, parallel, dest } from 'gulp';
import sass from 'gulp-sass';
import del from 'del';
import notify from 'gulp-notify';
import uglify from 'gulp-uglify';
import concat from 'gulp-concat';
import babel from 'gulp-babel';
import webpack from 'webpack-stream';

const paths = {
	root: './',
	assets: './assets',
	node_modules: './node_modules',
	sass: './assets/sass',
	js: './assets/js',
	img: './assets/img',
	ico: './assets/ico',
	create: './create',
	dist: './dist',
	includes: './includes',
};

/**
 * Sass compiler
 */
function sassCompiler() {
	return src([paths.sass + '/main.scss'])
		.pipe(
			sass({ outputStyle: 'compressed' }).on(
				'error',
				notify.onError(function (error) {
					return 'Error: ' + error.message;
				})
			)
		)
		.pipe(concat('main.css'))
		.pipe(dest(paths.dist + '/css'));
}

/**
 * JS compiler
 */
function jsCompiler() {
	return src([paths.js + '/main.js'])
		.pipe(
			webpack({
				output: {
					filename: 'main.min.js',
				},
			})
		)
		.pipe(
			babel({
				presets: ['@babel/env'],
			})
		)
		.pipe(uglify())
		.pipe(dest(paths.dist + '/js'));
}

/**
 * JS libs copy
 */
function copyLibs() {
	return true;
	// return src([])
	// 	.pipe(fileinclude())
	// 	.pipe(dest(paths.dist + '/js/vendor'));
}

/**
 * Copy files in dist
 */
function copyImages() {
	return src([paths.img + '/**/*.*']).pipe(dest(paths.dist + '/img'));
}

function copyIco() {
	return src([paths.ico + '/**/*.*']).pipe(dest(paths.dist + '/ico'));
}

function copyFonts() {
	return src([paths.fonts + '/**/*.*']).pipe(dest(paths.dist + '/fonts'));
}

/**
 * Clean
 */
function clean(cb) {
	del([paths.dist + '/css']);
	cb();
}

/**
 * Watch
 */
function watchFiles(cb) {
	gulp.watch([paths.sass + '/**/*.scss'], series(sassCompiler));
	gulp.watch([paths.js + '/*.js'], series(jsCompiler));
	cb();
}

const build = series(
	clean,
	copyImages,
	copyIco,
	parallel(sassCompiler, jsCompiler)
);
const watch = parallel(watchFiles);

exports.build = build;
exports.watch = watch;
exports.clean = clean;

exports.default = series(build, watch);
