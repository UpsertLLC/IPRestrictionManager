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

if ( ! defined('sugarEntry') || ! sugarEntry) {
    die('Not A Valid Entry Point');
}

$version = $GLOBALS['sugar_version'];

$GLOBALS['log']->info('Upsert® IP Restriction Manager :: Precheck');

$manifest = [];
include($this->base_dir . '/manifest.php');

$qb = $GLOBALS['db']->getConnection()->createQueryBuilder();
$qb->select(['id', 'name', 'version'])
    ->from('upgrade_history')
    ->where($qb->expr()->eq('status', $qb->createPositionalParameter('installed')))
    ->andWhere($qb->expr()->eq('id_name', $qb->createPositionalParameter($manifest['key'])));

$stmt = $qb->execute();
$packages = [];
while ($row =  $stmt->fetch()) {
    $packages[] = $row;
}

if ($packages) {
    $message = "The following packages must be uninstalled before updated versions can be installed: \n<p/><ul>";
    if (version_compare($version, '11.3.0', '>=')) {
        foreach ($packages as $key => $package) {
            $packageNumber = $key + 1;
            $message .= "<li>{$packageNumber}) {$package['name']} {$package['version']}\n</li>";
        }
    } else {
        foreach ($packages as $key => $package) {
            $message .= "<li>{$package['name']} {$package['version']}\n</li>";
        }
    }

    $message .= '</ul>';

    $GLOBALS['log']->fatal(strip_tags($message));
    if (version_compare($version, '11.3.0', '>=')) {
        $errors[] = strip_tags($message);
    } else {
        $errors[] = $message;
    }
    $this->abort($errors);
}

$conflicts = [];

if ( ! class_exists("\SugarAutoloader") || ! method_exists("\SugarAutoloader", 'fileExists')) {
    $GLOBALS['log']->fatal('SugarAutoloader::fileExists was not found.');
    return;
}

if (isset($this->installdefs['copy']) && ! empty($this->installdefs['copy'])) {
    foreach ($this->installdefs['copy'] as $file) {
        if ( ! isset($file['to'])) {
            continue;
        }

        if (\SugarAutoloader::fileExists($file['to'])) {
            $conflicts[] = $file['to'];
        }
    }
}

$additionalFileChecks = [
    'custom/Extension/application/Ext/Language/temp.php',
];

foreach ($additionalFileChecks as $additionalFileCheck) {
    if (\SugarAutoloader::fileExists($additionalFileCheck)) {
        $conflicts[] = "{$additionalFileCheck} - This file is known to cause install issues and should be renamed or removed";
    }
}

$additionalFolderChecks = [
    'custom/Extension/application/Ext/Language/temp/',
];

foreach ($additionalFolderChecks as $additionalFolderCheck) {
    if (sugar_is_dir($additionalFolderCheck)) {
        $conflicts[] = "{$additionalFolderCheck} - This folder is known to cause install issues and should be renamed or removed";
    }
}

if ($conflicts) {
    $contactUs = 'Please contact us at <a href="mailto:support@upsertconsulting.com">support@upsertconsulting.com</a> for assistance.';
    $message = "The following files conflict with this package: <p/><ol>\n";
    if (version_compare($version, '11.3.0', '>=')) {
        $emailMessage = $message;
        foreach ($conflicts as $key => $conflict) {
            $fileNumber = $key + 1;
            $message .= "<li>{$fileNumber}) {$conflict}\n</li>";
            $emailMessage .= "<li>{$conflict}\n</li>";
        }
        $emailMessage .= "</ol><p/>\n";
        $emailMessage .= $contactUs;
    } else {
        foreach ($conflicts as $conflict) {
            $message .= "<li>{$conflict}\n</li>";
        }
    }
    
    $message .= "</ol><p/>\n";
    $message .= $contactUs;

    $plainMessage = strip_tags(br2nl($message));

    //log
    $GLOBALS['log']->fatal($plainMessage);

    //email
    $primaryEmailAddress = $GLOBALS['current_user']->emailAddress->getPrimaryAddress($GLOBALS['current_user']);

    if ( ! empty($primaryEmailAddress)) {
        try {
            $mailer = \MailerFactory::getSystemDefaultMailer();
            $mailTransmissionProtocol = $mailer->getMailTransmissionProtocol();
            $mailer->setSubject('Conflicts when installing ' . $manifest['name']);
            $mailer->setTextBody($plainMessage);
            if (version_compare($version, '11.3.0', '>=')) {
                $mailer->setHtmlBody($emailMessage);
            } else {
                $mailer->setHtmlBody($message);
            }
            $mailer->addRecipientsTo(new \EmailIdentity($GLOBALS['current_user']->full_name, $primaryEmailAddress));
            $mailer->send();
        } catch (\MailerException $e) {
            $error = $e->getMessage();

            switch ($e->getCode()) {
                case \MailerException::FailedToConnectToRemoteServer:
                    $GLOBALS['log']->fatal('Email Reminder: error sending email, system smtp server is not set');
                    break;
                default:
                    $GLOBALS['log']->fatal("Email Reminder: error sending e-mail (method: {$mailTransmissionProtocol}), (error: {$error})");
                    break;
            }
        }
    }

    //display
    if (version_compare($version, '11.3.0', '>=')) {
        $errors[] = strip_tags($message);
    } else {
        $errors[] = $message;
    }
    $this->abort($errors);
}
