#!/bin/bash
# Empties every content table of the development installation before a seed run.
# Runs inside the container: ddev exec bash Build/Content/reset.sh
mysql -uroot -proot db -e "SET FOREIGN_KEY_CHECKS=0; TRUNCATE pages; TRUNCATE tt_content; TRUNCATE sys_file_reference; TRUNCATE sys_file; TRUNCATE sys_file_metadata; TRUNCATE sys_file_processedfile; TRUNCATE sys_category; TRUNCATE sys_category_record_mm; TRUNCATE sys_refindex; TRUNCATE tx_bootstrappackage_accordion_item; TRUNCATE tx_bootstrappackage_card_group_item; TRUNCATE tx_bootstrappackage_carousel_item; TRUNCATE tx_bootstrappackage_icon_group_item; TRUNCATE tx_bootstrappackage_tab_item; TRUNCATE tx_bootstrappackage_timeline_item;" 2>/dev/null
rm -rf "$(dirname "$0")/../../.build/public/fileadmin/_processed_"/*
