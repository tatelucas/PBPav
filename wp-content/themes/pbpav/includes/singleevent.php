<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

  <?php
	$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); 
  $eventtime = get_post_meta($post->ID, 'datetime');         
  $endeventtime = get_post_meta($post->ID, 'enddatetime');      
  $buylink = get_post_meta($post->ID, 'infolink');
  $pricing = get_post_meta($post->ID, 'pricing');
  $parking = get_post_meta($post->ID, 'parking');
  $doorsopen = get_post_meta($post->ID, 'doorsopen');
  $promoter = get_post_meta($post->ID, 'promoter');
  $showtimes = get_post_meta($post->ID, 'showtimes');  
        
  if ($image[0]) {
  ?>
  <div class="eventtopimg">
  <img src="<?php bloginfo('template_url'); ?>/scripts/timthumb.php?src=<?php echo $image[0] ?>&amp;h=399&amp;w=634px&amp;zc=1" alt="" />
  </div>
  <?php
  }
  ?>

 <a class="singleeventbynow" href="<?php echo $buylink[0]; ?>" target="_blank">Buy Now</a>

 <h1 class="posttitle"><?php the_title(); ?></h1>

 <p class="singleeventdate">
	  <?php
	  if (strlen($endeventtime[0]) > 0) {
	  ?>
	  <?php echo date('l F d', $eventtime[0]); ?> - <?php echo date('l F d, Y', $endeventtime[0]); ?>
	  <?php
	  } else {
	  ?>
	  <?php echo date('l F d, Y g:ia', $eventtime[0]); ?>
	  <?php
	  } 
	  ?>
 </p>


<div class="entry">

  <div class="badgecont">
  <div class="facebook-like-box">
    <h5>Share This Event</h5>
    <div class="fbbox">
      <iframe src="http://www.facebook.com/plugins/like.php?href=<?php echo the_permalink(); ?>&amp;layout=standard&amp;show_faces=false&amp;width=200&amp;action=like&amp;colorscheme=light&amp;height=35" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:200px; height:45px;" allowTransparency="true"></iframe>
    </div><!--/fbbox-->
  </div><!--/facebook-like-box-->
  <div class="badges">
<span class="st_twitter_vcount" displayText="Tweet"></span><span class="st_facebook_vcount" displayText="Share"></span><span class="st_email_vcount" displayText="Email"></span>
  </div><!--/badges-->
  </div><!--/badgecont-->

	<div class="eventmeta">
	  <p>
	  <strong>When:</strong>
	  <br />
	  <?php
	  if (strlen($endeventtime[0]) > 0) {
	  ?>
	  <?php echo date('l F d', $eventtime[0]); ?> - <?php echo date('l F d, Y', $endeventtime[0]); ?>
	  <?php
	  } else {
	  ?>
	  <?php echo date('l F d, Y g:ia', $eventtime[0]); ?>
	  <?php
	  }
	  ?>
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
	  
	  if ($showtimes[0]) {
	    echo '<div class="showtimes"><strong>Show Times</strong><br />' . wpautop($showtimes[0]) . '</div>';	  
	  }
	  
	  if ($pricing[0]) {
	    echo '<div class="showtimes"><strong>Ticket Information (Pricing)</strong><br />' . wpautop($pricing[0]) . '</div>';
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

	<?php the_content(); ?>
	
	<?php comments_template(); ?>
	
    
<?php edit_post_link(__('Edit this entry','gravy'), '<p id="wp-edit">', ' &rsaquo;</p>'); ?>

 </div><!--/end entry-->
</div><!--/end post-->
