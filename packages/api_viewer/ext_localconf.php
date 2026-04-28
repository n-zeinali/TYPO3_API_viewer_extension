<?php
defined('TYPO3') or die();

use Nafise\ApiViewer\Controller\ApiController;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

ExtensionUtility::configurePlugin(
    'ApiViewer',
    'List',
    [ApiController::class => 'index'],
    [],
    ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT
);