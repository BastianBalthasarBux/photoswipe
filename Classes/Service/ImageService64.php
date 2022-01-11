<?php

namespace Tei\PhotoSwipe\Service;

use TYPO3\CMS\Core\Core\Environment;
use TYPO3\CMS\Core\Resource\ProcessedFile;
use TYPO3\CMS\Core\SingletonInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManager;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;
use TYPO3\CMS\Extbase\Configuration\FrontendConfigurationManager;
use TYPO3\CMS\Extbase\Service\ImageService;

class ImageService64
{
    protected FrontendConfigurationManager $frontendConfigurationManager;

    protected array $settings;

    public function injectFrontendConfigurationManager(FrontendConfigurationManager $fcm)
    {
        $this->frontendConfigurationManager = $fcm;
    }

    public function getBase64Preview(ProcessedFile $processedImage): string
    {
        $this->settings = $this->frontendConfigurationManager->getTypoScriptSetup()['plugin.']['tx_photoswipe.']['settings.'];
        $imageExtension = strtolower($processedImage->getExtension());
        $allowedImageExtensions = explode(',', strtolower($this->settings['imageExtensions']));
        $svgImage = 'data:image/file-extensions-not-supported;';

        if (in_array($imageExtension, $allowedImageExtensions)) {
            $props = $processedImage->getOriginalFile()->getProperties();
            $svgHeight = ($props['height'] * $this->settings['svgWidth']) / $props['width'];

            $processingInstructions = [
                'width' => $this->settings['svgWidth'],
                'height' => $svgHeight,
            ];
            $imageService = $this->getImageService();
            $processedImageSVG = $imageService->applyProcessingInstructions($processedImage, $processingInstructions);

            $fileLink = Environment::getPublicPath() . $imageService->getImageUri($processedImageSVG);

            // remove EXIF and get img-data
            $tmpFileLink = Environment::getPublicPath() . '/fileadmin/_processed_/ps_tmp.' . $imageExtension;
            $this->removeExif($fileLink, $tmpFileLink);
            $tmpData = file_get_contents($tmpFileLink);

            $svgImage = 'data:image/' . $imageExtension . ';base64,' . base64_encode($tmpData);
        }
        return $svgImage;
    }

    /**
     * taken from https://stackoverflow.com/questions/3614925/remove-exif-data-from-jpg-using-php/38862429 [Dmitry Bugrov]
     * @param string $in
     * @param string $out
     */
    private function removeExif(string $in, string $out): void
    {
        $buffer_len = 4096;
        $fd_in = fopen(urldecode($in), 'rb');
        $fd_out = fopen($out, 'wb');
        while (($buffer = fread($fd_in, $buffer_len))) {
            //  \xFF\xE1\xHH\xLLExif\x00\x00 - Exif
            //  \xFF\xE1\xHH\xLLhttp://      - XMP
            //  \xFF\xE2\xHH\xLLICC_PROFILE  - ICC
            //  \xFF\xED\xHH\xLLPhotoshop    - PH
            while (preg_match('/\xFF[\xE1\xE2\xED\xEE](.)(.)(exif|photoshop|http:|icc_profile|adobe)/si', $buffer, $match, PREG_OFFSET_CAPTURE)) {
                $len = ord($match[1][0]) * 256 + ord($match[2][0]);
                fwrite($fd_out, substr($buffer, 0, $match[0][1]));
                $filepos = $match[0][1] + 2 + $len - strlen($buffer);
                fseek($fd_in, $filepos, SEEK_CUR);
                $buffer = fread($fd_in, $buffer_len);
            }
            fwrite($fd_out, $buffer, strlen($buffer));
        }
        fclose($fd_out);
        fclose($fd_in);
    }

    /**
     * @return SingletonInterface|ImageService|null
     */
    protected function getImageService()
    {
        return GeneralUtility::makeInstance(ImageService::class);
    }
}