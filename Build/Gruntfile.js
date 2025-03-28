const sass = require('sass');
const fantasticon = require('fantasticon');

module.exports = function(grunt) {

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
     * Grunt task for webfonts
     */
    grunt.registerMultiTask('webfont', 'Grunt task to run npm scripts', function () {
        var options = this.options(),
            done = this.async();
        fantasticon.generateFonts(options).then(
            function (result) {
                for (const { writePath } of result.writeResults) {
                    grunt.log.ok('Generated ' + writePath);
                }
                done();
            },
            function (error) {
                grunt.log.error(error);
            }
        );
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
        cssmin: {
            options: {
                keepSpecialComments: '*',
                advanced: false
            },
            bootstrap5_theme: {
                src: '<%= paths.css %>bootstrap5-theme.css',
                dest: '<%= paths.css %>bootstrap5-theme.min.css'
            },
            bootstrap5_rte: {
                src: '<%= paths.css %>bootstrap5-rte.css',
                dest: '<%= paths.css %>bootstrap5-rte.min.css'
            },
            bootstrappackageicon: {
                src: '<%= paths.fonts %>bootstrappackageicon.css',
                dest: '<%= paths.fonts %>bootstrappackageicon.min.css'
            },
            photoswipe: {
                src: '<%= paths.contrib %>/photoswipe/photoswipe.css',
                dest: '<%= paths.contrib %>/photoswipe/photoswipe.css'
            },
            photoswipedynamiccaptionplugin: {
                src: '<%= paths.contrib %>/photoswipe/photoswipe-dynamic-caption-plugin.css',
                dest: '<%= paths.contrib %>/photoswipe/photoswipe-dynamic-caption-plugin.css'
            },
        },
        uglify: {
            options: {
                output: {
                    comments: false
                }
            },
            bootstrapAccordion: {
                src: '<%= paths.js %>Src/bootstrap.accordion.js',
                dest: '<%= paths.js %>Dist/bootstrap.accordion.min.js'
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
                    '<%= paths.contrib %>bootstrap5/js/bootstrap.min.js': '<%= paths.contrib %>bootstrap5/js/bootstrap.min.js',
                    '<%= paths.contrib %>popper-core/popper.min.js': '<%= paths.contrib %>popper-core/popper.min.js'
                }
            }
        },
        sass: {
            options: {
                implementation: sass,
                outputStyle: 'expanded',
                precision: 8,
                sourceMap: false,
            },
            bootstrap5_theme: {
                files: {
                    '<%= paths.css %>bootstrap5-theme.css': '<%= paths.sass %>bootstrap5/theme.scss'
                }
            },
            bootstrap5_rte: {
                files: {
                    '<%= paths.css %>bootstrap5-rte.css': '<%= paths.sass %>bootstrap5/rte.scss'
                }
            },
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
                        collapseGroups: false,
                        removeViewBox: false,
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
            photoswipe: {
                files: [
                    {
                        cwd: '<%= paths.node %>photoswipe/dist/',
                        src: [
                            'umd/photoswipe-lightbox.umd.min.js',
                            'umd/photoswipe.umd.min.js',
                            'photoswipe.css'
                        ],
                        dest: '<%= paths.contrib %>photoswipe/',
                        expand: true,
                        flatten: true,
                    },
                    {
                        cwd: '<%= paths.node %>photoswipe-dynamic-caption-plugin/',
                        src: [
                            'dist/photoswipe-dynamic-caption-plugin.umd.min.js',
                            'photoswipe-dynamic-caption-plugin.css'
                        ],
                        dest: '<%= paths.contrib %>photoswipe/',
                        expand: true,
                        flatten: true,
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
            popperCore: {
                files: [
                    {
                        cwd: '<%= paths.node %>@popperjs/core/dist/umd/',
                        src: [
                            'popper.min.js'
                        ],
                        dest: '<%= paths.contrib %>popper-core/',
                        expand: true
                    }
                ]
            },
            bootstrap5: {
                files: [
                    {
                        cwd: '<%= paths.node %>bootstrap5/dist/js/',
                        src: [
                            'bootstrap.min.js'
                        ],
                        dest: '<%= paths.contrib %>bootstrap5/js/',
                        expand: true
                    },
                    {
                        cwd: '<%= paths.node %>bootstrap5/scss/',
                        src: '**',
                        dest: '<%= paths.contrib %>bootstrap5/scss/',
                        expand: true
                    }
                ]
            },
        },
        webfont: {
            bootstrappackageicon: {
                options: {
                    inputDir: '../Resources/Public/Icons/BootstrapPackageIcon',
                    outputDir: '../Resources/Public/Fonts',
                    fontTypes: [
                        'eot',
                        'woff2',
                        'woff',
                        'ttf'
                    ],
                    assetTypes: [
                        'css',
                        'json'
                    ],
                    name: 'bootstrappackageicon',
                    prefix: 'bootstrappackageicon',
                    selector: '.bootstrappackageicon',
                    codepoints: grunt.file.readJSON('./bootstrappackageicon.json'),
                    formatOptions: {
                        json: {
                            indent: 4
                        }
                    },
                    templates: {
                        css: './bootstrappackageicon.css.hbs'
                    },
                    pathOptions: {
                        json:   './bootstrappackageicon.json',
                        css:    '../Resources/Public/Fonts/bootstrappackageicon.css',
                        eot:    '../Resources/Public/Fonts/bootstrappackageicon.eot',
                        ttf:    '../Resources/Public/Fonts/bootstrappackageicon.ttf',
                        woff:   '../Resources/Public/Fonts/bootstrappackageicon.woff',
                        woff2:  '../Resources/Public/Fonts/bootstrappackageicon.woff2'
                    }
                }
            }
        },
    });

    /**
     * Register tasks
     */
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-contrib-copy');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-imagemin');
    grunt.loadNpmTasks('grunt-sass');
    grunt.loadNpmTasks('grunt-stylelint');

    /**
     * Grunt update task
     */
    grunt.registerTask('update', ['copy', 'cssmin:photoswipe', 'cssmin:photoswipedynamiccaptionplugin']);
    grunt.registerTask('icon', ['webfont', 'cssmin:bootstrappackageicon']);
    grunt.registerTask('css', ['sass', 'cssmin']);
    grunt.registerTask('js', ['uglify', 'removesourcemap']);
    grunt.registerTask('image', ['imagemin']);
    grunt.registerTask('lint', ['stylelint']);
    grunt.registerTask('build', ['update', 'lint', 'webfont', 'css', 'js', 'image']);
    grunt.registerTask('default', ['build']);

};
