#
# Table structure for table 'pages'
#
CREATE TABLE pages (
    nav_icon int(11) unsigned DEFAULT '0',
    thumbnail int(11) unsigned DEFAULT '0',
);


#
# Table structure for table 'sys_language'
#
CREATE TABLE sys_language (
    nav_title varchar(255) DEFAULT '' NOT NULL,
    locale varchar(20) DEFAULT '' NOT NULL,
    hreflang varchar(20) DEFAULT '' NOT NULL,
    direction varchar(3) DEFAULT '' NOT NULL,
);


#
# Table structure for table 'tt_content'
#
CREATE TABLE tt_content (
    teaser text,
    readmore_label varchar(255) DEFAULT '' NOT NULL,
    quote_source varchar(255) DEFAULT '' NOT NULL,
    quote_link varchar(1024) DEFAULT '' NOT NULL,
    panel_class varchar(60) DEFAULT 'default' NOT NULL,
    file_folder text,
    icon varchar(255) DEFAULT '' NOT NULL,
    icon_set varchar(255) DEFAULT '' NOT NULL,
    icon_file int(11) unsigned DEFAULT '0',
    icon_position varchar(255) DEFAULT '' NOT NULL,
    icon_size varchar(60) DEFAULT 'default' NOT NULL,
    icon_type varchar(60) DEFAULT 'default' NOT NULL,
    icon_color varchar(255) DEFAULT '' NOT NULL,
    icon_background varchar(255) DEFAULT '' NOT NULL,
    external_media_source varchar(1024) DEFAULT '' NOT NULL,
    external_media_ratio varchar(10) DEFAULT '' NOT NULL,
    tx_bootstrappackage_card_group_item int(11) unsigned DEFAULT '0',
    tx_bootstrappackage_carousel_item int(11) unsigned DEFAULT '0',
    tx_bootstrappackage_accordion_item int(11) unsigned DEFAULT '0',
    tx_bootstrappackage_icon_group_item int(11) unsigned DEFAULT '0',
    tx_bootstrappackage_tab_item int(11) unsigned DEFAULT '0',
    tx_bootstrappackage_timeline_item int(11) unsigned DEFAULT '0',
    background_color_class varchar(255) DEFAULT '' NOT NULL,
    background_image int(11) unsigned DEFAULT '0',
    background_image_options mediumtext,
);


#
# Table structure for table 'tx_bootstrappackage_card_group_item'
#
CREATE TABLE tx_bootstrappackage_card_group_item (
    uid int(11) unsigned NOT NULL auto_increment,
    pid int(11) DEFAULT '0' NOT NULL,

    tt_content int(11) unsigned DEFAULT '0',
    header varchar(255) DEFAULT '' NOT NULL,
    subheader varchar(255) DEFAULT '' NOT NULL,
    image int(11) DEFAULT '0' NOT NULL,
    bodytext text,
    link varchar(1024) DEFAULT '' NOT NULL,
    link_title varchar(255) DEFAULT '' NOT NULL,
    link_icon int(11) unsigned DEFAULT '0',
    link_class varchar(255) DEFAULT '' NOT NULL,

    tstamp int(11) unsigned DEFAULT '0' NOT NULL,
    crdate int(11) unsigned DEFAULT '0' NOT NULL,
    cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
    deleted smallint unsigned DEFAULT '0' NOT NULL,
    hidden smallint unsigned DEFAULT '0' NOT NULL,
    starttime int(11) unsigned DEFAULT '0' NOT NULL,
    endtime int(11) unsigned DEFAULT '0' NOT NULL,
    sorting int(11) DEFAULT '0' NOT NULL,

    sys_language_uid int(11) DEFAULT '0' NOT NULL,
    l10n_parent int(11) unsigned DEFAULT '0' NOT NULL,
    l10n_diffsource mediumblob NULL,

    t3ver_oid int(11) unsigned DEFAULT '0' NOT NULL,
    t3ver_id int(11) unsigned DEFAULT '0' NOT NULL,
    t3ver_wsid int(11) unsigned DEFAULT '0' NOT NULL,
    t3ver_label varchar(255) DEFAULT '' NOT NULL,
    t3ver_state smallint DEFAULT '0' NOT NULL,
    t3ver_stage int(11) DEFAULT '0' NOT NULL,
    t3ver_count int(11) unsigned DEFAULT '0' NOT NULL,
    t3ver_tstamp int(11) unsigned DEFAULT '0' NOT NULL,
    t3ver_move_id int(11) unsigned DEFAULT '0' NOT NULL,
    t3_origuid int(11) unsigned DEFAULT '0' NOT NULL,

    PRIMARY KEY (uid),
    KEY parent (pid),
    KEY t3ver_oid (t3ver_oid,t3ver_wsid),
    KEY language (l10n_parent,sys_language_uid)
);


