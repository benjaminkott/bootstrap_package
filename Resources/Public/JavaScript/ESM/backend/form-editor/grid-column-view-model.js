function subscribeEvents(formEditor) {
    formEditor.getPublisherSubscriber().subscribe('view/stage/abstract/render/template/perform', (
        topic,
        [formElement, template]
    ) => {
        if (formElement.get('type') === 'GridColumn') {
            formEditor.getViewModel().getStage().renderSimpleTemplateWithValidators(formElement, template);
        }
    });
};

export function bootstrap(formEditorApp) {
    subscribeEvents(formEditorApp);
};
