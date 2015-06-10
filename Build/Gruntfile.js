module.exports = function(grunt) {

	/**
	 * Project configuration.
	 */
	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),
		paths: {
			root: "../",
			less: "<%= paths.root %>Resources/Private/Less/",
			css: "<%= paths.root %>Resources/Public/Css/",
			js: "<%= paths.root %>Resources/Public/JavaScript/"
		},
		cssmin: {
			options: {
				compatibility: 'ie8',
				keepSpecialComments: '*',
				advanced: false
			},
			theme: {
				src: '<%= paths.css %>theme.css',
				dest: '<%= paths.css %>theme.min.css'
			}
		},
		uglify: {
			options: {
				compress: {
					warnings: false
				},
				mangle: true,
				preserveComments: 'some'
			},
			responsiveimages: {
				src: '<%= paths.js %>Libs/jquery.responsiveimages.js',
				dest: '<%= paths.js %>Libs/jquery.responsiveimages.min.js'
			},
			viewportfix: {
				src: '<%= paths.js %>Libs/windowsphone-viewportfix.js',
				dest: '<%= paths.js %>Libs/windowsphone-viewportfix.min.js'
			},
			main: {
				src: '<%= paths.js %>main.js',
				dest: '<%= paths.js %>main.min.js'
			}
		},
		less: {
			theme: {
				src: '<%= paths.less %>Theme/theme.less',
				dest: '<%= paths.css %>theme.css'
			}
		},
		watch: {
			less: {
				files: '../Resources/Private/Less/**/*.less',
				tasks: 'less'
			}
		}
	});

	/**
	 * Register tasks
	 */
	grunt.loadNpmTasks('grunt-contrib-cssmin');
	grunt.loadNpmTasks('grunt-contrib-less');
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-npm-install');

	/**
	 * Grunt update task
	 */
	grunt.registerTask('update', ['npm-install']);
	grunt.registerTask('build', ['less','cssmin','uglify']);

};