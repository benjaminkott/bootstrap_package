<?php

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

$container = require __DIR__ . '/bootstrap.php';
$tca = $GLOBALS['TCA']['tt_content'];
$skip = ['CType', 'colPos', 'sys_language_uid', 'l18n_parent', 'hidden', 'starttime', 'endtime', 'fe_group', 'editlock', 'rowDescription', 'categories', 'pages', 'records', 'tx_impexp_origuid', 'l10n_source', 'l18n_diffsource', 'pi_flexform', 'file_folder', 'filelink_sorting', 'filelink_sorting_direction'];
$out = [];
foreach ($tca['types'] as $type => $def) {
    if ($type === '1' || $type === 1) {
        continue;
    }
    $show = $def['showitem'] ?? '';
    $show = preg_replace_callback('/--palette--;[^;,]*;([a-zA-Z_0-9]+)/', fn ($m) => $tca['palettes'][$m[1]]['showitem'] ?? '', $show);
    $fields = [];
    foreach (explode(',', $show) as $f) {
        $f = trim(explode(';', trim($f))[0]);
        if ($f !== '' && !str_starts_with($f, '--') && !in_array($f, $skip, true)) {
            $fields[] = $f;
        }
    }
    $fields = array_values(array_unique($fields));
    $line = [];
    foreach ($fields as $f) {
        $cfg = $def['columnsOverrides'][$f]['config'] ?? [];
        $cfg = array_replace_recursive($tca['columns'][$f]['config'] ?? [], $cfg);
        $t = $cfg['type'] ?? '?';
        $desc = $t;
        if (isset($cfg['items'])) {
            $vals = array_map(fn ($i) => $i['value'] ?? $i[1] ?? '', $cfg['items']);
            $vals = array_filter($vals, fn ($v) => $v !== '--div--');
            $desc .= '[' . implode('|', $vals) . ']';
        }
        if (isset($cfg['itemsProcFunc'])) {
            $desc .= '[proc]';
        }
        if (isset($cfg['default']) && $cfg['default'] !== '' && $cfg['default'] !== 0) {
            $desc .= '=' . json_encode($cfg['default']);
        }
        if ($t === 'file' && isset($cfg['maxitems'])) {
            $desc .= ' max' . $cfg['maxitems'];
        }
        $line[] = "$f:$desc";
    }
    $out[$type] = $line;
}
foreach ($out as $type => $line) {
    echo "== $type\n   ", implode("\n   ", $line), "\n";
}
