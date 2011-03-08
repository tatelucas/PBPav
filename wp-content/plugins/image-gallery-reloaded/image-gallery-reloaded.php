<?php

/*

Plugin Name: Image Gallery Reloaded
Plugin URI: http://18elements.com/tools/wordpress-image-gallery-reloaded
Description: The plugin replaces the default Wordpress gallery with a minimal, jquery-powered gallery.
Version: 0.6.0
Author: Daniel Sachs
Author URI: http://18elements.com
License: GPL

*/
define('GALLERY_RELOADED_VERSION', '0.6.0');
add_action('admin_menu', 'gr_control_menu');
add_action('wp_print_scripts','reloaded_gallery_js');
add_action('wp_head','helper_js',100);
register_activation_hook( __FILE__, 'gr_activate' );
register_deactivation_hook( __FILE__, 'gr_deactivate' );
function reloaded_gallery_js(){	
if(!is_admin()){
	wp_enqueue_script ('jquery');	
    wp_enqueue_script ('thickbox');
	wp_enqueue_script ('gallery_reloaded_pack', '/' . PLUGINDIR . '/image-gallery-reloaded/image-gallery-reloaded.js', array('jquery'));
}
}
function helper_js () {
$g_bookmark_add=get_option('g_bookmark');
$g_next_click_add=get_option('g_next_click');
	?>
	<script type='text/javascript'>
/*<![CDATA[*/
jQuery(function($){jQuery('.gallery').addClass('gallery_reloaded');jQuery('ul.gallery_reloaded').gallery_reloaded({history:<?php echo $g_bookmark_add;?>,clickNext:<?php echo $g_next_click_add;?>,insert:'.main_image',onImage:function(a,b,c){a.css('display','none').fadeIn(1000);b.css('display','none').fadeIn(1000);var d=c.parents('li');d.siblings().children('img.selected').fadeTo(500,0.5);c.fadeTo('fast',1).addClass('selected');a.attr('title','Next image >>')},onThumb:function(a){var b=a.parents('li');var c=b.is('.active')?'1':'0.5';a.css({display:'none',opacity:c}).fadeIn(500);a.hover(function(){a.fadeTo('fast',1)},function(){b.not('.active').children('img').fadeTo('fast',0.5)})}});jQuery('ul.gallery_reloaded li:first-child').addClass('active')});function makeScrollable(j,k){var j=jQuery(j),k=jQuery(k);k.hide();var l=jQuery('<div class=loading>Loading Gallery...</div>').appendTo(j);var m=setInterval(function(){var a=k.find('img');var b=0;a.each(function(){if(this.complete)b++});if(b==a.length){clearInterval(m);setTimeout(function(){l.hide();j.css({overflow:'hidden'});k.slideDown('slow',function(){enable()})},1000)}},100);function enable(){var c=50;var d=j.width();var f=j.height();var g=k.outerWidth()+2*c;var h=j.offset();j.css({overflow:'hidden'});var i=k.find('li:last-child');j.mousemove(function(e){var a=i[0].offsetLeft+i.outerWidth()+c;var b=(e.pageX-j.offset().left)*(a-d)/d-c;if(b<0){b=0}j.scrollLeft(b)})}}jQuery(function(jQuery){makeScrollable('div.gholder','ul.gallery_reloaded')});this.gr_tooltip=function(){xOffset=10;yOffset=20;jQuery("div.gbackgr img").hover(function(e){this.t=this.title;this.alt = this.t;this.title = "";jQuery("body").append("<p id='gr_tooltip'>"+this.t+"</p>");jQuery("#gr_tooltip").css("top",(e.pageY-xOffset)+"px").css("left",(e.pageX+yOffset)+"px").fadeIn("fast")},function(){this.title=this.alt;jQuery("#gr_tooltip").remove()});jQuery("div.gbackgr img").mousemove(function(e){jQuery("#gr_tooltip").css("top",(e.pageY-xOffset)+"px").css("left",(e.pageX+yOffset)+"px")})};jQuery(function($){gr_tooltip()});/*]]>*/	</script>
<script type='text/javascript'>
/*<![CDATA[*/
jQuery(document).ready(function() {
    jQuery('.main_image a').attr({class: "thickbox", rel: "thickbox"});
});
/*]]>*/
</script>
<?php
require_once ( dirname(__FILE__) . '/image-gallery-reloaded-style.php');
}
function reloaded_gallery_shortcode($attr) {
  $g_main_height=get_option('g_main_height');
  $g_main_width=get_option('g_main_width');
  $g_thumb_height=get_option('g_thumb_height');
  $g_thumb_width=get_option('g_thumb_width');
  $g_slide=get_option('g_slide');
  $g_border_color=get_option('g_border_color');
  $g_background_color=get_option('g_background_color');
  $g_caption_color=get_option('g_caption_color');
  $g_fwd_back_position=get_option('g_fwd_back_position');
  $g_fwd_back_add=get_option('g_fwd_back');
  $g_fwd_back_ini = '<div class="clear" style="clear: both;"></div><p class="gallery-nav"><a class="back" href="#" onclick="jQuery.gallery_reloaded.prev(); return false;">&laquo; Back</a>    <a class="forward" href="#" onclick="jQuery.gallery_reloaded.next(); return false;">Forward &raquo;</a></p>';
global $post;
	if ( isset( $attr['orderby'] ) ) {
		$attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
		if ( !$attr['orderby'] )
			unset( $attr['orderby'] );
	}
	extract(shortcode_atts(array(
		'orderby' => 'menu_order ASC, ID ASC',
		'id' => $post->ID,
		'itemtag' => 'dl',
		'icontag' => 'dt',
		'captiontag' => 'dd',
		'columns' => 3,
		'size' => 'thumbnail',
	), $attr));

        $count = 1;
	$id = intval($id);
	$attachments = get_children("post_parent=$id&post_type=attachment&post_mime_type=image&orderby={$orderby}");

	if ( empty($attachments) )
		return '';

	if ( is_feed() ) {
		$output = "\n";
		foreach ( $attachments as $id => $attachment )
			$output .= wp_get_attachment_link($id, $size, true) . "\n";
		return $output;
	}
	$listtag = tag_escape($listtag);
	$itemtag = tag_escape($itemtag);
	$captiontag = tag_escape($captiontag);
	$columns = intval($columns);
	$itemwidth = $columns > 0 ? floor(100/$columns) : 100;

// The Gallery init
	$output = apply_filters('gallery_style', "<div class='gbackgr'>");


	if($g_fwd_back_position == 'top') {
	if($g_fwd_back_add == 'true') {
	$output .= $g_fwd_back_ini; 
	};
	};
if ($g_slide == 'bottom') {
		$output .= "\n<div class='main_image'></div>\n";
	};
 $output .= "\n<div class='gholder'><ul class='gallery-thumbs gallery_reloaded'>\n";
	foreach ( $attachments as $id => $attachment ) {
		$a_img = wp_get_attachment_url($id);
		$att_page = get_attachment_link($id);
		$img = wp_get_attachment_image_src($id, $size);
		$img = $img[0];
		$title = $attachment->post_excerpt;
		if($title == '') $title = $attachment->post_title;
if($count == 1)
$output .= "<li class='active'>";
if($count > 1)
$output .= "<li>";
		$link = $a_img;
		$output .= "\t<a href=\"$link\" title=\"$title\" class=\"$a_class\" rel=\"$a_rel\">";
		$output .= "<img src=\"$img\" alt=\"$title\" />";
		$output .= "</a>";
		$output .= "</li>
";
$count++;
	}
	$output .= "\n</ul></div>\n";
	if ($g_slide == 'top') {
		$output .= "<div class='main_image'></div>\n";
	};
	if($g_fwd_back_position == 'bottom') {
	if($g_fwd_back_add == 'true') {
	$output .= $g_fwd_back_ini; 
	};
	};
    $output .= "\n</div><div style='clear:both;' class='clear'></div>\n";
	return $output;
}
// Replaces the default gallery
	remove_shortcode(gallery);
	add_shortcode('gallery', 'reloaded_gallery_shortcode');
