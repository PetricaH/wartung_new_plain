const gulp = require('gulp');
const uglify = require('gulp-uglify');
const cssnano = require('gulp-cssnano');
const rename = require('gulp-rename');

// Task to minify JavaScript files individually
gulp.task('minify-js', () => {
  return gulp.src('scripts/*.js') // Adjust the source path to your scripts directory
    .pipe(uglify())
    .pipe(rename({ suffix: '.min' })) // Append .min to each file
    .pipe(gulp.dest('dist/scripts')); // Output to a separate directory
});

// Task to minify CSS files individually
gulp.task('minify-css', () => {
  return gulp.src('styles/*.css') // Adjust the source path to your styles directory
    .pipe(cssnano())
    .pipe(rename({ suffix: '.min' })) // Append .min to each file
    .pipe(gulp.dest('dist/styles')); // Output to a separate directory
});

// Default task to run both minify tasks in parallel
gulp.task('default', gulp.parallel('minify-js', 'minify-css'));
