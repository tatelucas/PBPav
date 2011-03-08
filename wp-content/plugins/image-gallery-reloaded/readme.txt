=== Image Gallery Reloaded ===

Contributors: Daniel Sachs
Tags: gallery, default gallery, replacement, galleria, colorpicker
Requires at least: 2.7
Tested up to: 2.9
Stable tag: 0.6.0

Automaticaly replaces the default Wordpress gallery with a new gallery and slideshow.

== Description ==

**A jQuery based Image Gallery Reloaded plugin replaces the default Wordpress gallery with a highly customizable mouseover slideshow and gallery for every post.**

**What are the settings?**


*   Set your main image height and width
*   Set thumbnails height and width and position
*   Turn on and off the navigation and it's position
*   Browser "Back and Forward" ability 
*   Sets a direct link to every image in the gallery
*   Custom colors via color picker to match your theme - you do not to remember all those HEX numbers
*   Thickbox support
*   Styled tooltips
*   Other less important stuff

To see Image Gallery Reloaded in action and the roadmap for development visit : [18 Elements site](http://18elements.com/tools/wordpress-image-gallery-reloaded)


== Installation ==

1. Upload `image-gallery-reloaded` directory to the `/wp-content/plugins/` directory.
3. Activate the plugin via the Plugins menu.
4. Configure your new gallery via the Settings > Image Gallery Reloaded menu.

5. For better results please update you Wordpress default images sizes for Thumbnails and Medium sizes to match your chosen Image Gallery Reloaded settings (also view FAQ)

== Frequently Asked Questions  ==
**What images does the gallery use?**

The plugin does not use the default image you upload, instead it uses the Medium and Thumbnail versions of it. It is done in order to produce better image quality and to increase performance.  The size of these versions are set at Settings > Media. And why is it important? Because if you are running a photo blog or simply plan to use a very big gallery you may need to update the size of you Medium and Thumbnail versions of the image. The default sizes are 300X300 px and 150X150 px respectively. If you plan to set the main image to 960X700 px and/or use larger thumbnails it might be a good idea to set these sizes at the Settings > Media as well.

**How do I add  galleries to posts?**

Remember, Image gallery Reloaded uses the default Wordpress Gallery feature.

* Write a new Post or edit an existent.
* Add images to it via the default Upload/Insert >Add an Image.
* On the Add an Image popup click the Gallery tab, Click Insert Gallery and watch your new gallery set.



== Changelog ==
**0.6**

* bug fix: caption and tooltips displayed properly now
* Better Thickbox support
* Multiple bugfixes and cleanup

**0.5.6**

* bug fix: CSS for large galleries to form one line of images
* bug fix: multiple galleries on one (archive) page.

**0.5.5**

* Resolved issues with the built-in jQuery
* bug fix: Tooltip styling reserved to IGR only
* bug fix: tooltip script reserved to IGR only
* Other bugfixes

**0.5.2**

* Styled Tooltips added;
* Thickbox support added;
* Better function handling;
* Styling for tooltips from the Control Panel;
* "Loading Gallery" massage while loading the images;
* Transition Effects on image load;
* bugfix: function conflicts on some themes;
* bugfix: jQuery loaded twice in enqueue mode;
* ther multiple bug fixes;

**0.2.4**

* bug fix: fixed "Headers already sent" error

**0.2.3**

* bug fix: fixed: improperly named files

**0.2.2**

* initial release

== Screenshots ==

1. The Setup Page
2. The Gallery