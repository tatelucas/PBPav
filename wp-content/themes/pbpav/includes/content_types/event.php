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
    	'supports' => array('comments','title', 'editor', 'thumbnail')
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
	
	$labels_eventcat = array(
		'name' => _x( 'Event Categories', 'taxonomy general name' ),
		'singular_name' => _x( 'Event Categories', 'taxonomy singular name' ),
		'search_items' =>  __( 'Search Event Categories' ),
		'all_items' => __( 'All Event Categories' ),
		'parent_item' => __( 'Parent Event Categories' ),
		'parent_item_colon' => __( 'Parent Event Category:' ),
		'edit_item' => __( 'Edit Event Category' ), 
		'update_item' => __( 'Update Event Category' ),
		'add_new_item' => __( 'Add New Event Category' ),
		'new_item_name' => __( 'New Event Category Name' ),
	);

	register_taxonomy('eventcat',array('event'), array(
		'hierarchical' => true,
		'labels' => $labels_eventcat,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'eventcat' ),
	));		
	
}

add_action('save_post', 'save_timedate');

function save_timedate() {
    global $post;

    if ($_REQUEST['action'] != 'autosave') {
        update_post_meta($post->ID, "datetime", date(strtotime($_POST["datetime"]) ) );
        update_post_meta($post->ID, "enddatetime", date(strtotime($_POST["enddatetime"]) ) );
        if ($_POST['deleteremovedate'] == true) {
          update_post_meta($post->ID, "removedate", null);        
        } else {
          update_post_meta($post->ID, "removedate", date(strtotime($_POST["removedate"]) ) );        
        }
        update_post_meta($post->ID, "infolink", $_REQUEST['infolink'] );
        update_post_meta($post->ID, "shorttitle", $_REQUEST['shorttitle'] );
        update_post_meta($post->ID, "pricing", $_REQUEST['pricing'] );
        update_post_meta($post->ID, "parking", $_REQUEST['parking'] );        
        update_post_meta($post->ID, "doorsopen", $_REQUEST['doorsopen'] );
        update_post_meta($post->ID, "promoter", $_REQUEST['promoter'] );
        update_post_meta($post->ID, "showtimes", $_REQUEST['showtimes'] );

    }
}

