import * as Core from '@ckeditor/ckeditor5-core';
import * as UI from '@ckeditor/ckeditor5-ui';
import * as Widget from '@ckeditor/ckeditor5-widget';

export class BootstrapPackageTextColumn extends Core.Plugin {
    static get pluginName() {
        return 'BootstrapPackageTextColumn';
    }

    init() {
        const editor = this.editor;

        editor.model.schema.register('textColumn', {
            allowWhere: '$block',
            allowContentOf: '$root'
        });

        editor.conversion.for('upcast').elementToElement({
            model: 'textColumn',
            view: {
                name: 'div',
                classes: 'text-column'
            }
        });

        editor.conversion.for('dataDowncast').elementToElement({
            model: 'textColumn',
            view: {
                name: 'div',
                classes: 'text-column'
            }
        });

        editor.conversion.for('editingDowncast').elementToElement({
            model: 'textColumn',
            view: (modelElement, { writer }) => {
                const div = writer.createContainerElement('div', { class: 'text-column' });
                return Widget.toWidgetEditable(div, writer, { label: 'text column widget' });
            }
        });

        editor.commands.add('insertTextColumn', new InsertTextColumnCommand(editor));

        editor.ui.componentFactory.add('textColumn', locale => {
            const view = new UI.ButtonView(locale);
            view.set({
                label: 'Insert Text Column',
                icon: `
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16">
                        <g fill="currentColor">
                            <path d="M2 2h5v2H2zM2 5h5v1H2zM2 7h5v1H2zM2 9h5v1H2zM2 11h5v1H2zM2 13h5v1H2zM9 2h5v2H9zM9 5h5v1H9zM9 7h5v1H9zM9 9h5v1H9zM9 11h5v1H9zM9 13h5v1H9z"/>
                        </g>
                    </svg>
                `,
                tooltip: true
            });

            view.bind('isEnabled').to(editor.commands.get('insertTextColumn'));
            view.bind('isOn').to(editor.commands.get('insertTextColumn'), 'value');
            view.on('execute', () => {
                editor.execute('insertTextColumn');
                editor.editing.view.focus();
            });

            return view;
        });
    }
}

class InsertTextColumnCommand extends Core.Command {
    execute() {
        const editor = this.editor;
        const model = editor.model;
        const selection = model.document.selection;
        const blocks = Array.from(selection.getSelectedBlocks());

        if (blocks.length === 0) {
            return;
        }

        model.change(writer => {
            const isWrapped = blocks.every(block => {
                return !!block.getAncestors().find(ancestor => ancestor.name === 'textColumn');
            });

            if (isWrapped) {
                const box = blocks[0].getAncestors().find(ancestor => ancestor.name === 'textColumn');
                if (!box) {
                    return;
                }
                const contentChildren = Array.from(box.getChildren());
                for (const child of contentChildren) {
                    writer.move(
                        writer.createRangeOn(child),
                        writer.createPositionBefore(box)
                    );
                }
                writer.remove(box);
            } else {
                const box = writer.createElement('textColumn');
                writer.insert(box, writer.createPositionBefore(blocks[0]));
                for (const block of blocks) {
                    if (!block.getAncestors().some(ancestor => ancestor.name === 'textColumn')) {
                        writer.move(
                            writer.createRangeOn(block),
                            writer.createPositionAt(box, 'end')
                        );
                    }
                }
                if (box.childCount === 0) {
                    const paragraph = writer.createElement('paragraph');
                    writer.append(paragraph, box);
                }
            }
        });
    }

    refresh() {
        const editor = this.editor;
        const blocks = Array.from(editor.model.document.selection.getSelectedBlocks());
        this.isEnabled = blocks.length > 0;
        this.value = this.isEnabled && blocks.every(block => !!block.getAncestors().find(ancestor => ancestor.name === 'textColumn'));
    }
}
