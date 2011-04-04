<?php
/*
Plugin Name: Post Attachment Slideshow
Plugin URI: http://www.tatelucas.com/postattachmentslideshow
Description: Post Attachment Slideshow is a highly configurable slideshow plugin to create a Huffington Post-style slider with the current post or page's media attachments. 
Version: 1.0
Author: Tate Lucas
Author URI: http://www.tatelucas.com

License:

Copyright (c) 2011 Tate Lucas

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
*/

if (!defined('ATTACHMENTSLIDESHOW_THEME_DIR'))
    define('ATTACHMENTSLIDESHOW_THEME_DIR', ABSPATH . 'wp-content/themes/' . get_template());

if (!defined('ATTACHMENTSLIDESHOW_PLUGIN_NAME'))
    define('ATTACHMENTSLIDESHOW_PLUGIN_NAME', trim(dirname(plugin_basename(__FILE__)), '/'));

if (!defined('ATTACHMENTSLIDESHOW_PLUGIN_DIR'))
    define('ATTACHMENTSLIDESHOW_PLUGIN_DIR', WP_PLUGIN_DIR . '/' . MYPLUGIN_PLUGIN_NAME);

if (!defined('ATTACHMENTSLIDESHOW_PLUGIN_URL'))
    define('ATTACHMENTSLIDESHOW_PLUGIN_URL', WP_PLUGIN_URL . '/' . MYPLUGIN_PLUGIN_NAME);

if (!defined('ATTACHMENTSLIDESHOW_VERSION_KEY'))
    define('ATTACHMENTSLIDESHOW_VERSION_KEY', 'attachmentslideshow_version');

if (!defined('ATTACHMENTSLIDESHOW_VERSION_NUM'))
    define('ATTACHMENTSLIDESHOW_VERSION_NUM', '1.0.0');

add_option(ATTACHMENTSLIDESHOW_VERSION_KEY, ATTACHMENTSLIDESHOW_VERSION_NUM);

