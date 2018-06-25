'use strict';

(function() {

    CKEDITOR.plugins.add('bootstrappackage_address', {
        lang: 'en,de',
        requires: 'widget',
        icons: 'address',
        hidpi: true,
        init: function(editor) {
            editor.widgets.add('address', {
                button: editor.lang.bootstrappackage_address.toolbar,
                template:
                    '<address class="address">' +
                        '<p class="address-title"><strong>Name</strong></p>' +
                        '<p class="address-address">Street<br>Zip & City</p>' +
                        '<p class="address-phone">+49 1234 456-7890</p>' +
                        '<p class="address-fax">+49 1234 456-7891</p>' +
                        '<p class="address-email"><a href="mailto:john.doe@example.com">john.doe@example.com</a></p>' +
                        '<p class="address-www"><a href="http://www.example.com">www.example.com</a></p>' +
                    '</address>',
                editables: {
                    title: {
                        selector: '.address-title',
                        allowedContent: 'br strong em'
                    },
                    address: {
                        selector: '.address-address',
                        allowedContent: 'br strong em'
                    },
                    phone: {
                        selector: '.address-phone',
                        allowedContent: 'br strong em'
                    },
                    fax: {
                        selector: '.address-fax',
                        allowedContent: 'br strong em'
                    },
                    email: {
                        selector: '.address-email',
                        allowedContent: 'br strong em a[!href]'
                    },
                    www: {
                        selector: '.address-www',
                        allowedContent: 'br strong em a[!href]'
                    }
                },
                allowedContent:
                    'address(!address);',
                requiredContent: 'address(address)',
                upcast: function(element) {
                    return element.name == 'address' && element.hasClass('address');
                }
            });
        }
    });

})();
