###########################
#### RESPONSIVE IMAGES ####
###########################
tt_content.image.20.1 {
    layout {
        bootstrappackage {
            element (
                <img src="typo3conf/ext/bootstrap_package/Resources/Public/Images/blank.gif" ###PARAMS######SOURCECOLLECTION######ALTPARAMS######SELFCLOSINGTAGSLASH###>
                <noscript>
                    <img src="###SRC###"###ALTPARAMS###/>
                </noscript>
            )
            source = data-###DATAKEY###="###SRC###"
            source.noTrimWrap = ; ;;
            source.noTrimWrap.splitChar = ;
        }
    }

    sourceCollection >
    sourceCollection {
        src {
            dataKey = src
        }

        bigger {
            width = 1140
            dataKey = bigger
        }

        large {
            width = 940
            dataKey = large
        }

        medium {
            width = 720
            dataKey = medium
        }

        small {
            width = 320
            dataKey = small
        }
    }

    params = class="lazyload"
}

################################################
#### DYNAMIC CONTENT LIB FOR USAGE IN FLUID ####
################################################
#
#  EXAMPLE
#  ---------------
#  <f:cObject typoscriptObjectPath="lib.dynamicContent" data="{pageUid: '{data.uid}', colPos: '0', wrap: '<div>|</div>'}" />
#
#
#  COLUMN NUMBES
#  ---------------
#
#  0  = main
#  1  = left
#  2  = right
#  3  = border
#  4  = main2
#
#  10 = footer1
#  11 = footer2
#  12 = footer3
#
#  20 = middle1
#  21 = middle2
#  22 = middle3
#
#  30 = special1
#  31 = special2
#  32 = special3
#  33 = special4
#  34 = special5
#  35 = special6
#  36 = special7
#  37 = special8
#  38 = special9
#  39 = special10
#
#################
lib.dynamicContent = COA
lib.dynamicContent {
    5 = LOAD_REGISTER
    5 {
        colPos.cObject = TEXT
        colPos.cObject {
            field = colPos
            ifEmpty.cObject = TEXT
            ifEmpty.cObject {
                value.current = 1
                ifEmpty = 0
            }
        }
        pageUid.cObject = TEXT
        pageUid.cObject {
            field = pageUid
            ifEmpty.data = TSFE:id
        }
        contentFromPid.cObject = TEXT
        contentFromPid.cObject {
            data = DB:pages:{register:pageUid}:content_from_pid
            data.insertData = 1
        }
        wrap.cObject = TEXT
        wrap.cObject {
            field = wrap
        }
    }
    20 < styles.content.get
    20 {
        select {
            where = colPos={register:colPos}
            where.insertData = 1
            pidInList.data = register:pageUid
            pidInList.override.data = register:contentFromPid
        }
        stdWrap {
            dataWrap = {register:wrap}
            required = 1
        }
    }
    90 = RESTORE_REGISTER
}
lib.dynamicContentSlide =< lib.dynamicContent
lib.dynamicContentSlide.20.slide = -1

###########################
#### LIB PARSEFUNC RTE ####
###########################
lib.parseFunc_RTE {
    externalBlocks {
        blockquote.callRecursive.tagStdWrap.HTMLparser.tags.blockquote.overrideAttribs >
        table {
            stdWrap {
                HTMLparser.tags.table {
                    fixAttrib >
                    fixAttrib {
                        class {
                            always = 1
                            prefixRelPathWith = table###SPACE###
                        }
                    }
                }

                wrap = <div class="table-responsive">|</div>
            }
        }
    }

    nonTypoTagStdWrap.encapsLines {
        addAttributes.P.class >
    }
}

