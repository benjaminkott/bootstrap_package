/* ========================================================================
 * Cookie Consent
 * ======================================================================== */

+function ($) {

    if ($('#cookieconsent').length > 0) {

        // Default Options
        var cookieConsentOptions = {
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
            revokeBtn: '<div class="cc-revoke {{classes}}">Cookie settings</div>',
            content: {
                header: "Cookies used on the website!",
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
        var cookieConsentSupportedOptions = [
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
        var cookieConsentFunctions = {};
        cookieConsentFunctions.updateCookieConsentOptions = function(options, path, value) {
            var stack = path.split('.');
            while (stack.length > 1) {
                key = stack.shift();
                options = options[key];
            }
            options[stack.shift()] = value;
        }

        // Settings
        $('[data-cookieconsent-setting]').each(function () {
            var data = $(this).data();
            var setting = data.cookieconsentSetting;
            var value = data.cookieconsentValue;
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
            $(this).remove();
        });

        // Events
        cookieConsentOptions.onPopupOpen = function() {
            var type = this.options.type;
            if (type == "info" || type == "opt-out") {
                $(window).trigger('bk2k.cookie.enable', [type, 'onPopupOpen', undefined]);
            }
        };
        cookieConsentOptions.onInitialise = function (status) {
            var type = this.options.type;
            var didConsent = this.hasConsented();
            if (didConsent) {
                $(window).trigger('bk2k.cookie.enable', [type, 'onInitialise', status]);
            }
            if (!didConsent) {
                $(window).trigger('bk2k.cookie.disable', [type, 'onInitialise', status]);
            }
        };
        cookieConsentOptions.onStatusChange = function (status, chosenBefore) {
            var type = this.options.type;
            var didConsent = this.hasConsented();
            if (didConsent && type == 'opt-in') {
                $(window).trigger('bk2k.cookie.enable', [type, 'onStatusChange', status]);
            }
            if (!didConsent && (type == 'opt-in' || type == 'opt-out')) {
                $(window).trigger('bk2k.cookie.disable', [type, 'onStatusChange', status]);
            }
        };
        cookieConsentOptions.onRevokeChoice = function () {
            var type = this.options.type;
            $(window).trigger('bk2k.cookie.revoke', [type, 'onRevokeChoice', undefined]);
        };

        // Initialize
        cookieConsentOptions.container = document.getElementById("cookieconsent");
        window.cookieconsent.initialise(cookieConsentOptions);

    }
}(jQuery);
