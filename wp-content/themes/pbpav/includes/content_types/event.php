<?php
/*
    Event Custom Post Type
    For PBPav by Adrian Unger <staydecent.ca>

    Image 
    Date
    Time
    More info link
    Buy now link
    Description
*/

add_action('init', 'events');

function events() {
	$labels_event = array(
		'name' => __( 'Events' ),
		'singular_name' => __( 'Event' ),
		'add_new' => __( 'Add New' ),
		'add_new_item' => __( 'Add New Event' ),
		'edit' => __( 'Edit' ),
		'edit_item' => __( 'Edit Event' ),
		'new_item' => __( 'New Event' ),
		'view' => __( 'View Event' ),
		'view_item' => __( 'View Event' ),
		'search_items' => __( 'Search events' ),
		'not_found' => __( 'No events found' ),
		'not_found_in_trash' => __( 'No events found in Trash' ),
		'parent' => __( 'Parent Event' ),
	);
	
	$args = array(
    	'labels' => $labels_event,
    	'public' => true,
    	'show_ui' => true,
    	'capability_type' => 'post',
		   'menu_position' => 5,
    	'hierarchical' => false,
    	'rewrite' => true,
    	'supports' => array('title', 'editor', 'thumbnail')
    );

	register_post_type('event', $args);
	
    // Event Types
	$labels_categories = array(
		'name' => _x( 'Types', 'taxonomy general name' ),
		'singular_name' => _x( 'Type', 'taxonomy singular name' ),
		'search_items' =>  __( 'Search Types' ),
		'all_items' => __( 'All Types' ),
		'parent_item' => __( 'Parent Type' ),
		'parent_item_colon' => __( 'Parent Type:' ),
		'edit_item' => __( 'Edit Type' ), 
		'update_item' => __( 'Update Type' ),
		'add_new_item' => __( 'Add New Type' ),
		'new_item_name' => __( 'New Type Name' ),
	);
  /*
	register_taxonomy('type', array('event'), array(
		'hierarchical' => true,
		'labels' => $labels_categories,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'type' ),
	));
	*/

	$labels_location = array(
		'name' => _x( 'Locations', 'taxonomy general name' ),
		'singular_name' => _x( 'Location', 'taxonomy singular name' ),
		'search_items' =>  __( 'Search Locations' ),
		'all_items' => __( 'All Locations' ),
		'parent_item' => __( 'Parent Location' ),
		'parent_item_colon' => __( 'Parent Location:' ),
		'edit_item' => __( 'Edit Location' ), 
		'update_item' => __( 'Update Location' ),
		'add_new_item' => __( 'Add New Location' ),
		'new_item_name' => __( 'New Location Name' ),
	);

	register_taxonomy('location',array('event'), array(
		'hierarchical' => true,
		'labels' => $labels_location,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'location' ),
	));
	
	$labels_sitelocation = array(
		'name' => _x( 'Site Locations', 'taxonomy general name' ),
		'singular_name' => _x( 'Site Locations', 'taxonomy singular name' ),
		'search_items' =>  __( 'Search Site Locations' ),
		'all_items' => __( 'All Site Locations' ),
		'parent_item' => __( 'Parent Site Locations' ),
		'parent_item_colon' => __( 'Parent Site Location:' ),
		'edit_item' => __( 'Edit Site Location' ), 
		'update_item' => __( 'Update Site Location' ),
		'add_new_item' => __( 'Add New Site Location' ),
		'new_item_name' => __( 'New Site Location Name' ),
	);

	register_taxonomy('sitelocation',array('event','post'), array(
		'hierarchical' => true,
		'labels' => $labels_sitelocation,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'sitelocation' ),
	));	
}

add_action('save_post', 'save_timedate');

function save_timedate() {
    global $post;

    if ($_REQUEST['action'] != 'autosave') {
        update_post_meta($post->ID, "datetime", date(strtotime($_POST["datetime"]) ) );
        update_post_meta($post->ID, "infolink", $_REQUEST['infolink'] );
        //update_post_meta($post->ID, "buylink", $_REQUEST['buylink'] );
    }
}

function event_meta_options() {
	global $post;

	if (!preg_match("/post-new/", $_SERVER['REQUEST_URI'], $matches) && isset($post->ID)) {
        // We're editing a post
		$datetime = get_post_meta($post->ID, 'datetime', true);
		$d = date("m/d/Y g:i A", $datetime);
		$infolink = get_post_meta($post->ID,'infolink',true);
	}
	
	echo '<label for="datetime">' .__("Date / Time:") . "</label>";
	?>	
       	<input id="datetime" name="datetime" class="datetime" value="<?php echo $d; ?>" />
        <script type="text/javascript">
			jQuery("#datetime").AnyTime_picker({
                hideInput : false,
                placement : 'popup',
                askSecond : false,
                format	  : '%m/%d/%Y %l:%i %p',
                baseYear  : <?php echo date('Y'); ?>
            });
        </script>

	    <div class="clear"></div>
<?php
	echo '<label for="infolink">' .__("Buy Now URL:") . "</label>";
?>
       	<input id="infolink" name="infolink" class="infolink" value="<?php echo $infolink; ?>" />
<?php
	/*
	echo '<label for="buylink">' .__("Buy Now URL:") . "</label>";
?>
       	<input id="buylink" name="buylink" class="buylink" value="<?php echo $buylink; ?>" />
<?php
  */
}

// Load dependencies
add_action('admin_init', 'event_admin_init');

function event_admin_init() {
    // enhance admin meta boxes with some styles and date picker
    // rewquired for events post type
    wp_enqueue_style('admin', get_bloginfo('template_url').'/css/admin/admin.css');
    wp_enqueue_style('anytime', get_bloginfo('template_url') . '/css/admin/anytime.css');
    wp_enqueue_style('show_admin', get_bloginfo('template_url') . '/css/admin/show_admin.css');
    wp_enqueue_style('ui.theme', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/themes/start/jquery-ui.css' );

    wp_enqueue_script('anytime', get_bloginfo('template_url') . '/js/admin/anytimec.js', array('jquery','jquery-ui-core') );

    // load the events meta box
    add_meta_box("event-info", __("Show Information", 'PBPav'), "event_meta_options", "event", "normal", "low");
}

?>