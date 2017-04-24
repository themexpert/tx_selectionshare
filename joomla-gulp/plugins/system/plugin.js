var gulp = require('gulp');
var config = require('../../../gulp-config.json');

// Dependencies
var browserSync = require('browser-sync');
var rm          = require('gulp-rimraf');
var gutil 			= require('gulp-util');
var baseTask  = 'plugins.system.plugin';
var extPath   = './src';

// Clean
gulp.task('clean:' + baseTask,
	[
		'clean:' + baseTask + ':tx_selectionshare',
		'clean:' + baseTask + ':language',
		'media:' + baseTask + ':media'
	],
	function() {
		return true;
});

gulp.task('clean:' +  baseTask + ':tx_selectionshare', function() {
	// gutil.log('Lets start cleaning tx_selectionshare plugin');
	return gulp.src(config.wwwDir + '/plugins/system/tx_selectionshare/', { read: false }).pipe(rm({ force: true }));
});
gulp.task('clean:' +  baseTask + ':media', function() {
	// gutil.log('Lets start cleaning tx_selectionshare plugin');
	return gulp.src(config.wwwDir + '/media/tx_selectionshare/', { read: false }).pipe(rm({ force: true }));
});

gulp.task('clean:' + baseTask + ':language', function() {
	return gulp.src(
    [
      config.wwwDir + '/administrator/language/en-GB/en-GB.plg_system_tx_selectionshare.ini'
    ],
    { read: false }
  ).pipe(rm({ force: true }));
});


// Copy
gulp.task('copy:' + baseTask,
	[
    'copy:' + baseTask + ':tx_selectionshare',
	'copy:' + baseTask + ':language',
	'copy:' + baseTask + ':media'
	],
	function() {
		return true;
});

gulp.task('copy:' +  baseTask + ':tx_selectionshare', ['clean:' + baseTask + ':tx_selectionshare'], function() {
	return gulp.src(extPath + '/plg_system_tx_selectionshare/**').pipe(gulp.dest(config.wwwDir + '/plugins/system/tx_selectionshare'));
});

gulp.task('copy:' +  baseTask + ':media', ['clean:' + baseTask + ':media'], function() {
	return gulp.src(extPath + '/plg_system_tx_selectionshare/media/**').pipe(gulp.dest(config.wwwDir + '/media/tx_selectionshare'));
});

gulp.task('copy:' +  baseTask + ':language', ['clean:' + baseTask + ':language'], function() {
	return gulp.src([
	    extPath + '/plg_system_tx_selectionshare/language/en-GB/**'
  	])
  	.pipe(gulp.dest(config.wwwDir + '/administrator/language/en-GB'));
});

// Watch
gulp.task('watch:' + baseTask,
	[
    'watch:' + baseTask + ':tx_selectionshare',
	'watch:' + baseTask + ':media',
	'watch:' + baseTask + ':language'
	],
	function() {
		return true;
});

gulp.task('watch:' +  baseTask + ':tx_selectionshare', function() {
	gulp.watch(extPath + '/plg_system_tx_selectionshare/**', ['copy:' + baseTask + ':tx_selectionshare', browserSync.reload]);
});
gulp.task('watch:' +  baseTask + ':media', function() {
	gulp.watch(extPath + '/plg_system_tx_selectionshare/media/**', ['copy:' + baseTask + ':media', browserSync.reload]);
});

gulp.task('watch:' +  baseTask + ':language', function() {
	gulp.watch([
		extPath + '/plg_system_tx_selectionshare/language/en-GB/**'
	],
		['copy:' + baseTask + ':language', browserSync.reload]
	);
});
