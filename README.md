# TYPO3 photoswipe
[![Latest Stable Version](https://img.shields.io/packagist/v/tei/photoswipe?style=for-the-badge)](https://packagist.org/packages/tei/photoswipe)
[![TYPO3](https://img.shields.io/badge/TYPO3-photoswipe-%23f49700?style=for-the-badge)](https://extensions.typo3.org/extension/photoswipe)
[![License](https://img.shields.io/packagist/l/tei/photoswipe?style=for-the-badge)](https://packagist.org/packages/tei/photoswipe)

**Extension key:**
photoswipe

**Language:**
en

**Description:**
Adds the [photoswipe.com](http://photoswipe.com/) JavaScript plugin (version 5.4.2 https://github.com/dimsemenov/photoswipe) as default for image enlargement

**Keywords:**
gallery, photoswipe, lightbox, layer, zoom

**Copyright:**
2024

**Author:**
Tobias Eichelberger

**Email:**
[tobi.eichelberger@gmail.com](tobi.eichelberger@gmail.com)

**Licence:**
This document is published under the Open Publication License available from [opencontent.org/openpub/](http://www.opencontent.org/openpub/)
The content of this document is related to TYPO3, a GNU/GPL CMS/Framework available from www.typo3.org.


## Administration

### Installation

#### via ExtensionManager
1. Go to the Extension Manager and install the extension
2. Include the static template "PhotoSwipe (photoswipe)"
3. Configure extension if required (see section below)

#### via Composer
1. install the extension via composer: composer require tei/photoswipe
2. Include the static template "PhotoSwipe (photoswipe)"
3. Configure extension if required (see section below)

## Configuration
You can overwrite all files in the Constant Editor. 

#### Photoswipe in your HTML:
The default setting for initializing photoswipe is by TYPO3's default css-class "ce-gallery". 
Your HTML has to look like this:
```
<someHtmlEl class="your-wrapper-class">
    [... code / parent nodes]
        <figure>
            <a href="big image" data-ispsw-img="1" data-pswp-width="800" data-pswp-height="500">
                <img [opt: title='used as caption']/>
            </a>
            [opt: <figcaption>prefered as caption</figcaption>]
        </figure>
    [/... code / parent nodes]
</someHtmlEl>
```

## Usage
Just use the regular "Enlarge on Click" checkbox in the backend. If you have more than one image, the extension will
add arrows in the zoom-view.

## Layer
After installing photoswipe, TYPO3 will offer you a new link-type "Layer". You can choose between pages (iFrame) and 
 content elements (innerHTML). 