function event_meta_options() {
	global $post;

	if (!preg_match("/post-new/", $_SERVER['REQUEST_URI'], $matches) && isset($post->ID)) {
        // We're editing a post
		$datetime = get_post_meta($post->ID, 'datetime', true);

    if ($datetime) {
		$d = date("m/d/Y g:i A", $datetime);    
    }
    
		$enddatetime = get_post_meta($post->ID, 'enddatetime', true);
		if ($enddatetime) {
		  $ed = date("m/d/Y g:i A", $enddatetime);
    }

		$removedate = get_post_meta($post->ID, 'removedate', true);
		if ($removedate) {
		  $rd = date("m/d/Y g:i A", $removedate);
    } else {
      $tempdate = strtotime(date("Y-m-d", strtotime($date)) . " +1 month");
      $rd = date("m/d/Y g:i A", mktime(0, 0, 0, 3, 0, 2099));
    }
    
		$infolink = get_post_meta($post->ID,'infolink',true);
		$shorttitle = get_post_meta($post->ID,'shorttitle',true);
		$pricing = get_post_meta($post->ID,'pricing',true);
		$parking = get_post_meta($post->ID,'parking',true);
		$doorsopen = get_post_meta($post->ID,'doorsopen',true);
		$promoter = get_post_meta($post->ID,'promoter',true);								
		$showtimes = get_post_meta($post->ID,'showtimes',true);		
	}
	
	echo '<label for="datetime">' .__("Start Date / Time:") . "</label>";
	?>	
       	<input id="datetime" name="datetime" class="datetime" value="<?php echo $d; ?>" />
        <script type="text/javascript">
			jQuery("#datetime").AnyTime_picker({
                hideInput : false,
                placement : 'popup',
                askSecond : false,
                format	  : '%m/%d/%Y %l:%i %p',
                formatUtcOffset: "%: (%@)",
                baseYear  : <?php echo date('Y'); ?>
            });
        </script>

	    <div class="clear"></div>
<?php
	echo '<label for="enddatetime">' .__("End Date / Time:") . "</label>";
	?>	
       	<input id="enddatetime" name="enddatetime" class="enddatetime" value="<?php echo $ed; ?>" />
        <script type="text/javascript">
			jQuery("#enddatetime").AnyTime_picker({
                hideInput : false,
                placement : 'popup',
                askSecond : false,
                format	  : '%m/%d/%Y %l:%i %p',
                baseYear  : <?php echo date('Y'); ?>
            });
        </script>
        <script type="text/javascript">
        jQuery(document).ready(function() {
        jQuery("#textareaID").addClass("mceEditor");
        if ( typeof( tinyMCE ) == "object" && typeof( tinyMCE.execCommand ) == "function" ) {
        tinyMCE.execCommand("mceAddControl", false, "showtimes");
        tinyMCE.execCommand("mceAddControl", false, "pricing");
        }
        
        });
        </script>

	    <div class="clear"></div>
<?php
	echo '<label for="infolink">' .__("Buy Now URL:") . "</label>";
?>
       	<input id="infolink" name="infolink" class="infolink" value="<?php echo $infolink; ?>" />

<?php
	echo '<label for="shorttitle">' .__("Short Title for Header:") . "</label>";
?>
       	<input id="shorttitle" name="shorttitle" class="plaintext" value="<?php echo $shorttitle; ?>" />
<?php
	echo '<label for="showtimes">' .__("Showtimes:") . "</label>";
?>
       	<textarea id="showtimes" name="showtimes" class="plaintext" style="width: 400px; height: 120px;"><?php echo wpautop($showtimes); ?></textarea>
<?php
	echo '<label for="pricing">' .__("Ticket Information (Pricing):") . "</label>";
?>
       	<textarea id="pricing" name="pricing" class="plaintext" style="width: 400px; height: 120px;"><?php echo wpautop($pricing); ?></textarea>
       	<!--<input id="pricing" name="pricing" class="plaintext" value="<?php echo $pricing; ?>" />-->
<?php
	echo '<label for="parking">' .__("Parking Info (Time and costs):") . "</label>";
?>
       	<input id="parking" name="parking" class="plaintext" value="<?php echo $parking; ?>" />
<?php
	echo '<label for="doorsopen">' .__("Doors Open:") . "</label>";
?>
       	<input id="doorsopen" name="doorsopen" class="plaintext" value="<?php echo $doorsopen; ?>" />
<?php
	echo '<label for="promoter">' .__("Promoter:") . "</label>";
?>
       	<input id="promoter" name="promoter" class="plaintext" value="<?php echo $promoter; ?>" />       	       	
<?php
	echo '<label for="removedate">' .__("Date / Time to Remove from the Site:") . "</label>";
	?>	
       	<input id="removedate" name="removedate" class="enddatetime" value="<?php echo $rd; ?>" />
        <script type="text/javascript">
			jQuery("#removedate").AnyTime_picker({
                hideInput : false,
                placement : 'popup',
                askSecond : false,
                format	  : '%m/%d/%Y %l:%i %p',
                baseYear  : <?php echo date('Y'); ?>
            });
        </script>
	    <div class="clear"></div>
<?php
	//echo '<label for="deleteremovedate">' .__("Delete the current Remove Date:") . "</label>";
?>
       	<!--<input type="checkbox" id="deleteremovedate" name="deleteremovedate" class="plaintext" value="Y" />-->
<?php

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
    wp_enqueue_script('anytimetz', get_bloginfo('template_url') . '/js/admin/anytimetz.js', array('jquery','jquery-ui-core') );

    // load the events meta box
    add_meta_box("event-info", __("Show Information", 'PBPav'), "event_meta_options", "event", "normal", "low");
}

?>