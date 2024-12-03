'use strict';

var gulp = require('gulp'),
    watch = require('gulp-watch'),
    prefixer = require('gulp-autoprefixer'),
    uglify = require('gulp-uglify'),
    sass = require('gulp-sass'),
    cssimport = require("gulp-cssimport"),
    sourcemaps = require('gulp-sourcemaps'),
    rigger = require('gulp-rigger'),
    cssmin = require('gulp-minify-css'),
    rimraf = require('rimraf'),
    rename = require('gulp-rename');

var path = {
    build: {
        js: '../js/web/',
        css: '../css/web/',
        fonts: '../css/web/fonts/'
    },
    src: {
        js: 'scripts/default.js',
        style: 'styles/default.scss',
        fonts: 'fonts/**/*.*'
    },
    watch: {
        js: 'scripts/**/*.js',
        style: 'styles/**/*.scss',
        fonts: 'fonts/**/*.*'
    }
};

gulp.task('js:build', function () {
    return gulp.src(path.src.js)
        .pipe(rigger())
        .pipe(sourcemaps.init())
        .pipe(uglify())
        //  .pipe(sourcemaps.write())
        //.pipe(rename({suffix: '.min'}))
        .pipe(gulp.dest(path.build.js));
});

gulp.task('style:build', function () {
    return gulp.src(path.src.style)
        .pipe(sourcemaps.init())
        .pipe(sass({
            sourceMap: true,
            errLogToConsole: true
        }))
        .pipe(cssimport())
        .pipe(prefixer())
        .pipe(cssmin())
        //.pipe(sourcemaps.write())
       // .pipe(rename({suffix: '.min'}))
        .pipe(gulp.dest(path.build.css));
});


gulp.task('fonts:build', function () {
    return gulp.src([
        path.src.fonts
    ]).pipe(gulp.dest(path.build.fonts));
});


gulp.task('build', gulp.parallel(
    'js:build',
    'style:build',
    'fonts:build'
));


gulp.task('watch', function () {
    gulp.watch(path.watch.style, gulp.series('style:build'));
    gulp.watch(path.watch.js, gulp.series('js:build'));
    gulp.watch(path.watch.fonts, gulp.series('fonts:build'));
});