#!/usr/bin/env php
<?php

/*
 * IP Restriction Manager is an open source module developed by SugarCRM, Inc
 * Copyright (C) SugarCRM, Inc.
 *
 * "Upsert® IP Restriction Manager" is an extension to "IP Restriction Manager" developed by Upsert, LLC.
 * Copyright (C) Upsert, LLC.
 *
 * Project: https://github.com/upsertllc/IPRestrictionManager
 * Support: https://github.com/UpsertLLC/IPRestrictionManager/issues
 *
 * Licensed by SugarCRM, Inc under the Apache 2.0 license.
 */


$longopts = ['name:', 'tests:'];

if ( ! isset($options)) {
    $options = getopt('', $longopts);
}

if ( ! isset($options['tests'])) {
    $options['tests'] = false;
}

if (isset($options['name']) && ! empty($options['name'])) {
    $zipFile = "builds/{$options['name']}.zip";
} else {
    $id = time();
    $zipFile = "builds/UpsertIPRestrictionManager-{$id}.zip";
}

echo "Creating {$zipFile} ... \n";

$zip = new ZipArchive();
$zip->open($zipFile, ZipArchive::CREATE);
$basePath = realpath('src/');

$files = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($basePath, RecursiveDirectoryIterator::SKIP_DOTS),
    RecursiveIteratorIterator::LEAVES_ONLY
);

foreach ($files as $name => $file) {
    if ($file->isFile()) {
        $fileReal = $file->getRealPath();
        $fileRelative = str_replace($basePath . '/', '', $fileReal);

        if ($options['tests'] !== 'true') {
            if (strpos($fileReal, '/custom/tests/') !== false) {
                echo " [*] SKIPPING $fileRelative \n";
                continue;
            }
        }
    
        echo " [*] $fileRelative \n";
        $zip->addFile($fileReal, $fileRelative);
        $installdefs['copy'][] = [
            'from' => '<basepath>/' . $fileRelative,
            'to' => preg_replace('/^src\/(.*)/', '$1', $fileRelative),
        ];
    }
}

$license = 'LICENSE.txt';
$zip->addFile($license, $license);
$zip->addFile('README.md', 'README.txt');
echo " [*] $license \n";

$zip->close();

echo "done\n";
exit(0);