function post_attachment_slideshow_shortcode() {

  global $post;	
        
  $at_slideshow_image_height_name = 'at_slideshow_image_height';
  $at_slideshow_image_width_name = 'at_slideshow_image_width';
  $at_slideshow_thumb_height_name = 'at_slideshow_thumb_height';
  $at_slideshow_thumb_width_name = 'at_slideshow_thumb_width';

  $at_slideshow_image_height_val = get_option($at_slideshow_image_height_name);
  $at_slideshow_image_width_val = get_option($at_slideshow_image_width_name);
  $at_slideshow_thumb_height_val = get_option($at_slideshow_thumb_height_name);
  $at_slideshow_thumb_width_val = get_option($at_slideshow_thumb_width_name);
  
	extract( shortcode_atts( array(
		'orderby' => 'menu_order ASC, ID ASC',
		'id' => $post->ID		
	), $attr ) );

	$attachments = get_children("post_parent=$id&post_type=attachment&orderby={$orderby}");

	if ( empty($attachments) ) {
		return '';
  } else {
    //var_dump($attachments);
    ?>
    <div class="attachmentslideshow">
      <h4 class="atslideshowtitle"><?php echo $post->post_title ?></h4>
      <div class="atslideshare">
        <div class="atsharefacebook">
          <iframe src="http://www.facebook.com/plugins/like.php?href=axmpel.com&amp;layout=button_count&amp;show_faces=false&amp;width=80&amp;action=like&amp;font&amp;colorscheme=light&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:80px; height:20px;" allowTransparency="true"></iframe>
        </div>
        <div class="atsharetwitter">
          <a href="http://twitter.com/share" class="twitter-share-button" data-count="horizontal">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
        </div>
        <div class="atshareemail">
          <span class='st_email_hcount' st_title='<?php echo $post->post_title; ?>' st_url='<?php echo $post->permalink; ?>' displayText='share'></span>
        </div>
      </div>
      <div class="atslidenav">
        <div class="atslidenavbuttons">
          <a href="#" class="atslidebeginning" id="goto1">Beginning</a>
          <a href="#" class="atslideback" id="prev">Back</a>
          <div class="atslidepagination"></div>
          <a href="#" class="atslideforward" id="next">Forward</a>
        </div> <!-- /slidenavbuttons -->
        <div class="clear"></div>
      </div> <!--/slidenav-->
      <div class="atslidecont">
      	<div class="atslideshow">
        <?php
        $n = 0;
        foreach ($attachments as $attachment) {
        //var_dump($attachment);
        $rt_image_link = get_post_meta($attachment->ID, '_rt-image-link', true);
        ?>
          <div class="atslide<?php if ($n==0) { ?> atslidefirst<?php } ?>">
            <div class="atslideinnercont">
              <div class="atslidetitle"><?php echo $attachment->post_title ?></div> <!-- /slidetitle -->   
              <?php 
              //Put code here to use built in wordpress image sizes or timthumb 
              //$imagesrc = wp_get_attachment_image_src($attachment->ID,'medium'); 
              $imagesrc = wp_get_attachment_image_src($attachment->ID, 'full');    
              $relsource =  wp_get_attachment_image_src($attachment->ID, 'full');   
              if($rt_image_link) {                 
              echo $rt_image_link;
              ?>
              <img src="<?php echo WP_PLUGIN_URL . '/attachment-slideshow/scripts/timthumb.php?src=' . $imagesrc[0] . '&amp;w=' . $at_slideshow_image_width_val . '&amp;h=' . $at_slideshow_image_height_val . '&amp;zc=1'; ?>" alt="<?php echo $attachment->post_title ?>" rel="<?php echo $relsource[0]; ?>" class="at_hiddenimage" height="1" width="1" />            
              <?php
              } else {
              ?>
              <div class="atimagecont">
                <img src="<?php echo WP_PLUGIN_URL . '/attachment-slideshow/scripts/timthumb.php?src=' . $imagesrc[0] . '&amp;w=' . $at_slideshow_image_width_val . '&amp;h=' . $at_slideshow_image_height_val . '&amp;zc=1'; ?>" alt="<?php echo $attachment->post_title ?>" width="<?php echo $at_slideshow_image_width_val; ?>" height="<?php echo $at_slideshow_image_height_val; ?>" rel="<?php echo $relsource[0]; ?>" />
                <?php if ($attachment->post_excerpt) {
                ?>
                <div class="atphotocaption">
                  <?php echo $attachment->post_excerpt; ?>
                </div>
                <?php
                }
                ?>
              </div>
              <?php
              }
              ?>

              <?php echo wpautop($attachment->post_content); ?>
            
              <?php //var_dump($attachment); ?>
            </div> <!--/atslideinnercont -->
          </div><!--/atslide-->
   
        <?php
          $n++;
        }
        ?>
      	</div><!--/atslideshow-->
      </div> <!-- /attachmentslide -->
    </div> <!--/attachmentslideshow-->
 

        
    <?php
  }

}

add_shortcode('attach_slide', 'post_attachment_slideshow_shortcode');

function post_attachment_slideshow_add_stylesheet() {  
  $jcarouselSlideshowStyleURL = WP_PLUGIN_URL . '/attachment-slideshow/jcarousel/skins/attachmentslideshow/skin.css';
  $jcarouselSlideshowStyleFile = WP_PLUGIN_DIR . '/attachment-slideshow/jcarousel/skins/attachmentslideshow/skin.css';
  if ( file_exists($jcarouselSlideshowStyleFile) ) {
      wp_register_style('jcarousel', $jcarouselSlideshowStyleURL);
      wp_enqueue_style( 'jcarousel');
  }     

}  

