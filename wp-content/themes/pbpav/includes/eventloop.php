		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		
        	<?php 
            $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );             	
        	?>
            
            <div class="homeevent">        		
        		  <div id="homeevent-post-<?php the_ID(); ?>" <?php post_class(); ?>>
              <a href="<?php the_permalink(); ?>">
                <img src="<?php bloginfo('template_url'); ?>/scripts/timthumb.php?src=<?php echo $image[0] ?>&amp;h=105&amp;w=152px&amp;zc=1" alt="" />
              </a>
              <div class="eventdetails">
            		<h4 class="posttitle"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h4>     

                <?php 
                $eventtime = get_post_meta($post->ID, 'datetime'); 
                $endeventtime = get_post_meta($post->ID, 'enddatetime'); 
                $buylink = get_post_meta($post->ID, 'infolink');
            
                if (strlen($eventtime[0]) > 0) { 
                ?>
                <p class="eventdate">                
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
                }
                ?>
                <div class="eventexcerpt">
              		<div class="entry">
              		<?php the_excerpt(); ?>
              		</div><!--/entry-->
              	</div><!--/eventexcerpt-->	
            	</div><!--/eventdetails-->	
            	<div class="eventlinks">
                <a href="<?php the_permalink(); ?>" class="eventmore">More Info</a>
                <a href="<?php echo htmlspecialchars($buylink[0]); ?>" target="_blank" class="eventbuy">Buy Now</a>                 
              </div><!--/eventlinks-->
        		</div><!--/post-->
        		<div class="clear"></div>
        	</div><!--/homeevent-->	  


		</div>