//Options Page
function gr_activate()
{
  gr_set_default_options();
}
function gr_deactivate()
{
  gr_delete_options(); 
}
function gr_set_default_options() {
  if(get_option('g_main_width')===false)		                add_option('g_main_width', 600);
  if(get_option('g_main_height')===false)		                add_option('g_main_height', 480);
  if(get_option('g_thumb_width')===false)		                add_option('g_thumb_width', 80);
  if(get_option('g_thumb_height')===false)		                add_option('g_thumb_height', 80);
  if(get_option('g_slide')===false)		                        add_option('g_slide', 'top');
  if(get_option('g_border_color')===false)		                add_option('g_border_color', '000000');
  if(get_option('g_background_color')===false)		            add_option('g_background_color', '000000');
  if(get_option('g_caption_color')===false)		                add_option('g_caption_color', '887777');
  if(get_option('g_bookmark')===false)		                    add_option('g_bookmark', 'false');
  if(get_option('g_next_click')===false)		                add_option('g_next_click', 'true');
  if(get_option('g_fwd_back')===false)		                    add_option('g_fwd_back', 'true');
  if(get_option('g_fwd_back_position')===false)		            add_option('g_fwd_back_position', 'bottom');
}
function gr_delete_options() {
	delete_option('g_main_width');
	delete_option('g_main_height');
	delete_option('g_thumb_width');
	delete_option('g_thumb_height');
	delete_option('g_slide');
	delete_option('g_border_color');
	delete_option('g_background_color');
	delete_option('g_caption_color');
	delete_option('g_bookmark');
	delete_option('g_next_click');
	delete_option('g_fwd_back');
	delete_option('g_fwd_back_position');
}
function gr_control_menu() {
  $page = add_options_page('Gallery Reloaded Settings', 'Gallery Reloaded', 8, 'gallery_reloaded_options', 'reloaded_gallery_options');
  add_action( 'admin_print_scripts', 'gr_admin_head' ); 
}
function gr_admin_head() {
	wp_enqueue_script ('jquery');
	wp_enqueue_script ('gr_picker', '/' . PLUGINDIR . '/image-gallery-reloaded/picker/colorpicker.js', array('jquery'));
}

