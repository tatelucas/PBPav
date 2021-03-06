<?php
//  TABLE OF CONTENTS

//  Localization Initialize
//  Custom Menus Call
//  Custom Background
//  Custom Header
//  Automatic Feed Links
//  Post Thumbs
//  SEO Stuff
//  The 'Read More' link
//  Nav Animation
//  wp_page_menu Filter
//  Search Highlighting
//	Dynamic Titles
//  Widgets
//  Get the Image
//  Comment Output
//  Archive Pagination
//  Numeric Pagination

function new_excerpt_length($length) {
	return 25;
}
add_filter('excerpt_length', 'new_excerpt_length');

function new_excerpt_more($more) {
       global $post;
	return '&nbsp;<a href="'. get_permalink($post->ID) . '">Read more</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');


$content_types = array(
    'event',
);
foreach ($content_types as $type) {
    $file = TEMPLATEPATH.'/includes/content_types/'.$type.'.php';
    if (is_file($file)) {
        require_once $file; 
    }
}

/* Localization Initialize ********************************************/
// This sets the basename of the theme for localization. 

load_theme_textdomain('gravy');


/* Custom Menus Call ********************************************/
	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'gravy' ),
		'kings' => __( 'Kings Navigation', 'gravy' )
	) );

/* Custom Background ********************************************/
add_custom_background();


/* Custom Header ********************************************/
define( 'HEADER_IMAGE', '%s/images/logo.png' ); // The default logo located in themes folder
define( 'HEADER_IMAGE_WIDTH', apply_filters( '', 770 ) ); // Width of Logo
define( 'HEADER_IMAGE_HEIGHT', apply_filters( '', 153 ) ); // Height of Logo
define( 'NO_HEADER_TEXT', true );
add_custom_image_header( '', 'admin_header_style' ); // This Enables the Appearance > Header
// Following Code is for Styling the Admin Side
if ( ! function_exists( 'admin_header_style' ) ) :
function admin_header_style() {
?>
<style type="text/css">
#headimg {
height: <?php echo HEADER_IMAGE_HEIGHT; ?>px;
width: <?php echo HEADER_IMAGE_WIDTH; ?>px;
}
#headimg h1, #headimg #desc {
display: none;
}
</style>
<?php
}
endif;


/* Automatic Feed Links ********************************************/
add_theme_support( 'automatic-feed-links' );


/* Post Thumbs ********************************************/
add_theme_support( 'post-thumbnails' );
/*
Post thumbnail settings

There are some predefined sizes registered
below. But, it is suggested that you define
any thumbnail dimensions you need for your
theme.
*/
set_post_thumbnail_size(252, 252, true); // Normal post thumbnails (loop)
add_image_size('featured', 561, 401, true);
add_image_size('medium-thumbnail', 170, 170, true);
add_image_size('small-thumbnail', 70, 53, true);


/* SEO Stuff ********************************************/
// This converts the tags associated with a post into SEO-friendly keywords

function keyword_tags() {
	$posttags = get_the_tags();
	foreach((array)$posttags as $tag) {
		$keyword_tags .= $tag->name . ',';
	}
	echo '<meta name="keywords" content="'.$keyword_tags.'" />';
}


/* The 'More' Link ********************************************/
// This is a filter for styling the "Read More" link that appears when creating excerpts

add_filter( 'the_content_more_link', 'my_more_link', 10, 2 );

function my_more_link( $more_link, $more_link_text ) {
	return str_replace( $more_link_text, __('Continue reading &rsaquo;','gravy'), $more_link );
}


/* Nav Animation ********************************************/
// This enqueues the necessary javascript

function nav_animation() {
	
	wp_enqueue_script('jcarousel', '/wp-content/themes/pbpav/js/jquery.jcarousel.min.js', array('jquery'), '1.2.6'); 
	wp_enqueue_script('superfish', '/wp-content/themes/pbpav/js/superfish.js', array('jquery'), '1.2.6'); 
    wp_enqueue_script('hoverintent', '/wp-content/themes/pbpav/js/hoverIntent.js', array('jquery'), '1.2.6');
    wp_enqueue_script('cycle', '/wp-content/themes/pbpav/js/jquery.cycle.js', array('jquery'), '1.2.6');
	wp_enqueue_script('jquery-ui', '/wp-content/themes/pbpav/js/jquery-ui-1.8.6.custom.min.js', array('jquery'), '11.8.6'); 
	wp_enqueue_script('pbpav', '/wp-content/themes/pbpav/js/pbpav.js', array('jquery'), '1.0', true); 
	wp_enqueue_script('mosiac', '/wp-content/themes/pbpav/js/mosaic.1.0.1.min.js', array('jquery'), '1.0.1', true); 	
	
    if ( is_singular() ) wp_enqueue_script('comment-reply');
}


/* wp_page_menu Filter ********************************************/
// This is a filter that allows a custom ID to be added to your nav

