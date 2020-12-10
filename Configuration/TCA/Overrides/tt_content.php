<?php
defined('TYPO3_MODE') or die();

$ttContentColumns = [
    'imagelazy64' => [
        'exclude' => true,
        'label' => 'LLL:EXT:photoswipe/Resources/Private/Language/locallang_db.xlf:tx_photoswipe.imagelazy64',
        'config' => [
            'type' => 'check',
            'renderType' => 'checkboxToggle',
            'items' => [
                [
                    0 => '',
                    1 => '',
                ]
            ],
        ]
    ],
];

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tt_content', $ttContentColumns);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette('tt_content', 'imagelinks', 'imagelazy64');
