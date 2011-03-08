=== Random image gallery with fancy zoom ===
Contributors: Gopi.R 
Donate link: http://www.gopiplus.com/work/2010/07/18/random-image-gallery-with-fancy-zoom/
Author URI: http://www.gopiplus.com/work/2010/07/18/random-image-gallery-with-fancy-zoom/
Plugin URI: http://www.gopiplus.com/work/2010/07/18/random-image-gallery-with-fancy-zoom/
Tags: image, random, rotating, fancy zoom, effect, gallery, plugin, sidebar,
Requires at least: 2.8
Tested up to: 3.0
Stable tag: 2.0
	
This plug-in which allows you to simply and easily show random image 
anywhere in your template files or using widgets with onclick fancy zoom effect.

== Description ==

[Live Demo](http://www.gopiplus.com/work/2010/07/18/random-image-gallery-with-fancy-zoom/)		 	
[More info](http://www.gopiplus.com/work/2010/07/18/random-image-gallery-with-fancy-zoom/)			 		
[Comments/Suggestion](http://www.gopiplus.com/work/2010/07/18/random-image-gallery-with-fancy-zoom/)			 	
[About author](http://www.gopiplus.com/work/) 	

The "Random image gallery with fancy zoom" plug-in which allows you to simply and easily show random image Anywhere in your template files or using widgets with onclick fancy zoom effect. You can upload the images directly into 
The folder or you can set the existing image folder; this will automatically generate the thumbnail image.

We can use this plug-in in two different way.
1. Go to widget menu and drag and drop the "R I G W F Z" widget to your sidebar location. or 
2. Copy and past the below mentioned code to your desired template location.
		
<code><?php if (function_exists (rigwfz_show)) rigwfz_show(); ?></code>

**Feature**   	

1. Simple. 	
2. Easy installation.   	
3. Fancy zoom effect.   
3. Random image.   
3. Automatic thumbnail image.

**To Update the Scrolling setting:**   
Go to 'R I G W F Z' link under SETTINGS TAB. 		

[Live Demo](http://www.gopiplus.com/work/2010/07/18/random-image-gallery-with-fancy-zoom/)		 	
[More info](http://www.gopiplus.com/work/2010/07/18/random-image-gallery-with-fancy-zoom/)			 		
[Comments/Suggestion](http://www.gopiplus.com/work/2010/07/18/random-image-gallery-with-fancy-zoom/)			 	
[About author](http://www.gopiplus.com/work/) 	

== Installation ==

**Installation Instruction & Configuration**  

* Unpack the *.zip file and extract the /random-image-gallery-with-fancy-zoom/ folder.    
* Drop the 'random-image-gallery-with-fancy-zoom' folder into your 'wp-content/plugins' folder    
* In word press administration panels, click on plug-in from the menu.    
* You should see your new 'Random image gallery with fancy zoom' plug-in listed under Inactive plug-in tab.    
* To turn the word presses plug-in on, click activate.    
* Go to 'R I G W F Z' link under SETTINGS TAB to update the setting.
* Copy and paste the mentioned code to your desired template location or drag and drop the widget!.  
<code><?php if (function_exists (rigwfz_show)) rigwfz_show(); ?></code>

== Frequently Asked Questions ==

**Thumbnail not display?**  
To create thumbnail the “GD support” must be enabled to your PHP setting (its default enabled mode, if not please check your phpinfo file and contact your server).  
  
**Where to change the thumbnail width**  
Go to 'R I G W F Z' link under SETTINGS TAB to update the setting, the height of the image automatically resized based on your width.  

**Close button not display in light box effect?** 
Open "rigwfz_js/FancyZoom.js" file and set full path to mentioned variables zoomImagesURI .

"wp-content/plugins/random-image-gallery-with-fancy-zoom/rigwfz_img/"

to

"http://yourwebsitename.com/wp-content/plugins/random-image-gallery-with-fancy-zoom/rigwfz_img/"

== Screenshots ==

1. Admin setting page.

2. Front end without light box.

3. Front end with light box.

== Upgrade Notice ==

= 1.0 =	 

First version

= 2.0 = 

Tested upto 3.0

== Changelog ==

**1.0**	 First version

**2.0**	 Tested upto 3.0