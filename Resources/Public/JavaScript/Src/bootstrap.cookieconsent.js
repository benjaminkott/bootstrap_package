window.addEventListener('DOMContentLoaded', function () {

    if (document.getElementById('cookieconsent')) {
        // Default Options
        const cookieConsentOptions = {
            layout: 'basic',
            layouts: {
                'basic': '<div class="cc-container">{{messagelink}}{{compliance}}</div>',
                'basic-close': '<div class="cc-container">{{messagelink}}{{compliance}}{{close}}</div>',
                'basic-header': '<div class="cc-container">{{header}}{{message}}{{link}}{{compliance}}</div>',
            },
            cookie: {
                domain: window.location.hostname,
                expiryDays: 365,
            },
            compliance: {
                'opt-in': '<div class="cc-compliance cc-highlight">{{deny}}{{allow}}</div>',
            },
            elements: {
                header: '<h2 class="cc-header">{{header}}</h2>',
                dismiss: '<button tabindex="0" class="cc-btn cc-dismiss">{{dismiss}}</button>',
                allow: '<button tabindex="0" class="cc-btn cc-allow">{{allow}}</button>',
            },
            window:
                '<div role="dialog" aria-label="cookieconsent" aria-describedby="cookieconsent:desc" class="cc-window {{classes}}"><!--googleoff: all-->{{children}}<!--googleon: all--></div>',
            revokeBtn: '<div class="cc-revoke {{classes}}">Cookie settings</div>',
            content: {
                header: "We use cookies",
                message: "This website uses cookies to ensure you get the best experience on our website.",
                dismiss: "Got it!",
                allow: "Allow cookies",
                deny: "Decline",
                link: "Learn more",
                href: '',
            },
            law: {
                countryCode: null,
                regionalLaw: true,
            },
            type: "info",
            position: "bottom",
            revokable: false,
            static: false,
            location: true,
            showLink: false,
        };

        // Supported Options
        const cookieConsentSupportedOptions = [
            'layout',
            'cookie.expiryDays',
            'content.header',
            'content.message',
            'content.dismiss',
            'content.allow',
            'content.deny',
            'content.link',
            'content.href',
            'type',
            'position',
            'law.countryCode',
            'law.regionalLaw',
            'revokable',
            'static',
            'location',
        ];

        // Functions
        const cookieConsentFunctions = {};
        cookieConsentFunctions.updateCookieConsentOptions = function (options, path, value) {
            stack = path.split('.');
            while (stack.length > 1) {
                key = stack.shift();
                options = options[key];
            }
            options[stack.shift()] = value;
        }

        // Settings
        document.querySelectorAll('[data-cookieconsent-setting]').forEach(function (element) {
            const setting = element.dataset.cookieconsentSetting;
            let value = element.dataset.cookieconsentValue;
            if (parseInt(value, 10) == value) {
                value = parseInt(value, 10);
            }
            if (cookieConsentSupportedOptions.indexOf(setting) != -1) {
                cookieConsentFunctions.updateCookieConsentOptions(
                    cookieConsentOptions,
                    setting,
                    value
                );
                if (setting === 'content.href') {
                    cookieConsentFunctions.updateCookieConsentOptions(
                        cookieConsentOptions,
                        'showLink',
                        (value !== '') ? true : false
                    );
                }
            }
            element.remove();
        });

        // Events
        cookieConsentOptions.onPopupOpen = function () {
            const eventOpen = new Event('bk2k.cookie.popupopen', { bubbles: true, cancelable: true });
            window.dispatchEvent(eventOpen);
            const type = this.options.type;
            if (type === "info" || type === "opt-out") {
                const event = new Event('bk2k.cookie.enable', { bubbles: true, cancelable: true });
                window.dispatchEvent(event);
            }
        };
        cookieConsentOptions.onPopupClose = function() {
            const event = new Event('bk2k.cookie.popupclose', { bubbles: true, cancelable: true });
            window.dispatchEvent(event);
        };
        cookieConsentOptions.onInitialise = function () {
            let eventName = 'bk2k.cookie.disable';
            if (this.hasConsented()) {
                eventName = 'bk2k.cookie.enable';
            }
            const event = new Event(eventName, { bubbles: true, cancelable: true });
            window.dispatchEvent(event);
        };
        cookieConsentOptions.onStatusChange = function () {
            const type = this.options.type;
            const didConsent = this.hasConsented();
            if (didConsent && type === 'opt-in') {
                const event = new Event('bk2k.cookie.enable', { bubbles: true, cancelable: true });
                window.dispatchEvent(event);
            }
            if (!didConsent && (type === 'opt-in' || type === 'opt-out')) {
                const event = new Event('bk2k.cookie.disable', { bubbles: true, cancelable: true });
                window.dispatchEvent(event);
            }
        };
        cookieConsentOptions.onRevokeChoice = function () {
            const event = new Event('bk2k.cookie.revoke', { bubbles: true, cancelable: true });
            window.dispatchEvent(event);
        };

        // Initialize
        cookieConsentOptions.container = document.getElementById('cookieconsent');
        window.cookieconsent.initialise(cookieConsentOptions);
    }

});
