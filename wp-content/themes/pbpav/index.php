<?php get_header(); ?>

<div id="content">
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
  
  <?php include (TEMPLATEPATH . '/includes/loop.php'); ?>
  <?php endwhile; ?>
  <?php numeric_pagination(); ?>
  
  <?php else : ?>
  <h2><?php _e('Not Found','gravy'); ?></h2>
   
   <?php endif; ?>
</div>
<!--/content-->
<?php get_sidebar(); ?>
<?php get_footer(); ?>