function post_attachment_slideshow_add_js() {
  if(!is_admin()){
  	wp_enqueue_script ('jquery');	
  	wp_enqueue_script ('cycle', WP_PLUGIN_URL . '/attachment-slideshow/js/jquery.cycle.all.min.js', array('jquery'), '2.97');
  	wp_enqueue_script ('jcarousel', WP_PLUGIN_URL . '/attachment-slideshow/jcarousel/lib/jquery.jcarousel.min.js', array('jquery'), '0.2.7');
  }
}

function post_attachment_slideshow_helper_js() {

  $at_slideshow_image_height_name = 'at_slideshow_image_height';
  $at_slideshow_image_width_name = 'at_slideshow_image_width';
  $at_slideshow_thumb_height_name = 'at_slideshow_thumb_height';
  $at_slideshow_thumb_width_name = 'at_slideshow_thumb_width';

  $at_slideshow_image_height_val = get_option($at_slideshow_image_height_name);
  $at_slideshow_image_width_val = get_option($at_slideshow_image_width_name);
  $at_slideshow_thumb_height_val = get_option($at_slideshow_thumb_height_name);
  $at_slideshow_thumb_width_val = get_option($at_slideshow_thumb_width_name);

	?>
	<script type="text/javascript">
    jQuery(document).ready(function() {

    	// Adds ability to link to specifics slides - must come first to work correctly   
    	var index = 0, hash = window.location.hash;
    	if (hash) {
    		index = /\d+/.exec(hash)[0];
    		index = (parseInt(index) || 1) - 1; // slides are zero-based
    	}

      jQuery('.atslideshow').after('<ul id="atnav" class="jcarousel-skin-attachmentslideshow">').cycle({
    		fx: 'scrollHorz',
    		prev: '#prev',
    		speed:  'fast',
        next: '#next',
	      before: onBefore,        
        after: onAfter,
        pager:  '#atnav',
        timeout: 0,
        pagerAnchorBuilder: function(idx, slide) {
            divimgsrc = jQuery(slide).find("img").attr('rel');
            //divimgsrc = slide.src;

            return '<li><a href="#"><img src="<?php echo WP_PLUGIN_URL; ?>/attachment-slideshow/scripts/timthumb.php?src=' + divimgsrc + '&amp;w=<?php echo $at_slideshow_thumb_width_val; ?>&amp;h=<?php echo $at_slideshow_thumb_height_val; ?>&amp;zc=1" width="<?php echo $at_slideshow_thumb_width_val; ?>" height="<?php echo $at_slideshow_thumb_height_val; ?>" /></a></li>';
        }
    	});
      jQuery('#goto1').click(function() { 
        jQuery('.atslideshow').cycle(0); 
        return false; 
      });
      jQuery('#atnav').jcarousel({
        scroll: 7,
		    visible: 7,
		    initCallback: initCallbackFunction
      });

    	// Adds index to thumbnail links
    	jQuery('#atnav li a').each(function(idx) {
        jQuery(this).data('index', (++idx));
    	});

      function onAfter(curr,next,opts) {
      	var caption = '' + (opts.currSlide + 1) + ' / ' + opts.slideCount;
      	jQuery('.atslidepagination').html(caption);
      }
  
      function onBefore(curr,next,opts) {
    		//Centers the active thumbnail when slideshow is playing or next/previous buttons are clicked
    		/*
    		var carousel = jQuery('#atnav').data('jcarousel');
    		nextsrc = jQuery(next).find("img").attr('src');
    		var activeIdx = jQuery('#atnav img[src="'+nextsrc+'"]').closest('a').data('index');
    		//alert(activeIdx);
     		if (carousel) {
          carousel.scroll(activeIdx);
        }
        */
      }
  
    	function initCallbackFunction(carousel) {
        jQuery('#atnav li a').bind("click",function() {
          var idx =  jQuery(this).data('index');
          carousel.scroll(idx);
        }); 		
    	};
    	
    	jQuery('.atslidecont .jcarousel-prev').fadeTo('slow', 0.5);
    	jQuery('.atslidecont .jcarousel-next').fadeTo('slow', 0.5);

    	jQuery(".atslidecont .jcarousel-prev").hover(function(){
    		jQuery(".atslidecont .jcarousel-prev").fadeTo("slow", 1.0); // This sets the opacity to 100% on hover
    	},function(){
       		jQuery(".atslidecont .jcarousel-prev").fadeTo("slow", 0.5); // This sets the opacity back to 60% on mouseout
    	});

    	jQuery(".atslidecont .jcarousel-next").hover(function(){
    		jQuery(".atslidecont .jcarousel-next").fadeTo("slow", 1.0); // This sets the opacity to 100% on hover
    	},function(){
       		jQuery(".atslidecont .jcarousel-next").fadeTo("slow", 0.5); // This sets the opacity back to 60% on mouseout
    	});
    	    	
    });
    
	</script>
  <?php
}