#######################
#### LIB STDHEADER ####
#######################
lib.stdheader {
    3 {
        headerClass {
            cObject {
                10 {
                    field = header_position
                    required = 1
                    noTrimWrap = |text-| |
                }
                20 {
                    value = first-headline
                }
            }
        }
    }

    5 >
    10 >
    10 = CASE
    10 {
        setCurrent {
            field = header
            htmlSpecialChars = 1
            typolink.parameter.field = header_link
        }

        key {
            field = header_layout
            ifEmpty = {$content.defaultHeaderType}
            ifEmpty.override.data = register: defaultHeaderType
        }

        1 = COA
        1 {
            10 = TEXT
            10.current = 1
            20 = TEXT
            20 {
                field = subheader
                stdWrap.noTrimWrap = | <small>|</small>|
                stdWrap.required = 1
            }

            stdWrap.dataWrap = <h1{register:headerClass}>|</h1>
            stdWrap.required = 1
        }

        2 = < lib.stdheader.10.1
        2.stdWrap.dataWrap = <h2{register:headerClass}>|</h2>
        3 = < lib.stdheader.10.1
        3.stdWrap.dataWrap = <h3{register:headerClass}>|</h3>
        4 = < lib.stdheader.10.1
        4.stdWrap.dataWrap = <h4{register:headerClass}>|</h4>
        5 = < lib.stdheader.10.1
        5.stdWrap.dataWrap = <h5{register:headerClass}>|</h5>
    }

    20 >
    40 >
    40 = COA
    40 {
        stdWrap {
            wrap = <p>|</p>
            innerWrap {
                cObject = COA
                cObject {
                    10 = TEXT
                    10 {
                        value = <time
                    }

                    20 = TEXT
                    20 {
                        noTrimWrap = | datetime="|"|
                        field = date
                        strftime = %Y-%m-%d
                    }

                    30 = TEXT
                    30 {
                        value = >|</time>
                    }
                }
            }

            required = 1
        }

        10 = TEXT
        10 {
            field = date
            strftime = %Y-%m-%d
        }

        if {
            isTrue {
                field = date
            }
        }
    }

    stdWrap {
        dataWrap >
        dataWrap = |
    }

    stdWrap.prefixComment >
}

#######################
#### LIB NEWSHEADER ####
#######################
lib.newsheader < lib.stdheader
lib.newsheader {
    3 {
        headerClass {
            cObject {
                10 {
                    field >
                    value = {$page.theme.news.list.header_position}
                }

                20 >
            }
        }
    }

    10 {
        setCurrent {
            field = title
            typolink.parameter.field = uid
        }

        key >
        key = {$page.theme.news.list.header_layout}
    }

    20 = COA
    20 {
        10 = TEXT
        10 {
            field = author
            typolink.parameter.field = author_email
            noTrimWrap = |<span class="news-author"><strong>BY: |</strong></span>|
            required = 1
        }

        20 = TEXT
        20 {
            field = starttime
            override.field = crdate
            override.if {
                value = 0
                equals.field = starttime
            }

            strftime = %B %d, %Y
            noTrimWrap = | <span class="news-date"><strong>|</strong></span>|
            required = 1
        }

        stdWrap.required = 1
        stdWrap.wrap = <div class="news-info">|</div>
    }

    40 >
    stdWrap {
        fieldRequired = title
    }
}

######################################
#### UNSET CSS STYLED CONTENT CSS ####
######################################
plugin.tx_cssstyledcontent >

###########################
#### TT_CONTENT FRAMES ####
###########################
tt_content.stdWrap {
    innerWrap.cObject {
        default.20.10.value >
        default.30.cObject {
            default >
            default = CASE
            default {
                key.field = CType
                default = TEXT
                default {
                    value = >|</div>
                    override = ><div class="container">|</div></div>
                    override.if {
                        value = 3
                        equals.field = colPos
                    }
                }

                bootstrap_package_carousel = TEXT
                bootstrap_package_carousel {
                    value = >|</div>
                }
            }

            menu >
            menu < .default
            menu {
                default {
                    value = >|</nav>
                    override = ><div class="container">|</div></nav>
                }
            }
        }

        1.20.10.value = frame invisible
        5.20.10.value = frame rulerbefore
        6.20.10.value = frame rulerafter
        10 {
            20.10.value = frame col-xs-11 col-xs-push-1
            stdWrap.wrap = <div class="row">|</div>
        }

        11 =< tt_content.stdWrap.innerWrap.cObject.10
        11.20.10.value = frame col-xs-9 col-xs-push-3
        12 =< tt_content.stdWrap.innerWrap.cObject.10
        12.20.10.value = frame col-xs-9
        20.20.10.value = frame well
        21.20.10.value = frame jumbotron
    }

    innerWrap2 >
    innerWrap2 {
        cObject = COA
        cObject {
            10 = TEXT
            10 {
                value = |
            }

            20 = TEXT
            20 {
                typolink {
                    parameter.data = TSFE:id
                    returnLast = url
                }

                insertData = 1
                wrap = <p class="csc-linkToTop"><a href="|#">{LLL:EXT:css_styled_content/pi1/locallang.xml:label.toTop}</a></p>
            }
        }

        fieldRequired = linkToTop
    }
}

