const gulp = require('gulp');
const sass = require('gulp-sass');
const cleanCss = require('gulp-clean-css')
const rename = require('gulp-rename');
const {series, parallel, watch} = require('gulp');

// Sass to css converter.
function compileSass() {
  return gulp.src('assets/sass/**/*.scss')
    .pipe(sass().on('error', sass.logError))
    .pipe(gulp.dest('assets/dist'));
}

// Minify css, place in .min.css file.
function minifyCss() {
  return gulp.src('assets/dist/index.css')
    .pipe(cleanCss())
    .pipe(rename({
      suffix: '.min'
    }))
    .pipe(gulp.dest('assets/dist'))
}


exports.build = series(
  parallel(compileSass, minifyCss),
);

exports.default = function () {
  watch('assets/sass/**/*.scss', series(compileSass, minifyCss));
};
