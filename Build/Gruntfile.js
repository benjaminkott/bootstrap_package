module.exports = function(grunt) {

    /**
     * Project configuration.
     */
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        banner: '/*!\n' +
            ' * Bootstrap Package v<%= pkg.version %> (<%= pkg.homepage %>)\n' +
            ' * Copyright 2014-<%= grunt.template.today("yyyy") %> <%= pkg.author %>\n' +
            ' * Licensed under the <%= pkg.license %> license\n' +
            ' */\n',
        paths: {
            root: '../',
            bower: 'bower_components/',
            node: 'node_modules/',
            resources: '<%= paths.root %>Resources/',
            images: '<%= paths.resources %>Public/Images/',
            fonts: '<%= paths.resources %>Public/Fonts/',
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
            },
            rte: {
                src: '<%= paths.css %>rte.css',
                dest: '<%= paths.css %>rte.min.css'
            }
        },
        uglify: {
            options: {
                banner: '<%= banner %>',
                compress: {
                    warnings: false
                },
                preserveComments: false
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
            bootstrapSmoothscroll: {
                src: '<%= paths.js %>Src/bootstrap.smoothscroll.js',
                dest: '<%= paths.js %>Dist/bootstrap.smoothscroll.min.js'
            },
            bootstrapStickyheader: {
                src: '<%= paths.js %>Src/bootstrap.stickyheader.js',
                dest: '<%= paths.js %>Dist/bootstrap.stickyheader.min.js'
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
            },
            rte: {
                options: {
                    sourceMap: true,
                    outputSourceFiles: true,
                    sourceMapURL: 'rte.css.map',
                    sourceMapFilename: '<%= paths.css %>rte.css.map'
                },
                src: '<%= paths.less %>RTE/rte.less',
                dest: '<%= paths.css %>rte.css'
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
            bootstrapSmoothscroll: {
                files: '<%= paths.js %>Src/bootstrap.smoothscroll.js',
                tasks: 'uglify:bootstrapSmoothscroll'
            },
            bootstrapStickyheader: {
                files: '<%= paths.js %>Src/bootstrap.stickyheader.js',
                tasks: 'uglify:bootstrapStickyheader'
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
                tasks: 'css'
            }
        },
        imagemin: {
            images: {
                files: [
                    {
                        cwd: '<%= paths.images %>',
                        src: ['**/*.{png,jpg,gif}'],
                        dest: '<%= paths.images %>',
                        expand: true
                    }
                ]
            },
            extensionicon: {
                files: {
                    '<%= paths.root %>ext_icon.png': '<%= paths.root %>ext_icon.png'
                }
            }
        },
        copy: {
            jquery: {
                files: [
                    {
                        cwd: '<%= paths.node %>jquery/dist/',
                        src: 'jquery.min.js',
                        dest: '<%= paths.js %>Libs/',
                        expand: true
                    }
                ]
            },
            hammerjs: {
                files: [
                    {
                        cwd: '<%= paths.node %>hammerjs/',
                        src: [
                            'hammer.js',
                            'hammer.min.js',
                            'hammer.min.js.map',
                        ],
                        dest: '<%= paths.js %>Libs/',
                        expand: true
                    }
                ]
            },
            photoswipe: {
                files: [
                    {
                        cwd: '<%= paths.node %>photoswipe/dist/',
                        src: [
                            'photoswipe.min.js',
                            'photoswipe-ui-default.min.js'
                        ],
                        dest: '<%= paths.js %>Libs/',
                        expand: true
                    },
                    {
                        cwd: '<%= paths.node %>photoswipe/dist/default-skin/',
                        src: [
                            'default-skin.png',
                            'default-skin.svg',
                            'preloader.gif'
                        ],
                        dest: '<%= paths.images %>PhotoSwipe/',
                        expand: true
                    }
                ]
            },
            bootstrap: {
                files: [
                    {
                        cwd: '<%= paths.node %>bootstrap/dist/js/',
                        src: 'bootstrap.min.js',
                        dest: '<%= paths.js %>Libs/',
                        expand: true
                    },
                    {
                        cwd: '<%= paths.node %>bootstrap/dist/fonts/',
                        src: '*',
                        dest: '<%= paths.fonts %>',
                        expand: true
                    },
                    {
                        cwd: '<%= paths.node %>bootstrap/less/',
                        src: '**',
                        dest: '<%= paths.less %>Bootstrap/',
                        expand: true
                    }
                ]
            }
        },
        modernizr: {
            dist: {
                'crawl': false,
                'customTests': [],
                'dest': '<%= paths.js %>Dist/modernizr.min.js',
                'tests': [
                    'applicationcache',
                    'audio',
                    'canvas',
                    'canvastext',
                    'geolocation',
                    'hashchange',
                    'history',
                    'indexeddb',
                    'input',
                    'inputtypes',
                    'postmessage',
                    'svg',
                    'video',
                    'webgl',
                    'websockets',
                    'cssanimations',
                    'backgroundsize',
                    'borderimage',
                    'borderradius',
                    'boxshadow',
                    'csscolumns',
                    'flexbox',
                    'flexboxlegacy',
                    'fontface',
                    'generatedcontent',
                    'cssgradients',
                    'hsla',
                    'multiplebgs',
                    'opacity',
                    'cssreflections',
                    'rgba',
                    'textshadow',
                    'csstransforms',
                    'csstransforms3d',
                    'csstransitions',
                    'cssvhunit',
                    'cssvwunit',
                    'localstorage',
                    'sessionstorage',
                    'websqldatabase',
                    'svgclippaths',
                    'inlinesvg',
                    'smil',
                    'webworkers'
                ],
                'options': [
                    'domPrefixes',
                    'prefixes',
                    'hasEvent',
                    'testAllProps',
                    'testProp',
                    'testStyles',
                    'html5shiv',
                    'setClasses'
                ],
                'uglify': true
            }
        }
    });

    /**
     * Register tasks
     */
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-contrib-copy');
    grunt.loadNpmTasks('grunt-contrib-less');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-imagemin');
    grunt.loadNpmTasks("grunt-modernizr");

    /**
     * Grunt update task
     */
    grunt.registerTask('update', ['copy', 'modernizr']);
    grunt.registerTask('css', ['less', 'cssmin']);
    grunt.registerTask('js', ['uglify', 'cssmin']);
    grunt.registerTask('image', ['imagemin']);
    grunt.registerTask('build', ['update', 'css', 'js', 'image']);
    grunt.registerTask('default', ['build']);

};
