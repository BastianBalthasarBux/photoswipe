# TYPO3 CMS extension "photoswipe"

**Extension key:**
photoswipe

**Version:**
1.0.0

**Language:**
en

**Description:**
Adds the [photoswipe.com](http://photoswipe.com/) JavaScript plugin (version 4.1.3) as default for image enlargement

**Keywords:**
gallery, photoswipe, lightbox, zoom

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
You can overwrite all files in the Constant Editor. Besides that you will find a checkbox to
enable a share-button for social media and the setting for the css-wrapper to enable photoswipe in it.
Please note that the extension itself uses TS-setup 'page.99' to add its html-template at the bottom of the page.
It also adds a parameter 'data-size' in TYPO3's media link in TypoScript/setup.txt
```
# add data-size attr to image-link
lib.contentElement.settings.media.popup.linkParams{
    ATagParams.dataWrap = class="{$styles.content.textmedia.linkWrap.lightboxCssClass}" rel="{$styles.content.textmedia.linkWrap.lightboxRelAttribute}" data-size="{file:current:width}x{file:current:height}"
}
```
You don't have to enable lightbox-features in TYPO3's constant editor. The extension will do this for you.

#### Photoswipe in your HTML:
The default setting for initializing photoswipe is by TYPO3's default css-class "ce-gallery". You can add your own classes
in the constant editor. Your HTML has to look like this:
```
<someHtmlEl class="your-wrapper-class">
    [... code / parent nodes]
        <figure>
            <a href="big image" data-size="[width]X[height]">
                <img rel="potoswipe_[whatever]" [opt: title='used as caption']/>
            </a>
            [opt: <figcaption>prefered as caption</figcaption>]
        </figure>
    [/... code / parent nodes]
</someHtmlEl>
```

## Usage
Just use the regular "Enlarge on Click" checkbox in the backend. If you have more than one image, the extension will
add arrows in the zoom-view.


## ChangeLog

- 1.0.0 - Initial release of Extension
- 1.0.1 - 1.0.4 - struggling with composer.json
- 1.0.5 - Bugfix: Always opened first image in gallery
- 1.0.6 - Bugfix: share button, added config for css-wrapper class
- 1.0.7 - Bugfix: composer.json for packagist
- 1.1.0 - Feature: added base64 support for lazy loading. Just use the checkbox "lazy loading" next to "enlarge image".
