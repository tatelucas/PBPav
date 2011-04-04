=== TMF Gallery ===
Contributors: fanningert
Donate link: http://dev.fanninger.at/
Tags: gallery, image, video, music
Requires at least: 3.0
Tested up to: 3.0.1
Stable tag: trunk

Another gallery plugin for every type of media (image, video, music)

== Description ==

> **Note:** This version is a development version. So not every feature is implemented and it's possible that it have many bugs.

When you have a feature request, found a bug or have some problem with this plugin, write this into the [wordpress plugin support forum](http://wordpress.org/tags/tmf-gallery?forum_id=10).

= Important Links =

* [Changelog](http://wordpress.org/extend/plugins/tmf-gallery/changelog/)
* [Support Forum on wordpress.org](http://wordpress.org/tags/tmf-gallery?forum_id=10)

= TODO for next version =

* automatic resize on events (remove, add, edit image formats) 
* manuell upload of other image formats (sizes)
* Gallery details
* Gallery management for files
* File view/edit incl. image format views

= Upcoming features =

* Support for Image object
	* EXIF support
	* cron-job for mass resize action (Wordpress-PseudoCron)
	* AJAX-Upload, directory import(good for images with a great size)
	* automatic resize or manuell upload of other image formats (sizes)
	* See status (and changeable) of every image (creating status of the different image formats, ...)
* Support for Video object
	* Meta data support
* Support for Music object
	* ID3 support
* Add translations

== Installation ==

1. Just go to Plugins/Add New
1. Enter the term "TMF Gallery" and start the search
1. Click on "TMF Gallery"
1. Click on "install"

== Upgrade Notice ==

No upgrade notice at the moment

== Frequently Asked Questions ==

Please post any question you have into the wordpress plugin forum.

== Screenshots ==

1. Setting menu
2. Manage Gallery menu

== Changelog ==

= 0.3.7 =

* Gallery view under "Manage Medias" is now working
* List view under "Manage Medias" is now working
* paging on page "Manage Medias"

= 0.3.6 =

* Add functions for creation of thumbnails (resize, crop, ...)
* Add "PHPThumb" library for image modification (Link and Details on the "About" page)
* Add image format management (TODO: Delete image formate)
* Create on upload all added image formats

= 0.3.5 =

* Removed description column

= 0.3.4 =

* Add status to the upload queue (flash upload)
* Some bugfixes and small changes
* Add gallery select widget on the "add media" and "manage medias" page
* Add DB-Update-Syntax (For Plugin-Update)

= 0.3.3 =

* Better output of debug messages
* File now saving (No creation of virtual file in DB)
* Creation of virtual file object
* Add initial value for options

= 0.3.2 =

* Add nice style for progress elements
* Add some small changes

= 0.3.1 =

* Flash upload is now working
* Add some settings for the flash upload (debug, queue limit, ...)

= 0.3.0 =

* Add medias upload (At the moment it will not send or execute any event. I don't find the problem)
* Add panel "Used Libraries" to the about page.
* And some small changes

= 0.2.9 =

* Merge the gallery and list view into one metabox
* Add test layout for gallery view (set the number of items you would see in the settings first)

= 0.2.8 =

* Testlayout for List view

= 0.2.7 =

* Add some panels for the media page
* Change some ajax calls to json-response

= 0.2.6 =

* Move the Javascript-code in seperate files and cleaning the code
* Gallery description is now optional
* Add Exception-Handling in Ajax functions

= 0.2.5 =

* Added support for move galleries under a different galleries (over ajax), it is not perfect at the moment.

= 0.2.4 =

* Fixed problem with the activation hook (table installation)
* better look for the gallery management. jQuery effects (show and hide with delay)

= 0.2.3 =

* Add, Edit, Delete Gallery (over Ajax)
* Temporary removed the TinyMCE Editor for the Gallery description

= 0.2.2 =

* Update plugin description
* Add two screenshots

= 0.2.1 =

* Add Feature to create, edit and delete galleries (only layout for the moment)
* Add menus for media and about
* Support WP 3.0.1

= 0.2.0 =

* Complete rewrite of the code for a better handling
* Settings working, also the image format settings

= 0.1.6 =

* Added some options and some layout elements
* Removed the Watermark metabox. I will create it leater in a extra plugin (extend this plugin)
* Add check for existenz of php moduls EXIF, Image (GD), ImageMagick
* Add switch for the views (I only allow to display one view, performence reason)

= 0.1.5 =

* Add admin icons for menu

= 0.1.4 =

* Add installation script (DB create and so on)
* Add tables (incl. activate hook implementation)
* Add methods do create/manage galleries (Dump version)

= 0.1.3 =

* Add 'Save' Feature to every Metabox I used for this plugin. So you can define a own view for 'Management Galleries'.
* Add some other view options

= 0.1.2 =

* Add layout elements for 'Manage Galleries' and 'Add Images'

= 0.1.1 =

* Add Settings options, implemented with the default meta box feature of wordpress (also the screen option feature). But at the moment the saving does not working.

= 0.1 =

* This version is a initial release