/**
 * Module: @bk2k/bootstrap-package/backend/form-editor/grid-column-view-model.js
 */

import $ from 'jquery';
import * as StageComponent from '@typo3/form/backend/form-editor/stage-component.js';

/**
 * @private
 *
 * @return object
 */
function getPublisherSubscriber(formEditorApp) {
    return formEditorApp.getPublisherSubscriber();
}

/**
 * @private
 *
 * @return void
 */
function subscribeEvents(formEditorApp) {
    /**
     * @private
     *
     * @param string
     * @param array
     *              args[0] = formElement
     *              args[1] = template
     * @return void
     * @subscribe view/stage/abstract/render/template/perform
     */
    getPublisherSubscriber(formEditorApp).subscribe('view/stage/abstract/render/template/perform', function (topic, args) {
        if (args[0].get('type') === 'GridColumn') {
            StageComponent.renderCheckboxTemplate(args[0], args[1]);
        }
    });
}

/**
 * @public
 *
 * @param object formEditorApp
 * @return void
 */
export function bootstrap(formEditorApp) {
    subscribeEvents(formEditorApp);
}