################################################
#### CTYPE: HEADER                          ####
################################################
tt_content.header.20 >

#######################
#### CTYPE: BULLET ####
#######################
tt_content.bullets.20.dataWrap >
tt_content.bullets.20.dataWrap.cObject = CASE
tt_content.bullets.20.dataWrap.cObject {
    key.field = layout
    default = COA
    default {
        10 = TEXT
        10 {
            value = <ul
        }

        20 = COA
        20 {
            10 = TEXT
            10 {
                value = list
                required = 1
                noTrimWrap = || |
            }

            stdWrap {
                trim = 1
                noTrimWrap = | class="|"|
                required = 1
            }
        }

        30 = TEXT
        30 {
            value = >|</ul>
        }
    }

    110 =< tt_content.bullets.20.dataWrap.cObject.default
    110.10.value = <ol
    110.30.value = >|</ol>
    120 =< tt_content.bullets.20.dataWrap.cObject.default
    120.20.10.value = list list-unstyled
    130 =< tt_content.bullets.20.dataWrap.cObject.default
    130.20.10.value = list list-inline
}

########################
#### CTYPE: UPLOADS ####
########################
tt_content.uploads.20 {
    renderObj >
    renderObj = COA
    renderObj {
        10 = IMAGE
        10 {
            file {
                import.data = file:current:originalUid // file:current:uid
                width = 100
            }
            stdWrap {
                if.value = 1
                if.isGreaterThan.field = layout
                typolink {
                    parameter.data = file:current:originalUid // file:current:uid
                    parameter.wrap = file:|
                    fileTarget < lib.parseTarget
                    fileTarget =
                    fileTarget.override = {$styles.content.uploads.target}
                    fileTarget.override.override.field = target
                    removePrependedNumbers = 1
                }
                wrap = <div class="media-left">|</div>
            }
        }

        20 = COA
        20 {
            10 = COA
            10 {
                10 = COA
                10 {
                    10 = CASE
                    10 {
                        key.data = file:current:extension
                        key.case = lower
                        default = TEXT
                        default.value = glyphicon glyphicon-file
                        default.stdWrap.noTrimWrap = |<span class="|"></span> |
                        avi =< tt_content.uploads.20.renderObj.20.10.10.10.default
                        avi.value = glyphicon glyphicon-film
                        mov =< tt_content.uploads.20.renderObj.20.10.10.10.avi
                        mpg =< tt_content.uploads.20.renderObj.20.10.10.10.avi
                        mpeg =< tt_content.uploads.20.renderObj.20.10.10.10.avi
                        mkv =< tt_content.uploads.20.renderObj.20.10.10.10.avi
                        jpg =< tt_content.uploads.20.renderObj.20.10.10.10.default
                        jpg.value = glyphicon glyphicon-picture
                        gif =< tt_content.uploads.20.renderObj.20.10.10.10.jpg
                        png =< tt_content.uploads.20.renderObj.20.10.10.10.jpg
                        bmp =< tt_content.uploads.20.renderObj.20.10.10.10.jpg
                        ai =< tt_content.uploads.20.renderObj.20.10.10.10.jpg
                        eps =< tt_content.uploads.20.renderObj.20.10.10.10.jpg
                        ico =< tt_content.uploads.20.renderObj.20.10.10.10.jpg
                        tga =< tt_content.uploads.20.renderObj.20.10.10.10.jpg
                        tif =< tt_content.uploads.20.renderObj.20.10.10.10.jpg
                        if {
                            value = 0
                            isGreaterThan.field = layout
                        }
                    }

                    20 = TEXT
                    20 {
                        data = file:current:name
                        override.data = file:current:title
                        htmlSpecialChars = 1
                        required = 1
                        replacement {
                            10 {
                                search = _
                                replace.char = 32
                            }
                        }
                    }

                    stdWrap.typolink < tt_content.uploads.20.renderObj.10.stdWrap.typolink
                    stdWrap.typolink.ATagParams >
                }

                40 = TEXT
                40 {
                    if.isTrue.field = filelink_size
                    data = file:current:size
                    noTrimWrap = | <small class="text-muted">|</small>|
                    bytes = 1
                    bytes.labels = {$styles.content.uploads.filesizeBytesLabels}
                }

                stdWrap.wrap = <h4 class="media-heading">|</h4>
            }

            30 = TEXT
            30 {
                data = file:current:description
                htmlSpecialChars = 1
                wrap = |
                required = 1
            }

            wrap = <div class="media-body">|</div>
        }

        wrap = <li class="media">|</li>
    }

    stdWrap {
        dataWrap = <ul class="media-list">|</ul>
    }
}

