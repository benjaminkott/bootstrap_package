import * as Core from '@ckeditor/ckeditor5-core';
import * as UI from '@ckeditor/ckeditor5-ui';
import * as Widget from '@ckeditor/ckeditor5-widget';

export class BootstrapPackageBox extends Core.Plugin {
    static get pluginName() {
        return 'BootstrapPackageBox';
    }

    init() {
        const editor = this.editor;

        editor.model.schema.register('box', {
            allowWhere: '$block',
            allowContentOf: '$root'
        });

        editor.conversion.for('upcast').elementToElement({
            model: 'box',
            view: {
                name: 'div',
                classes: 'well'
            }
        });

        editor.conversion.for('dataDowncast').elementToElement({
            model: 'box',
            view: {
                name: 'div',
                classes: 'well'
            }
        });

        editor.conversion.for('editingDowncast').elementToElement({
            model: 'box',
            view: (modelElement, { writer }) => {
                const div = writer.createContainerElement('div', { class: 'well' });
                return Widget.toWidgetEditable(div, writer, { label: 'box widget' });
            }
        });

        editor.commands.add('insertBox', new InsertBoxCommand(editor));

        editor.ui.componentFactory.add('box', locale => {
            const view = new UI.ButtonView(locale);
            view.set({
                label: 'Insert Box',
                icon: `
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16">
                        <g fill="currentColor">
                            <path d="M13 2c.6 0 1 .4 1 1v10c0 .6-.4 1-1 1H3c-.6 0-1-.4-1-1V3c0-.6.4-1 1-1h10m0-1H3c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h10c1.1 0 2-.9 2-2V3c0-1.1-.9-2-2-2z"/>' +
                        </g>
                    </svg>
                `,
                tooltip: true
            });

            view.bind('isEnabled').to(editor.commands.get('insertBox'));
            view.bind('isOn').to(editor.commands.get('insertBox'), 'value');
            view.on('execute', () => {
                editor.execute('insertBox');
                editor.editing.view.focus();
            });

            return view;
        });
    }
}

class InsertBoxCommand extends Core.Command {
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
                return !!block.getAncestors().find(ancestor => ancestor.name === 'box');
            });

            if (isWrapped) {
                const box = blocks[0].getAncestors().find(ancestor => ancestor.name === 'box');
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
                const box = writer.createElement('box');
                writer.insert(box, writer.createPositionBefore(blocks[0]));
                for (const block of blocks) {
                    if (!block.getAncestors().some(ancestor => ancestor.name === 'box')) {
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
        this.value = this.isEnabled && blocks.every(block => !!block.getAncestors().find(ancestor => ancestor.name === 'box'));
    }
}
