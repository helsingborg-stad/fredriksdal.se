// Include gulp
var gulp = require('gulp');

// Include Our Plugins
var sass 			= require('gulp-sass');
var concat 			= require('gulp-concat');
var uglify 			= require('gulp-uglify');
var cssnano 		= require('gulp-cssnano');
var rename 			= require('gulp-rename');
var autoprefixer 	= require('gulp-autoprefixer');
var browserSync = require('browser-sync').create();


// Compile Our Sass
gulp.task('sass-dist', function() {
    return gulp.src('assets/source/sass/app.scss')
            .pipe(sass())
            .pipe(autoprefixer('last 2 version', 'safari 5', 'ie 8', 'ie 9', 'opera 12.1'))
            .pipe(rename({suffix: '.min'}))
            .pipe(cssnano({
                mergeLonghand: false,
                zindex: false
            }))
            .pipe(gulp.dest('assets/dist/css'))
            .pipe(browserSync.stream());
});

gulp.task('sass-dev', function() {
    return gulp.src('assets/source/sass/app.scss')
            .pipe(sass())
            .pipe(autoprefixer('last 2 version', 'safari 5', 'ie 8', 'ie 9', 'opera 12.1'))
            .pipe(rename({suffix: '.dev'}))
            .pipe(gulp.dest('assets/dist/css'))
            .pipe(browserSync.stream());
});

// Concatenate & Minify JS
gulp.task('scripts-dist', function() {
    return gulp.src(['assets/source/js/vendor/*.js', 'assets/source/js/*.js'])
            .pipe(concat('app.js'))
            .pipe(gulp.dest('assets/dist/js'))
            .pipe(rename('app.min.js'))
            .pipe(uglify())
            .pipe(gulp.dest('assets/dist/js'));
});

// Watch Files For Changes
gulp.task('watch', function() {
    gulp.watch('assets/source/js/**/*.js', ['scripts-dist']);
    gulp.watch('assets/source/sass/**/*.scss', ['sass-dist', 'sass-dev']);
});

// Default Task
gulp.task('default', ['sass-dist', 'sass-dev', 'scripts-dist', 'watch']);

//BrowserSync
gulp.task('browser-sync', function() {
    browserSync.init({
        proxy: "https://fredriksdal.dev",
        https: true
    });
});

//Watch with BrowserSync
gulp.task('watch-bs', ['browser-sync'], function () {
    gulp.watch('assets/source/js/**/*.js', ['scripts-dist', browserSync.reload]);
    gulp.watch('assets/source/sass/**/*.scss', ['sass-dist', 'sass-dev']);

});
