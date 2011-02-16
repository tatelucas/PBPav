<?php
/*
Template Name: Full Width
*/
?>

<?php get_header(); ?>


		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		
				 <?php include (TEMPLATEPATH . '/includes/loop.php'); ?>

        <?php comments_template(); ?>
        
		<?php endwhile; else: ?>

		<p><?php _e('Not Found','gravy'); ?></p>

<?php endif; ?>
        


<?php get_footer(); ?>