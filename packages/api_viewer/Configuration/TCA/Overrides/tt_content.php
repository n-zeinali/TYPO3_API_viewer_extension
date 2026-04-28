<?php
defined('TYPO3') or die();

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

// 1. Register plugin
ExtensionUtility::registerPlugin(
    'ApiViewer',
    'List',
    'API Viewer – Fetch & Display'
);

// 2. Add FlexForm
$pluginSignature = 'apiviewer_list';

$GLOBALS['TCA']['tt_content']['types'][$pluginSignature]['showitem'] = '
    --div--;General,
        --palette--;;general,
        pi_flexform,
    --div--;Access,
        --palette--;;hidden,
        --palette--;;access
';

ExtensionManagementUtility::addPiFlexFormValue(
    '*',
    'FILE:EXT:api_viewer/Configuration/FlexForms/ApiPlugin.xml',
    $pluginSignature
);