################################################
#### CTYPE: IMAGE                           ####
#### also used for rendering 'textpic' type ####
################################################
tt_content.image.20 {
    1 {
        imageLinkWrap {
            JSwindow = 0
            directImageLink = 1
        }
    }

    addClassesCol.ifEmpty =
    addClassesCol.override.cObject = COA
    addClassesCol.override.cObject {
        10 = CASE
        10 {
            key.field = imagecols

            default = TEXT
            default.value = col-md-12

            2 < .default
            2.value = col-md-6

            3 < .default
            3.value = col-md-4 col-sm-4 col-xs-4

            4 < .default
            4.value = col-md-3 col-sm-3 col-xs-6

            6 < .default
            6.value = col-md-2 col-sm-2 col-xs-4
        }
    }

    addClassesCol.override =
    addClassesCol.override.if {
        isGreaterThan.field = imagecols
        value = 0
    }

    addClassesImage >
    layout {
        default.override >
        default.value = <div class="image-center image-above###CLASSES###">###IMAGES######TEXT###</div>
        1.override >
        1.value = <div class="image-right image-above###CLASSES###">###IMAGES######TEXT###</div>
        2.override >
        2.value = <div class="image-left image-below###CLASSES###">###IMAGES######TEXT###</div>
        8.override >
        8.value = <div class="image-center image-below###CLASSES###">###TEXT######IMAGES###</div>
        9.override >
        9.value = <div class="image-right image-below###CLASSES###">###TEXT######IMAGES###</div>
        10.override >
        10.value = <div class="image-left image-below###CLASSES###">###TEXT######IMAGES###</div>
        17.override >
        17.value = <div class="image-intext-right image-intext###CLASSES###">###IMAGES######TEXT###</div>
        18.override >
        18.value = <div class="image-intext-left image-intext###CLASSES###">###IMAGES######TEXT###</div>
        25.value = <div class="image-beside-right image-beside###CLASSES###">###IMAGES######TEXT###</div>
        25.override >
        25.override = <div class="image-header-{field:header_layout} image-beside-right image-beside###CLASSES###">###IMAGES######TEXT###</div>
        25.override.if.isTrue.field = header
        25.override.insertData = 1
        26.value = <div class="image-beside-left image-beside###CLASSES###">###IMAGES######TEXT###</div>
        26.override >
        26.override = <div class="image-header-{field:header_layout} image-beside-left image-beside###CLASSES###">###IMAGES######TEXT###</div>
        26.override.if.isTrue.field = header
        26.override.insertData = 1
    }

    rendering {
        singleNoCaption {
            allStdWrap {
                dataWrap = <div class="image-wrap"> | </div>
                dataWrap {
                    override = <div class="image-wrap"> | </div>
                }

                innerWrap.cObject.0.value = <div class="image-center-outer"><div class="image-center-inner"> | </div></div>
                innerWrap.cObject.8.value = <div class="image-center-outer"><div class="image-center-inner"> | </div></div>
            }

            singleStdWrap {
                wrap = <div class="image###CLASSES###"> | </div>
                wrap {
                    override.cObject = COA
                    override.cObject {
                        10 = TEXT
                        10 {
                            value = <figure class="image###CLASSES###">|</figure>
                            override = <figure class="thumbnail###CLASSES###">|</figure>
                            override {
                                if {
                                    value = 1
                                    equals.field = imageborder
                                }
                            }
                        }
                    }
                }
            }
        }

        noCaption {
            allStdWrap {
                dataWrap = <div class="image-wrap"> | </div>
                dataWrap {
                    override = <div class="image-wrap"> | </div>
                }
            }

            singleStdWrap {
                wrap = <div class="image###CLASSES###"> | </div>
                wrap {
                    override.cObject = COA
                    override.cObject {
                        10 = TEXT
                        10 {
                            value = <figure class="image###CLASSES###">|</figure>
                            override = <figure class="thumbnail###CLASSES###">|</figure>
                            override {
                                if {
                                    value = 1
                                    equals.field = imageborder
                                }
                            }
                        }
                    }
                }
            }

            rowStdWrap.wrap = <div class="image-row"> | </div>
            noRowsStdWrap.wrap = <div class="image-row"> | </div>
            lastRowStdWrap.wrap = <div class="image-row"> | </div>
            columnStdWrap.wrap = <div class="image-column###CLASSES###"> | </div>
        }

        singleCaption {
            singleStdWrap {
                wrap {
                    override.cObject = COA
                    override.cObject {
                        10 = TEXT
                        10 {
                            value = <figure class="image###CLASSES###">|###CAPTION###</figure>
                            override = <figure class="thumbnail###CLASSES###">|###CAPTION###</figure>
                            override {
                                if {
                                    value = 1
                                    equals.field = imageborder
                                }
                            }
                        }
                    }
                }
            }

            caption {
                wrap = <caption class="caption###CLASSES###"> | </caption>
                wrap.override = <figcaption class="caption###CLASSES###"> | </figcaption>
            }
        }

        splitCaption {
            singleStdWrap {
                wrap {
                    override.cObject = COA
                    override.cObject {
                        10 = TEXT
                        10 {
                            value = <figure class="image###CLASSES###">|###CAPTION###</figure>
                            override = <figure class="thumbnail###CLASSES###">|###CAPTION###</figure>
                            override {
                                if {
                                    value = 1
                                    equals.field = imageborder
                                }
                            }
                        }
                    }
                }
            }

            caption {
                wrap = <caption class="caption###CLASSES###"> | </caption>
                wrap.override = <figcaption class="caption###CLASSES###"> | </figcaption>
            }

            rowStdWrap.wrap = <div class="image-row"> | </div>
            noRowsStdWrap.wrap = <div class="image-row"> | </div>
            lastRowStdWrap.wrap = <div class="image-row"> | </div>
            columnStdWrap.wrap = <div class="image-column###CLASSES###"> | </div>
        }

        globalCaption {
            allStdWrap {
                dataWrap = <div class="image-wrap"> | ###CAPTION###</div>
                dataWrap {
                    override = <figure class="image-wrap"> | ###CAPTION###</figure>
                }
            }

            singleStdWrap {
                wrap = <div class="image###CLASSES###"> | </div>
                wrap {
                    override.cObject = COA
                    override.cObject {
                        10 = TEXT
                        10 {
                            value = <div class="image###CLASSES###">|</div>
                            override = <div class="thumbnail###CLASSES###">|</div>
                            override {
                                if {
                                    value = 1
                                    equals.field = imageborder
                                }
                            }
                        }
                    }
                }
            }

            caption {
                wrap = <caption class="caption"> | </caption>
                wrap.override = <figcaption class="caption###CLASSES###"> | </figcaption>
            }

            rowStdWrap.wrap = <div class="image-row"> | </div>
            noRowsStdWrap.wrap = <div class="image-row"> | </div>
            lastRowStdWrap.wrap = <div class="image-row"> | </div>
            columnStdWrap.wrap = <div class="image-column###CLASSES###"> | </div>
        }
    }
}

