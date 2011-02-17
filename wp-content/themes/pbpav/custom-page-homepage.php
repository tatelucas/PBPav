<?php
/*
Template Name: Homepage
*/
?>

<?php get_header(); ?>

<div id="content">


<?php
$page = (get_query_var('paged')) ? get_query_var('paged') : 1;
query_posts("showposts=6&paged=$page");
?>

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		
		<h2 class="posttitle"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
		<p class="postmetadata"><em><?php _e('by','gravy'); ?></em> <?php the_author_posts_link('namefl'); ?> <em><?php _e('on','gravy'); ?></em> <?php the_time('M d, Y'); ?> 
     <span class="commentcount">(<?php comments_popup_link('0', '1', '%'); ?>) <?php _e('Comments','gravy'); ?></span>
</p>


		<div class="entry">
		<?php the_content(); ?>
		</div>
		</div>
	<?php endwhile; ?>

		  <?php numeric_pagination(); ?>


	<?php else : ?>
	
	<p><?php _e('Not Found','gravy'); ?></p>

	<?php endif; ?>

</div><!--/content-->


<?php get_footer(); ?>
