<?php get_header(); ?>

	<div id="content">

  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<?php $attachment_link = get_the_attachment_link($post->ID, true, array(300, 300)); ?>
<?php $_post = &get_post($post->ID); $classname = ($_post->iconsize[0] <= 128 ? 'small' : '') . 'attachment'; ?>

		<div class="post">
        
        <div class="entry">
        
        <h1 class="pagetitle">&#8216;<?php the_title(); ?>&#8217;</h1>
        
		<?php echo $attachment_link; ?>
       
        <h2><a href="<?php echo get_permalink($post->post_parent); ?>" rev="attachment">&laquo;<?php _e('Back','gravy'); ?></a></h2>
        
		</div><!--/entry-->
		</div><!--/post-->

	<?php comments_template(); ?>
	<?php endwhile; else: ?>

		<p><?php _e('Not Found','gravy'); ?></p>

<?php endif; ?>

	</div><!--/content-->

<?php get_sidebar(); ?>
<?php get_footer(); ?>