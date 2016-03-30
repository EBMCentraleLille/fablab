var gulp = require('gulp');
var browserify = require('browserify');
var concat = require('gulp-concat');
var sass = require('gulp-sass');
var less = require('gulp-less');
var clean = require('gulp-clean');
var minifyCSS = require('gulp-minify-css');
var bulkify = require('bulkify');
var source = require('vinyl-source-stream');
var buffer = require('vinyl-buffer');
var ngAnnotate = require('gulp-ng-annotate');
var uglify = require('gulp-uglify');

const SRC_BASEDIR = "static/gdp/";
const DEST_BASEDIR = "web/gdp/";


/* Vendor JS files are compiled and resolved by browserify */

var vendorJS = [
    './node_modules/angular/angular.min.js',
    './node_modules/angular-ui-router/release/angular-ui-router.min.js',
    './node_modules/angular-cookies/angular-cookies.min.js',
    './node_modules/angular-sanitize/angular-sanitize.min.js',
    './node_modules/angular-ui-bootstrap/dist/ui-bootstrap-tpls.js',
    './node_modules/angular-toastr/dist/angular-toastr.tpls.min.js',
    './node_modules/angular-draganddrop/angular-draganddrop.min.js',
    './static/vendor/date-fr-FR.js'
];

var vendorCSS = [
    './node_modules/angular-toastr/dist/angular-toastr.min.css',
    //'./node_modules/bootstrap/dist/css/bootstrap.min.css'
]


gulp.task('scripts', function() {
    var opts= {entries: SRC_BASEDIR+'app.js',transform: ['bulkify']}
    var b = browserify(opts);
    b.transform('bulkify',{});

    var stream = b.bundle().on('error',function(err) {
        throw new Error('Could not create bundle');
        this.emit('end');
    }).pipe(source('app.js'));

    stream
        .pipe(buffer())     // We need to put our stream into a buffer
        .pipe(ngAnnotate()) // Then include angular dependencies
        .pipe(uglify())     // Then minify JS
        .pipe(gulp.dest(DEST_BASEDIR))
})


gulp.task('vendorJS', function() {
    gulp.src(vendorJS)
        .pipe(concat('vendor.js'))
        .pipe(gulp.dest(DEST_BASEDIR));
});

gulp.task('styles', function() {
    gulp.src([SRC_BASEDIR+'styles/styles.scss'])
        .pipe(sass())
        .pipe(minifyCSS())
        .pipe(gulp.dest(DEST_BASEDIR))
})

gulp.task('vendorCSS',function() {
    gulp.src(vendorCSS)
        .pipe(concat('vendor.css'))
        .pipe(minifyCSS())
        .pipe(gulp.dest(DEST_BASEDIR))
})

gulp.task('html', function() {
    gulp.src(SRC_BASEDIR+"index.html")
        .pipe(gulp.dest(DEST_BASEDIR))

    gulp.src(SRC_BASEDIR+"views/**/*.html")
        .pipe(gulp.dest(DEST_BASEDIR+"views/"))
})

gulp.task('fonts', function() {
    gulp.src('./node_modules/bootstrap/fonts/**/*')
        .pipe(gulp.dest('web/fonts/'))
})


gulp.task('default', function() {
    gulp.run('vendorJS', 'scripts', 'styles', 'html','vendorCSS','fonts');

    gulp.watch(SRC_BASEDIR+"**/*.js", ['scripts'])
    gulp.watch(SRC_BASEDIR+"styles/**", ['styles'])
    gulp.watch(SRC_BASEDIR+"**/*.html", ['html'])
})