const sass = require('node-sass');

module.exports = function(grunt) {

    /**
     * Grunt correct scss urls
     */
    grunt.registerMultiTask('rebase', 'Grunt task to rebase urls after sass processing', function () {
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
     * Grunt task to remove source map comment
     */
    grunt.registerMultiTask('removesourcemap', 'Grunt task to remove sourcemp comment from files', function() {
        var done = this.async(),
            files = this.filesSrc.filter(function (file) {
                return grunt.file.isFile(file);
            }),
            counter = 0;
        this.files.forEach(function (file) {
            file.src.filter(function (filepath) {
                var content = grunt.file.read(filepath).replace(/\/\/# sourceMappingURL=\S+/, '');
                grunt.file.write(file.dest, content);
                grunt.log.success('Source file "' + filepath + '" was processed.');
                counter++;
                if (counter >= files.length) done(true);
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
        paths: {
            root: '../',
            node: 'node_modules/',
            resources: '<%= paths.root %>Resources/',
            icons: '<%= paths.resources %>Public/Icons/',
            images: '<%= paths.resources %>Public/Images/',
            fonts: '<%= paths.resources %>Public/Fonts/',
            sass: '<%= paths.resources %>Public/Scss/',
            css: '<%= paths.resources %>Public/Css/',
            js: '<%= paths.resources %>Public/JavaScript/',
            contrib: '<%= paths.resources %>Public/Contrib/'
        },
        stylelint: {
            options: {
                configFile: '<%= paths.root %>.stylelintrc',
                fix: true,
            },
            sass: ['<%= paths.sass %>**/*.scss'],
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
            bootstrappackageicon: {
                src: '<%= paths.fonts %>bootstrappackageicon.css',
                dest: '<%= paths.fonts %>bootstrappackageicon.min.css'
            }
        },
        uglify: {
            options: {
                output: {
                    comments: false
                }
            },
            modernizr: {
                src: '<%= paths.contrib %>modernizr/modernizr.min.js',
                dest: '<%= paths.contrib %>modernizr/modernizr.min.js'
            },
            bootstrapAccordion: {
                src: '<%= paths.js %>Src/bootstrap.accordion.js',
                dest: '<%= paths.js %>Dist/bootstrap.accordion.min.js'
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
            cookieconsent: {
                src: '<%= paths.js %>Src/bootstrap.cookieconsent.js',
                dest: '<%= paths.js %>Dist/bootstrap.cookieconsent.min.js'
            },
            ckeditor_address: {
                src: '<%= paths.resources %>Public/CKEditor/Plugins/Address/plugin.js',
                dest: '<%= paths.resources %>Public/CKEditor/Plugins/Address/plugin.min.js'
            },
            ckeditor_box: {
                src: '<%= paths.resources %>Public/CKEditor/Plugins/Box/plugin.js',
                dest: '<%= paths.resources %>Public/CKEditor/Plugins/Box/plugin.min.js'
            },
            ckeditor_columns: {
                src: '<%= paths.resources %>Public/CKEditor/Plugins/Columns/plugin.js',
                dest: '<%= paths.resources %>Public/CKEditor/Plugins/Columns/plugin.min.js'
            },
            ckeditor_indent: {
                src: '<%= paths.resources %>Public/CKEditor/Plugins/Indent/plugin.js',
                dest: '<%= paths.resources %>Public/CKEditor/Plugins/Indent/plugin.min.js'
            },
            ckeditor_table: {
                src: '<%= paths.resources %>Public/CKEditor/Plugins/Table/plugin.js',
                dest: '<%= paths.resources %>Public/CKEditor/Plugins/Table/plugin.min.js'
            }
        },
        removesourcemap: {
            contrib: {
                files: {
                    '<%= paths.contrib %>bootstrap4/js/bootstrap.min.js': '<%= paths.contrib %>bootstrap4/js/bootstrap.min.js',
                    '<%= paths.contrib %>hammerjs/hammer.min.js': '<%= paths.contrib %>hammerjs/hammer.min.js',
                    '<%= paths.contrib %>popper/popper.min.js': '<%= paths.contrib %>popper/popper.min.js'
                }
            }
        },
        sass: {
            options: {
                implementation: sass,
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
            cookieconsent: {
                files: '<%= paths.js %>Src/bootstrap.cookieconsent.js',
                tasks: 'uglify:cookieconsent'
            },
            ckeditor_address: {
                files: '<%= paths.resources %>Public/CKEditor/Plugins/Address/plugin.js',
                tasks: 'uglify:ckeditor_address'
            },
            ckeditor_box: {
                files: '<%= paths.resources %>Public/CKEditor/Plugins/Box/plugin.js',
                tasks: 'uglify:ckeditor_box'
            },
            ckeditor_columns: {
                files: '<%= paths.resources %>Public/CKEditor/Plugins/Columns/plugin.js',
                tasks: 'uglify:ckeditor_columns'
            },
            ckeditor_indent: {
                files: '<%= paths.resources %>Public/CKEditor/Plugins/Indent/plugin.js',
                tasks: 'uglify:ckeditor_indent'
            },
            ckeditor_table: {
                files: '<%= paths.resources %>Public/CKEditor/Plugins/Table/plugin.js',
                tasks: 'uglify:ckeditor_table'
            },
            scss: {
                files: '<%= paths.scss %>**/*.scss',
                tasks: 'css'
            }
        },
        imagemin: {
            images: {
                options: {
                    svgoPlugins: [{
                        removeViewBox: false
                    }]
                },
                files: [
                    {
                        cwd: '<%= paths.images %>',
                        src: ['**/*.{png,jpg,gif,svg}'],
                        dest: '<%= paths.images %>',
                        expand: true
                    }
                ]
            },
            icons: {
                options: {
                    svgoPlugins: [{
                        removeViewBox: false
                    }]
                },
                files: [
                    {
                        cwd: '<%= paths.icons %>',
                        src: ['**/*.{png,jpg,gif,svg}'],
                        dest: '<%= paths.icons %>',
                        expand: true
                    }
                ]
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
            cookieconsent: {
                files: [
                    {
                        cwd: '<%= paths.node %>cookieconsent/build/',
                        src: [
                            'cookieconsent.min.css',
                            'cookieconsent.min.js',
                        ],
                        dest: '<%= paths.contrib %>cookieconsent/',
                        expand: true
                    }
                ]
            },
            hammerjs: {
                files: [
                    {
                        cwd: '<%= paths.node %>hammerjs/',
                        src: [
                            'hammer.min.js'
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
                            'popper.min.js'
                        ],
                        dest: '<%= paths.contrib %>popper/',
                        expand: true
                    }
                ]
            },
            bootstrap4: {
                files: [
                    {
                        cwd: '<%= paths.node %>bootstrap/dist/js/',
                        src: [
                            'bootstrap.min.js'
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
            },
        },
        modernizr: {
            main: {
                'dest': '<%= paths.contrib %>modernizr/modernizr.min.js',
                'options': {
                    'options': [
                        'domPrefixes',
                        'prefixes',
                        'addTest',
                        'hasEvent',
                        'mq',
                        'prefixedCSSValue',
                        'testAllProps',
                        'testProp',
                        'testStyles',
                        'setClasses'
                    ],
                    'feature-detects': [
                        'custom-elements',
                        'history',
                        'pointerevents',
                        'postmessage',
                        'webgl',
                        'websockets',
                        'css/animations',
                        'css/columns',
                        'css/flexbox',
                        'elem/picture',
                        'img/sizes',
                        'img/srcset',
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
                    codepointsFile: "bootstrappackageicon.json",
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
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-imagemin');
    grunt.loadNpmTasks('grunt-sass');
    grunt.loadNpmTasks('grunt-stylelint');
    grunt.loadNpmTasks('grunt-webfont');

    /**
     * Grunt update task
     */
    grunt.registerTask('update', ['copy', 'modernizr']);
    grunt.registerTask('icon', ['webfont', 'cssmin:bootstrappackageicon']);
    grunt.registerTask('css', ['sass', 'rebase', 'cssmin']);
    grunt.registerTask('js', ['uglify', 'removesourcemap']);
    grunt.registerTask('image', ['imagemin']);
    grunt.registerTask('lint', ['stylelint']);
    grunt.registerTask('build', ['update', 'lint', 'webfont', 'css', 'js', 'image']);
    grunt.registerTask('default', ['build']);

};
