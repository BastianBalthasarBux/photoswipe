<?php

declare(strict_types=1);

namespace Tei\PhotoSwipe\Service;

use TYPO3\CMS\Core\Imaging\ImageManipulation\Area;
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
        $file = $this->cObj->getCurrentFile();

        ['width' => $width, 'height' => $height] = $this->getFileProperties($file);

        // fallback to original file if dimensions are still null for unknown reason
        // see https://github.com/j0nnybrav079/photoswipe/issues/10
        if (((int)$width === 0) || ((int)$height === 0)) {
            ['width' => $width, 'height' => $height] = $file->getOriginalFile()->getProperties();
        }

        return sprintf(
            'data-ispsw-img="1" data-pswp-width="%s" data-pswp-height="%s"',
            $width,
            $height,
        );
    }

    private function getFileProperties($file): array
    {
        $crop = $file->getReferenceProperties()['crop'];

        if ($crop === null) {
            // No crop applied, so just return properties of original file.
            return $file->getProperties();
        }

        // File (reference) is cropped.
        $cropArea = CropVariantCollection::create($crop)->getCropArea('default');

        return $cropArea->isEmpty() ? $file->getProperties() : $this->getCroppedFileProperties($file, $cropArea);
    }

    private function getCroppedFileProperties($file, Area $cropArea): array
    {
        $processingInstructions = [
            'crop' => $cropArea->isEmpty() ? null : $cropArea->makeAbsoluteBasedOnFile($file)
        ];

        $imageService = GeneralUtility::makeInstance(ImageService::class);

        return $imageService->applyProcessingInstructions($file, $processingInstructions)->getProperties();
    }
}