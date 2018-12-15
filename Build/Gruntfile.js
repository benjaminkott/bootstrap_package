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
            bootstrapLightbox: {
                src: '<%= paths.js %>Src/bootstrap.lightbox.js',
                dest: '<%= paths.js %>Dist/bootstrap.lightbox.min.js'
            },
            bootstrapNavbarToggle: {
                src: '<%= paths.js %>Src/bootstrap.navbartoggle.js',
                dest: '<%= paths.js %>Dist/bootstrap.navbartoggle.min.js'
            },
            bootstrapPopover: {
                src: '<%= paths.js %>Src/bootstrap.popover.js',
                dest: '<%= paths.js %>Dist/bootstrap.popover.min.js'
            },
            bootstrapSwipe: {
                src: '<%= paths.js %>Src/bootstrap.swipe.js',
                dest: '<%= paths.js %>Dist/bootstrap.swipe.min.js'
            },
            equalheight: {
                src: '<%= paths.js %>Src/jquery.equalheight.js',
                dest: '<%= paths.js %>Dist/jquery.equalheight.min.js'
            },
            responsiveimages: {
                src: '<%= paths.js %>Src/jquery.responsiveimages.js',
                dest: '<%= paths.js %>Dist/jquery.responsiveimages.min.js'
            },
            viewportfix: {
                src: '<%= paths.js %>Src/windowsphone-viewportfix.js',
                dest: '<%= paths.js %>Dist/windowsphone-viewportfix.min.js'
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
            bootstrapLightbox: {
                files: '<%= paths.js %>Src/bootstrap.lightbox.js',
                tasks: 'uglify:bootstrapLightbox'
            },
            bootstrapNavbarToggle: {
                files: '<%= paths.js %>Src/bootstrap.navbartoggle.js',
                tasks: 'uglify:bootstrapNavbarToggle'
            },
            bootstrapPopover: {
                files: '<%= paths.js %>Src/bootstrap.popover.js',
                tasks: 'uglify:bootstrapPopover'
            },
            bootstrapSwipe: {
                files: '<%= paths.js %>Src/bootstrap.swipe.js',
                tasks: 'uglify:bootstrapSwipe'
            },
            equalheight: {
                files: '<%= paths.js %>Src/jquery.equalheight.js',
                tasks: 'uglify:equalheight'
            },
            responsiveimages: {
                files: '<%= paths.js %>Src/jquery.responsiveimages.js',
                tasks: 'uglify:responsiveimages'
            },
            viewportfix: {
                files: '<%= paths.js %>Src/windowsphone-viewportfix.js',
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
                    // jQuery
                    'Public/JavaScript/Libs/jquery.min.js': 'jquery/dist/jquery.min.js',
                    // hammer.js
                    'Public/JavaScript/Libs/hammer.min.js': 'hammerjs/hammer.min.js',
                    // Bootstrap
                    'Public/Less/Bootstrap': 'bootstrap/less',
                    'Public/Fonts': 'bootstrap/fonts',
                    'Public/JavaScript/Libs/bootstrap.min.js': 'bootstrap/dist/js/bootstrap.min.js',
                    // PhotoSwipe
                    'Public/JavaScript/Libs/photoswipe.min.js': 'photoswipe/dist/photoswipe.min.js',
                    'Public/JavaScript/Libs/photoswipe-ui-default.min.js': 'photoswipe/dist/photoswipe-ui-default.min.js',
                    'Public/Images/PhotoSwipe/default-skin.png': 'photoswipe/dist/default-skin/default-skin.png',
                    'Public/Images/PhotoSwipe/default-skin.svg': 'photoswipe/dist/default-skin/default-skin.svg',
                    'Public/Images/PhotoSwipe/preloader.gif': 'photoswipe/dist/default-skin/preloader.gif'
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
    grunt.registerTask('css', ['less', 'cssmin']);
    grunt.registerTask('js', ['uglify', 'cssmin']);
    grunt.registerTask('build', ['update', 'css', 'js']);
    grunt.registerTask('default', ['build']);

};
