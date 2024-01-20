<?php

return [
    'dependencies' => [
        'core',
    ],
    'tags' => [
        'backend.module',
        'backend.form',
        'backend.navigation-component',
    ],
    'imports' => [
        '@tei/photoswipe/' => [
            'path' => 'EXT:photoswipe/Resources/Public/JavaScript/',
        ],
    ],
];
