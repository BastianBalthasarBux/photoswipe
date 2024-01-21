# TYPO3 photoswipe
[![Latest Stable Version](https://img.shields.io/packagist/v/tei/photoswipe?style=for-the-badge)](https://packagist.org/packages/tei/photoswipe)
[![TYPO3](https://img.shields.io/badge/TYPO3-photoswipe-%23f49700?style=for-the-badge)](https://extensions.typo3.org/extension/photoswipe)
[![License](https://img.shields.io/packagist/l/tei/photoswipe?style=for-the-badge)](https://packagist.org/packages/tei/photoswipe)

**Extension key:**
photoswipe

**Version:**
2.0.0

**Language:**
en

**Description:**
Adds the [photoswipe.com](http://photoswipe.com/) JavaScript plugin (version 5.4.2 https://github.com/dimsemenov/photoswipe) as default for image enlargement

**Keywords:**
gallery, photoswipe, lightbox, layer, zoom

**Copyright:**
2020

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

## ChangeLog

- 1.0.0 - Initial release of Extension
- 1.0.1 - 1.0.4 - struggling with composer.json
- 1.0.5 - Bugfix: Always opened first image in gallery
- 1.0.6 - Bugfix: share button, added config for css-wrapper class
- 1.0.7 - Bugfix: composer.json for packagist
- 1.1.0 - Feature: added base64 support for lazy loading. Just use the checkbox "lazy loading" next to "enlarge image".
- 1.1.1 - Ready for TYPO3 11
- 1.1.2 - Bugfix: Composer
- 1.1.3 - Bugfix: TCA in overrides
- 1.2.0 - Bugfix: image link with special chars, Feature: new psw-version 4.4.1
- 1.2.1 - 1.2.2 Documentation update, version emconf
- 1.2.3 - 1.2.4 Bugfixes, new PHP version
- 1.2.5 - 1.2.6 TYPO3 v12
- 1.2.7 - Bugfix: link in caption
- 2.0.0 - PhotoSwipe 5.4.2, Layer in LinkWizard, TYPO3 v12 only
- 2.0.1 - Bugfix: CSS
- 2.0.2 - Bugfix: Javascript is merged without module-attribute