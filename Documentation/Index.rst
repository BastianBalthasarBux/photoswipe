==========
PhotoSwipe
==========


What does it do?
================
Adds the photoswipe.com JavaScript plugin (version 4.1.3) as default for image enlargement.
|

Installation
============
You can install this extension via em or composer:
|

Installation via ExtensionManager
=================================
1. Go to the Extension Manager and install the extension
2. Include the static template "PhotoSwipe (photoswipe)"
3. Configure extension if required (see section below)

Installation via Composer
=========================
1. install the extension via composer
2. Include the static template "PhotoSwipe (jh_photoswipe)"
3. Configure extension if required (see section below)

Configuration
=============
You can overwrite all files in the Constant Editor. Besides that you will find a checkbox to
enable a Share-Button for social media.
Please not, that the extension itself uses page.99 to add its html template at the bottom of the page.
It also adds a parameter to TYPO3's media link in TypoScript/setup.txt

Usage
=====
Just use the regular "Enlarge on Click" checkbox in the backend. If you have more than one image, the extension will
add arrows in the zoom-view.

ChangeLog
=========
|
1.0.0
=====
- Initial release of Extension