########################
#### CTYPE: TEXTPIC ####
########################
tt_content.textpic.20 {
    text.wrap = <div class="text"> | </div>
    text.10.10.stdWrap.dataWrap = |
}

#####################
#### CTYPE: HTML ####
#####################
tt_content.html {
    parseFunc {
        tags {
            link = TEXT
            link {
                current = 1
                typolink {
                    parameter.data = parameters : allParams
                    extTarget = _self
                    target = _self
                    wrap = |
                }

                parseFunc.constants = 1
            }
        }
    }
}

#########################
#### CTYPE: MAILFORM ####
#########################
plugin.tx_form._CSS_DEFAULT_STYLE >

tt_content.mailform.20 {
    form {
        layout {
            form (
                <form class="form-horizontal">
                    <containerWrap />
                </form>
            )
            containerWrap (
                <div>
                    <elements />
                </div>
            )
            elementWrap (
                <div>
                    <element />
                </div>
            )
            fieldset (
                <fieldset>
                    <legend />
                    <containerWrap />
                </fieldset>
            )
            checkbox (
                <div class="checkbox">
                    <input />
                    <label />
                </div>
            )
            radio (
                <div class="radio">
                    <input />
                    <label />
                </div>
            )
            radiogroup (
                <div class="form-group">
                    <div class="col-sm-3 control-label">
                        <legend />
                    </div>
                    <div class="col-sm-5">
                        <elements />
                    </div>
                </div>
            )
            checkboxgroup < .radiogroup
            label (
                <label>
                    <labelvalue />
                    <mandatory />
                    <error />
                </label>
            )
            legend (
                <legend>
                    <legendvalue />
                    <mandatory />
                    <error />
                </legend>
            )
            error (
                <span class="help-block text-danger"><errorvalue /></span>
            )
            textline (
                <div class="form-group">
                    <div class="col-sm-3 control-label">
                        <label />
                    </div>
                    <div class="col-sm-5">
                        <input class="form-control" />
                    </div>
                </div>
            )
            fileupload < .textline
            textarea (
                <div class="form-group">
                    <div class="col-sm-3 control-label">
                        <label />
                    </div>
                    <div class="col-sm-5">
                        <textarea class="form-control" />
                    </div>
                </div>
            )
            submit (
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9">
                        <input class="btn btn-primary" />
                    </div>
                </div>
            )
            select (
                <div class="form-group">
                    <div class="col-sm-3 control-label">
                        <label />
                    </div>
                    <div class="col-sm-5">
                        <select class="form-control">
                            <elements />
                        </select>
                    </div>
                </div>
            )
        }
    }

    confirmation {
        layout {
            confirmation (
                <div class="form-horizontal">
                    <containerWrap />
                </div>
            )
            containerWrap (
                <div>
                    <elements />
                </div>
            )
            elementWrap (
                <div>
                    <element />
                </div>
            )
            fieldset (
                <containerWrap />
            )
            checkbox (
                <label />
                <inputvalue />
            )
            radio (
                <label />
                <inputvalue />
            )
            radiogroup (
                <div class="form-group">
                    <div class="col-sm-3">
                        <strong><legend /></strong>
                    </div>
                    <div class="col-sm-5">
                        <elements />
                    </div>
                </div>
            )
            checkboxgroup < .radiogroup
            label (
                <labelvalue />
            )
            legend (
                <legendvalue />
            )
            textline (
                <div class="form-group">
                    <div class="col-sm-3">
                        <strong>
                            <label />
                        </strong>
                    </div>
                    <div class="col-sm-5">
                        <inputvalue />
                    </div>
                </div>
            )
            fileupload < .textline
            textarea (
                <div class="form-group">
                    <div class="col-sm-3">
                        <strong>
                            <label />
                        </strong>
                    </div>
                    <div class="col-sm-5">
                        <inputvalue />
                    </div>
                </div>
            )
            select (
                <div class="form-group">
                    <div class="col-sm-3">
                        <strong>
                            <label />
                        </strong>
                    </div>
                    <div class="col-sm-5">
                        <elements />
                    </div>
                </div>
            )
        }
    }

    stdWrap.wrap = |
}

