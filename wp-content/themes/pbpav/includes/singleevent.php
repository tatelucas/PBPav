<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

  <?php
	$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); 
  $eventtime = get_post_meta($post->ID, 'datetime');         
  $buylink = get_post_meta($post->ID, 'infolink');
  $pricing = get_post_meta($post->ID, 'pricing');
  $parking = get_post_meta($post->ID, 'parking');
  $doorsopen = get_post_meta($post->ID, 'doorsopen');
  $promoter = get_post_meta($post->ID, 'promoter');
  
        
  if ($image[0]) {
  ?>
    <img src="<?php bloginfo('template_url'); ?>/scripts/timthumb.php?src=<?php echo $image[0] ?>&h=399&w=634px&zc=1" alt="" />
  <?php
  }
  ?>

 <a class="singleeventbynow" href="<?php echo $buylink[0]; ?>">Buy Now</a>

 <h1 class="posttitle"><?php the_title(); ?></h1>

 <p class="singleeventdate"><?php echo date('l F d, g:ia', $eventtime[0]); ?></p>


<div class="entry">

  <div class="badgecont">
  <div class="facebook-like-box">
    <h5>Share This Event</h5>
    <div class="fbbox">
      <iframe src="http://www.facebook.com/plugins/like.php?href=<?php echo the_permalink(); ?>&amp;layout=standard&amp;show_faces=false&amp;width=200&amp;action=like&amp;colorscheme=light&amp;height=35" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:200px; height:35px;" allowTransparency="true"></iframe>
    </div><!--/fbbox-->
  </div><!--/facebook-like-box-->
  <div class="badges">
<span class="st_twitter_vcount" displayText="Tweet"></span><span class="st_facebook_vcount" displayText="Share"></span><span class="st_email_vcount" displayText="Email"></span>
  </div><!--/badges-->
  </div><!--/badgecont-->

	<?php the_content(); ?>
	
	<div class="eventmeta">
	  <p>
	  <strong>When:</strong>
	  <br />
	  <?php echo date('l F d, Y g:ia', $eventtime[0]); ?>
	  </p>

	  <?php 
	  $terms = get_the_terms($post->ID, 'location'); 
	  if ($terms) {
	    foreach ($terms as $location) {
        ?>
    	  <p>
    	  <strong>Where:</strong>
    	  <br />        
        <?php
	      echo $location->name;
        ?>
	      </p>        
        <?php
	    }
	  }
	  
	  if ($pricing[0]) {
	    echo '<p><strong>Ticket Information (Pricing)</strong><br />' . $pricing[0] . '</p>';
	  }

	  if ($parking[0]) {
	    echo '<p><strong>Parking Info (Time and costs)</strong><br />' . $parking[0] . '</p>';
	  }

	  if ($doorsopen[0]) {
	    echo '<p><strong>Doors Open</strong><br />' . $doorsopen[0] . '</p>';
	  }

	  if ($promoter[0]) {
	    echo '<p><strong>Promoter</strong><br />' . $promoter[0] . '</p>';
	  }

	  
	  ?>

	</div>
    
<?php edit_post_link(__('Edit this entry','gravy'), '<p id="wp-edit">', ' &rsaquo;</p>'); ?>

 </div><!--/end entry-->
</div><!--/end post-->
