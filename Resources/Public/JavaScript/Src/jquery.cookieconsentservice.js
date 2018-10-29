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
    let cookieConsentService = {
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

        serviceNeeded: function () {
            let result = this.$dialog !== null && this.$dialog.length;
            result = result && !this.$dialog.hasClass('cc-invisible');
            result = result && !this.$dialog.hasClass('cc-static');
            return result && !this.$dialog.hasClass('cc-floating');
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
            let newPadding = this.$dialog.hasClass('cc-invisible') ? 0 : this.$dialog.outerHeight(true);
            // the height from a fix positioned border element
            if(this.$border.css('position') === 'fixed') {
                newPadding += this.$border.outerHeight();
            }
            let previousPadding = parseFloat(this.$frame.css('padding-' + this.dialogPosition));
            this.$frame.css('padding-' + this.dialogPosition,newPadding);
            // notify about the change
            if (newPadding !== previousPadding) {
                let event = document.createEvent('Event');
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
            let newMargin = this.$dialog.hasClass('cc-invisible') ? 0 : this.$dialog.outerHeight(true);
            // remove height if the element is not fix positioned
            if(this.$border.css('position') !== 'fixed') {
                newMargin = 0;
            }
            let previousMargin = parseFloat(this.$border.css('margin-' + this.dialogPosition));
            // apply an effect in case the margin is removed
            if (newMargin === 0) this.$border.css('transition', 'margin-' + this.dialogPosition + ' 0.5s 0.5s');
            this.$border.css('margin-' + this.dialogPosition,newMargin);
            // notify about the change
            if (newMargin !== previousMargin) {
                let event = document.createEvent('Event');
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
         *
         * @see CookiePopup.prototype.fadeIn from cookieconsent.js
         */
        updateDelayed: function () {
            window.setTimeout(function ($this) {
                $this.update();
            },40,this);
        },

        registerEventHandlers: function () {
            window.addEventListener('bk2k.cookie.popupopen',function() {
                cookieConsentService.updateDelayed();
            });

            window.addEventListener('bk2k.cookie.popupclose',function() {
                cookieConsentService.update();
            });

            $(window).resize(function () {
                cookieConsentService.update();
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
            if (!cookieConsentService.serviceNeeded()) return;
            cookieConsentService.update();
            cookieConsentService.registerEventHandlers();
        },40);
    });

}(jQuery);