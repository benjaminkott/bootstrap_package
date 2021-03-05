module.exports = {
    inputDir: './../Resources/Public/Icons/BootstrapPackageIcon',
    outputDir: './../Resources/Public/Fonts',
    fontTypes: ['eot', 'woff2', 'woff'],
    assetTypes: ['css', 'json'],
    name: 'bootstrappackageicon',
    prefix: 'bootstrappackageicon',
    selector: '.bootstrappackageicon',
    templates: {
        css: './templates/css.hbs',
    },
    pathOptions: {
        json: '../Resources/Public/Fonts/bootstrappackageicon.json',
        css: '../Resources/Public/Fonts/bootstrappackageicon.css',
        eot: '../Resources/Public/Fonts/bootstrappackageicon.eot',
        woff: '../Resources/Public/Fonts/bootstrappackageicon.woff',
        woff2: '../Resources/Public/Fonts/bootstrappackageicon.woff2',
    }
};