function add_menuclass($ulclass) {
return preg_replace('/<ul>/', '<ul class="menu">', $ulclass, 1);
}
add_filter('wp_page_menu','add_menuclass');


/* Search Highlighting ********************************************/
// This highlights search terms in both titles, excerpts and content

function search_excerpt_highlight() {
	$excerpt = get_the_excerpt();
	$keys = implode('|', explode(' ', get_search_query()));
	$excerpt = preg_replace('/(' . $keys .')/iu', '<strong class="search-highlight">\0</strong>', $excerpt);
	
	echo '<p>' . $excerpt . '</p>';
}


function search_title_highlight() {
	$title = get_the_title();
	$keys = implode('|', explode(' ', get_search_query()));
	$title = preg_replace('/(' . $keys .')/iu', '<strong class="search-highlight">\0</strong>', $title);
	
	echo $title;
}
		

/* Dynamic Titles ********************************************/
// This sets your <title> depending on what page you're on, for better formatting and for SEO

function dynamictitles() {
	
	if ( is_single() ) {
      wp_title('');
      echo (' | ');
      bloginfo('name');
 
} else if ( is_page() || is_paged() ) {
      bloginfo('name');
      wp_title('|');
 
} else if ( is_author() ) {
      bloginfo('name');
      wp_title(' | '.__('Author','gravy').'');	  
	  
} else if ( is_category() ) {
      bloginfo('name');
      wp_title(' | '.__('Archive for','gravy').'');
      ('');

} else if ( is_tag() ) {
      bloginfo('name');
      echo (' | '.__('Tag archive for','gravy').'');
      wp_title('');

} else if ( is_archive() ) {
      bloginfo('name');
      echo (' | '.__('Archive for','gravy').'');
      wp_title('');

} else if ( is_search() ) {
      bloginfo('name');
      echo (' | '.__('Search Results','gravy').'');
 
} else if ( is_404() ) {
      bloginfo('name');
      echo (' | '.__('404 Error (Page Not Found)','gravy').'');
	  
} else if ( is_home() ) {
      bloginfo('name');
      echo (' | ');
      bloginfo('description');
 
} else {
      bloginfo('name');
      echo (' | ');
      echo (''.$blog_longd.'');
}
}



/* Widgets ********************************************/
// This establishes the elements that wrap your widgets

if ( function_exists('register_sidebar') )
    register_sidebar(array(
		'name' => 'Sidebar Widgets',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widgettitle">',
        'after_title' => '</h3>',
    ));


if ( function_exists('register_sidebar') )
    register_sidebar(array(
		'name' => 'Footer Widgets',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widgettitle">',
        'after_title' => '</h3>',
    ));
   


/* Get Post Image ********************************************/

/* 
To retrieve a post image and resize it with TimThumb: 
<?php echo get_post_image (get_the_id(), '', '', '' .get_bloginfo('template_url') .'/scripts/timthumb.php?zc=1&amp;w=105&amp;h=85&amp;src='); ?></a> 
*/
	

function get_post_image ($post_id=0, $width=0, $height=0, $img_script='') {
	global $wpdb;
	if($post_id > 0) {

		 // select the post content from the db

		 $sql = 'SELECT post_content FROM ' . $wpdb->posts . ' WHERE id = ' . $wpdb->escape($post_id);
		 $row = $wpdb->get_row($sql);
		 $the_content = $row->post_content;
		 if(strlen($the_content)) {

			  // use regex to find the src of the image

			preg_match("/<img src\=('|\")(.*)('|\") .*( |)\/>/", $the_content, $matches);
			if(!$matches) {
				preg_match("/<img class\=\".*\" title\=\".*\" src\=('|\")(.*)('|\") .*( |)\/>/U", $the_content, $matches);
			}
			$the_image = '';
			$the_image_src = $matches[2];
			$frags = preg_split("/(\"|')/", $the_image_src);
			if(count($frags)) {
				$the_image_src = $frags[0];
			}

			  // if src found, then create a new img tag

			  if(strlen($the_image_src)) {
				   if(strlen($img_script)) {

					    // if the src starts with http/https, then strip out server name

					    if(preg_match("/^(http(|s):\/\/)/", $the_image_src)) {
						     $the_image_src = preg_replace("/^(http(|s):\/\/)/", '', $the_image_src);
						     $frags = split("\/", $the_image_src);
						     array_shift($frags);
						     $the_image_src = '/' . join("/", $frags);
					    }
					    $the_image = '<img alt="" src="' . $img_script . $the_image_src . '" />';
				   }
				   else {
					    $the_image = '<img alt="" src="' . $the_image_src . '" width="' . $width . '" height="' . $height . '" />';
				   }
			  }
			  return $the_image;
		 }
	}
}



/* Comments Callback ********************************************/
// This code abstracts out comment code and makes the markup editable