add_action('wp_print_styles', 'post_attachment_slideshow_add_stylesheet');   
add_action('wp_print_scripts','post_attachment_slideshow_add_js');     
add_action('wp_footer','post_attachment_slideshow_helper_js',100);


//Add an admin page under "Settings"
add_action('admin_menu', 'attachmentgallery_admin_menu');

function attachmentgallery_admin_menu() {
    $page_title = 'Attachment Gallery';
    $menu_title = 'Attachment Gallery';
    $capability = 'manage_options';
    $menu_slug = 'attachmentgallery-settings';
    $function = 'attachmentgallery_settings';
    add_options_page($page_title, $menu_title, $capability, $menu_slug, $function);
}

function attachmentgallery_settings() {
    if (!current_user_can('manage_options')) {
        wp_die('You do not have sufficient permissions to access this page.');
    }

	  $at_hidden_field_name = 'gr_submit_hidden';
	  $at_slideshow_width_name = 'at_slideshow_width';
	  $at_slideshow_height_name = 'at_slideshow_height';	  	  
	  $at_slideshow_image_height_name = 'at_slideshow_image_height';
	  $at_slideshow_image_width_name = 'at_slideshow_image_width';
	  $at_slideshow_thumb_height_name = 'at_slideshow_thumb_height';
	  $at_slideshow_thumb_width_name = 'at_slideshow_thumb_width';
	  $at_slideshow_background_color_name = 'at_slideshow_background_color';
	  $at_slideshow_text_color_name = 'at_slideshow_text_color';
	  $at_slideshow_thumbnail_color_name = 'at_slideshow_thumbnail_color';
	  $at_slideshow_thumbnail_color_hover_name = 'at_slideshow_thumbnail_hover_color';  

	  
  	$at_slideshow_width_val = get_option($at_slideshow_width_name);
  	$at_slideshow_height_val = get_option($at_slideshow_height_name);
	  $at_slideshow_image_height_val = get_option($at_slideshow_image_height_name);
	  $at_slideshow_image_width_val = get_option($at_slideshow_image_width_name);
	  $at_slideshow_thumb_height_val = get_option($at_slideshow_thumb_height_name);
	  $at_slideshow_thumb_width_val = get_option($at_slideshow_thumb_width_name);
	  $at_slideshow_background_color_val = get_option($at_slideshow_background_color_name);
	  $at_slideshow_text_color_val = get_option($at_slideshow_text_color_name);
	  $at_slideshow_thumbnail_color_val = get_option($at_slideshow_thumbnail_color_name);
	  $at_slideshow_thumbnail_color_hover_val = get_option($at_slideshow_thumbnail_color_hover_name);


  	if( $_POST[ $at_hidden_field_name ] == 'Y' ) {
      //var_dump($_POST);
 
  		$at_slideshow_width_val = $_POST[$at_slideshow_width_name];
  		$at_slideshow_height_val = $_POST[$at_slideshow_height_name]; 
  	  $at_slideshow_image_height_val = $_POST[$at_slideshow_image_height_name];
  	  $at_slideshow_image_width_val = $_POST[$at_slideshow_image_width_name];
  	  $at_slideshow_thumb_height_val = $_POST[$at_slideshow_thumb_height_name];
  	  $at_slideshow_thumb_width_val = $_POST[$at_slideshow_thumb_width_name];
  	  $at_slideshow_background_color_val = $_POST[$at_slideshow_background_color_name];  	  
  	  $at_slideshow_text_color_val = $_POST[$at_slideshow_text_color_name]; 
  	  $at_slideshow_thumbnail_color_val = $_POST[$at_slideshow_thumbnail_color_name]; 
  	  $at_slideshow_thumbnail_color_hover_val = $_POST[$at_slideshow_thumbnail_color_hover_name]; 

  		update_option($at_slideshow_width_name, $at_slideshow_width_val);
  		update_option($at_slideshow_height_name, $at_slideshow_height_val);
  		update_option($at_slideshow_image_height_name, $at_slideshow_image_height_val);
  		update_option($at_slideshow_image_width_name, $at_slideshow_image_width_val);
  		update_option($at_slideshow_thumb_height_name, $at_slideshow_thumb_width_val);
  		update_option($at_slideshow_thumb_width_name, $at_slideshow_thumb_width_val);
  		update_option($at_slideshow_background_color_name, $at_slideshow_background_color_val);
  		update_option($at_slideshow_text_color_name, $at_slideshow_text_color_val);
  		update_option($at_slideshow_thumbnail_color_name, $at_slideshow_thumbnail_color_val);
  		update_option($at_slideshow_thumbnail_color_hover_name, $at_slideshow_thumbnail_color_hover_val);
  		
  		echo '<div class="updated"><p><strong>Options saved.</strong></p></div>';
  	}

    ?>
    
      <div class="wrap">
	  	<div class="icon32" id="icon-options-general"><br></div>
	  	<h2>Attachment Gallery Settings</h2>
      <form name="at_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
        <input type="hidden" name="<?php echo $at_hidden_field_name; ?>" value="Y">
        <table class="form-table">
          <tr valign="top"><th scope="row"><h3>Setup</h3></th></tr>
          <tr valign="top">
            <th scope="row">Gallery Width</th>
            <td><input type="text" name="<?php echo $at_slideshow_width_name; ?>" value="<?php echo $at_slideshow_width_val; ?>" size="4">
              pixels </td>
          </tr>
          <tr valign="top">
            <th scope="row">Gallery Height</th>
            <td><input type="text" name="<?php echo $at_slideshow_height_name; ?>" value="<?php echo $at_slideshow_height_val; ?>" size="4">
              pixels </td>
          </tr>
          <tr valign="top">
            <th scope="row">Feature Image Width</th>
            <td><input type="text" name="<?php echo $at_slideshow_image_width_name; ?>" value="<?php echo $at_slideshow_image_width_val; ?>" size="4">
              pixels </td>
          </tr>
          <tr valign="top">
            <th scope="row">Feature Image Height</th>
            <td><input type="text" name="<?php echo $at_slideshow_image_height_name; ?>" value="<?php echo $at_slideshow_image_height_val; ?>" size="4">
              pixels </td>
          </tr>
          <tr valign="top">
            <th scope="row">Thumbnail Image Width</th>
            <td><input type="text" name="<?php echo $at_slideshow_thumb_width_name; ?>" value="<?php echo $at_slideshow_thumb_width_val; ?>" size="4">
              pixels </td>
          </tr>
          <tr valign="top">
            <th scope="row">Thumbnail Image Height</th>
            <td><input type="text" name="<?php echo $at_slideshow_thumb_height_name; ?>" value="<?php echo $at_slideshow_thumb_width_val; ?>" size="4">
              pixels </td>
          </tr>
          <tr valign="top">
            <th scope="row">Gallery Background Color</th>
            <td>#<input type="text" name="<?php echo $at_slideshow_background_color_name; ?>" value="<?php echo $at_slideshow_background_color_val; ?>" size="4">
              </td>
          </tr>
          <tr valign="top">
            <th scope="row">Text Color</th>
            <td>#<input type="text" name="<?php echo $at_slideshow_text_color_name; ?>" value="<?php echo $at_slideshow_text_color_val; ?>" size="4">
              </td>
          </tr>
          <tr valign="top">
            <th scope="row">Thumbnail Border Color</th>
            <td>#<input type="text" name="<?php echo $at_slideshow_thumbnail_color_name; ?>" value="<?php echo $at_slideshow_thumbnail_color_val; ?>" size="4">
              </td>
          </tr>
          <tr valign="top">
            <th scope="row">Thumbnail Border Hover Color</th>
            <td>#<input type="text" name="<?php echo $at_slideshow_thumbnail_color_hover_name; ?>" value="<?php echo $at_slideshow_thumbnail_color_hover_val; ?>" size="4">
              </td>
          </tr>                    
        </table>
        <p class="submit">
          <input type="submit" name="Submit" value="<?php _e('Update Options', 'gr_trans_domain' ) ?>" />
        </p>
      </form>
      </div> 
    
      
    
    <?php
}

