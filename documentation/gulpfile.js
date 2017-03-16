var gulp         = require('gulp'),
		sass         = require('gulp-sass'),
		autoprefixer = require('gulp-autoprefixer'),
		cleanCSS    = require('gulp-clean-css'),
		rename       = require('gulp-rename'),
		concat       = require('gulp-concat'),
		uglify       = require('gulp-uglify');


gulp.task('styles', function () {
	return gulp.src('sass/*.sass')
	.pipe(sass({
	// 	includePaths: require('node-bourbon').includePaths
	}).on('error', sass.logError))
	// .pipe(rename({suffix: '.min', prefix : ''}))
	.pipe(concat('style.css'))
	.pipe(autoprefixer({browsers: ['last 15 versions'], cascade: false}))
	.pipe(cleanCSS())
	.pipe(gulp.dest(''))
});

gulp.task('watch', function () {
	gulp.watch('sass/*.sass', ['styles']);
	//gulp.watch('app/libs/**/*.js', ['scripts']);
});

gulp.task('default', ['watch']);
