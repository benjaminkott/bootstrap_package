module.exports = function(grunt) {

    /**
     * Project configuration.
     */
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        paths: {
            root: '../',
            bower: 'bower_components/',
            resources: '<%= paths.root %>Resources/',
            less: '<%= paths.resources %>Public/Less/',
            css: '<%= paths.resources %>Public/Css/',
            js: '<%= paths.resources %>Public/JavaScript/'
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
            bootstrapNavbarToggle: {
                src: '<%= paths.js %>Libs/bootstrap.navbartoggle.js',
                dest: '<%= paths.js %>Libs/bootstrap.navbartoggle.min.js'
            },
            bootstrapLightbox: {
                src: '<%= paths.js %>Libs/bootstrap.lightbox.js',
                dest: '<%= paths.js %>Libs/bootstrap.lightbox.min.js'
            },
            bootstrapSwipe: {
                src: '<%= paths.js %>Libs/bootstrap.swipe.js',
                dest: '<%= paths.js %>Libs/bootstrap.swipe.min.js'
            },
            selectivizr: {
                src: '<%= paths.bower %>selectivizr/selectivizr.js',
                dest: '<%= paths.js %>Libs/selectivizr.min.js'
            },
            responsiveimages: {
                src: '<%= paths.js %>Libs/jquery.responsiveimages.js',
                dest: '<%= paths.js %>Libs/jquery.responsiveimages.min.js'
            },
            viewportfix: {
                src: '<%= paths.js %>Libs/windowsphone-viewportfix.js',
                dest: '<%= paths.js %>Libs/windowsphone-viewportfix.min.js'
            }
        },
        less: {
            theme: {
                options: {
                    sourceMap: true,
                    outputSourceFiles: true,
                    sourceMapURL: 'theme.css.map',
                    sourceMapFilename: '<%= paths.css %>theme.css.map'
                },
                src: '<%= paths.less %>Theme/theme.less',
                dest: '<%= paths.css %>theme.css'
            }
        },
        watch: {
            bootstrapNavbarToggle: {
                files: '<%= paths.js %>Libs/bootstrap.navbartoggle.js',
                tasks: 'uglify:bootstrapNavbarToggle'
            },
            bootstrapLightbox: {
                files: '<%= paths.js %>Libs/bootstrap.lightbox.js',
                tasks: 'uglify:bootstrapLightbox'
            },
            bootstrapSwipe: {
                files: '<%= paths.js %>Libs/bootstrap.swipe.js',
                tasks: 'uglify:bootstrapSwipe'
            },
            responsiveimages: {
                files: '<%= paths.js %>Libs/jquery.responsiveimages.js',
                tasks: 'uglify:responsiveimages'
            },
            viewportfix: {
                files: '<%= paths.js %>Libs/windowsphone-viewportfix.js',
                tasks: 'uglify:viewportfix'
            },
            less: {
                files: '<%= paths.less %>**/*.less',
                tasks: 'less'
            }
        },
        bowercopy: {
            options: {
                clean: false,
                report: false,
                runBower: false,
                srcPrefix: 'bower_components/'
            },
            all: {
                options: {
                    destPrefix: '<%= paths.resources %>'
                },
                files: {
                    // RespondJs
                    'Public/JavaScript/Libs/respond.min.js': 'respond/dest/respond.min.js',
                    // jQuery
                    'Public/JavaScript/Libs/jquery.min.js': 'jquery/dist/jquery.min.js',
                    // hammer.js
                    'Public/JavaScript/Libs/hammer.min.js': 'hammerjs/hammer.min.js',
                    // Bootstrap
                    'Public/Less/Bootstrap': 'bootstrap/less',
                    'Public/Fonts': 'bootstrap/fonts',
                    'Public/JavaScript/Libs/bootstrap.min.js': 'bootstrap/dist/js/bootstrap.min.js'
                }
            }
        }
    });

    /**
     * Register tasks
     */
    grunt.loadNpmTasks('grunt-bowercopy');
    grunt.loadNpmTasks('grunt-bower-just-install');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-contrib-less');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-npm-install');

    /**
     * Grunt update task
     */
    grunt.registerTask('update', ['npm-install', 'bower_install', 'bowercopy']);
    grunt.registerTask('build', ['update', 'less', 'cssmin', 'uglify']);

};