=== Random Image Block ===
Contributors: mattrude
Author URI: http://mattrude.com/
Plugin URI: http://mattrude.com/projects/random-image-block/
Tags: gallery, images, image block, plugin, widget
Requires at least: 2.9
Tested up to: 3.1
Stable tag: 0.9.2

A small plugin that will display a random image from your native WordPress photo galley or in-beaded images.

== Description ==

The Random Image Block is a small plugin that will display a random image from your native WordPress photo galley or in-beaded images.

This widget will display the thumbnail of the random image, the "caption" and the images parent posts name. You may show all pictures on your site, or limit the selection to a single category if you wish. Once installed on your site, it will fully conform to the current theme. The Widgets title is also fully configurable. Random Image Widget was designed with full internationalization in mind and can be fully translated (Any help on this would be appreciated). As of Version 0.3 this plugin works out of the box without any configuraion (assuming you have pictures on your site).

The Random Image Block plugin works with WordPress 3.0+ in both single and multi site modes.  As a Site Admin, you may activate this plugin across all the sites on your install.

This Plugin is fully translated into the following languages:

* Arabic
* Czech
* Finnish
* French
* Danish
* Dutch
* German
* Indonesian
* Italian
* Portuguese
* Russian
* Spanish

If you would like to help translating this plugin, or you see a problem with the current translation, please see my [Translation](http://translate.mattrude.com/projects/random-image-block) page, and/or [contact me](http://mattrude.com/contact-me/).

== Installation ==
As with most WordPress plugins, there is two ways of installing this plugin.

= Primary Option =

1. Go to your WordPress Dashboard and login as an Admin
1. From your Dashboard go to `Plugins` section on the left hand side and select `Add New`.
1. Search for `Random Image Block`
1. Click the `Install Now` link and follow the instructions.

= Secondary Option =

1. Download the latest version from the download page (http://wordpress.org/extend/plugins/random-image-block/)
1. Extract the zip file and copy the folder "random-image-block" into the "wp-content/plugins/" directory in your WordPress installation.
1. Activate the plugin from your Dashboard by going to Plugins -> Installed page.

== Frequently Asked Questions ==

= Q: May I have more the one image on my sidebar? =
A: Sure, just add a second or third widget to the sidebar, but you can't do it from within this widget.

= Q: May I display more then one category at once? =
A: No, you may only display a single category per widget

= Q: I have no picture in my sidebar, the widget doesn't work!  =
A: Make sure the category you have selected has pictures in it, if it doesn't, nothing will be displayed.

= Q: Will this plugin work with WP Super Cache enabled? =
A: Unfortunately, no. [WP Super Cache](http://wordpress.org/extend/plugins/wp-super-cache/) caches all php built html pages for quicker page loads. Since the Random Image Block is built directly into the html page, with WP Super Cache enabled, you will see the same random image on the same page until the cache refreshes. Each page will still have a diffrent image, but they will not update for each page refresh.  Currently there is no work around.

== Screenshots ==

1. The Random Image Block on the front page, conforming to the current theme.
2. The Wiget Admin page for the Random Image Block.

== Changelog ==

= Version 0.9.2 =
* Fully tested for WordPress version 3.1
= Version 0.9.1 =
* Fixed bug where default options were always on.
= Version 0.9 =
* Added Advanced Options
* Allow for custom Meta data
* Added Tranlation for: Arabic, Czech, Danish, Dutch, Finnish, Indonesian, & Russian
= Version 0.8 =
* Added ability to link to the album vs the image.
= Version 0.7 =
* Changed to dropdown box for category selection, translaion files have not been fully updated, yet.
= Version 0.6 =
* Added ability to center image in the wiget area
= Version 0.5 =
* Switched to '{$before_widget}{$before_title}'... to try and resolve some display problems
= Version 0.4 =
* Translated into: French, German, Italian, Portuguese, & Spanish
= Version 0.3 =
* Fixed bug that showed no picture if the category box was left blank.
* Single Category check box now works.
= Version 0.2 =
* Added check box to allow single category.
= Version 0.1 =
* Everythings new!