#
# Table structure for table 'tx_bootstrappackage_carousel_item'
#
CREATE TABLE tx_bootstrappackage_carousel_item (
    uid int(11) unsigned NOT NULL auto_increment,
    pid int(11) DEFAULT '0' NOT NULL,

    tt_content int(11) unsigned DEFAULT '0',
    item_type varchar(255) DEFAULT '' NOT NULL,
    header varchar(255) DEFAULT '' NOT NULL,
    header_layout tinyint(3) unsigned DEFAULT '1' NOT NULL,
    header_class varchar(255) DEFAULT '' NOT NULL,
    subheader varchar(255) DEFAULT '' NOT NULL,
    subheader_layout tinyint(3) unsigned DEFAULT '2' NOT NULL,
    subheader_class varchar(255) DEFAULT '' NOT NULL,
    nav_title varchar(255) DEFAULT '' NOT NULL,
    button_text varchar(255) DEFAULT '' NOT NULL,
    bodytext text,
    image int(11) unsigned DEFAULT '0',
    link varchar(1024) DEFAULT '' NOT NULL,
    text_color varchar(255) DEFAULT '' NOT NULL,
    background_color varchar(255) DEFAULT '' NOT NULL,
    background_image int(11) unsigned DEFAULT '0',
    background_image_options mediumtext,

    tstamp int(11) unsigned DEFAULT '0' NOT NULL,
    crdate int(11) unsigned DEFAULT '0' NOT NULL,
    cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
    deleted smallint unsigned DEFAULT '0' NOT NULL,
    hidden smallint unsigned DEFAULT '0' NOT NULL,
    starttime int(11) unsigned DEFAULT '0' NOT NULL,
    endtime int(11) unsigned DEFAULT '0' NOT NULL,
    sorting int(11) DEFAULT '0' NOT NULL,

    sys_language_uid int(11) DEFAULT '0' NOT NULL,
    l10n_parent int(11) unsigned DEFAULT '0' NOT NULL,
    l10n_diffsource mediumblob NULL,

    t3ver_oid int(11) unsigned DEFAULT '0' NOT NULL,
    t3ver_id int(11) unsigned DEFAULT '0' NOT NULL,
    t3ver_wsid int(11) unsigned DEFAULT '0' NOT NULL,
    t3ver_label varchar(255) DEFAULT '' NOT NULL,
    t3ver_state smallint DEFAULT '0' NOT NULL,
    t3ver_stage int(11) DEFAULT '0' NOT NULL,
    t3ver_count int(11) unsigned DEFAULT '0' NOT NULL,
    t3ver_tstamp int(11) unsigned DEFAULT '0' NOT NULL,
    t3ver_move_id int(11) unsigned DEFAULT '0' NOT NULL,
    t3_origuid int(11) unsigned DEFAULT '0' NOT NULL,

    PRIMARY KEY (uid),
    KEY parent (pid),
    KEY t3ver_oid (t3ver_oid,t3ver_wsid),
    KEY language (l10n_parent,sys_language_uid)
);


