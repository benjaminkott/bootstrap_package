'use strict';

(function() {

    CKEDITOR.plugins.add('bootstrappackage_indent', {
        lang: 'en,de',
        icons: 'bootstrappackage_indent',
        hidpi: true,
        init: function (editor) {
            if (editor.blockless)
                return;

            // Add command
            editor.addCommand('bootstrappackage_indent', {
                exec: toggleIndent,
                refresh: setButtonState,
                context: 'div(text-indent)',
                allowedContent: 'div(!text-indent)',
                requiredContent: 'div(!text-indent)'
            });

            // Add Button
            editor.ui.addButton && editor.ui.addButton('bootstrappackage_indent', {
                label: editor.lang.bootstrappackage_indent.toolbar,
                command: 'bootstrappackage_indent',
                toolbar: 'blocks'
            });
        }
    });

    /**
     * Toggle indent
     *
     * @param {Object} editor
     */
    function toggleIndent(editor) {
        var selection = editor.getSelection(),
            range = selection && selection.getRanges()[0];

        if (!range)
            return;

        // Save selection and prepare data
        var bookmark = selection.createBookmarks(false)[0],
            startNode = bookmark.startNode,
            endNode = bookmark.endNode || startNode,
            iterator = range.createIterator(),
            editable = editor.editable(),
            block = null,
            blocks = [];

        while ((block = iterator.getNextParagraph()))
            blocks.push(block);

        // Add or remove the wrap
        if (editor.getCommand('bootstrappackage_indent').state == CKEDITOR.TRISTATE_OFF) {
            addWrap(editor, blocks);
        } else {
            removeWrap(editor, blocks);
        }

        // Restore Selection
        if (editable.contains(startNode) && editable.contains(endNode)) {
            selection.selectBookmarks([bookmark]);
        }
        editor.focus();
    }

    /**
     * Wrap blocks in new container
     *
     * @param {Object} editor
     * @param {Array} blocks
     */
    function wrapBlocks(editor, blocks) {
        var wrapper = editor.document.createElement('div'),
            block = null;
        wrapper.addClass("text-indent");
        wrapper.insertBefore(blocks[0]);
        while (blocks.length > 0) {
            block = blocks.shift();
            wrapper.append(block);
        }
    }

    /**
     * Find parent element for all selected blocks
     *
     * @param {Array} blocks
     * @return {Object}
     */
    function getCommonParent(blocks) {
        var parent = blocks[0].getParent(),
            block = null;
        for (var i = 0; i < blocks.length; i++) {
            block = blocks[i];
            parent = parent.getCommonAncestor(block.getParent());
        }
        // Filter invalid parents
        var denyTags = { table: 1, tbody: 1, tr: 1, ol: 1, ul: 1 };
        while (denyTags[parent.getName()])
            parent = parent.getParent();
        return parent;
    }

    /**
     * Streamlines the selected block elements to match a specific parent
     *
     * @param {Object} parent
     * @param {Array} blocks
     * @return {Array}
     */
    function unifyBlockParent(parent, blocks) {
        var lastBlock = null,
            block = null,
            unifiedBlocks = [];
        while (blocks.length > 0) {
            block = blocks.shift();
            while (!block.getParent().equals(parent)) {
                block = block.getParent();
            }
            if (!block.equals(lastBlock)) {
                unifiedBlocks.push(block);
                lastBlock = block;
            }
        }
        return unifiedBlocks;
    }

    /**
     * Remove existing wrapper from blocks
     *
     * @param {Object} editor
     * @param {Array} blocks
     * @return {Array}
     */
    function removeExistingWrapperFromBlocks(editor, blocks) {
        var block = null,
            cleanedBlocks = [];
        while (blocks.length > 0) {
            block = blocks.shift();
            if (block.getName() == 'div' && block.hasClass('text-indent')) {
                var fragment = new CKEDITOR.dom.documentFragment(editor.document);
                while (block.getFirst()) {
                    fragment.append(block.getFirst().remove());
                    cleanedBlocks.push(fragment.getLast());
                }
                fragment.replace(block);
            } else {
                cleanedBlocks.push(block);
            }
        }
        return cleanedBlocks;
    }

    /**
     * Add wrap around blocks
     *
     * @param {Object} editor
     * @param {Array} blocks
     */
    function addWrap(editor, blocks) {
        var commonParent = getCommonParent(blocks),
            unifiedBlocks = unifyBlockParent(commonParent, blocks),
            cleanedBlocks = removeExistingWrapperFromBlocks(editor, unifiedBlocks);
        wrapBlocks(editor, cleanedBlocks);
    }

    /**
     * Moves all outside the wrap if existing
     *
     * @param {Array} blocks
     * @return {$Array}
     */
    function unwrapBlocks(blocks) {
        var storage = {},
            processedBlocks = [],
            unwrapBlocks = [],
            block = null,
            parent = null;
        // Find blocks that need to be unwrapped
        for (var i = 0; i < blocks.length; i++) {
            block = blocks[i];
            var parent = null,
                child = null;
            if (block.getName() == 'div' && block.hasClass('text-indent') && isEmptyBlock(block)) {
                processedBlocks.push(block);
            } else {
                while (block.getParent()) {
                    if (block.getParent().getName() == 'div' && block.getParent().hasClass('text-indent')) {
                        parent = block.getParent();
                        child = block;
                        break;
                    }
                    block = block.getParent();
                }
                if (parent && child && !child.getCustomData('move')) {
                    unwrapBlocks.push(child);
                    CKEDITOR.dom.element.setMarker(storage, child, 'move', true);
                }
            }
        }
        CKEDITOR.dom.element.clearAllMarkers(storage);
        // Unwrap blocks
        while (unwrapBlocks.length > 0) {
            block = unwrapBlocks.shift();
            parent = block.getParent();
            if (!block.getPrevious()) {
                block.remove().insertBefore(parent);
            } else if (!block.getNext()) {
                block.remove().insertAfter(parent);
            } else {
                block.breakParent(block.getParent());
                processedBlocks.push(block.getNext());
            }
            if (!parent.getCustomData('processed')) {
                processedBlocks.push(parent);
                CKEDITOR.dom.element.setMarker(storage, parent, 'processed', true);
            }
        }
        CKEDITOR.dom.element.clearAllMarkers(storage);
        return processedBlocks;
    }

    /**
     * Remove wrap around blocks
     *
     * @param {Object} editor
     * @param {Array} blocks
     */
    function removeWrap(editor, blocks) {
        var processedBlocks = unwrapBlocks(blocks);
        removeEmptyBlocks(processedBlocks);
    }

    /**
     * Set button state
     *
     * @param {Object} editor
     * @param {Object} path
     */
    function setButtonState(editor, path) {
        var firstBlock = path.block || path.blockLimit;
        var element = editor.elementPath(firstBlock).contains(
            function(element) {
                if (element.is('div') && element.hasClass('text-indent')) return true;
            }, 1);
        this.setState(element ? CKEDITOR.TRISTATE_ON : CKEDITOR.TRISTATE_OFF);
    };

    /**
     * Check if block is empty
     *
     * @param {Object} block
     * @return {Boolean}
     */
    function isEmptyBlock(block) {
        for (var i = 0, length = block.getChildCount(), child; i < length && (child = block.getChild(i)); i++) {
            if (child.type == CKEDITOR.NODE_ELEMENT && child.isBlockBoundary())
                return false;
        }
        return true;
    }

    /**
     * Remove empty blocks
     *
     * @param {Array} blocks
     */
    function removeEmptyBlocks(blocks) {
        var block = null;
        for (var i = blocks.length - 1; i >= 0; i--) {
            block = blocks[i];
            if (isEmptyBlock(block)) {
                block.remove();
            }
        }
    }

})();
