<?php

declare(strict_types=1);

namespace Tei\PhotoSwipe\Service;

use TYPO3\CMS\Core\Imaging\ImageManipulation\CropVariantCollection;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Service\ImageService;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;


final class ATagParams
{
    private ContentObjectRenderer $cObj;

    public function setContentObjectRenderer(ContentObjectRenderer $cObj): void
    {
        $this->cObj = $cObj;
    }

    public function set(string $content, array $conf): string
    {
        $fileCurrent = $this->cObj->getCurrentFile();
        $cropArea = json_decode($fileCurrent->getReferenceProperties()['crop'])->default->cropArea;
        $cropWidth = $cropArea->width;
        $cropHeight = $cropArea->height;

        $properties = 1 === $cropWidth && 1 === $cropHeight
            ? $fileCurrent->getProperties()
            : $this->getCroppedSize($this->cObj->getCurrentFile(), $fileCurrent->getReferenceProperties()['crop']);

        return sprintf('data-ispsw-img="1" data-pswp-width="%s" data-pswp-height="%s"',
            $properties['width'],
            $properties['height']
        );
    }

    public function getCroppedSize($file, $crop): array
    {
        $cropArea = CropVariantCollection::create($crop)->getCropArea('default'); // cropVariant
        $processingInstructions = [
            'crop' => $cropArea->isEmpty() ? null : $cropArea->makeAbsoluteBasedOnFile($file)
        ];
        $imageService = GeneralUtility::makeInstance(ImageService::class);

        return $imageService->applyProcessingInstructions($file, $processingInstructions)->getProperties();
    }
}