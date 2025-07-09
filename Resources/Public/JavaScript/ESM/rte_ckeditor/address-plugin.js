import * as Core from '@ckeditor/ckeditor5-core';
import * as UI from '@ckeditor/ckeditor5-ui';

export class BootstrapPackageAddress extends Core.Plugin {
    static get pluginName() {
        return 'BootstrapPackageAddress';
    }

    init() {
        const editor = this.editor;

        editor.model.schema.register('address', {
            isObject: true,
            allowWhere: '$block'
        });

        editor.model.schema.register('addressTitle', {
            allowIn: 'address',
            allowContentOf: '$block'
        });
        editor.model.schema.register('addressAddress', {
            allowIn: 'address',
            allowContentOf: '$block'
        });
        editor.model.schema.register('addressPhone', {
            allowIn: 'address',
            allowContentOf: '$block'
        });
        editor.model.schema.register('addressFax', {
            allowIn: 'address',
            allowContentOf: '$block'
        });
        editor.model.schema.register('addressEmail', {
            allowIn: 'address',
            allowContentOf: '$block'
        });
        editor.model.schema.register('addressWWW', {
            allowIn: 'address',
            allowContentOf: '$block'
        });

        editor.conversion.for('upcast').elementToElement({
            model: 'address',
            view: {
                name: 'address',
                classes: 'address'
            }
        });
        editor.conversion.for('upcast').elementToElement({
            model: 'addressTitle',
            view: {
                name: 'p',
                classes: 'address-title'
            }
        });
        editor.conversion.for('upcast').elementToElement({
            model: 'addressAddress',
            view: {
                name: 'p',
                classes: 'address-address'
            }
        });
        editor.conversion.for('upcast').elementToElement({
            model: 'addressPhone',
            view: {
                name: 'p',
                classes: 'address-phone'
            }
        });
        editor.conversion.for('upcast').elementToElement({
            model: 'addressFax',
            view: {
                name: 'p',
                classes: 'address-fax'
            }
        });
        editor.conversion.for('upcast').elementToElement({
            model: 'addressEmail',
            view: {
                name: 'p',
                classes: 'address-email'
            }
        });
        editor.conversion.for('upcast').elementToElement({
            model: 'addressWWW',
            view: {
                name: 'p',
                classes: 'address-www'
            }
        });

        editor.conversion.for('dataDowncast').elementToElement({
            model: 'address',
            view: (modelElement, { writer }) => writer.createContainerElement('address', { class: 'address' })
        });
        editor.conversion.for('dataDowncast').elementToElement({
            model: 'addressTitle',
            view: (modelElement, { writer }) => writer.createContainerElement('p', { class: 'address-title' })
        });
        editor.conversion.for('dataDowncast').elementToElement({
            model: 'addressAddress',
            view: (modelElement, { writer }) => writer.createContainerElement('p', { class: 'address-address' })
        });
        editor.conversion.for('dataDowncast').elementToElement({
            model: 'addressPhone',
            view: (modelElement, { writer }) => writer.createContainerElement('p', { class: 'address-phone' })
        });
        editor.conversion.for('dataDowncast').elementToElement({
            model: 'addressFax',
            view: (modelElement, { writer }) => writer.createContainerElement('p', { class: 'address-fax' })
        });
        editor.conversion.for('dataDowncast').elementToElement({
            model: 'addressEmail',
            view: (modelElement, { writer }) => writer.createContainerElement('p', { class: 'address-email' })
        });
        editor.conversion.for('dataDowncast').elementToElement({
            model: 'addressWWW',
            view: (modelElement, { writer }) => writer.createContainerElement('p', { class: 'address-www' })
        });

        editor.conversion.for('editingDowncast').elementToElement({
            model: 'address',
            view: (modelElement, { writer }) => writer.createContainerElement('address', { class: 'address' })
        });
        editor.conversion.for('editingDowncast').elementToElement({
            model: 'addressTitle',
            view: (modelElement, { writer }) => writer.createEditableElement('p', { class: 'address-title' })
        });
        editor.conversion.for('editingDowncast').elementToElement({
            model: 'addressAddress',
            view: (modelElement, { writer }) => writer.createEditableElement('p', { class: 'address-address' })
        });
        editor.conversion.for('editingDowncast').elementToElement({
            model: 'addressPhone',
            view: (modelElement, { writer }) => writer.createEditableElement('p', { class: 'address-phone' })
        });
        editor.conversion.for('editingDowncast').elementToElement({
            model: 'addressFax',
            view: (modelElement, { writer }) => writer.createEditableElement('p', { class: 'address-fax' })
        });
        editor.conversion.for('editingDowncast').elementToElement({
            model: 'addressEmail',
            view: (modelElement, { writer }) => writer.createEditableElement('p', { class: 'address-email' })
        });
        editor.conversion.for('editingDowncast').elementToElement({
            model: 'addressWWW',
            view: (modelElement, { writer }) => writer.createEditableElement('p', { class: 'address-www' })
        });

        editor.commands.add('insertAddress', new InsertAddressCommand( editor ));

        editor.ui.componentFactory.add('address', locale => {
            const view = new UI.ButtonView(locale);
            view.set({
                label: 'Insert Address',
                icon: `
                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 16 16">
                        <g fill="currentColor">
                            <path d="M8,2c2.2,0,4,1.8,4,4c0,2.8-3,8-4,8S4,8.8,4,6C4,3.8,5.8,2,8,2 M8,1C5.2,1,3,3.2,3,6s3,9,5,9s5-6.2,5-9S10.8,1,8,1L8,1z"/>
                            <circle cx="8" cy="6" r="2"/>
                        </g>
                    </svg>
                `,
                tooltip: true
            });
            view.bind('isEnabled').to(editor.commands.get('insertAddress'));
            view.on('execute', () => {
                editor.execute('insertAddress');
            });

            return view;
        });
    }
}

class InsertAddressCommand extends Core.Command {
    execute() {
        this.editor.model.change( writer => {
            const addressElement = writer.createElement('address');
            const title = writer.createElement('addressTitle');
            const addr = writer.createElement('addressAddress');
            const phone = writer.createElement('addressPhone');
            const fax = writer.createElement('addressFax');
            const email = writer.createElement('addressEmail');
            const www = writer.createElement('addressWWW');

            writer.append(title, addressElement);
            writer.append(addr, addressElement);
            writer.append(phone, addressElement);
            writer.append(fax, addressElement);
            writer.append(email, addressElement);
            writer.append(www, addressElement);

            writer.insertText('Name', { bold: true }, title);
            writer.insertText('Street', {}, addr);
            writer.insertElement('softBreak', addr);
            writer.insertText('Zip & City', {}, addr);
            writer.insertText('+49 1234 456-7890', {}, phone);
            writer.insertText('+49 1234 456-7891', {}, fax);
            writer.insertText('john.doe@example.com', { linkHref: 'mailto:john.doe@example.com' }, email);
            writer.insertText('www.example.com', { linkHref: 'http://www.example.com' }, www);
            this.editor.model.insertContent( addressElement);
            writer.setSelection( addressElement, 'in');
        });
    }

    refresh() {
        const model = this.editor.model;
        const selection = model.document.selection;
        this.isEnabled = !selection.getFirstPosition().findAncestor('address');
    }
}