#####################
#### CTYPE: MENU ####
#####################
tt_content.menu.20 {
    news < .default
    news {
        maxItems = {$page.theme.news.pagination.itemsperpage}
        begin.stdWrap.cObject = COA
        begin.stdWrap.cObject {
            5 = LOAD_REGISTER
            5 {
                paginateCounter.cObject = CONTENT
                paginateCounter.cObject {
                    table = pages
                    select {
                        pidInList.field = pages
                        where.insertData = 1
                        selectFields = COUNT(*) AS counter
                    }

                    renderObj = TEXT
                    renderObj {
                        field = counter
                        wrap = |
                    }
                }

                paginateMaxPage.cObject = TEXT
                paginateMaxPage.cObject {
                    data = register:paginateCounter
                    stdWrap.wrap = |/{$page.theme.news.pagination.itemsperpage}
                    stdWrap.wrap.insertData = 1
                    prioriCalc = 1
                    round.roundType = ceil
                    round.decimals = 0
                }

                paginateMaxPageAdd.cObject = TEXT
                paginateMaxPageAdd.cObject {
                    data = register:paginateMaxPage
                    stdWrap.wrap = |+1
                    stdWrap.insertData = 1
                    prioriCalc = 1
                }

                paginateCurrentPage.cObject = TEXT
                paginateCurrentPage.cObject {
                    data = GP:page
                    override = 1
                    override.if {
                        value.data = GP:page
                        isLessThan = 0
                        isGreaterThan.data = register:paginateMaxPageAdd
                        negate = 1
                    }
                }

                paginateStart.cObject = TEXT
                paginateStart.cObject {
                    data = register:paginateCurrentPage
                    stdWrap.wrap = ((|-1)*{$page.theme.news.pagination.itemsperpage})+1
                    stdWrap.insertData = 1
                    prioriCalc = 1
                }

                paginatePreviousPage.cObject = TEXT
                paginatePreviousPage.cObject {
                    data = register:paginateCurrentPage
                    stdWrap.wrap = |-1
                    stdWrap.wrap {
                        override = |
                        override.if {
                            value = 1
                            equals.data = register:paginateCurrentPage
                        }
                    }

                    prioriCalc = intval
                }

                paginateNextPage.cObject = TEXT
                paginateNextPage.cObject {
                    data = register:paginateCurrentPage
                    stdWrap.wrap = |+1
                    stdWrap.wrap {
                        override = |
                        override.if {
                            value.data = register:paginateMaxPage
                            equals.data = register:paginateCurrentPage
                        }
                    }

                    prioriCalc = intval
                }
            }

            30 = TEXT
            30 {
                data = register:paginateStart
            }
        }

        special = directory
        stdWrap {
            prepend >
            outerWrap = |
            append = COA
            append {
                10 = COA
                10 {
                    ##################
                    ## PREVIOUS BTN ##
                    ##################
                    10 = COA
                    10 {
                        10 = COA
                        10 {
                            10 = TEXT
                            10.value = <li
                            20 = TEXT
                            20 {
                                value = disabled
                                noTrimWrap = | class="|"|
                                if {
                                    value.data = register:paginateCurrentPage
                                    equals = 1
                                }
                            }

                            30 = TEXT
                            30.value = >
                        }

                        20 = TEXT
                        20 {
                            value = &laquo;
                            typolink {
                                parameter.data = page:uid
                                additionalParams = &page={register:paginatePreviousPage}
                                additionalParams.insertData = 1
                                useCacheHash = 1
                            }
                        }

                        30 = TEXT
                        30.value = </li>
                    }

                    ###########
                    ## PAGES ##
                    ###########
                    20 = TEXT
                    20 {
                        value =
                        split {
                            token = ,
                            cObjNum = 1
                            min.stdWrap.cObject = COA
                            min.stdWrap.cObject {
                                10 = TEXT
                                10 {
                                    data = register:paginateMaxPage
                                }
                            }

                            1 {
                                5 = LOAD_REGISTER
                                5 {
                                    currPageLink.cObject = TEXT
                                    currPageLink.cObject {
                                        data = register:SPLIT_COUNT
                                        stdWrap.wrap = |+1
                                        prioriCalc = intval
                                    }
                                }

                                10 = COA
                                10 {
                                    10 = TEXT
                                    10.value = <li
                                    20 = TEXT
                                    20 {
                                        value = active
                                        noTrimWrap = | class="|"|
                                        if {
                                            value.data = register:currPageLink
                                            equals.data = register:paginateCurrentPage
                                        }
                                    }

                                    30 = TEXT
                                    30.value = >
                                }

                                20 = TEXT
                                20 {
                                    data = register:currPageLink
                                    typolink {
                                        parameter.data = page:uid
                                        additionalParams = &page={register:currPageLink}
                                        additionalParams.insertData = 1
                                        useCacheHash = 1
                                    }
                                }

                                30 = TEXT
                                30.value = </li>
                            }
                        }
                    }

                    ##############
                    ## NEXT BTN ##
                    ##############
                    30 < .10
                    30 {
                        10.20.if.value.data = register:paginateMaxPage
                        10.20.if.equals.data = register:paginateCurrentPage
                        20.value = &raquo;
                        20.typolink.additionalParams = &page={register:paginateNextPage}
                    }

                    wrap = <hr><ul class="pagination">|</ul>
                    if {
                        value = {$page.theme.news.pagination.itemsperpage}
                        value.insertData = 1
                        isGreaterThan.data = register:paginateCounter
                    }
                }
            }
        }

        1 {
            alternativeSortingField = starttime DESC
            NO {
                wrapItemAndSub = <article class="news-item">|</article><hr> |*| <article class="news-item">|</article><hr>  |*| <article class="news-item">|</article>
                doNotLinkIt = 1
                doNotShowLink = 1
                stdWrap2 {
                    cObject < tt_content.textpic
                    cObject {
                        10.if.isLessThan.field >
                        10.if.isLessThan = {$page.theme.news.list.imageorient}
                        10.10 =< lib.newsheader
                        20 < tt_content.image.20
                        20 {
                            preRenderRegisters {
                                allImageCaptions.cObject {
                                    references {
                                        table = pages
                                        fieldName = media
                                    }
                                }
                            }

                            addClassesCol.override.cObject.10.key.field >
                            addClassesCol.override.cObject.10.key = {$page.theme.news.list.imagecols}
                            addClassesCol.override.if.isGreaterThan.field >
                            addClassesCol.override.if.isGreaterThan = {$page.theme.news.list.imagecols}
                            layout {
                                key.field >
                                key = {$page.theme.news.list.imageorient}
                                25.override = <div class="image-header-{$page.theme.news.list.header_layout} image-beside-right image-beside###CLASSES###">###IMAGES######TEXT###</div>
                                25.override.if.isTrue.field = title
                                26.override = <div class="image-header-{$page.theme.news.list.header_layout} image-beside-left image-beside###CLASSES###">###IMAGES######TEXT###</div>
                                26.override.if.isTrue.field = title
                            }

                            textPos.field >
                            textPos = {$page.theme.news.list.imageorient}
                            maxW = {$page.theme.news.list.maxW}
                            maxWInText = {$page.theme.news.list.maxWInText}
                            imgList.cObject.references < tt_content.menu.20.news.1.NO.stdWrap2.cObject.20.preRenderRegisters.allImageCaptions.cObject.references
                            text < tt_content.textpic.20.text
                            text {
                                10 {
                                    if.isGreaterThan.field >
                                    if.isGreaterThan = {$page.theme.news.list.imageorient}
                                    10 =< lib.newsheader
                                }

                                20.field = abstract
                                20.editIcons >
                            }
                        }
                    }
                }
            }
        }
    }
}
