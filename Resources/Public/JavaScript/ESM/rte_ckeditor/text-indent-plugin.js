import * as Core from '@ckeditor/ckeditor5-core';
import * as UI from '@ckeditor/ckeditor5-ui';
import * as Widget from '@ckeditor/ckeditor5-widget';

export class BootstrapPackageTextIndent extends Core.Plugin {
    static get pluginName() {
        return 'BootstrapPackageTextIndent';
    }

    init() {
        const editor = this.editor;

        editor.model.schema.register('textIndent', {
            allowWhere: '$block',
            allowContentOf: '$root'
        });

        editor.conversion.for('upcast').elementToElement({
            model: 'textIndent',
            view: {
                name: 'div',
                classes: 'text-indent'
            }
        });

        editor.conversion.for('dataDowncast').elementToElement({
            model: 'textIndent',
            view: {
                name: 'div',
                classes: 'text-indent'
            }
        });

        editor.conversion.for('editingDowncast').elementToElement({
            model: 'textIndent',
            view: (modelElement, { writer }) => {
                const div = writer.createContainerElement('div', { class: 'text-indent' });
                return Widget.toWidgetEditable(div, writer, { label: 'text indent widget' });
            }
        });

        editor.commands.add('insertTextIndent', new InsertTextIndentCommand(editor));

        editor.ui.componentFactory.add('textIndent', locale => {
            const view = new UI.ButtonView(locale);
            view.set({
                label: 'Insert Text Indent',
                icon: `
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16">
                        <g fill="currentColor">
                            <path d="M9 2h5v2H9zM9 5h5v1H9zM9 7h5v1H9zM9 9h5v1H9zM9 11h5v1H9zM9 13h5v1H9z"/>
                            <path d="M7 2h1v12H7z" opacity=".5"/>
                            <path d="M2.3 10c0 .4.5.6.8.4l2.7-2c.2-.2.2-.6 0-.8l-2.7-2c-.3-.2-.8 0-.8.4v4Z"/>
                        </g>
                    </svg>
                `,
                tooltip: true
            });

            view.bind('isEnabled').to(editor.commands.get('insertTextIndent'));
            view.bind('isOn').to(editor.commands.get('insertTextIndent'), 'value');
            view.on('execute', () => {
                editor.execute('insertTextIndent');
                editor.editing.view.focus();
            });

            return view;
        });
    }
}

class InsertTextIndentCommand extends Core.Command {
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
                return !!block.getAncestors().find(ancestor => ancestor.name === 'textIndent');
            });

            if (isWrapped) {
                const box = blocks[0].getAncestors().find(ancestor => ancestor.name === 'textIndent');
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
                const box = writer.createElement('textIndent');
                writer.insert(box, writer.createPositionBefore(blocks[0]));
                for (const block of blocks) {
                    if (!block.getAncestors().some(ancestor => ancestor.name === 'textIndent')) {
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
        this.value = this.isEnabled && blocks.every(block => !!block.getAncestors().find(ancestor => ancestor.name === 'textIndent'));
    }
}
