<?php

	$gCF_abspath = dirname(__FILE__);
	$gCF_abspath_1 = str_replace('wp-content/plugins/random-image-gallery-with-fancy-zoom', '', $gCF_abspath);
	$gCF_abspath_1 = str_replace('wp-content\plugins\random-image-gallery-with-fancy-zoom', '', $gCF_abspath_1);
    require_once($gCF_abspath_1 .'wp-config.php');

	//$rigwfz_abspath = dirname(__FILE__);
	$rigwfz_dir = get_option('rigwfz_dir');
	
	$rigwfz_siteurl = get_option('siteurl') . "/" . $rigwfz_dir ;
	
 $imglist='';
  //$img_folder is the variable that holds the path to the banner images. Mine is images/tutorials/
// see that you don't forget about the "/" at the end 
 $img_folder = $rigwfz_dir;

  mt_srand((double)microtime()*1000);

  //use the directory class
 $imgs = dir($img_folder);

  //read all files from the  directory, checks if are images and ads them to a list (see below how to display flash banners)
 while ($file = $imgs->read()) {
   if (eregi("gif", $file) || eregi("jpg", $file) || eregi("png", $file))
     $imglist .= "$file ";

 } closedir($imgs->handle);

  //put all images into an array
 $imglist = explode(" ", $imglist);
 $no = sizeof($imglist)-2;

 //generate a random number between 0 and the number of images
 $random = mt_rand(0, $no);
 $image = $imglist[$random];

 $mainsiteurl =	get_option('siteurl') . "/wp-content/plugins/random-image-gallery-with-fancy-zoom/";

	$rigwfz_width =	get_option('rigwfz_width');
	if(!is_numeric($rigwfz_width))
	{
		$rigwfz_width = 180;
	} 

//display image
	echo '<div>';
	echo '<a href="'.$rigwfz_siteurl . $image .'" rel="fancyzoom">';
	echo '<img src="'.$mainsiteurl.'crop-random-image.php?AC=YES&IMGNAME='.$image.'&MAXWIDTH='.$rigwfz_width.'"> ';
	echo '</a>';
	echo '</div>';
 ?>