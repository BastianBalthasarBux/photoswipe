<?php

declare(strict_types=1);

namespace Tei\PhotoSwipe\LinkHandler;

use TYPO3\CMS\Core\LinkHandling\PageLinkHandler;

/** Resolves PhotoSwipe Links Backend */
class PhotoSwipeLinkHandling extends PageLinkHandler
{
    /** @var string */
    protected $baseUrn = 't3://photoswipe';
}
