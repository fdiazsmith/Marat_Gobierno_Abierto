module.exports = function(grunt) {

 /**
  *
  * Tellart.com, Build & Development Tasks
  *
  */

  grunt.initConfig({

    pkg: grunt.file.readJSON('package.json'),

    clean: {

      dist: {

        // IMPORTANT: leave wp-config.php file in dist when deployed onto server. 
        //
        //  This file should be placed into the dist folder on the server manually; it contains db credentials!
        //  The wp-config.php file is never committed to the github repository. 
        //  For local wp development, follow the steps for running vagrant in src/wp-site/README.md
        
        src: ['dist/wp-content/**/*', '!dist/wp-content/uploads/**']
      }

    },
    
    copy: {

      wp_site : { // copy the wordpress theme directory into dist

        files: [{
          expand: true, 
          cwd: 'src/wordpress/',
          src: [ '**/*', '!wp-config.php'],
          dest: 'dist/'
          }
        ]
      }
    },

    exec: {
      start_vagrant: {
        cwd: 'src/',
        command: 'vagrant up',
        stdout: true,
        stderr: true
      },

      stop_vagrant: {
        cwd: 'src/',
        command: 'vagrant halt',
        stdout: true,
        stderr: true
      },

      npm_install: {
        command: 'npm install',
        stdout: true,
        stderr: true
      },

      bower_install: {
        cwd: 'src/wordpress/wp-content/themes/tellart_2014/',
        command: 'bower install',
        stdout: true,
        stderr: true
      }
    },

  });

  /**
   *
   * Register NPM Modules
   *
   */

  grunt.loadNpmTasks('grunt-contrib-clean');
  grunt.loadNpmTasks('grunt-contrib-copy');
  grunt.loadNpmTasks('grunt-exec');
  grunt.loadNpmTasks('grunt-contrib-less');
  grunt.loadNpmTasks('grunt-contrib-watch');

  /**
   *
   * Register Grunt Tasks
   *
   */

  grunt.registerTask('install',   [ 'exec:npm_install', 'exec:bower_install' ]);
  grunt.registerTask('start',     [ 'build', 'exec:start_vagrant'  ]);
  grunt.registerTask('dev-stop',  [ 'build', 'exec:stop_vagrant'     ]);
  grunt.registerTask('build',     [ 'exec:npm_install', 'exec:bower_install', 'clean', 'copy:wp_site' ]);
  grunt.registerTask('watch',     [ 'watch']);

};