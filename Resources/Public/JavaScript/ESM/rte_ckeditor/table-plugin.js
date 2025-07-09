import * as Core from '@ckeditor/ckeditor5-core';

export class BootstrapPackageTablePlugin extends Core.Plugin {
    static get pluginName() {
        return 'BootstrapPackageTablePlugin';
    }

    init() {
        const editor = this.editor;

        editor.model.schema.extend('table', {
            allowAttributes: ['class']
        });

        editor.model.document.registerPostFixer(writer => {
            let wasModified = false;
            for (const element of editor.model.document.getRoot().getChildren()) {
                if (element.is('element', 'table')) {
                    const currentClass = element.getAttribute('class') || '';
                    const classes = currentClass.split(' ').filter(cls => cls);
                    if (!classes.includes('table')) {
                        classes.push('table');
                        writer.setAttribute('class', classes.join(' '), element);
                        wasModified = true;
                    }
                }
            }
            return wasModified;
        });

        editor.conversion.for('downcast').add(dispatcher => {
            dispatcher.on('insert:table', (evt, data, conversionApi) => {
                const writer = conversionApi.writer;
                const viewFigure = conversionApi.mapper.toViewElement(data.item);
                if (!viewFigure) {
                    return;
                }
                const tableElement = Array.from(viewFigure.getChildren())
                    .find(child => child.is('element', 'table'));
                if (tableElement && !tableElement.hasClass('table')) {
                    writer.addClass('table', tableElement);
                }
            }, {
                priority: 'low'
            });
        });

        editor.conversion.for('upcast').add(dispatcher => {
            dispatcher.on('element:table', (evt, data, conversionApi) => {
                if (!data.modelRange || !data.modelRange.start) {
                    return;
                }
                const modelTable = data.modelRange.start.nodeAfter;
                if (modelTable) {
                    const currentClass = modelTable.getAttribute('class') || '';
                    const classes = currentClass.split(' ').filter(cls => cls);
                    if (!classes.includes('table')) {
                        classes.push('table');
                        conversionApi.writer.setAttribute('class', classes.join(' '), modelTable);
                    }
                }
            }, {
                priority: 'low'
            });
        });
    }
}