//Add link to Settings page from Plugin install page

add_filter('plugin_action_links', 'attachmentgallery_plugin_action_links', 10, 2);


function set_attachment_gallery_defaults()
{

	  $at_hidden_field_name = 'gr_submit_hidden';
	  $at_slideshow_width_name = 'at_slideshow_width';
	  $at_slideshow_height_name = 'at_slideshow_height';	  	  
	  $at_slideshow_image_height_name = 'at_slideshow_image_height';
	  $at_slideshow_image_width_name = 'at_slideshow_image_width';
	  $at_slideshow_thumb_height_name = 'at_slideshow_thumb_height';
	  $at_slideshow_thumb_width_name = 'at_slideshow_thumb_width';
	  $at_slideshow_background_color_name = 'at_slideshow_background_color';
	  $at_slideshow_text_color_name = 'at_slideshow_text_color';
	  $at_slideshow_thumbnail_color_name = 'at_slideshow_thumbnail_color';
	  $at_slideshow_thumbnail_color_hover_name = 'at_slideshow_thumbnail_hover_color';  



    $o = array(
        'at_slideshow_width'             => '600',
        'at_slideshow_image_height'         => '500',
        'at_slideshow_image_width'         => '300',
        'at_slideshow_thumb_height'               => '50',
        'at_slideshow_thumb_width'       => '50',
        'at_slideshow_background_color'    => '000000',
        'at_slideshow_text_color'       => 'FFFFFF',
        'at_slideshow_thumbnail_color'              => '161616',
        'at_slideshow_thumbnail_hover_color'           => '2E2E2E',
    );
    foreach ( $o as $k => $v )
    {
        update_option($k, $v);
    }
    return;
}
register_activation_hook(__FILE__, 'set_attachment_gallery_defaults');



