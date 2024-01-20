<?php

declare(strict_types=1);

namespace Tei\PhotoSwipe\LinkHandler;

use TYPO3\CMS\Frontend\Typolink\LinkResultInterface;
use TYPO3\CMS\Frontend\Typolink\PageLinkBuilder;

/** Resolves PhotoSwipe Links Frontend */
class PhotoSwipeLinkBuilder extends PageLinkBuilder
{
    public function build(array &$linkDetails, string $linkText, string $target, array $conf): LinkResultInterface
    {
        $result = parent::build($linkDetails, $linkText, $target, $conf)
            ->withAttribute('data-ispsw-layer', '1');
        $url = $result->getUrl();
        $cUid = explode('#', $url)[1] ?? null;

        return $cUid
            ? $this->buildContentLayer($result, $cUid)
            : $this->buildIFrameLayer($result, $url);

    }

    private function buildIFrameLayer(LinkResultInterface $result, string $url): LinkResultInterface
    {
        return $result
            ->withAttribute('data-pswp-type', 'iframe')
            ->withAttribute('data-iframe-url', $url);
    }

    private function buildContentLayer(LinkResultInterface $result, string $cUid): LinkResultInterface
    {
        $html = trim(preg_replace('/\s+/', ' ', $GLOBALS['TSFE']->cObj->cObjGetSingle(
            'RECORDS',
            [
                'tables' => 'tt_content',
                'source' => (int)ltrim($cUid, 'c'),
                'dontCheckPid' => 1
            ]
        )));
        return $result
            ->withAttribute('data-pswp-type', 'html')
            ->withAttribute('data-html', rawurlencode($html));
    }
}