function reloaded_gallery_options() {
	$hidden_field_name = 'gr_submit_hidden';
	
	$g_main_width_name = 'g_main_width';
	$g_main_height_name = 'g_main_height';
	$g_thumb_width_name = 'g_thumb_width';
	$g_thumb_height_name = 'g_thumb_height';
	$g_slide_name = 'g_slide';
	$g_border_color_name = 'g_border_color';
	$g_background_color_name = 'g_background_color';
	$g_caption_color_name = 'g_caption_color';
	$g_bookmark_name = 'g_bookmark';
	$g_next_click_name = 'g_next_click';
	$g_fwd_back_name = 'g_fwd_back';
	$g_fwd_back_position_name = 'g_fwd_back_position';
	
	$g_main_width_val = get_option($g_main_width_name);
	$g_main_height_val = get_option($g_main_height_name);
	$g_thumb_width_val = get_option($g_thumb_width_name);
	$g_thumb_height_val = get_option($g_thumb_height_name);
	$g_slide_val = get_option($g_slide_name);
	$g_border_color_val = get_option($g_border_color_name);
	$g_background_color_val = get_option($g_background_color_name);
	$g_caption_color_val = get_option($g_caption_color_name);
	$g_bookmark_val = get_option($g_bookmark_name);
	$g_next_click_val = get_option($g_next_click_name);
	$g_fwd_back_val = get_option($g_fwd_back_name);
	$g_fwd_back_position_val = get_option($g_fwd_back_position_name);
	
	if( $_POST[ $hidden_field_name ] == 'Y' ) {
		
		$g_main_width_val = $_POST[$g_main_width_name];
		$g_main_height_val = $_POST[$g_main_height_name];
		$g_thumb_width_val = $_POST[$g_thumb_width_name];
		$g_thumb_height_val = $_POST[$g_thumb_height_name];
		$g_slide_val = $_POST[$g_slide_name];
		$g_border_color_val = $_POST[$g_border_color_name];
		$g_background_color_val = $_POST[$g_background_color_name];
		$g_caption_color_val = $_POST[$g_caption_color_name];
		$g_bookmark_val = $_POST[$g_bookmark_name];
		$g_next_click_val = $_POST[$g_next_click_name];
		$g_fwd_back_val = $_POST[$g_fwd_back_name];
		$g_fwd_back_position_val = $_POST[$g_fwd_back_position_name];
		
		update_option($g_main_width_name, $g_main_width_val);
		update_option($g_main_height_name, $g_main_height_val);
		update_option($g_thumb_width_name, $g_thumb_width_val);
		update_option($g_thumb_height_name, $g_thumb_height_val);
		update_option($g_slide_name, $g_slide_val);
		update_option($g_border_color_name, $g_border_color_val);
		update_option($g_background_color_name, $g_background_color_val);
		update_option($g_caption_color_name, $g_caption_color_val);
		update_option($g_bookmark_name, $g_bookmark_val);
		update_option($g_next_click_name, $g_next_click_val);
		update_option($g_fwd_back_name, $g_fwd_back_val);
		update_option($g_fwd_back_position_name, $g_fwd_back_position_val);
		
		echo '<div class="updated"><p><strong>Options saved.</strong></p></div>';
	}
	$plugin_directory = gr_get_plugin_root();
?>
<div class="wrap">
<link rel="stylesheet" media="screen" type="text/css" href="<?php echo bloginfo( 'url' ) . '/wp-content/plugins/image-gallery-reloaded/picker/colorpicker.css'; ?>" />
<script type="text/javascript">
jQuery(document).ready(function() {
jQuery('#color1, #color2, #color3').ColorPicker({
	onSubmit: function(hsb, hex, rgb, el) {
		jQuery(el).val(hex);
		jQuery(el).ColorPickerHide();
	},
	onBeforeShow: function () {
		jQuery(this).ColorPickerSetColor(this.value);
	}
})
.bind('keyup', function(){
	jQuery(this).ColorPickerSetColor(this.value);
});
						   		});
</script>
  <h2>Gallery Reloaded</h2>
  <form name="form1" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
    <input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">
  <table class="form-table">
  <tr valign="top"><th scope="row"><h3>Setup</h3></th></tr>
      <tr valign="top">
      <th scope="row">Gallery Width</th>
        <td><input type="text" name="<?php echo $g_main_width_name; ?>" value="<?php echo $g_main_width_val; ?>" size="4">
          pixels </td>
      </tr>
      <tr valign="top">
      <th scope="row">Main Image Height</th>
        <td><input type="text" name="<?php echo $g_main_height_name; ?>" value="<?php echo $g_main_height_val; ?>" size="4">
          pixels </td>
      </tr>
      <tr valign="top">
      <th scope="row">Thumbnail Width</th>
        <td><input type="text" name="<?php echo $g_thumb_width_name; ?>" value="<?php echo $g_thumb_width_val; ?>" size="4">
          pixels </td>
      </tr>
      <tr valign="top">
      <th scope="row">Thumbnail Height</th>
        <td><input type="text" name="<?php echo $g_thumb_height_name; ?>" value="<?php echo $g_thumb_height_val; ?>" size="4">
          pixels </td>
      </tr>
     <tr valign="top">
        <th scope="row">Slideshow Position</th>
        <td>
          <select name="<?php echo $g_slide_name; ?>" value="<?php echo $g_slide_val; ?>">
            <option value="top" <?php if($g_slide_val=='top'){echo 'selected="selected"';} ?>>Top</option>
            <option value="bottom" <?php if($g_slide_val=='bottom'){echo 'selected="selected"';} ?>>Bottom</option>
          </select></td>
      </tr>
      <tr valign="top"><th scope="row"><h3>Colors</h3></th><td><h4>Click on the color field to choose your own</h4></td></tr>
      <tr valign="top">
      <th scope="row">Gallery Border Color</th>
        <td><input type="text" id="color1" name="<?php echo $g_border_color_name; ?>" value="<?php echo $g_border_color_val; ?>" size="6"></td>
      </tr>
      <tr valign="top">
      <th scope="row">Gallery Background Color</th>
        <td><input type="text" id="color2" name="<?php echo $g_background_color_name; ?>" value="<?php echo $g_background_color_val; ?>" size="6"></td>
      </tr>
      <tr valign="top">
      <th scope="row">Text Color (caption and tooltips)</th>
        <td><input type="text" id="color3" name="<?php echo $g_caption_color_name; ?>" value="<?php echo $g_caption_color_val; ?>" size="6"></td>
      </tr>
      <tr valign="top"><th scope="row"><h3>Controls</h3></th></tr>
      
      <tr valign="top">
        <th scope="row">Browser "Back" support</th>
        <td>Enable browser "Back / Forward" and bookmarking specific image capabilities<br />
          <select name="<?php echo $g_bookmark_name; ?>" value="<?php echo $g_bookmark_val; ?>">
            <option value="true" <?php if($g_bookmark_val=='true'){echo 'selected="selected"';} ?>>Active</option>
            <option value="false" <?php if($g_bookmark_val=='false'){echo 'selected="selected"';} ?>>Not Active</option>
          </select></td>
      </tr>
      <tr valign="top">
        <th scope="row">Main Image "Next" click</th>
        <td>Enables click on the main image to step forward<br />
          <select name="<?php echo $g_next_click_name; ?>" value="<?php echo $g_next_click_val; ?>">
            <option value="true" <?php if($g_next_click_val=='true'){echo 'selected="selected"';} ?>>Active</option>
            <option value="false" <?php if($g_next_click_val=='false'){echo 'selected="selected"';} ?>>Not Active</option>
          </select></td>
      </tr>
      <tr valign="top">
        <th scope="row">Gallery Forward / Back Buttons</th>
        <td>Enables the Galley navigation buttons<br />
          <select name="<?php echo $g_fwd_back_name; ?>" value="<?php echo $g_fwd_back_val; ?>">
            <option value="true" <?php if($g_fwd_back_val=='true'){echo 'selected="selected"';} ?>>Active</option>
            <option value="false" <?php if($g_fwd_back_val=='false'){echo 'selected="selected"';} ?>>Not Active</option>
          </select>
          <select name="<?php echo $g_fwd_back_position_name; ?>" value="<?php echo $g_fwd_back_position_val; ?>">
            <option value="top" <?php if($g_fwd_back_position_val=='top'){echo 'selected="selected"';} ?>>Top</option>
            <option value="bottom" <?php if($g_fwd_back_position_val=='bottom'){echo 'selected="selected"';} ?>>Bottom</option>
          </select>
          </td>
      </tr>
      </table>
    <hr />
    <p class="submit">
      <input type="submit" name="Submit" value="<?php _e('Update Options', 'gr_trans_domain' ) ?>" />
    </p>
  </form>
</div>
<?php
 
}

