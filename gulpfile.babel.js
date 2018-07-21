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
import realFavicon from 'gulp-real-favicon';
import prettify from 'gulp-prettify';

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
    includes: './includes'
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
        .pipe(babel({ presets: ['env'] }))
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
        .src([
            /*array of vendor scripts*/
        ])
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
 * Favicon generator
 */
let FAVICON_DATA_FILE = paths.ico + '/faviconData.json',
    FAVICON_HTML_FILE = paths.includes + '/head.php';

gulp.task('generate-favicon', done => {
    gulp.src([paths.root]).pipe(
        prompt.prompt(
            [
                {
                    type: 'input',
                    name: 'name',
                    message: 'Theme name in manifest.json',
                    default: ''
                },
                {
                    type: 'checkbox',
                    name: 'display',
                    message: 'App display mode',
                    default: 'standalone',
                    choices: ['fullscreen', 'standalone', 'minimal-ui', 'browser']
                },
                {
                    type: 'checkbox',
                    name: 'orientation',
                    message: 'App orientation mode',
                    default: 'notSet',
                    choices: ['notSet', 'landscape', 'portrait']
                },
                {
                    type: 'input',
                    name: 'backgroundColor',
                    message: 'Favicon background color',
                    default: '#ffffff'
                },
                {
                    type: 'checkbox',
                    name: 'margin',
                    message: 'Favicon margin/padding',
                    default: 'y',
                    choices: ['y', 'n']
                },
                {
                    type: 'input',
                    name: 'themeColor',
                    message: 'PWA themeColor',
                    default: '#ffffff'
                },
                {
                    type: 'input',
                    name: 'safariThemeColor',
                    message: 'Favicon Safari theme color',
                    default: '#ffffff'
                }
            ],
            res => {
                realFavicon.generateFavicon(
                    {
                        masterPicture: paths.img + '/favicon/base.png',
                        dest: paths.ico,
                        iconsPath: paths.dist + '/ico',
                        design: {
                            ios: {
                                pictureAspect: 'backgroundAndMargin',
                                backgroundColor: res.backgroundColor,
                                margin: res.margin.toString() === 'y' ? '14%' : '0',
                                assets: {
                                    ios6AndPriorIcons: false,
                                    ios7AndLaterIcons: false,
                                    precomposedIcons: false,
                                    declareOnlyDefaultIcon: true
                                }
                            },
                            desktopBrowser: {},
                            windows: {
                                pictureAspect: 'noChange',
                                backgroundColor: res.backgroundColor,
                                onConflict: 'override',
                                assets: {
                                    windows80Ie10Tile: false,
                                    windows10Ie11EdgeTiles: {
                                        small: false,
                                        medium: true,
                                        big: false,
                                        rectangle: false
                                    }
                                }
                            },
                            androidChrome: {
                                pictureAspect: 'backgroundAndMargin',
                                margin: '17%',
                                backgroundColor: res.backgroundColor,
                                themeColor: res.themeColor,
                                manifest: {
                                    name: res.name,
                                    display: res.display.toString(),
                                    orientation: res.orientation.toString(),
                                    onConflict: 'override',
                                    declared: true
                                },
                                assets: {
                                    legacyIcon: false,
                                    lowResolutionIcons: false
                                }
                            },
                            safariPinnedTab: {
                                pictureAspect: 'blackAndWhite',
                                threshold: 50,
                                themeColor: res.safariThemeColor
                            }
                        },
                        settings: {
                            scalingAlgorithm: 'Mitchell',
                            errorOnImageTooSmall: false
                        },
                        markupFile: FAVICON_DATA_FILE
                    },
                    () => {
                        done();
                    }
                );
            }
        )
    );
});

gulp.task('copy-ico-files', () => {
    return gulp
        .src([paths.ico + '/manifest.json', paths.ico + '/browserconfig.xml'])
        .pipe(gulp.dest(paths.root));
});

