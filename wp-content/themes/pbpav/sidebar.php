<div id="sidebar">


<!--Begin Related Posts-->		
	<?php
		if ( is_single() ) :
		global $post;
		$categories = get_the_category();
		foreach ($categories as $category) :
   		$posts = get_posts('numberposts=4&exclude=' . $GLOBALS['current_id'] . '&category='. $category->term_id);
		//To change the number of posts, edit the 'numberposts' parameter above
		if(count($posts) > 1) {
	?>
	
	<div class="widget" id="more-category">
	<h3 class="widgettitle"><?php _e('More in','gravy'); ?> &#8216;<?php echo $category->name; ?>&#8217;</h3>
	<ul>
	<?php foreach($posts as $post) : ?>
	<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
	<?php endforeach; ?>
	</ul>
	</div>
	
	<?php } ?>

<?php endforeach; ?>
<?php endif; ?>

<!--/related posts-->



<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Sidebar Widgets') ) : ?><?php endif; ?>
 		

</div><!--/sidebar-->