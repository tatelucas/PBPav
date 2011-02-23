<?php get_header(); ?>

	<div id="content">

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
 	
	<?php 
      // excludes this post from 'Related posts' in the sidebar
      $GLOBALS['current_id'] = $post->ID; 
	    $posttype = get_post_type($post->ID);
	    ?>
	 
		 <?php 
		 if ($posttype == 'event') {
		   include (TEMPLATEPATH . '/includes/singleevent.php'); 
		 } else {
		   include (TEMPLATEPATH . '/includes/loop.php'); 		 
       comments_template();
		 }  
		 ?>



	<?php endwhile; else: ?>

		<p><?php _e('Not Found','gravy'); ?></p>

<?php endif; ?>

</div><!--/content-->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