function attachmentgallery_plugin_action_links($links, $file) {
    static $this_plugin;

    if (!$this_plugin) {
        $this_plugin = plugin_basename(__FILE__);
    }

    if ($file == $this_plugin) {
        // The "page" query string value must be equal to the slug
        // of the Settings admin page we defined earlier, which in
        // this case equals "myplugin-settings".
        $settings_link = '<a href="' . get_bloginfo('wpurl') . '/wp-admin/admin.php?page=attachmentgallery-settings">Settings</a>';
        array_unshift($links, $settings_link);
    }

    return $links;
}

function build_stylesheet_url() {
    echo '<link rel="stylesheet" href="' . WP_PLUGIN_URL . '/attachment-slideshow/attachment-slideshow.css?build=' . date( "Ymd", strtotime( '-24 days' ) ) . '" type="text/css" media="screen" />';
}

function build_stylesheet_content() {
    if( isset( $_GET['build'] ) && addslashes( $_GET['build'] ) == date( "Ymd", strtotime( '-24 days' ) ) ) {
        header("Content-type: text/css");
        
	  $at_hidden_field_name = 'gr_submit_hidden';
	  $at_slideshow_width_name = 'at_slideshow_width';
	  $at_slideshow_height_name = 'at_slideshow_height';	  	  
	  $at_slideshow_image_height_name = 'at_slideshow_image_height';
	  $at_slideshow_image_width_name = 'at_slideshow_image_width';
	  $at_slideshow_thumb_height_name = 'at_slideshow_thumb_height';
	  $at_slideshow_thumb_width_name = 'at_slideshow_thumb_width';
	  $at_slideshow_background_color_name = 'at_slideshow_background_color';
	  $at_slideshow_text_color_name = 'at_slideshow_text_color';
	  $at_slideshow_thumbnail_color_name = 'at_slideshow_thumbnail_color';
	  $at_slideshow_thumbnail_color_hover_name = 'at_slideshow_thumbnail_hover_color';  

	  
  	$at_slideshow_width_val = get_option($at_slideshow_width_name);
  	$at_slideshow_height_val = get_option($at_slideshow_height_name);
	  $at_slideshow_image_height_val = get_option($at_slideshow_image_height_name);
	  $at_slideshow_image_width_val = get_option($at_slideshow_image_width_name);
	  $at_slideshow_thumb_height_val = get_option($at_slideshow_thumb_height_name);
	  $at_slideshow_thumb_width_val = get_option($at_slideshow_thumb_width_name);
	  $at_slideshow_background_color_val = get_option($at_slideshow_background_color_name);
	  $at_slideshow_text_color_val = get_option($at_slideshow_text_color_name);
	  $at_slideshow_thumbnail_color_val = get_option($at_slideshow_thumbnail_color_name);
	  $at_slideshow_thumbnail_color_hover_val = get_option($at_slideshow_thumbnail_color_hover_name);
	  
        ?>
        .attachmentslideshow {
          background: #<?php echo $at_slideshow_background_color_val; ?>;
          padding: 10px;
          color: #<?php echo $at_slideshow_text_color_val; ?>;
          text-align: center;
        }
        
        .atslidebeginning {
          display: block;
          width: 32px;
          height: 32px;
          background: url(<?php echo WP_PLUGIN_URL; ?>/attachment-slideshow/images/rewind.png) no-repeat;
          text-indent: -9999px;
          float: left;
          margin: 0 5px 0 0;
        }
        
        .atslideback {
          display: block;
          width: 32px;
          height: 32px;
          background: url(<?php echo WP_PLUGIN_URL; ?>/attachment-slideshow/images/backward.png) no-repeat;
          text-indent: -9999px;
          float: left;
          margin: 0 5px 0 0;
        }
        
        .atslideforward {
          display: block;
          width: 32px;
          height: 32px;
          background: url(<?php echo WP_PLUGIN_URL; ?>/attachment-slideshow/images/forward.png) no-repeat;
          text-indent: -9999px;
          float: left;
        }
        
        .atslideshare {
          width: 400px;
          float: left;
          text-align: left;
        }
        
        .clear {
          clear: both;
        }
        
        .at_hiddenimage {
          display: none;
          visibility: hidden;
        }
        
        .atslidenavbuttons {
          float: right;
        }
        
        .atslidepagination {
          width: 70px;
          float: left;
          line-height: 32px;
          font-size: 18px;
          text-align: center;
        }
        
        #atnav { 
          margin: 0;
          padding: 0;
        }
        
        #atnav li { 
          width: 60px; 
          float: left; 
          margin: 8px; 
          list-style: none;
          padding: 0;
        }
        
        #atnav a { 
          width: 50px;  
          display: block; 
          margin: 0;
          padding: 5px;
          background: #<?php echo $at_slideshow_thumbnail_color_val; ?>
        }
        
        #atnav .activeSlide {
          background: #<?php echo $at_slideshow_thumbnail_color_hover_val; ?>;         
        }
        
        #atnav a:hover { 
          background: #<?php echo $at_slideshow_thumbnail_color_hover_val; ?>; 
        }
        
        #atnav a:focus { 
          outline: none; 
        }
        
        #atnav img { 
          border: none !important; 
          display: block; 
          margin: 0 !important;
          padding: 0 !important; 
        }
        
        .atslideshow img {
          padding: 0;
          border: 0;
        }
        
        h4.atslideshowtitle {
          color: #<?php echo $at_slideshow_text_color_val; ?> !important;
        }
        
        .atslide {
          display: none;
          color: #<?php echo $at_slideshow_text_color_val; ?> !important;
          text-align: center !important;
        }
        
        .atslideinnercont {
          text-align: center !important;          
          width: <?php echo $at_slideshow_width_val; ?>px !important;
        }
        
        .atslide.atslidefirst {
          display: block;
        }
        
        .atslide, .atslide h5 {
          color: #<?php echo $at_slideshow_text_color_val; ?> !important;
        }

        .atslide img {
          margin: 0 !important;
          padding: 0 !important;
          border: none;
        }
        
        .atslidetitle {
          width: <?php echo $at_slideshow_width_val; ?>;
          text-align: center;
          margin: 5px 0 10px 0;
          font-weight: bold;
        }
        
        .atslideshow {
          width: <?php echo $at_slideshow_width_val; ?>;
        }
        
        .atsharefacebook {
          margin: 5px 0 0 0;
          float: left;        
        }
        
        .atsharetwitter {
          margin: 5px 0 0 0;
          float: left;
        }
        
        .atshareemail {
          margin: 5px 0 0 0;
          float: left;
        }
        
        .atimagecont {
          position: relative;
        }
        
        .atphotocaption {
          position: absolute;
          text-shadow: black 0.1em 0.1em 0.2em;
          bottom: 0;
          right: 0;
          color: #fff;
          font-size: 12px;
          padding: 2px 5px 5px;
          text-align: right;
        }
                
        <?php
        define( 'DONOTCACHEPAGE', 1 ); // don't let wp-super-cache cache this page.
        die();
    }
}

