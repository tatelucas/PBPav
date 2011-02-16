<?php get_header(); ?>

	<div id="content">

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		
				 <?php include (TEMPLATEPATH . '/includes/loop.php'); ?>

        <?php comments_template(); ?>
        
		<?php endwhile; else: ?>

		<p><?php _e('Not Found','gravy'); ?></p>

<?php endif; ?>
        
    </div><!--/content-->

<?php get_sidebar(); ?>

<?php get_footer(); ?>