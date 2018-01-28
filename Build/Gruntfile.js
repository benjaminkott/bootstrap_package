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
            ' */',
        paths: {
            root: '../',
            bower: 'bower_components/',
            node: 'node_modules/',
            resources: '<%= paths.root %>Resources/',
            images: '<%= paths.resources %>Public/Images/',
            fonts: '<%= paths.resources %>Public/Fonts/',
            less: '<%= paths.resources %>Public/Less/',
            sass: '<%= paths.resources %>Public/Scss/',
            css: '<%= paths.resources %>Public/Css/',
            js: '<%= paths.resources %>Public/JavaScript/',
            contrib: '<%= paths.resources %>Public/Contrib/'
        },
        cssmin: {
            options: {
                keepSpecialComments: '*',
                advanced: false
            },
            bootstrap4_theme: {
                src: '<%= paths.css %>bootstrap4-theme.css',
                dest: '<%= paths.css %>bootstrap4-theme.min.css'
            },
            bootstrap4_rte: {
                src: '<%= paths.css %>bootstrap4-rte.css',
                dest: '<%= paths.css %>bootstrap4-rte.min.css'
            },
            bootstrap3_theme: {
                src: '<%= paths.css %>bootstrap3-theme.css',
                dest: '<%= paths.css %>bootstrap3-theme.min.css'
            },
            bootstrap3_rte: {
                src: '<%= paths.css %>bootstrap3-rte.css',
                dest: '<%= paths.css %>bootstrap3-rte.min.css'
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
            bootstrapNavbar: {
                src: '<%= paths.js %>Src/bootstrap.navbar.js',
                dest: '<%= paths.js %>Dist/bootstrap.navbar.min.js'
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
            responsiveimages: {
                src: '<%= paths.js %>Src/jquery.responsiveimages.js',
                dest: '<%= paths.js %>Dist/jquery.responsiveimages.min.js'
            },
            ckeditor_box: {
                src: '<%= paths.resources %>Public/CKEditor/Plugins/Box/plugin.js',
                dest: '<%= paths.resources %>Public/CKEditor/Plugins/Box/plugin.min.js'
            },
            ckeditor_table: {
                src: '<%= paths.resources %>Public/CKEditor/Plugins/Table/plugin.js',
                dest: '<%= paths.resources %>Public/CKEditor/Plugins/Table/plugin.min.js'
            }
        },
        sass: {
            options: {
                outputStyle: 'expanded',
                precision: 8,
                sourceMap: true
            },
            bootstrap4_theme: {
                files: {
                    '<%= paths.css %>bootstrap4-theme.css': '<%= paths.sass %>Theme/theme.scss'
                }
            },
            bootstrap4_rte: {
                files: {
                    '<%= paths.css %>bootstrap4-rte.css': '<%= paths.sass %>RTE/rte.scss'
                }
            }
        },
        less: {
            bootstrap3_theme: {
                options: {
                    sourceMap: true,
                    outputSourceFiles: true,
                    relativeUrls: true,
                    sourceMapURL: 'bootstrap3-theme.css.map',
                    sourceMapFilename: '<%= paths.css %>bootstrap3-theme.css.map',
                    rootpath: 'Public/'
                },
                src: '<%= paths.less %>Theme/theme.less',
                dest: '<%= paths.css %>bootstrap3-theme.css'
            },
            bootstrap3_rte: {
                options: {
                    sourceMap: true,
                    outputSourceFiles: true,
                    relativeUrls: true,
                    sourceMapURL: 'bootstrap3-rte.css.map',
                    sourceMapFilename: '<%= paths.css %>bootstrap3-rte.css.map',
                    rootpath: 'Public/'
                },
                src: '<%= paths.less %>RTE/rte.less',
                dest: '<%= paths.css %>bootstrap3-rte.css'
            }
        },
        watch: {
            bootstrapLightbox: {
                files: '<%= paths.js %>Src/bootstrap.lightbox.js',
                tasks: 'uglify:bootstrapLightbox'
            },
            bootstrapNavbar: {
                files: '<%= paths.js %>Src/bootstrap.navbar.js',
                tasks: 'uglify:bootstrapNavbar'
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
            responsiveimages: {
                files: '<%= paths.js %>Src/jquery.responsiveimages.js',
                tasks: 'uglify:responsiveimages'
            },
            ckeditor_box: {
                files: '<%= paths.resources %>Public/CKEditor/Plugins/Box/plugin.js',
                tasks: 'uglify:ckeditor_box'
            },
            ckeditor_table: {
                files: '<%= paths.resources %>Public/CKEditor/Plugins/Table/plugin.js',
                tasks: 'uglify:ckeditor_table'
            },
            scss: {
                files: '<%= paths.scss %>**/*.scss',
                tasks: 'css'
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
                        dest: '<%= paths.contrib %>jquery/',
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
                        dest: '<%= paths.contrib %>hammerjs/',
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
                        dest: '<%= paths.contrib %>photoswipe/',
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
            popper: {
                files: [
                    {
                        cwd: '<%= paths.node %>popper.js/dist/umd/',
                        src: [
                            'popper.min.js',
                            'popper.min.js.map',
                        ],
                        dest: '<%= paths.contrib %>popper/',
                        expand: true
                    }
                ]
            },
            bootstrap3: {
                files: [
                    {
                        cwd: '<%= paths.node %>bootstrap3/dist/js/',
                        src: 'bootstrap.min.js',
                        dest: '<%= paths.contrib %>bootstrap3/js/',
                        expand: true
                    },
                    {
                        cwd: '<%= paths.node %>bootstrap3/dist/fonts/',
                        src: '*',
                        dest: '<%= paths.contrib %>bootstrap3/fonts/',
                        expand: true
                    },
                    {
                        cwd: '<%= paths.node %>bootstrap3/less/',
                        src: '**',
                        dest: '<%= paths.contrib %>bootstrap3/less/',
                        expand: true
                    }
                ]
            },
            bootstrap4: {
                files: [
                    {
                        cwd: '<%= paths.node %>bootstrap/dist/js/',
                        src: [
                            'bootstrap.min.js',
                            'bootstrap.min.js.map',
                        ],
                        dest: '<%= paths.contrib %>bootstrap4/js/',
                        expand: true
                    },
                    {
                        cwd: '<%= paths.node %>bootstrap/scss/',
                        src: '**',
                        dest: '<%= paths.contrib %>bootstrap4/scss/',
                        expand: true
                    }
                ]
            }
        },
        modernizr: {
            dist: {
                'crawl': false,
                'customTests': [],
                'dest': '<%= paths.contrib %>modernizr/modernizr.min.js',
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
    grunt.loadNpmTasks('grunt-sass');

    /**
     * Grunt update task
     */
    grunt.registerTask('update', ['copy', 'modernizr']);
    grunt.registerTask('css', ['sass', 'less', 'cssmin']);
    grunt.registerTask('js', ['uglify', 'cssmin']);
    grunt.registerTask('image', ['imagemin']);
    grunt.registerTask('build', ['update', 'css', 'js', 'image']);
    grunt.registerTask('default', ['build']);

};