add_action( 'init', 'build_stylesheet_content' );
add_action( 'wp_head', 'build_stylesheet_url' );


//Add embed link to the upload media form
/* For adding custom field to gallery popup */
function attachmentgallery_image_attachment_fields_to_edit($form_fields, $post) {
	// $form_fields is a an array of fields to include in the attachment form
	// $post is nothing but attachment record in the database
	//     $post->post_type == 'attachment'
	// attachments are considered as posts in WordPress. So value of post_type in wp_posts table will be attachment
	// now add our custom field to the $form_fields array
	// input type="text" name/id="attachments[$attachment->ID][custom1]"
	$form_fields["rt-image-link"] = array(
		"label" => __("Video Embed Code"),
		"input" => "textarea", // this is default if "input" is omitted
		"value" => get_post_meta($post->ID, "_rt-image-link", true),
                "helps" => __("Enter embed code for YouTube, Vimeo, etc to embed a video in the attachment slideshow."),
	);
   return $form_fields;
}

// now attach our function to the hook
add_filter("attachment_fields_to_edit", "attachmentgallery_image_attachment_fields_to_edit", null, 2);

function attachmentgallery_image_attachment_fields_to_save($post, $attachment) {
	// $attachment part of the form $_POST ($_POST[attachments][postID])
        // $post['post_type'] == 'attachment'
	if( isset($attachment['rt-image-link']) ){
		// update_post_meta(postID, meta_key, meta_value);
		update_post_meta($post['ID'], '_rt-image-link', $attachment['rt-image-link']);
	}
	return $post;
}
// now attach our function to the hook.
add_filter("attachment_fields_to_save", "attachmentgallery_image_attachment_fields_to_save", null , 2);

?>