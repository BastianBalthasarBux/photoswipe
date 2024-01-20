<?php

declare(strict_types=1);

use TYPO3\CMS\Core\Imaging\IconProvider\BitmapIconProvider;
use TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider;

return [
    'tx-photoswipe-icon' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:photoswipe/Resources/Public/Icons/Extension.svg',
    ],
    'tx-photoswipe-content' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:photoswipe/Resources/Public/Icons/LayerContent.svg',
    ],
    'tx-photoswipe-page' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:photoswipe/Resources/Public/Icons/LayerPage.svg',
    ],
];