gulp.task('inject-favicon-markups', function() {
    let htmlcode = JSON.parse(fs.readFileSync(FAVICON_DATA_FILE)).favicon.html_code.replace(
        /\.\//g,
        '<?php echo $tmpDir;?>/'
    );

    return gulp
        .src([FAVICON_HTML_FILE])
        .pipe(replace('<!-- generated favicons -->', ''))
        .pipe(realFavicon.injectFaviconMarkups('<!-- generated favicons -->\n' + htmlcode + '\n'))
        .pipe(
            replace(
                '<?php echo $tmpDir;?>/dist/ico/browserconfig.xml',
                '<?php echo $tmpDir;?>/browserconfig.xml'
            )
        )
        .pipe(
            replace(
                '<?php echo $tmpDir;?>/dist/ico/browserconfig.xml',
                '<?php echo $tmpDir;?>/browserconfig.xml'
            )
        )
        .pipe(
            replace(
                '<?php echo $tmpDir;?>/dist/ico/manifest.json',
                '<?php echo $tmpDir;?>/manifest.json'
            )
        )
        .pipe(replace('</body>', ''))
        .pipe(replace('</html>', ''))
        .pipe(prettify({ indent_size: 4 }))
        .pipe(gulp.dest(paths.includes));
});

gulp.task('check-for-favicon-update', function(done) {
    var currentVersion = JSON.parse(fs.readFileSync(FAVICON_DATA_FILE)).version;
    realFavicon.checkForUpdates(currentVersion, function(err) {
        if (err) {
            throw err;
        }
    });
});

/**
 * Del folder
 */
gulp.task(
    'clean-ico-files',
    del.bind(null, [paths.ico + '/manifest.json', paths.ico + '/browserconfig.xml'])
);
gulp.task('clean-dist-css', del.bind(null, [paths.dist + '/css']));

/**
 * Tasks
 */
gulp.task('default', ['dist']);

/**
 * Watch
 */
gulp.task('watch', ['copy-images', 'copy-ico', 'copy-js'], () => {
    gulp.watch([paths.sass + '/**/*.scss'], ['sass']);
    gulp.watch([paths.js + '/*.js'], ['js']);
});

/**
 * Favicon
 */
gulp.task('favicons', cb => {
    runSequence(
        'generate-favicon',
        'copy-ico-files',
        'clean-ico-files',
        'inject-favicon-markups',
        cb
    );
});

/**
 * Dist
 */
gulp.task('dist', ['clean-dist-css', 'favicons'], cb => {
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
                    message: 'Theme name'
                },
                {
                    type: 'input',
                    name: 'version',
                    message: 'Theme version',
                    default: '1.0.0'
                },
                {
                    type: 'input',
                    name: 'description',
                    message: 'Theme description',
                    default: ''
                },
                {
                    type: 'input',
                    name: 'author',
                    message: 'Theme author',
                    default: 'giovanni.bieller@gmail.com'
                }
            ],
            res => {
                let formName = res.name.replace(/\s/g, '-').toLowerCase();
                let destPath = paths.create + '/' + formName;

                let changeName = () => {
                    gulp.src([paths.root + 'package.json'])
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
                    gulp.src([paths.root + 'style.css'])
                        .pipe(replace('WP Start Theme', res.name))
                        .pipe(replace('Version: 1.0', 'Version: ' + res.version))
                        .pipe(replace('Description: ', 'Description: ' + res.description))
                        .pipe(gulp.dest(destPath));
                };

                let copyFiles = () => {
                    gulp.src([
                        paths.root + '**/**/*.*',
                        paths.root + '.babelrc',
                        paths.root + '.gitignore',
                        '!' + paths.node_modules + '/**',
                        '!' + paths.dist + '/**',
                        '!' + paths.root + 'package.json',
                        '!' + paths.root + 'style.css'
                    ]).pipe(gulp.dest(destPath));
                };

                del([destPath])
                    .then(copyFiles)
                    .then(changeName)
                    .then(changeThemeName);
            }
        )
    );
});
