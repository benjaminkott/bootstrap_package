#
# Table structure for table 'tt_content'
#
CREATE TABLE tt_content (
    icon varchar(255) DEFAULT '' NOT NULL,
    icon_position varchar(255) DEFAULT '' NOT NULL,
    icon_size int(11) unsigned DEFAULT '0',
    icon_type int(11) unsigned DEFAULT '0',
    icon_color varchar(255) DEFAULT '' NOT NULL,
    icon_background varchar(255) DEFAULT '' NOT NULL,
    external_media_source varchar(1024) DEFAULT '' NOT NULL,
    external_media_ratio varchar(10) DEFAULT '' NOT NULL,
    tx_bootstrappackage_carousel_item int(11) unsigned DEFAULT '0',
    tx_bootstrappackage_accordion_item int(11) unsigned DEFAULT '0',
    tx_bootstrappackage_tab_item int(11) unsigned DEFAULT '0'
);


#
# Table structure for table 'tx_bootstrappackage_carousel_item'
#
CREATE TABLE tx_bootstrappackage_carousel_item (
    uid int(11) NOT NULL auto_increment,
    pid int(11) DEFAULT '0' NOT NULL,

    tt_content int(11) unsigned DEFAULT '0',
    item_type varchar(255) DEFAULT '' NOT NULL,
    header varchar(255) DEFAULT '' NOT NULL,
    header_layout tinyint(3) unsigned DEFAULT '1' NOT NULL,
    bodytext text NOT NULL,
    image int(11) unsigned DEFAULT '0',
    link varchar(255) DEFAULT '' NOT NULL,
    text_color varchar(255) DEFAULT '' NOT NULL,
    background_color varchar(255) DEFAULT '' NOT NULL,
    background_image int(11) unsigned DEFAULT '0',

    tstamp int(11) unsigned DEFAULT '0' NOT NULL,
    crdate int(11) unsigned DEFAULT '0' NOT NULL,
    cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
    deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
    hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,
    starttime int(11) unsigned DEFAULT '0' NOT NULL,
    endtime int(11) unsigned DEFAULT '0' NOT NULL,

    t3ver_oid int(11) DEFAULT '0' NOT NULL,
    t3ver_id int(11) DEFAULT '0' NOT NULL,
    t3ver_wsid int(11) DEFAULT '0' NOT NULL,
    t3ver_label varchar(255) DEFAULT '' NOT NULL,
    t3ver_state tinyint(4) DEFAULT '0' NOT NULL,
    t3ver_stage int(11) DEFAULT '0' NOT NULL,
    t3ver_count int(11) DEFAULT '0' NOT NULL,
    t3ver_tstamp int(11) DEFAULT '0' NOT NULL,
    t3ver_move_id int(11) DEFAULT '0' NOT NULL,
    sorting int(11) DEFAULT '0' NOT NULL,
    t3_origuid int(11) DEFAULT '0' NOT NULL,
    sys_language_uid int(11) DEFAULT '0' NOT NULL,
    l10n_parent int(11) DEFAULT '0' NOT NULL,
    l10n_diffsource mediumblob NOT NULL,

    PRIMARY KEY (uid),
    KEY parent (pid),
    KEY t3ver_oid (t3ver_oid,t3ver_wsid),
    KEY language (l10n_parent,sys_language_uid)
);


#
# Table structure for table 'tx_bootstrappackage_accordion_item'
#
CREATE TABLE tx_bootstrappackage_accordion_item (
    uid int(11) NOT NULL auto_increment,
    pid int(11) DEFAULT '0' NOT NULL,

    tt_content int(11) unsigned DEFAULT '0',
    header varchar(255) DEFAULT '' NOT NULL,
    bodytext text NOT NULL,

    tstamp int(11) unsigned DEFAULT '0' NOT NULL,
    crdate int(11) unsigned DEFAULT '0' NOT NULL,
    cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
    deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
    hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,
    starttime int(11) unsigned DEFAULT '0' NOT NULL,
    endtime int(11) unsigned DEFAULT '0' NOT NULL,

    t3ver_oid int(11) DEFAULT '0' NOT NULL,
    t3ver_id int(11) DEFAULT '0' NOT NULL,
    t3ver_wsid int(11) DEFAULT '0' NOT NULL,
    t3ver_label varchar(255) DEFAULT '' NOT NULL,
    t3ver_state tinyint(4) DEFAULT '0' NOT NULL,
    t3ver_stage int(11) DEFAULT '0' NOT NULL,
    t3ver_count int(11) DEFAULT '0' NOT NULL,
    t3ver_tstamp int(11) DEFAULT '0' NOT NULL,
    t3ver_move_id int(11) DEFAULT '0' NOT NULL,
    sorting int(11) DEFAULT '0' NOT NULL,
    t3_origuid int(11) DEFAULT '0' NOT NULL,
    sys_language_uid int(11) DEFAULT '0' NOT NULL,
    l10n_parent int(11) DEFAULT '0' NOT NULL,
    l10n_diffsource mediumblob NOT NULL,

    PRIMARY KEY (uid),
    KEY parent (pid),
    KEY t3ver_oid (t3ver_oid,t3ver_wsid),
    KEY language (l10n_parent,sys_language_uid)
);


#
# Table structure for table 'tx_bootstrappackage_tab_item'
#
CREATE TABLE tx_bootstrappackage_tab_item (
    uid int(11) NOT NULL auto_increment,
    pid int(11) DEFAULT '0' NOT NULL,

    tt_content int(11) unsigned DEFAULT '0',
    header varchar(255) DEFAULT '' NOT NULL,
    bodytext text NOT NULL,

    tstamp int(11) unsigned DEFAULT '0' NOT NULL,
    crdate int(11) unsigned DEFAULT '0' NOT NULL,
    cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
    deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
    hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,
    starttime int(11) unsigned DEFAULT '0' NOT NULL,
    endtime int(11) unsigned DEFAULT '0' NOT NULL,

    t3ver_oid int(11) DEFAULT '0' NOT NULL,
    t3ver_id int(11) DEFAULT '0' NOT NULL,
    t3ver_wsid int(11) DEFAULT '0' NOT NULL,
    t3ver_label varchar(255) DEFAULT '' NOT NULL,
    t3ver_state tinyint(4) DEFAULT '0' NOT NULL,
    t3ver_stage int(11) DEFAULT '0' NOT NULL,
    t3ver_count int(11) DEFAULT '0' NOT NULL,
    t3ver_tstamp int(11) DEFAULT '0' NOT NULL,
    t3ver_move_id int(11) DEFAULT '0' NOT NULL,
    sorting int(11) DEFAULT '0' NOT NULL,
    t3_origuid int(11) DEFAULT '0' NOT NULL,
    sys_language_uid int(11) DEFAULT '0' NOT NULL,
    l10n_parent int(11) DEFAULT '0' NOT NULL,
    l10n_diffsource mediumblob NOT NULL,

    PRIMARY KEY (uid),
    KEY parent (pid),
    KEY t3ver_oid (t3ver_oid,t3ver_wsid),
    KEY language (l10n_parent,sys_language_uid)
);