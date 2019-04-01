+function ($) {
    /**
     * Embeds the fixed positioned cookie consent dialog in a way that the original page content is shown entirely. This
     * is achieved by adding a padding to the framing container (.body-bg). In case the original page content contains
     * fixed positioned border elements (header or footer) a margin is applied to one of them hence the cookie consent
     * dialog doesn't overlap it any more.
     *
     * Events:
     * bk2k.cookie.framechange: Fired when the padding from the framing container changes
     * bk2k.cookie.borderchange: Fired when the margin from a border element changes
     */
    var cookieConsentService = {
        $dialog: null,
        dialogPosition: 'top',
        $frame: null,
        $border: null,

        /**
         * Initialize the object
         */
        init: function () {
            this.$dialog = $('#cookieconsent .cc-window');
            if (this.$dialog.length && this.$dialog.hasClass('cc-bottom')) {
                this.dialogPosition = 'bottom';
            }
            this.$frame = $('.body-bg');
            if (this.dialogPosition === 'top') {
                this.$border = $('.body-bg > header');
            } else {
                this.$border = $('.body-bg > footer');
            }
        },

        embeddingRequired: function () {
            var dialogFillsWidth = this.$dialog.outerWidth(true) >= this.$frame.outerWidth(true);
            return this.$dialog !== null && this.$dialog.length
                && !this.$dialog.hasClass('cc-invisible')
                && !this.$dialog.hasClass('cc-static')
                && dialogFillsWidth;
        },

        /**
         * Update the frame for that the fixed positioned cookie consent dialog fits in.
         * To embed the dialog a padding is added to the framing container (.body-bg). The padding added is as big as
         * the cookie dialog height and the adjacent border element height if it is fix positioned.
         *
         * In case the padding from the framing container changes an event will be dispatched to give other members the
         * chance to adapt to this change.
         *
         * @return void
         */
        updateFrame: function () {
            // the height to fit the dialog
            var newPadding = this.$dialog.outerHeight(true);
            if (!this.embeddingRequired() || this.$dialog.hasClass('cc-invisible')) {
                newPadding = 0;
            }
            // the height from a fix positioned border element
            if(this.$border.css('position') === 'fixed') {
                newPadding += this.$border.outerHeight();
            }
            var previousPadding = parseFloat(this.$frame.css('padding-' + this.dialogPosition));
            this.$frame.css('padding-' + this.dialogPosition,newPadding);
            // notify about the change
            if (newPadding !== previousPadding) {
                var event = document.createEvent('Event');
                event.initEvent('bk2k.cookie.framechange', true, true);
                window.dispatchEvent(event);
            }
        },

        /**
         * On the frames border fix positioned elements might be present. For that the cookie consent dialog doesn't
         * overlap those elements a margin is added to the border element next to the cookie consent dialog.
         *
         * In case the margin from the border element changes an event will be dispatched to give other members the
         * chance to adapt to this change.
         *
         * @return void
         */
        updateBorder: function () {
            var newMargin = this.$dialog.outerHeight(true);
            if (!this.embeddingRequired() || this.$dialog.hasClass('cc-invisible')) {
                newMargin = 0;
            }
            // remove margin if the element is not fix positioned
            if(this.$border.css('position') !== 'fixed') {
                newMargin = 0;
            }
            var previousMargin = parseFloat(this.$border.css('margin-' + this.dialogPosition));
            // apply an effect in case the margin is removed
            this.$border.css('margin-' + this.dialogPosition,newMargin);
            // notify about the change
            if (newMargin !== previousMargin) {
                var event = document.createEvent('Event');
                event.initEvent('bk2k.cookie.borderchange', true, true);
                window.dispatchEvent(event);
            }
        },

        /**
         * Update the dialog embedding
         *
         * @return void
         */
        update: function () {
            this.updateFrame();
            this.updateBorder();
        },

        /**
         * Call the update method with delay to ensure the dialog is in stationary state.
         * Upon calling this method the dialog might not have its final size due to the rendering not being completed
         * (e.g. due to animations or screen rotation).
         *
         * @see CookiePopup.prototype.fadeIn from cookieconsent.js
         */
        updateDelayed: function (delay) {
            delay = typeof delay !== 'undefined' ? delay : 40;
            window.setTimeout(function ($this) {
                $this.update();
            },delay,this);
        },

        registerEventHandlers: function () {
            window.addEventListener('bk2k.cookie.popupopen',function() {
                cookieConsentService.updateDelayed();
            });

            window.addEventListener('bk2k.cookie.popupclose',function() {
                cookieConsentService.update();
            });

            var mediaOrientation = window.matchMedia('(orientation: portrait)');
            mediaOrientation.addListener(function () {
                cookieConsentService.updateDelayed(200);
            });
        },

    };

    /**
     * Start when DOM is ready (cookie consent dialog added to DOM)
     */
    $(function() {
        /**
         * delay initialisation until cookie dialog updated class 'cc-invisible'
         *
         * @see CookiePopup.prototype.fadeIn from cookieconsent.js
         */
        window.setTimeout(function () {
            cookieConsentService.init();
            cookieConsentService.registerEventHandlers();
            if (!cookieConsentService.embeddingRequired()) return;
            cookieConsentService.update();
        },40);
    });

}(jQuery);