module.exports = function(grunt) {

    /**
     * Grunt correct scss urls
     */
    grunt.registerMultiTask('rebase', 'Grunt task zo rebase urls after sass processing', function () {
        var options = this.options(),
            done = this.async(),
            postcss = require('postcss'),
            url = require('postcss-url'),
            files = this.filesSrc.filter(function (file) {
                return grunt.file.isFile(file);
            }),
            counter = 0;
        this.files.forEach(function (file) {
            file.src.filter(function (filepath) {
                var content = grunt.file.read(filepath);
                postcss().use(url(options)).process(content, { from: undefined }).then(function (result) {
                    grunt.file.write(file.dest, result.css);
                    grunt.log.success('Source file "' + filepath + '" was processed.');
                    counter++;
                    if (counter >= files.length) done(true);
                });
            });
        });
    });

    /**
     * Grunt task for modernizr
     */
    grunt.registerMultiTask("modernizr", "Respond to your user’s browser features.", function () {
        var options = this.options(),
            done = this.async(),
            modernizr = require("modernizr"),
            dest = this.data.dest;
        modernizr.build(options, function(output) {
            grunt.file.write(dest, output);
            done();
        });
	});

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
            icons: '<%= paths.resources %>Public/Icons/',
            images: '<%= paths.resources %>Public/Images/',
            fonts: '<%= paths.resources %>Public/Fonts/',
            less: '<%= paths.resources %>Public/Less/',
            sass: '<%= paths.resources %>Public/Scss/',
            css: '<%= paths.resources %>Public/Css/',
            js: '<%= paths.resources %>Public/JavaScript/',
            contrib: '<%= paths.resources %>Public/Contrib/'
        },
        rebase: {
            bootstrap4: {
                options: {
                    url: "rebase",
                    assetsPath: '../'
                },
                files: {
                    '<%= paths.css %>bootstrap4-theme.css': '<%= paths.css %>bootstrap4-theme.css'
                }
            },
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
            },
            bootstrappackageicon: {
                src: '<%= paths.fonts %>bootstrappackageicon.css',
                dest: '<%= paths.fonts %>bootstrappackageicon.min.css'
            }
        },
        uglify: {
            options: {
                banner: '<%= banner %>',
                compress: {
                    warnings: false
                },
                output: {
                    comments: false
                }
            },
            modernizr: {
                options: {
                    banner: ''
                },
                src: '<%= paths.contrib %>modernizr/modernizr.js',
                dest: '<%= paths.contrib %>modernizr/modernizr.min.js'
            },
            bootstrapForm: {
                src: '<%= paths.js %>Src/bootstrap.form.js',
                dest: '<%= paths.js %>Dist/bootstrap.form.min.js'
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
            ckeditor_address: {
                src: '<%= paths.resources %>Public/CKEditor/Plugins/Address/plugin.js',
                dest: '<%= paths.resources %>Public/CKEditor/Plugins/Address/plugin.min.js'
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
                sourceMap: false
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
                    sourceMap: false,
                    outputSourceFiles: true,
                    relativeUrls: true,
                    rootpath: 'Public/'
                },
                src: '<%= paths.less %>Theme/theme.less',
                dest: '<%= paths.css %>bootstrap3-theme.css'
            },
            bootstrap3_rte: {
                options: {
                    sourceMap: false,
                    outputSourceFiles: true,
                    relativeUrls: true,
                    rootpath: 'Public/'
                },
                src: '<%= paths.less %>RTE/rte.less',
                dest: '<%= paths.css %>bootstrap3-rte.css'
            }
        },
        watch: {
            bootstrapForm: {
                files: '<%= paths.js %>Src/bootstrap.form.js',
                tasks: 'uglify:bootstrapForm'
            },
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
            ckeditor_address: {
                files: '<%= paths.resources %>Public/CKEditor/Plugins/Address/plugin.js',
                tasks: 'uglify:ckeditor_address'
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
            main: {
                'dest': '<%= paths.contrib %>modernizr/modernizr.js',
                'options': {
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
                    'feature-detects': [
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
                        'css/animations',
                        'css/backgroundsize',
                        'css/borderimage',
                        'css/borderradius',
                        'css/boxshadow',
                        'css/columns',
                        'css/flexbox',
                        'css/focuswithin',
                        'css/flexboxlegacy',
                        'css/fontface',
                        'css/generatedcontent',
                        'css/gradients',
                        'css/hsla',
                        'css/multiplebgs',
                        'css/opacity',
                        'css/reflections',
                        'css/rgba',
                        'css/textshadow',
                        'css/transforms',
                        'css/transforms3d',
                        'css/transitions',
                        'css/vhunit',
                        'css/vwunit',
                        'storage/localstorage',
                        'storage/sessionstorage',
                        'storage/websqldatabase',
                        'svg/clippaths',
                        'svg/inline',
                        'svg/smil',
                        'workers/webworkers'
                    ]
                }
            }
        },
        webfont: {
            bootstrappackageicon: {
                src: '<%= paths.icons %>BootstrapPackageIcon/*.svg',
                dest: '<%= paths.fonts %>',
                options: {
                    font: 'bootstrappackageicon',
                    template: 'templates/font.css',
                    fontFamilyName: 'BootstrapPackageIcon',
                    engine: 'node',
                    autoHint: false,
                    htmlDemo: false,
                    templateOptions: {
                        baseClass: 'bootstrappackageicon',
                        classPrefix: 'bootstrappackageicon-'
                    }
                }
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
    grunt.loadNpmTasks('grunt-sass');
    grunt.loadNpmTasks('grunt-webfont');

    /**
     * Grunt update task
     */
    grunt.registerTask('update', ['copy', 'modernizr']);
    grunt.registerTask('icon', ['webfont', 'cssmin:bootstrappackageicon']);
    grunt.registerTask('css', ['sass', 'less', 'rebase', 'cssmin']);
    grunt.registerTask('js', ['uglify', 'cssmin']);
    grunt.registerTask('image', ['imagemin']);
    grunt.registerTask('build', ['webfont', 'update', 'css', 'js', 'image']);
    grunt.registerTask('default', ['build']);

};
