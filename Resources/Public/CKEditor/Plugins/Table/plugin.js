'use strict';

(function() {

    CKEDITOR.plugins.add('bootstrappackage_table', {
        init: function(editor) {
            editor.on('removeFormatCleanup', function(event) {
                var element = event.data;
                if (element.is('table')) {
                    element.addClass('table');
                }
            });
        },
        afterInit: function (editor) {
            var dataProcessor = editor.dataProcessor,
                dataFilter = dataProcessor && dataProcessor.dataFilter,
                htmlFilter = dataProcessor && dataProcessor.htmlFilter;
            if (dataFilter) {
                dataFilter.addRules({
                    elements: {
                        table: function(element) {
                            var attributes = element.attributes,
                                cssClass = attributes['class'];
                            if (!cssClass || cssClass.indexOf('table') == -1) {
                                attributes[ 'class' ] = (cssClass || '') + ' table';
                            }
                        }
                    }
                });
            }
            if (htmlFilter) {
                htmlFilter.addRules({
                    elements: {
                        table: function(element) {
                            var attributes = element.attributes,
                                cssClass = attributes['class'];
                            if (!cssClass || cssClass.indexOf('table') == -1) {
                                attributes[ 'class' ] = (cssClass || '') + ' table';
                            }
                        }
                    }
                });
            }
        }
    });

})();