#
# Table structure for table 'tx_bootstrappackage_accordion_item'
#
CREATE TABLE tx_bootstrappackage_accordion_item (
    uid int(11) unsigned NOT NULL auto_increment,
    pid int(11) DEFAULT '0' NOT NULL,

    tt_content int(11) unsigned DEFAULT '0',
    header varchar(255) DEFAULT '' NOT NULL,
    bodytext text,
    media int(11) unsigned DEFAULT '0',
    mediaorient varchar(60) DEFAULT 'left' NOT NULL,
    imagecols tinyint(4) unsigned DEFAULT '1' NOT NULL,
    image_zoom tinyint(3) unsigned DEFAULT '0' NOT NULL,

    tstamp int(11) unsigned DEFAULT '0' NOT NULL,
    crdate int(11) unsigned DEFAULT '0' NOT NULL,
    cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
    deleted smallint unsigned DEFAULT '0' NOT NULL,
    hidden smallint unsigned DEFAULT '0' NOT NULL,
    starttime int(11) unsigned DEFAULT '0' NOT NULL,
    endtime int(11) unsigned DEFAULT '0' NOT NULL,
    sorting int(11) DEFAULT '0' NOT NULL,

    sys_language_uid int(11) DEFAULT '0' NOT NULL,
    l10n_parent int(11) unsigned DEFAULT '0' NOT NULL,
    l10n_diffsource mediumblob NULL,

    t3ver_oid int(11) unsigned DEFAULT '0' NOT NULL,
    t3ver_id int(11) unsigned DEFAULT '0' NOT NULL,
    t3ver_wsid int(11) unsigned DEFAULT '0' NOT NULL,
    t3ver_label varchar(255) DEFAULT '' NOT NULL,
    t3ver_state smallint DEFAULT '0' NOT NULL,
    t3ver_stage int(11) DEFAULT '0' NOT NULL,
    t3ver_count int(11) unsigned DEFAULT '0' NOT NULL,
    t3ver_tstamp int(11) unsigned DEFAULT '0' NOT NULL,
    t3ver_move_id int(11) unsigned DEFAULT '0' NOT NULL,
    t3_origuid int(11) unsigned DEFAULT '0' NOT NULL,

    PRIMARY KEY (uid),
    KEY parent (pid),
    KEY t3ver_oid (t3ver_oid,t3ver_wsid),
    KEY language (l10n_parent,sys_language_uid)
);


#
# Table structure for table 'tx_bootstrappackage_icon_group_item'
#
CREATE TABLE tx_bootstrappackage_icon_group_item (
    uid int(11) unsigned NOT NULL auto_increment,
    pid int(11) DEFAULT '0' NOT NULL,

    tt_content int(11) unsigned DEFAULT '0',
    header varchar(255) DEFAULT '' NOT NULL,
    subheader varchar(255) DEFAULT '' NOT NULL,
    icon_file int(11) unsigned DEFAULT '0',

    tstamp int(11) unsigned DEFAULT '0' NOT NULL,
    crdate int(11) unsigned DEFAULT '0' NOT NULL,
    cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
    deleted smallint unsigned DEFAULT '0' NOT NULL,
    hidden smallint unsigned DEFAULT '0' NOT NULL,
    starttime int(11) unsigned DEFAULT '0' NOT NULL,
    endtime int(11) unsigned DEFAULT '0' NOT NULL,
    sorting int(11) DEFAULT '0' NOT NULL,

    sys_language_uid int(11) DEFAULT '0' NOT NULL,
    l10n_parent int(11) unsigned DEFAULT '0' NOT NULL,
    l10n_diffsource mediumblob NULL,

    t3ver_oid int(11) unsigned DEFAULT '0' NOT NULL,
    t3ver_id int(11) unsigned DEFAULT '0' NOT NULL,
    t3ver_wsid int(11) unsigned DEFAULT '0' NOT NULL,
    t3ver_label varchar(255) DEFAULT '' NOT NULL,
    t3ver_state smallint DEFAULT '0' NOT NULL,
    t3ver_stage int(11) DEFAULT '0' NOT NULL,
    t3ver_count int(11) unsigned DEFAULT '0' NOT NULL,
    t3ver_tstamp int(11) unsigned DEFAULT '0' NOT NULL,
    t3ver_move_id int(11) unsigned DEFAULT '0' NOT NULL,
    t3_origuid int(11) unsigned DEFAULT '0' NOT NULL,

    PRIMARY KEY (uid),
    KEY parent (pid),
    KEY t3ver_oid (t3ver_oid,t3ver_wsid),
    KEY language (l10n_parent,sys_language_uid)
);


