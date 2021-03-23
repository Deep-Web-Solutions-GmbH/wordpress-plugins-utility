module.exports = function( grunt ) {
	'use strict';

	// Load all grunt tasks matching the `grunt-*` pattern
	require( 'load-grunt-tasks' )( grunt );

	// Show elapsed time
	require( 'time-grunt' )( grunt );

	// Project configuration
	grunt.initConfig(
		{
			package : grunt.file.readJSON( 'package.json' ),
			dirs    : {
				dependencies : 'dependencies',
				code         : 'src',
				assets       : 'src/assets',
				lang         : 'src/languages',
				templates    : 'src/templates',
			},

			babel   : {
				options : {
					sourceMap : true
				},
				dist    : {
					files: [ {
						expand : true,
						cwd    : '<%= dirs.assets %>/dev/**/*.ts',
						src    : [ '**/*.ts' ],
						dest   : '<%= dirs.assets %>/dist/**/*.js',
						ext    : '.js'
					} ]
				}
			},
			makepot : {
				dist : {
					options : {
						domainPath      : '<%= dirs.languages %>',
						exclude         : [ 'node_modules/.*', 'vendor/.*' ],
						potFilename     : 'dws-utility-plugin.pot',
						mainFile        : 'bootstrap.php',
						potHeaders      : {
							'report-msgid-bugs-to'  : 'https://github.com/deep-web-solutions/wordpress-plugins-utility/issues',
							'project-id-version'    : '<%= package.title %> <%= package.version %>',
							'poedit'     		    : true,
							'x-poedit-keywordslist' : true,
						},
						processPot      : function( pot ) {
							delete pot.headers['x-generator'];
							return pot;
						},
						type            : 'wp-plugin',
						updateTimestamp : false,
						updatePoFiles   : true
					}
				}
			},
			postcss : {
				options : {
					map        : {
						inline : false
					},
					processors : [
						require( 'autoprefixer' )( { overrideBrowserslist: [ 'last 2 versions' ] } ),
						require( 'cssnano' )()
					]
				},
				dist    : {
					files : [ {
						expand : true,
						cwd    : '<%= dirs.assets %>/dist/**/*.css',
						src    : [ '**/*.css' ],
						dest   : '<%= dirs.assets %>/dist/**/*.css',
						ext    : '.min.css'
					} ]
				}
			},
			potomo  : {
				dist : {
					options : {
						poDel : false
					},
					files   : [ {
						expand : true,
						cwd	   : '<%= dirs.lang %>',
						src    : [ '*.po' ],
						dest   : '<%= dirs.lang %>',
						ext    : '.mo',
						nonull : true
					} ]
				}
			},
			sass    : {
				dist : {
					files: [ {
						expand : true,
						cwd    : '<%= dirs.assets %>/dev/**/*.scss',
						src    : [ '**/*.scss' ],
						dest   : '<%= dirs.assets %>/dist/**/*.css',
						ext    : '.css'
					} ]
				}
			},
			uglify  : {
				options : {
					mangle: {
						reserved: [ 'jQuery' ]
					},
					sourceMap: true
				},
				dist    : {
					files : [ {
						expand : true,
						cwd    : '<%= dirs.assets %>/dist/**/*.js',
						src    : [ '**/*.js' ],
						dest   : '<%= dirs.assets %>/dist/**/*.js',
						ext    : '.min.js'
					} ]
				}
			},
			watch   : {
				scripts : {
					files   : [ '<%= dirs.assets %>/dev/**/*.ts' ],
					tasks   : [ 'assets-typescript' ],
					options : {
						interrupt: true,
					}
				},
				styles  : {
					files   : [ '<%= dirs.assets %>/dev/**/*.scss' ],
					tasks   : [ 'assets-scss' ],
					options : {
						interrupt: true,
					}
				}
			}
		}
	);

	grunt.registerTask( 'i18n', [ 'makepot', 'potomo' ] );
	grunt.registerTask( 'assets-typescript', [ 'babel', 'uglify' ] );
	grunt.registerTask( 'assets-scss', [ 'sass', 'postcss' ] );
}
