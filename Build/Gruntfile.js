module.exports = function(grunt) {

	/**
	 * Project configuration.
	 */
	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),
		paths: {
			root : "../",
			less : "<%= paths.root %>Resources/Private/Less/",
			css : "<%= paths.root %>Resources/Public/Css/"
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
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-npm-install');

	/**
	 * Grunt update task
	 */
	grunt.registerTask('update', ['npm-install']);
	grunt.registerTask('build', ['less','cssmin']);

};