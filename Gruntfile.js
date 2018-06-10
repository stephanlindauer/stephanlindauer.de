module.exports = function ( grunt ) {

  require( 'load-grunt-tasks' )( grunt );

  grunt.initConfig( {

    pkg: grunt.file.readJSON( 'package.json' ),

    jshint: {
      all: ['Gruntfile.js', 'js/script.js'],
      options: {
        curly: true,
        eqeqeq: true,
        eqnull: true,
        browser: true,
        globals: {
          jQuery: true
        },
        reporter: require( 'jshint-html-reporter' ),
        reporterOutput: 'reports/jshint-report.html'
      }
    },

    jslint: {
      client: {
        src: [
          'js/script.js'
        ],
        directives: {
          white: true,
          browser: true,
          nomen: true,
          vars: true,
          predef: ['jQuery', '$', 'main', '_gaq']
        },
        options: {
          junit: 'reports/client-junit.xml',
          failOnError: false,
          errorsOnly: true
        }
      }
    },

    concat: {
      js: {
        src: 'js/lib/*.js',
        dest: 'js/plugins.js'
      }
    },

    compass: {
      dist: {
        options: {
          basePath: 'css',
          force: true,

          imagesPath: 'img/',
          sassDir: 'sass',

          cssDir: './',
          environment: 'production'
        }
      }
    },

    uglify: {
      options: {
        mangle: {except: ['$', 'main']}
      },
      my_target: {
        files: {
          'js/script.js': ['js/script.js']
        }
      }
    },

    replace: {
      example: {
        src: ['includes/footer.php'],
        dest: 'includes/footer.php',
        replacements: [{
          from: '@build-number@',
          to: process.env.TRAVIS_BUILD_NUMBER
        },{
          from: '@timestamp@',
          to: new Date().getTime()
        },{
          from: '@git-commit@',
          to: String( process.env.TRAVIS_COMMIT ).substring( 36 )
        },{
          from: '@git-branch@',
          to: process.env.TRAVIS_BRANCH
        }]
      }
    },


    smushit: {
      group1: {
        src: 'upload/'
      }
    },
  } );

  grunt.registerTask( 'default', [
    'jshint',
    'jslint',
    'concat',
    'compass',
    'uglify',
    'replace',
    'smushit'
  ] );
};