function gr_get_plugin_root() {
	return dirname(__FILE__).'/';
}
function gr_get_plugin_web_root(){
	$site_url = get_option('siteurl');

	$pos = gr_strpos_nth(3, $site_url, '/');
	$plugin_root = gr_get_plugin_root();
	$plugin_dir_name = substr($plugin_root, strrpos(substr($plugin_root, 0, strlen($plugin_root)-2), DIRECTORY_SEPARATOR)+1); //-2 to skip the trailing '/' on $plugin_root
	if($pos===false)
		$web_root = substr($site_url, strlen($site_url));
	else
		$web_root = '/' . substr($site_url, $pos);
	if($web_root[strlen($web_root)-1]!='/')
		$web_root .= '/';
	$web_root .= 'wp-content/plugins/' . $plugin_dir_name;
	return $web_root;
}
?>
<?php
// Get the Images from the default Gallery
function get_gallery_images( $args = array() ) {
	$defaults = array(
		'custom_key' => array( 'Thumbnail', 'thumbnail' ),
		'post_id' => false,
		'attachment' => true,
		'default_size' => 'thumbnail',
		'default_image' => false,
		'order_of_image' => 1,
		'link_to_post' => true,
		'image_class' => false,
		'image_scan' => false,
		'width' => false,
		'height' => false,
		'format' => 'img',
		'echo' => true
	);
	$args = apply_filters( 'get_gallery_images_args', $args );
	$args = wp_parse_args( $args, $defaults );
	extract( $args );
	if ( !is_array( $custom_key ) ) :
		$custom_key = str_replace( ' ', '', $custom_key) ;
		$custom_key = str_replace( array( '+' ), ',', $custom_key );
		$custom_key = explode( ',', $custom_key );
		$args['custom_key'] = $custom_key;
	endif;
	if ( $custom_key && $custom_key !== 'false' && $custom_key !== '0' )
		$image = image_by_custom_field( $args );
	if ( !$image && $attachment && $attachment !== 'false' && $attachment !== '0' )
		$image = image_by_attachment( $args );
	if ( !$image && $image_scan )
		$image = image_by_scan( $args );
	if (!$image && $default_image )
		$image = image_by_default( $args );
	if ( $image )
		$image = display_the_image( $args, $image );
	$image = apply_filters( 'get_gallery_images', $image );
	if ( $echo && $echo !== 'false' && $echo !== '0' && $format !== 'array' )
		echo $image;
	else
		return $image;
}
?>