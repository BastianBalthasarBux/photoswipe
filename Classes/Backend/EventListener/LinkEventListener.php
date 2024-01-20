<?php

declare(strict_types=1);

namespace Tei\PhotoSwipe\Backend\EventListener;

use TYPO3\CMS\Backend\Form\Event\ModifyLinkExplanationEvent;
use TYPO3\CMS\Core\Imaging\Icon;
use TYPO3\CMS\Core\Imaging\IconFactory;

final class LinkEventListener
{
    public function __construct(
        private readonly IconFactory $iconFactory
    )
    {
    }

    public function __invoke(ModifyLinkExplanationEvent $event): void
    {
        if ($event->getLinkData()['type'] === 'photoswipe') {
            if (str_contains($event->getLinkParts()['url'], '#')) {
                $event->setLinkExplanation([
                    'icon' => $this->iconFactory->getIcon(
                        'tx-photoswipe-content',
                        Icon::SIZE_SMALL
                    )->render(),
                    'text' => sprintf('PhotoSwipe Lightbox - Content (%s)', $event->getLinkParts()['url']),
                ]);
            } else {
                $event->setLinkExplanation([
                    'icon' => $this->iconFactory->getIcon(
                        'tx-photoswipe-page',
                        Icon::SIZE_SMALL
                    )->render(),
                    'text' => sprintf('PhotoSwipe Lightbox - Page (%s)', $event->getLinkParts()['url']),
                ]);
            }

        }
    }
}