function mytheme_comment($comment, $args, $depth) {

	$GLOBALS['comment'] = $comment;
?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
		<div id="comment-<?php comment_ID(); ?>">
			<div class="comment-author vcard">
				<?php echo get_avatar($comment,$size='48' ); ?>
				<div class="commentmetadata">
					<?php printf(__('<cite class="fn">%s</cite>'), get_comment_author_link()) ?>
					<div class="comment-date">
						<a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">
							<?php printf(__('%1$s &bull; %2$s'), get_comment_date(),  get_comment_time()) ?>
						</a>
						<?php edit_comment_link(__('(Edit)','gravy')) ?>
					</div>
				</div>
			</div>
<?php
	if ($comment->comment_approved == '0') {
?>
			<em><?php _e('Your comment is awaiting moderation.','gravy') ?></em>
			<br />
<?php }	comment_text(); ?>
			<div class="reply">
<?php
	comment_reply_link(
		array_merge( $args, array(
			'depth' => $depth, 
			'reply_text' => __('Reply','gravy'), 
			'login_text' => __('Log in to reply','gravy'),				
			'max_depth' => $args['max_depth'])
		)
	);
?>
			</div>
		</div>
<?php
}
		
		
function comment_add_microid($classes) {
	$c_email=get_comment_author_email();
	$c_url=get_comment_author_url();
	if (!empty($c_email) && !empty($c_url)) {
		$microid = 'microid-mailto+http:sha1:' . sha1(sha1('mailto:'.$c_email).sha1($c_url));
		$classes[] = $microid;
	}
	return $classes;	
}
add_filter('comment_class','comment_add_microid'); 
	





/* Archive Pagination ********************************************/
// This adds pagination to the custom Archives page

function my_post_limit($limit) {
	global $paged, $myOffset, $postsperpage;
	if(empty($paged)) {
		$paged = 1;
	}
	$pgstrt = ((intval($paged) -1) * $postsperpage) + $myOffset . ', ';
	$limit = 'LIMIT '.$pgstrt.$postsperpage;
	return $limit;
}





/* Numeric Pagination ********************************************/

function numeric_pagination ($pageCount = 9, $query = null) {

	if ($query == null) {
		global $wp_query;
		$query = $wp_query;
	}
	
	if ($query->max_num_pages <= 1) {
		return;
	}

	$pageStart = 1;
	$paged = $query->query_vars['paged'];
	
	// set current page if on the first page
	if ($paged == null) {
		$paged = 1;
	}
	
	// work out if page start is halfway through the current visible pages and if so move it accordingly
	if ($paged > floor($pageCount / 2)) {
		$pageStart = $paged	- floor($pageCount / 2);
	}

	if ($pageStart < 1) {
		$pageStart = 1;
	}

	// make sure page start is 
	if ($pageStart + $pageCount > $query->max_num_pages) {
		$pageCount = $query->max_num_pages - $pageStart;
	}
	
?>
	<div id="archive_pagination">
<?php
	if ($paged != 1) {
?>
	<a href="<?php echo get_pagenum_link(1); ?>" class="numbered page-number-first"><span>&lsaquo; <?php _e('Newest', 'gravy'); ?></span></a>
<?php
	}
	// first page is not visible...
	if ($pageStart > 1) {
		//echo 'previous';
	}
	for ($p = $pageStart; $p <= $pageStart + $pageCount; $p ++) {
		if ($p == $paged) {
?>
		<span class="numbered page-number-<?php echo $p; ?> current-numeric-page"><?php echo $p; ?></span>
<?php } else { ?>
		<a href="<?php echo get_pagenum_link($p); ?>" class="numbered page-number-<?php echo $p; ?>"><span><?php echo $p; ?></span></a>

<?php
		}
	}
	// last page is not visible
	if ($pageStart + $pageCount < $query->max_num_pages) {
		//echo "last";
	}
	if ($paged != $query->max_num_pages) {
?>
		<a href="<?php echo get_pagenum_link($query->max_num_pages); ?>" class="numbered page-number-last"><span><?php _e('Oldest', 'gravy'); ?> &rsaquo;</span></a>
<?php } ?>
	
	</div>

<?php } 

/* Facebook Meta Info ********************************************/
add_action( 'wp_head', 'fb_like_thumbnails' );

function fb_like_thumbnails() {
global $post;

$default = 'http://cdn.powerbalancepavilion.com/wp-content/themes/pbpav/images/logo.png';
//$content = $posts[0]->post_content; // $posts is an array, fetch the first element

//$output = preg_match_all( '/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $content, $matches);

$image = wp_get_attachment_image_src( get_post_thumbnail_id( $posts[0]->ID ), 'single-post-thumbnail' );

if ( $image[0] )
$thumb = $image[0];
else
$thumb = $default;
echo "\n\n<!-- Facebook Like Thumbnail -->\n<link rel=\"image_src\" href=\"$thumb\" />\n<!-- End Facebook Like Thumbnail -->\n\n";
}

?>