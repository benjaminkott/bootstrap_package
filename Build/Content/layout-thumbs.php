<?php

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

$layouts = [
  'default' => [[['normal', 12]]],
  'simple' => [[['normal', 12]]],
  '2_columns' => [[['normal', 8], ['right', 4]]],
  '2_columns_25_75' => [[['left', 3], ['normal', 9]]],
  '2_columns_50_50' => [[['normal', 6], ['right', 6]]],
  '2_columns_offset_right' => [[['normal', 8], ['', 1], ['right', 3]]],
  '3_columns' => [[['left', 3], ['normal', 6], ['right', 3]]],
  'subnavigation_left' => [[['nav', 3], ['normal', 9]]],
  'subnavigation_left_2_columns' => [[['nav', 3], ['left', 3], ['normal', 6]]],
  'subnavigation_right' => [[['normal', 9], ['nav', 3]]],
  'subnavigation_right_2_columns' => [[['normal', 6], ['right', 3], ['nav', 3]]],
  'special_feature' => [[['normal', 12]], [['s1', 3], ['s2', 3], ['s3', 3], ['s4', 3]], [['main2', 12]], [['s5', 3], ['s6', 3], ['s7', 3], ['s8', 3]]],
  'special_start' => [[['normal', 12]], [['m1', 4], ['m2', 4], ['m3', 4]]],
];
$W=1200;
$H=900;
$pad=60;
$gap=16;
foreach ($layouts as $name => $rows) {
    $im = imagecreatetruecolor($W, $H);
    $bg = imagecolorallocate($im, 0xF0, 0xEE, 0xE9);
    imagefill($im, 0, 0, $bg);
    $teal = imagecolorallocate($im, 0x19, 0x73, 0x7A);
    $khaki = imagecolorallocate($im, 0xCB, 0xBB, 0xA1);
    $umber = imagecolorallocate($im, 0x57, 0x50, 0x4C);
    $green = imagecolorallocate($im, 0x54, 0x6F, 0x68);
    $white = imagecolorallocate($im, 0xF8, 0xF7, 0xF4);
    // header bar and footer bar as context
    imagefilledrectangle($im, $pad, $pad, $W-$pad, $pad+50, $umber);
    $footY=$H-$pad-50;
    if ($name !== 'simple') {
        imagefilledrectangle($im, $pad, $footY, $W-$pad, $H-$pad, $umber);
    } else {
        $footY=$H-$pad;
    }
    $top=$pad+50+$gap*2;
    $bottom=$footY-$gap*2;
    // border/contentbefore/contentafter as thin khaki bars
    imagefilledrectangle($im, $pad, $top, $W-$pad, $top+24, $khaki);
    $top+=24+$gap;
    imagefilledrectangle($im, $pad, $bottom-24, $W-$pad, $bottom, $khaki);
    $bottom-=24+$gap;
    $rowH = ($bottom-$top-($gap*(count($rows)-1)))/count($rows);
    $unit = ($W-2*$pad-11*$gap)/12;
    foreach ($rows as $ri => $cols) {
        $y1 = (int)($top + $ri*($rowH+$gap));
        $y2=(int)($y1+$rowH);
        $x=$pad;
        foreach ($cols as [$id,$span]) {
            $w = $span*$unit + ($span-1)*$gap;
            if ($id !== '') {
                $c = $id==='normal'||$id==='main2' ? $teal : ($id==='nav' ? $green : ($id[0]==='s'||$id[0]==='m' ? $green : $khaki));
                imagefilledrectangle($im, (int)$x, $y1, (int)($x+$w), $y2, $id==='nav'?$umber:$c);
                if ($id==='nav') {
                    for ($i=0;$i<4;$i++) {
                        imagefilledrectangle($im, (int)$x+20, $y1+30+$i*40, (int)($x+$w)-20, $y1+30+$i*40+14, $white);
                    }
                }
            }
            $x += $w + $gap;
        }
    }
    imagepng($im, __DIR__ . "/../Images/Demo/layouts/$name.png", 6);
}
echo "done\n";