#
# Table structure for table 'tx_bootstrappackage_tab_item'
#
CREATE TABLE tx_bootstrappackage_tab_item (
    uid int(11) unsigned NOT NULL auto_increment,
    pid int(11) DEFAULT '0' NOT NULL,

    tt_content int(11) unsigned DEFAULT '0',
    header varchar(255) DEFAULT '' NOT NULL,
    bodytext text,
    media int(11) unsigned DEFAULT '0',
    mediaorient varchar(60) DEFAULT 'left' NOT NULL,
    imagecols tinyint(4) unsigned DEFAULT '1' NOT NULL,
    image_zoom tinyint(3) unsigned DEFAULT '0' NOT NULL,

    tstamp int(11) unsigned DEFAULT '0' NOT NULL,
    crdate int(11) unsigned DEFAULT '0' NOT NULL,
    cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
    deleted smallint unsigned DEFAULT '0' NOT NULL,
    hidden smallint unsigned DEFAULT '0' NOT NULL,
    starttime int(11) unsigned DEFAULT '0' NOT NULL,
    endtime int(11) unsigned DEFAULT '0' NOT NULL,
    sorting int(11) DEFAULT '0' NOT NULL,

    sys_language_uid int(11) DEFAULT '0' NOT NULL,
    l10n_parent int(11) unsigned DEFAULT '0' NOT NULL,
    l10n_diffsource mediumblob NULL,

    t3ver_oid int(11) unsigned DEFAULT '0' NOT NULL,
    t3ver_id int(11) unsigned DEFAULT '0' NOT NULL,
    t3ver_wsid int(11) unsigned DEFAULT '0' NOT NULL,
    t3ver_label varchar(255) DEFAULT '' NOT NULL,
    t3ver_state smallint DEFAULT '0' NOT NULL,
    t3ver_stage int(11) DEFAULT '0' NOT NULL,
    t3ver_count int(11) unsigned DEFAULT '0' NOT NULL,
    t3ver_tstamp int(11) unsigned DEFAULT '0' NOT NULL,
    t3ver_move_id int(11) unsigned DEFAULT '0' NOT NULL,
    t3_origuid int(11) unsigned DEFAULT '0' NOT NULL,

    PRIMARY KEY (uid),
    KEY parent (pid),
    KEY t3ver_oid (t3ver_oid,t3ver_wsid),
    KEY language (l10n_parent,sys_language_uid)
);


#
# Table structure for table 'tx_bootstrappackage_timeline_item'
#
CREATE TABLE tx_bootstrappackage_timeline_item (
    uid int(11) unsigned NOT NULL auto_increment,
    pid int(11) DEFAULT '0' NOT NULL,

    tt_content int(11) unsigned DEFAULT '0',
    date date,
    header varchar(255) DEFAULT '' NOT NULL,
    bodytext text,
    icon_file int(11) unsigned DEFAULT '0',
    image int(11) unsigned DEFAULT '0',

    tstamp int(11) unsigned DEFAULT '0' NOT NULL,
    crdate int(11) unsigned DEFAULT '0' NOT NULL,
    cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
    deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
    hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,
    starttime int(11) unsigned DEFAULT '0' NOT NULL,
    endtime int(11) unsigned DEFAULT '0' NOT NULL,
    sorting int(11) DEFAULT '0' NOT NULL,

    sys_language_uid int(11) DEFAULT '0' NOT NULL,
    l10n_parent int(11) unsigned DEFAULT '0' NOT NULL,
    l10n_diffsource mediumblob NULL,

    t3ver_oid int(11) unsigned DEFAULT '0' NOT NULL,
    t3ver_id int(11) unsigned DEFAULT '0' NOT NULL,
    t3ver_wsid int(11) unsigned DEFAULT '0' NOT NULL,
    t3ver_label varchar(255) DEFAULT '' NOT NULL,
    t3ver_state smallint DEFAULT '0' NOT NULL,
    t3ver_stage int(11) DEFAULT '0' NOT NULL,
    t3ver_count int(11) unsigned DEFAULT '0' NOT NULL,
    t3ver_tstamp int(11) unsigned DEFAULT '0' NOT NULL,
    t3ver_move_id int(11) unsigned DEFAULT '0' NOT NULL,
    t3_origuid int(11) unsigned DEFAULT '0' NOT NULL,

    PRIMARY KEY (uid),
    KEY parent (pid),
    KEY t3ver_oid (t3ver_oid,t3ver_wsid),
    KEY language (l10n_parent,sys_language_uid)
);
