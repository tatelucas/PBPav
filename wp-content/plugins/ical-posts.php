<?php
/*
Plugin Name: iCal Posts
Plugin URI: http://www.kinggary.com/archives/build-an-ical-feed-from-your-wordpress-posts-plugin
Description: Creates an iCal feed which can be added to calendar applications such as Google Calendar and Microsoft Outlook to create a visual representation of your blog posting.
Version: 1.0
Author: Gary King
Author URI: http://www.kinggary.com/
*/

function ical_feed()
{
	global $wpdb;
	
	if (isset($_GET['debug']))
		define('DEBUG', true);
	
	if ($_GET['category'])
	{
		$categories = get_categories();
		foreach ($categories as $category)
		{
			if ($_GET['category'] == $category->category_nicename)
			{
				$category_id = $category->cat_ID;
				break;
			}
		}
		if (!$category_id)
			$category_id = 0;
	}
	
	if (is_numeric($_GET['limit']))
		$limit = 'LIMIT ' . $_GET['limit'];
	
	// get posts
	if ($_GET['category'])
		$posts = $wpdb->get_results("SELECT $wpdb->posts.ID, UNIX_TIMESTAMP(post_date) AS post_date, post_title FROM $wpdb->posts LEFT JOIN $wpdb->post2cat ON ($wpdb->post2cat.post_id = $wpdb->posts.ID) WHERE post_status = 'publish' AND post_type = 'event' AND $wpdb->post2cat.category_id = $category_id ORDER BY post_date DESC $limit;");
	else
		$posts = $wpdb->get_results("SELECT ID, post_content, UNIX_TIMESTAMP(post_date) AS post_date, post_title FROM $wpdb->posts WHERE post_status = 'publish' AND post_type = 'event' ORDER BY post_date DESC $limit;");
	
	$events = '';
	$space = '      ';
	foreach ($posts as $post)
	{


    //TATE - use custom field start and end date instead of post date
		$start_time = date('Ymd\THis', $post->post_date);
		$end_time = date('Ymd\THis', $post->post_date + (60 * 60));

    /*
    $eventtime = get_post_meta($posts->ID, 'datetime'); 
    $endeventtime = get_post_meta($posts->ID, 'enddatetime');    

    $niceeventtime = date('Y-m-d H:i:s', $eventtime[0]);
		$start_time = date('Ymd\THis', $niceeventtime);
		
		if ($endeventtime[0]) { 
      $niceeventendtime = date('Y-m-d H:i:s', $endeventtime[0]);
		  $end_time = date('Ymd\THis', $niceeventendtime);		
    } else {
		  $end_time = date('Ymd\THis', $niceeventtime + (60 * 60));  
    }
     */
     
		$summary = $post->post_title;
		$permalink = get_permalink($post->ID);
		if (isset($_GET['content']))
		{
			$content = str_replace(',', '\,', str_replace('\\', '\\\\', str_replace("\n", "\n" . $space, strip_tags($post->post_content))));
			$content = $permalink . "\n" . $space . "\n" . $space . $content;
		}
		else
			$content = $permalink;
		
		$events .= <<<EVENT
BEGIN:VEVENT
DTSTART:$start_time
DTEND:$end_time
SUMMARY:$summary
DESCRIPTION:$content
END:VEVENT

EVENT;
	}
	
	$blog_name = get_bloginfo('name');
	$blog_url = get_bloginfo('home');
	
	if (!defined('DEBUG'))
	{
		header('Content-type: text/calendar');
		header('Content-Disposition: attachment; filename="blog_posts.ics"');
	}
	
	$apostrophe = (isset($_GET['content']) ? "'" : '&#8217;');
	
	$content = <<<CONTENT
BEGIN:VCALENDAR
VERSION:2.0
PRODID:-//$blog_name//NONSGML v1.0//EN
X-WR-CALNAME:{$blog_name}{$apostrophe}s posts
X-WR-TIMEZONE:US/Eastern
X-ORIGINAL-URL:{$blog_url}
X-WR-CALDESC:Blog posts from {$blog_name}
CALSCALE:GREGORIAN
METHOD:PUBLISH
{$events}END:VCALENDAR
CONTENT;
	
	//echo '<pre>';
	echo $content;
	//echo '</pre>';

	exit;
}

if (isset($_GET['ical']))
{
	add_action('init', 'ical_feed');
}

?>