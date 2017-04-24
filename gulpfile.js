var requireDir = require('require-dir');

var dir = requireDir('./node_modules/joomla-gulp', {recurse: true});
var dir = requireDir('./joomla-gulp', {recurse: true});


// Load config
var extension = require('./package.json');
var config    = require('./gulp-config.json');

var gulp    = require('gulp');
var zip     = require('gulp-zip');
var rm      = require('gulp-rimraf');
var replace = require('gulp-replace');
var es      = require('event-stream');

//release
gulp.task('cleanRelease', function () {
  return gulp.src('./releases', { read: false }).pipe(rm({ force: true }));
});

var modelFolders = [
    'plg_system_tx_selectionshare'
];

// identifies a dependent task must be complete before this one begins
gulp.task('release', ['cleanRelease'], function() {

  for (var i = 0; i < modelFolders.length; i++) {
    var model = modelFolders[i];
    modelZip = gulp.src('./src/'+ model+'/**')
              .pipe(zip(model + '.zip'))
              .pipe(gulp.dest('releases'));

  }

});
