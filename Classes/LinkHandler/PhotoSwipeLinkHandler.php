<?php

declare(strict_types=1);

namespace Tei\PhotoSwipe\LinkHandler;

use Psr\Http\Message\ServerRequestInterface;
use TYPO3\CMS\Backend\LinkHandler\PageLinkHandler;

/** Resolves PhotoSwipe Links Backend LinkBrowser */
class PhotoSwipeLinkHandler extends PageLinkHandler
{
    public function render(ServerRequestInterface $request): string
    {
        $this->pageRenderer->loadJavaScriptModule('@tei/photoswipe/photoswipe-link-handler.js');
        $this->pageRenderer->loadJavaScriptModule('@typo3/backend/viewport/resizable-navigation.js');
        $this->pageRenderer->loadJavaScriptModule('@typo3/backend/tree/page-browser.js');
        $this->getBackendUser()->initializeWebmountsForElementBrowser();

        $this->expandPage = isset($request->getQueryParams()['expandPage']) ? (int)$request->getQueryParams()['expandPage'] : 0;

        $this->view->assign('initialNavigationWidth', $this->getBackendUser()->uc['selector']['navigation']['width'] ?? 250);
        $this->view->assign('treeActions', ['link']);
        $this->getRecordsOnExpandedPage($this->expandPage);
        return $this->view->render('LinkBrowser/Page');
    }
}
