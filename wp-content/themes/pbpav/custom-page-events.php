<?php
/*
Template Name: Events
*/
?>

<?php get_header(); ?>

<div id="content">


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

</div><!--/content-->

<?php get_sidebar(); ?>

<?php get_footer(); ?>
