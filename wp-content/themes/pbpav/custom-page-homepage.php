<?php
/*
Template Name: Homepage
*/
?>

<?php get_header(); ?>

<div id="content">

  <div class="homepageslidercont">
    <!-- Slider goes here -->
    
  </div><!--/homepageslidercont-->

  <div class="homepagecontent">

    <div id="tabs">
    	<ul>
    		<li><a href="#tabs-1">Events</a></li>
    		<li><a href="#tabs-2">News</a></li>
    		<li class="last"><a href="#tabs-3">Promos</a></li>
    	</ul>
    	<div id="tabs-1">
    
        <?php
        $page = (get_query_var('paged')) ? get_query_var('paged') : 1;
        query_posts("post_type=event&showposts=6&paged=$page");
        ?>
        
        	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
          <?php include (TEMPLATEPATH . '/includes/eventloop.php'); ?>
        	<?php endwhile; ?>
        
        		  <?php numeric_pagination(); ?>
        
        
        	<?php else : ?>
        	
        	<p><?php _e('Not Found','gravy'); ?></p>
        
        	<?php endif; ?>
    
        <a href="/events/" class="moreevents">More</a>
    
        <div class="clear"></div>
    
    	</div><!--/tabs-1-->
    	
    	
    	<div id="tabs-2">
    	
        <div class="homenewscont">
        <?php
        query_posts("showposts=6");
        ?>

        	<?php 
        	  if (have_posts()) : while (have_posts()) : the_post(); 
            $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );             	
        	?>
            
            <div class="homeevent">        		
        		  <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
              <a href="<?php the_permalink(); ?>">
                <img src="<?php bloginfo('template_url'); ?>/scripts/timthumb.php?src=<?php echo $image[0] ?>&h=95&w=152px&zc=1" alt="" />
              </a>
              <div class="eventdetails">
            		<h4 class="posttitle"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h4>     
                <div class="eventexcerpt">
              		<div class="entry">
              		<?php the_excerpt(); ?>
              		</div><!--/entry-->
              	</div><!--/eventexcerpt-->	
            	</div><!--/eventdetails-->	
            	<div class="eventlinks">
                <a href="<?php the_permalink(); ?>" class="eventmore">More Info</a>
              </div><!--/eventlinks-->
        		</div><!--/post-->
        		<div class="clear"></div>
        	</div><!--/homeevent-->	
      	
      	<?php endwhile; ?>
      
        <?php //numeric_pagination(); ?>
      	
      	<?php else : ?>
      	<p><?php _e('Not Found','gravy'); ?></p>
      	<?php endif; ?>

    
        <a href="/news/" class="moreevents">More</a>
    
        <div class="clear"></div>
    
    
        </div><!--/homenews-->
    	</div><!--/tabs-2-->
    	<div id="tabs-3">
    		<p>Mauris eleifend est et turpis. Duis id erat. Suspendisse potenti. Aliquam vulputate, pede vel vehicula accumsan, mi neque rutrum erat, eu congue orci lorem eget lorem. Vestibulum non ante. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Fusce sodales. Quisque eu urna vel enim commodo pellentesque. Praesent eu risus hendrerit ligula tempus pretium. Curabitur lorem enim, pretium nec, feugiat nec, luctus a, lacus.</p>
    		<p>Duis cursus. Maecenas ligula eros, blandit nec, pharetra at, semper at, magna. Nullam ac lacus. Nulla facilisi. Praesent viverra justo vitae neque. Praesent blandit adipiscing velit. Suspendisse potenti. Donec mattis, pede vel pharetra blandit, magna ligula faucibus eros, id euismod lacus dolor eget odio. Nam scelerisque. Donec non libero sed nulla mattis commodo. Ut sagittis. Donec nisi lectus, feugiat porttitor, tempor ac, tempor vitae, pede. Aenean vehicula velit eu tellus interdum rutrum. Maecenas commodo. Pellentesque nec elit. Fusce in lacus. Vivamus a libero vitae lectus hendrerit hendrerit.</p>
    	</div><!--/tabs-3-->
    
    </div><!--/tabs-->

  </div><!--/homepagecontent-->

</div><!--/content-->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
