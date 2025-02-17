const gulp = require('gulp');
const uglify = require('gulp-uglify');
const cssnano = require('gulp-cssnano');
const concat = require('gulp-concat');

// Task to minify JavaScript files
gulp.task('minify-js', () => {
  return gulp.src('scripts/*.js') // Adjust the source path to your scripts directory
    .pipe(uglify())
    .pipe(concat('all.min.js'))
    .pipe(gulp.dest('dist')); // Adjust the destination path as needed
});

// Task to minify CSS files
gulp.task('minify-css', () => {
  return gulp.src('styles/*.css') // Adjust the source path to your styles directory
    .pipe(cssnano())
    .pipe(concat('all.min.css'))
    .pipe(gulp.dest('dist')); // Adjust the destination path as needed
});

// Default task to run both minify tasks
gulp.task('default', gulp.parallel('minify-js', 'minify-css'));
