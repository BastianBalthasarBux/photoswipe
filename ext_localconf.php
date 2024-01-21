<?php
defined('TYPO3') || defined('TYPO3_MODE') || die();

use \TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Page\AssetCollector;


(function () {

    $GLOBALS['TYPO3_CONF_VARS']['FE']['typolinkBuilder']['photoswipe'] =
        \Tei\PhotoSwipe\LinkHandler\PhotoSwipeLinkBuilder::class;
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['linkHandler']['photoswipe'] =
        \Tei\PhotoSwipe\LinkHandler\PhotoSwipeLinkHandling::class;

    /** @var AssetCollector $assetController */
    $assetController = GeneralUtility::makeInstance(AssetCollector::class);
    $assetController->addJavaScript(
        'photoswipe',
        'EXT:photoswipe/Resources/Public/JavaScript/photoswipe-init.js',
        [
            'type' => 'module'
        ]);
    $assetController->addStyleSheet(
        'photoswipe',
        'EXT:photoswipe/Resources/Public/Css/photoswipe.css');
})();