<?php
/*
Template Name: News
*/
?>

<?php get_header(); ?>

<div id="content">


<?php
$page = (get_query_var('paged')) ? get_query_var('paged') : 1;
query_posts("showposts=6&paged=$page");
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

		  <?php numeric_pagination(); ?>


	<?php else : ?>
	
	<p><?php _e('Not Found','gravy'); ?></p>

	<?php endif; ?>

</div><!--/content-->

<?php get_sidebar(); ?>

<?php get_footer(); ?>
